<!-- Logic xử lý Frontend (Javascript) -->
<script>
    /**
     * Cấu hình toàn cục
     */
    const IS_AUTHENTICATED = document.body.dataset.auth === '1';

    /**
     * Công cụ gọi API (AJAX Helper)
     * Tự động đính kèm CSRF Token và xử lý kết quả trả về dạng JSON.
     */
    const Api = {
        async fetch(url, options = {}) {
            // Chuẩn hóa URL sang dạng tương đối để tránh lỗi 404 trên các môi trường khác nhau
            const cleanUrl = url.startsWith('/') ? url.substring(1) : url;

            const config = {
                ...options,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]')?.value || '{{ csrf_token() }}',
                    ...options.headers
                }
            };
            if (options.body && typeof options.body === 'object') {
                config.body = JSON.stringify(options.body);
            }

            try {
                const res = await fetch(cleanUrl, config);
                const data = await res.json();
                if (!res.ok) throw {
                    status: res.status,
                    data
                };
                return data;
            } catch (err) {
                console.error(`[Api Error] ${cleanUrl}:`, err);
                throw err;
            }
        }
    };

    /**
     * Bộ điều khiển Modal (Ẩn/Hiện)
     */
    const Modal = {
        init() {
            // Đóng khi nhấn nền (Backdrop)
            window.addEventListener('click', (e) => {
                if (e.target.classList.contains('fixed') && e.target.id.endsWith('Modal')) {
                    this.close(e.target.id);
                }
            });

            // Đóng khi nhấn phím ESC
            window.addEventListener('keydown', (e) => {
                const isEscape = e.key === 'Escape' || e.key === 'Esc' || e.keyCode === 27;
                if (isEscape) {
                    // Tìm tất cả modal đang mở (không có class hidden)
                    document.querySelectorAll('[id$="Modal"]:not(.hidden)').forEach(modal => {
                        this.close(modal.id);
                    });
                }
            });
        },
        open(id) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.remove('hidden');
                el.classList.add('flex');
            }
        },
        close(id) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.add('hidden');
                el.classList.remove('flex');
            }
        },
        switch (oldId, newId) {
            this.close(oldId);
            this.open(newId);
        }
    };

    // Khởi tạo tính năng đóng khi nhấn nền
    Modal.init();

    /**
     * Hiển thị lỗi ngay trên ô nhập liệu
     */
    const ErrorUI = {
        show(inputEl, msg) {
            if (!inputEl) return;
            let container = inputEl.closest('.group') || inputEl.parentElement;
            let errorEl = container.querySelector('.input-error');
            if (!errorEl) {
                errorEl = document.createElement('div');
                errorEl.className = 'input-error absolute -top-11 left-6 text-rose-500 text-[10px] font-black uppercase tracking-widest mt-1 bg-white px-3 py-1.5 rounded-xl shadow-lg border border-rose-100 animate-in fade-in slide-in-from-bottom-2 z-20';

                // Thiết kế riêng cho form trong Modal (Login/Register)
                if (container.classList.contains('group')) {
                    errorEl.className = 'input-error absolute right-4 top-0 text-rose-500 text-[9px] font-black uppercase tracking-[0.1em] animate-in fade-in slide-in-from-right-2 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-100 z-10';
                    container.style.position = 'relative';
                } else {
                    container.style.position = container.style.position || 'relative';
                }

                inputEl.parentElement.insertBefore(errorEl, inputEl);
            }
            errorEl.innerHTML = `${msg}`;
            inputEl.classList.add('!border-rose-400', '!bg-rose-50/50');
        },
        clear(formEl) {
            formEl.querySelectorAll('.input-error').forEach(e => e.remove());
            formEl.querySelectorAll('input').forEach(input => {
                input.classList.remove('!border-rose-400', '!bg-rose-50/50');
            });
        }
    };

    /**
     * Bộ hiển thị thông báo góc dưới màn hình (Toast)
     */
    const Toast = {
        show(message, type = 'info') {
            // Xóa toast cũ nếu có
            if (this.currentToast) this.currentToast.remove();

            const toast = document.createElement('div');
            toast.className = `fixed bottom-4 right-4 md:bottom-10 md:right-10 px-6 py-4 rounded-2xl shadow-xl z-[100] transform transition-all duration-300 translate-y-10 opacity-0 flex items-center gap-3 font-black text-xs md:text-sm tracking-wide uppercase`;

            const icons = {
                success: `<svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`,
                error: `<svg class="w-5 h-5 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>`,
                info: `<svg class="w-5 h-5 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`
            };

            const styles = {
                success: 'bg-emerald-900 border-emerald-800 text-emerald-50',
                error: 'bg-rose-900 border-rose-800 text-rose-50',
                info: 'bg-slate-900 border-slate-800 text-slate-50'
            };

            toast.classList.add(...styles[type].split(' '));
            toast.innerHTML = `${icons[type]} <span>${message}</span>`;
            document.body.appendChild(toast);
            this.currentToast = toast;

            // Animate in
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-10', 'opacity-0');
            });

            // Animate out sau 3s
            setTimeout(() => {
                toast.classList.add('translate-y-10', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    };

    /**
     * Logic xử lý Xác thực (Login / Register)
     */
    const Auth = {
        async handleLogin(e) {
            e.preventDefault();
            const form = e.target;
            ErrorUI.clear(form);

            const formData = new FormData(form);
            const email = formData.get('email');
            const password = formData.get('password');
            let error = false;

            if (!email) {
                ErrorUI.show(form.querySelector('[name=email]'), 'Vui lòng nhập email');
                error = true;
            }
            if (!password) {
                ErrorUI.show(form.querySelector('[name=password]'), 'Vui lòng nhập mật khẩu');
                error = true;
            }
            if (error) return;

            try {
                await Api.fetch('api/login', {
                    method: 'POST',
                    body: Object.fromEntries(formData)
                });
                window.location.assign('./');
            } catch (err) {
                ErrorUI.show(form.querySelector('[name=password]'), err.data?.message || 'Thông tin đăng nhập không hợp lệ.');
            }
        },
        async handleRegister(e) {
            e.preventDefault();
            const form = e.target;
            ErrorUI.clear(form);

            const formData = new FormData(form);
            const name = formData.get('name');
            const email = formData.get('email');
            const password = formData.get('password');
            const password_conf = formData.get('password_confirmation');
            let error = false;

            if (!name) {
                ErrorUI.show(form.querySelector('[name=name]'), 'Vui lòng nhập họ tên');
                error = true;
            }
            if (!email) {
                ErrorUI.show(form.querySelector('[name=email]'), 'Vui lòng nhập email');
                error = true;
            }
            if (!password) {
                ErrorUI.show(form.querySelector('[name=password]'), 'Vui lòng nhập mật khẩu');
                error = true;
            }
            if (!password_conf) {
                ErrorUI.show(form.querySelector('[name=password_confirmation]'), 'Vui lòng xác nhận mật khẩu');
                error = true;
            }
            if (password && password_conf && password !== password_conf) {
                ErrorUI.show(form.querySelector('[name=password_confirmation]'), 'Mật khẩu xác nhận không khớp');
                error = true;
            }
            if (error) return;

            try {
                await Api.fetch('api/register', {
                    method: 'POST',
                    body: Object.fromEntries(formData)
                });
                window.location.assign('./');
            } catch (err) {
                const msg = err.data?.errors ? Object.values(err.data.errors).flat().join('<br>') : (err.data?.message || 'Lỗi đăng ký');
                ErrorUI.show(form.querySelector('[name=email]'), msg);
            }
        }
    };

    /**
     * Bộ quản lý liên kết (Shorten / Stats / Delete)
     */
    const LinkManager = {
        isShortened: false,

        async handleShorten(e) {
            e.preventDefault();
            const input = document.getElementById('url');
            const customInput = document.getElementById('customCode');
            const btn = document.getElementById('btnSubmit');
            const qrContainer = document.getElementById('qrContainer');
            const qrImage = document.getElementById('qrImage');

            ErrorUI.clear(e.target);

            if (!input.value.trim()) {
                ErrorUI.show(input, 'Vui lòng dán link muốn rút gọn vào đây!');
                input.focus();
                return;
            }

            if (this.isShortened) {
                navigator.clipboard.writeText(input.value);
                const originalText = btn.innerHTML;
                btn.innerHTML = 'COPIED! ✨';
                setTimeout(() => {
                    btn.innerHTML = originalText;
                }, 2000);
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '✨ SNAPPING...';

            try {
                const data = await Api.fetch('api/shorten', {
                    method: 'POST',
                    body: {
                        url: input.value,
                        custom_code: customInput ? customInput.value : null
                    }
                });

                input.value = data.short_url;
                this.isShortened = true;
                btn.innerHTML = 'Sao chép link';
                btn.classList.add('bg-brand-green');
                btn.classList.remove('bg-brand-blue');

                if (data.qr_code) {
                    this.showQR(data.short_url, data.qr_code);
                }

                if (IS_AUTHENTICATED) {
                    this.loadStats();
                    this.loadLogs();
                    this.loadChart();
                }
                Toast.show('Rút gọn liên kết thành công!', 'success');
            } catch (err) {
                const msg = err.data?.message || 'URL không hợp lệ hoặc mã tùy chỉnh đã tồn tại.';
                ErrorUI.show(input, msg);
                this.resetBtn();
            } finally {
                btn.disabled = false;
            }
        },

        resetBtn() {
            this.isShortened = false;
            this.currentShortUrl = null;
            const btn = document.getElementById('btnSubmit');
            const input = document.getElementById('url');
            const stickyInput = document.getElementById('stickyUrl');
            const customInput = document.getElementById('customCode');
            const qrContainer = document.getElementById('qrContainer');
            const clearBtn = document.getElementById('clearUrl');
            const stickyClearBtn = document.getElementById('stickyClearUrl');

            if (qrContainer) {
                qrContainer.classList.add('hidden');
                qrContainer.classList.remove('flex');
            }

            if (input) input.value = '';
            if (stickyInput) stickyInput.value = '';
            if (customInput) customInput.value = '';
            
            if (clearBtn) clearBtn.classList.add('hidden');
            if (stickyClearBtn) stickyClearBtn.classList.add('hidden');

            const form = document.querySelector('form[onsubmit="LinkManager.handleShorten(event)"]');
            if (form) ErrorUI.clear(form);

            if (btn) {
                btn.innerHTML = 'Rút gọn link';
                btn.classList.add('bg-brand-blue');
                btn.classList.remove('bg-brand-green');
            }
        },

        clearInput(id) {
            const input = document.getElementById(id);
            if (input) {
                input.value = '';
                input.focus();
                this.resetBtn();
                
                // Cập nhật nút Clear liên quan
                const clearBtn = document.getElementById('clearUrl');
                const stickyClearBtn = document.getElementById('stickyClearUrl');
                if (clearBtn) clearBtn.classList.add('hidden');
                if (stickyClearBtn) stickyClearBtn.classList.add('hidden');
            }
        },

        async loadStats() {
            const statsBody = document.getElementById('statsBody');
            if (!statsBody) return;

            try {
                const data = await Api.fetch('api/stats');
                statsBody.innerHTML = '';

                if (data.length === 0) {
                    statsBody.innerHTML = `
                        <div class="bg-white rounded-[40px] p-20 shadow-sm border border-slate-100 flex flex-col items-center gap-4">
                            <span class="text-[10px] font-black text-slate-200 uppercase tracking-[0.2em]">Chưa có bản ghi nào.</span>
                        </div>
                    `;
                    return;
                }

                const LIMIT = 5;
                data.forEach((link, index) => {
                    const menuId = 'menu-' + Math.random().toString(36).substr(2, 8);
                    const card = document.createElement('div');
                    card.className = "p-5 md:p-6 hover:bg-slate-50/50 transition-all group relative border-b border-slate-200 last:border-0" + (index >= LIMIT ? ' hidden stats-extra' : '');
                    card.innerHTML = `
                        <div class="flex flex-col gap-3">
                            <!-- Nút Menu (3 chấm) - Căn giữa chiều dọc bên phải -->
                            <div class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 z-10">
                                <button onclick="LinkManager.toggleMenu('${menuId}')" class="p-2 text-slate-300 hover:text-brand-blue transition-all active:scale-90">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </button>
                                
                                <div id="${menuId}" class="absolute right-0 top-1/2 -translate-y-1/2 mt-8 md:mt-10 w-40 md:w-48 bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 hidden z-50 overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                                    <div class="p-1.5 space-y-0.5">
                                        <a href="${link.original_url}" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[10px] font-black text-slate-600 hover:bg-slate-50 hover:text-brand-blue transition-all uppercase tracking-widest text-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                            Link gốc
                                        </a>
                                        <button onclick="LinkManager.showQR('${link.full_short_url}')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-[10px] font-black text-slate-600 hover:bg-slate-50 hover:text-brand-blue transition-all uppercase tracking-widest text-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                                            Mã QR
                                        </button>
                                        <button onclick="LinkManager.deleteLink('${link.id}')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-[10px] font-black text-rose-500 hover:bg-rose-50 transition-all uppercase tracking-widest text-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            Xoá link
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="pr-14 md:pr-16 space-y-3">
                                <!-- Link Gốc -->
                                <h4 class="text-[11px] md:text-sm font-bold text-slate-400 truncate opacity-70 mb-0.5" title="${link.original_url}">
                                    ${link.original_url.replace(/^https?:\/\//, '')}
                                </h4>
                                
                                <!-- Link Rút gọn - HIỂN THỊ ĐẦY ĐỦ VỚI KÍCH THƯỚC HỢP LÝ -->
                                <div class="flex flex-wrap items-center gap-2 md:gap-4">
                                    <a href="${link.full_short_url}" target="_blank" class="text-brand-blue font-black text-sm md:text-lg hover:bg-blue-50/50 px-1 rounded-lg transition-all decoration-brand-blue hover:underline underline-offset-8 decoration-2 whitespace-normal break-all">
                                        ${link.full_short_url.replace(/^https?:\/\//, '')}
                                    </a>
                                    <button onclick="Utils.copyToClipboard('${link.full_short_url}', this)" class="bg-blue-100/50 text-brand-blue text-[9px] md:text-[10px] font-black px-4 py-2 rounded-xl hover:bg-brand-blue hover:text-white transition-all uppercase tracking-widest leading-none shadow-sm border border-blue-200/50 h-fit">
                                        Sao chép
                                    </button>
                                </div>

                                <!-- Thống kê phụ -->
                                <div class="flex items-center gap-6 md:gap-10 pt-1">
                                    <div class="flex items-center gap-1.5 opacity-60">
                                        <div class="w-1.5 h-1.5 bg-slate-200 rounded-full"></div>
                                        <span class="text-[8px] md:text-[9px] font-bold text-slate-400 uppercase tracking-widest whitespace-nowrap">${link.created_at}</span>
                                    </div>
                                    <span class="text-[9px] md:text-[11px] font-black text-brand-blue uppercase tracking-widest flex items-center gap-2 bg-white px-3 py-1.5 rounded-full leading-none border border-blue-50 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5 text-brand-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                                        ${link.clicks} Click
                                    </span>
                                </div>
                            </div>
                        </div>
                    `;
                    statsBody.appendChild(card);
                });

                // Nút "Xem thêm / Thu gọn" duy nhất và căn giữa
                if (data.length > LIMIT) {
                    const remaining = data.length - LIMIT;
                    const toggleArea = document.createElement('div');
                    toggleArea.className = 'border-t border-slate-100 bg-slate-50/30';
                    toggleArea.innerHTML = `
                        <button id="statsToggleBtn" onclick="LinkManager.toggleShowAll('stats')" class="w-full py-4 text-[10px] font-black text-slate-400 hover:text-brand-blue hover:bg-white transition-all uppercase tracking-[0.2em] flex items-center justify-center gap-2 group">
                            <span id="statsToggleText">Xem thêm (còn ${remaining})</span>
                            <svg id="statsToggleIcon" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                    `;
                    statsBody.appendChild(toggleArea);
                }

                // Tải widget thống kê
                LinkManager.loadChart();
            } catch (e) {
                console.error('Stats loading failed.');
            }
        },

        async loadChart() {
            try {
                const d = await Api.fetch('api/chart');

                // Hiện widget, ẩn skeleton
                const widget = document.getElementById('statsWidget');
                const skeleton = document.getElementById('statsWidgetSkeleton');
                if (skeleton) skeleton.remove();
                if (widget) widget.classList.remove('hidden');

                // Cập nhật card số liệu
                const setEl = (id, val) => {
                    const el = document.getElementById(id);
                    if (el) el.innerHTML = val;
                };
                setEl('statTotalLinks', d.total_links);
                setEl('statTodayLinks', `<span class="${d.today_links > 0 ? 'text-emerald-500' : 'text-slate-300'}">+${d.today_links} Hôm nay</span>`);
                setEl('statTotalClicks', d.total_clicks.toLocaleString('vi-VN'));
                setEl('statTodayClicks', `<span class="${d.today_clicks > 0 ? 'text-emerald-500' : 'text-slate-300'}">+${d.today_clicks} Hôm nay</span>`);

                // Vẽ biểu đồ
                const canvas = document.getElementById('clicksChart');
                if (!canvas || !window.Chart) return;

                const labels = d.daily_clicks.map(item => {
                    const dt = new Date(item.date);
                    return `${dt.getDate()} Tháng ${dt.getMonth() + 1}`;
                });
                const values = d.daily_clicks.map(item => item.count);

                const ctx = canvas.getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 140);
                gradient.addColorStop(0, 'rgba(37, 99, 235, 0.18)');
                gradient.addColorStop(1, 'rgba(37, 99, 235, 0.01)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels,
                        datasets: [{
                            data: values,
                            borderColor: '#2563eb',
                            borderWidth: 2,
                            backgroundColor: gradient,
                            fill: true,
                            tension: 0.4,
                            pointRadius: values.map(v => v > 0 ? 3 : 0),
                            pointBackgroundColor: '#2563eb',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: ctx => `${ctx.parsed.y} click`
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 10,
                                        weight: '700'
                                    },
                                    color: '#94a3b8'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#f1f5f9'
                                },
                                ticks: {
                                    font: {
                                        size: 10,
                                        weight: '700'
                                    },
                                    color: '#94a3b8',
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            } catch (e) {
                console.error('Chart loading failed.', e);
            }
        },

        async loadLogs() {
            const logsBody = document.getElementById('logsBody');
            if (!logsBody) return;

            try {
                const data = await Api.fetch('api/logs');
                logsBody.innerHTML = '';

                if (data.length === 0) {
                    logsBody.innerHTML = `
                        <div class="py-12 flex flex-col items-center gap-4 text-center px-6">
                            <span class="text-[10px] font-black text-slate-200 uppercase tracking-[0.2em]">Chưa có hoạt động.</span>
                        </div>
                    `;
                    return;
                }

                const LIMIT = 5;
                data.forEach((log, index) => {
                    const card = document.createElement('div');
                    card.className = "p-5 md:p-6 flex items-start gap-4 md:gap-5 hover:bg-slate-50/80 transition-all border-b border-slate-200 last:border-0" + (index >= LIMIT ? ' hidden logs-extra' : '');

                    const osIcon = log.os === 'Windows' ? '🪟' : (log.os === 'MacOS' ? '🍎' : '📱');
                    const browserIcon = log.browser === 'Chrome' ? '🌐' : '🧭';
                    const fullShort = `${window.location.host}/${log.short_code}`;

                    card.innerHTML = `
                        <div class="flex-1 min-w-0 space-y-3">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-2 md:gap-4">
                                <div class="flex flex-col space-y-1.5 min-w-0 overflow-hidden flex-1">
                                    <!-- Link Gốc lên trước -->
                                    <a href="${log.original_url}" target="_blank" class="text-sm md:text-base font-bold text-slate-800 hover:text-brand-blue truncate transition-colors decoration-2 hover:underline underline-offset-4" title="${log.original_url}">
                                        ${log.original_url.replace(/^https?:\/\//, '')}
                                    </a>
                                    <!-- Link Rút gọn có Domain -->
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                                        <span class="text-[11px] font-black text-brand-blue tracking-tight shrink-0">
                                            ${fullShort}
                                        </span>
                                    </div>
                                </div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap bg-slate-50 px-3 py-1.5 rounded-full">${log.created_at}</span>
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-2 md:gap-3 text-[9px] font-black uppercase tracking-widest leading-none pt-1">
                                <span class="flex items-center gap-1.5 text-emerald-700 bg-emerald-50 px-2.5 py-1.5 rounded-lg border border-emerald-100">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                    ${log.ip}
                                </span>
                                <span class="flex items-center gap-1.5 text-slate-600 bg-white border border-slate-200/60 px-2.5 py-1.5 rounded-lg shadow-sm">${osIcon} ${log.os}</span>
                                <span class="flex items-center gap-1.5 text-slate-600 bg-white border border-slate-200/60 px-2.5 py-1.5 rounded-lg shadow-sm">${browserIcon} ${log.browser}</span>
                            </div>
                        </div>
                    `;
                    logsBody.appendChild(card);
                });

                // Nút "Xem thêm / Thu gọn" duy nhất và căn giữa
                if (data.length > LIMIT) {
                    const remaining = data.length - LIMIT;
                    const toggleArea = document.createElement('div');
                    toggleArea.className = 'border-t border-slate-100 bg-slate-50/30';
                    toggleArea.innerHTML = `
                        <button id="logsToggleBtn" onclick="LinkManager.toggleShowAll('logs')" class="w-full py-4 text-[10px] font-black text-slate-400 hover:text-emerald-600 hover:bg-white transition-all uppercase tracking-[0.2em] flex items-center justify-center gap-2 group">
                            <span id="logsToggleText">Xem thêm (còn ${remaining})</span>
                            <svg id="logsToggleIcon" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                    `;
                    logsBody.appendChild(toggleArea);
                }

            } catch (e) {
                console.error('Logs loading failed.');
            }
        },

        showQR(shortUrl, qrUrl = null) {
            const qrModalImage = document.getElementById('qrModalImage');
            if (qrModalImage) {
                this.currentShortUrl = shortUrl;
                qrModalImage.src = qrUrl || `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(shortUrl)}`;
                Modal.open('qrModal');
                Toast.show('Đã tạo mã QR! ✨', 'info');
            }
        },

        async saveQR() {
            const qrImage = document.getElementById('qrModalImage');
            if (!qrImage || !qrImage.src) return;
            
            try {
                const response = await fetch(qrImage.src);
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `LinkSnap_QR_${Math.random().toString(36).substr(2, 6)}.png`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
                Toast.show('Đã tải mã QR về máy!', 'success');
            } catch (e) {
                console.error('Save QR error', e);
                Toast.show('Không thể tải mã QR. Thử chuột phải chọn "Lưu hình ảnh".', 'error');
            }
        },

        async shareLink() {
            const url = this.currentShortUrl || document.getElementById('url')?.value;
            if (!url) return;

            if (navigator.share) {
                try {
                    await navigator.share({
                        title: 'Chia sẻ liên kết từ LinkSnap',
                        text: 'Truy cập liên kết rút gọn của tôi:',
                        url: url
                    });
                } catch (e) {
                    if (e.name !== 'AbortError') console.error('Share error', e);
                }
            } else {
                navigator.clipboard.writeText(url);
                Toast.show('Trình duyệt không hỗ trợ chia sẻ. Đã copy link vào bộ nhớ!', 'info');
            }
        },

        toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            if (!menu) return;
            // Đóng tất cả menu đang mở trước
            document.querySelectorAll('[id^="menu-"]').forEach(m => {
                if (m.id !== menuId) m.classList.add('hidden');
            });
            menu.classList.toggle('hidden');
        },

        toggleShowAll(type) {
            const extraClass = type === 'stats' ? 'stats-extra' : 'logs-extra';
            const textId = type + 'ToggleText';
            const btnId = type + 'ToggleBtn';
            const collapseId = type + 'CollapseBtn';
            const STEP = 5;

            const hiddenCards = document.querySelectorAll('.' + extraClass + '.hidden');
            let shown = 0;
            hiddenCards.forEach(card => {
                if (shown < STEP) {
                    card.classList.remove('hidden');
                    shown++;
                }
            });

            // Hiện nút Ẩn bớt (bỏ opacity-0, pointer-events-none)
            const collapseBtn = document.getElementById(collapseId);
            if (collapseBtn) {
                collapseBtn.classList.remove('opacity-0', 'pointer-events-none');
            }

            const stillHidden = document.querySelectorAll('.' + extraClass + '.hidden').length;
            const textEl = document.getElementById(type + 'ToggleText');
            const iconEl = document.getElementById(type + 'ToggleIcon');
            const btn = document.getElementById(type + 'ToggleBtn');

            if (stillHidden === 0) {
                if (textEl) textEl.textContent = 'Thu gọn';
                if (iconEl) iconEl.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7" />';
                if (btn) {
                    btn.setAttribute('onclick', `LinkManager.collapseAll('${type}')`);
                    btn.classList.add('text-rose-400', 'hover:text-rose-600');
                    btn.classList.remove('text-slate-400');
                }
            } else {
                if (textEl) textEl.textContent = 'Xem thêm (còn ' + stillHidden + ')';
            }
        },

        collapseAll(type) {
            const extraClass = type === 'stats' ? 'stats-extra' : 'logs-extra';
            const allExtras = document.querySelectorAll('.' + extraClass);
            const total = allExtras.length;
            allExtras.forEach(card => card.classList.add('hidden'));

            const btn = document.getElementById(type + 'ToggleBtn');
            const textEl = document.getElementById(type + 'ToggleText');
            const iconEl = document.getElementById(type + 'ToggleIcon');

            if (btn) {
                btn.setAttribute('onclick', `LinkManager.toggleShowAll('${type}')`);
                btn.classList.remove('text-rose-400', 'hover:text-rose-600');
                btn.classList.add('text-slate-400');
            }
            if (textEl) textEl.textContent = 'Xem thêm (còn ' + total + ')';
            if (iconEl) iconEl.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />';
        },

        async deleteLink(id) {
            if (!confirm('Xác nhận tiêu hủy liên kết này?')) return;
            try {
                const res = await Api.fetch(`api/delete/${id}`, {
                    method: 'DELETE'
                });
                if (res.success) {
                    Toast.show('Liên kết đã bị tiêu hủy', 'success');
                    this.loadStats();
                    this.loadLogs();
                    this.loadChart();
                }
            } catch (e) {
                const msg = e.data?.error || e.data?.message || 'Không thể xóa liên kết này. Vui lòng thử lại.';
                Toast.show(msg, 'error');
                console.error('Delete error', e);
            }
        }
    };

    // Bấm ra ngoài để đóng menu
    document.addEventListener('click', function(e) {
        if (!e.target.closest('[id^="menu-"]') && !e.target.closest('button[onclick*="toggleMenu"]')) {
            document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
        }
    });


    /**
     * Tiện ích xử lý chuỗi (Loại bỏ dấu tiếng Việt và ký tự đặc biệt)
     */
    const StringHelper = {
        removeAccents(str) {
            return str.normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/đ/g, 'd').replace(/Đ/g, 'D')
                .replace(/[^a-zA-Z0-9]/g, ''); // Chỉ giữ lại chữ và số
        }
    };

    // Khởi tạo các sự kiện khi trang đã tải xong (DOMContentLoaded)
    document.addEventListener('DOMContentLoaded', () => {
        // Nếu đã đăng nhập, tự động tải danh sách link
        if (IS_AUTHENTICATED) {
            LinkManager.loadStats();
            LinkManager.loadLogs();
            LinkManager.loadChart();
        }

        // Đồng bộ 2 chiều: sticky ↔ ô nhập chính
        const mainInput = document.getElementById('url');
        const stickyInput = document.getElementById('stickyUrl');
        const clearBtn = document.getElementById('clearUrl');
        const stickyClearBtn = document.getElementById('stickyClearUrl');

        const updateClearBtn = (val) => {
            if (clearBtn) {
                if (val) clearBtn.classList.remove('hidden');
                else clearBtn.classList.add('hidden');
            }
            if (stickyClearBtn) {
                if (val) stickyClearBtn.classList.remove('hidden');
                else stickyClearBtn.classList.add('hidden');
            }
        };

        if (mainInput) {
            mainInput.addEventListener('input', () => {
                if (stickyInput) stickyInput.value = mainInput.value;
                updateClearBtn(mainInput.value);
                if (LinkManager.isShortened) LinkManager.resetBtn();
            });
        }

        if (stickyInput) {
            stickyInput.addEventListener('input', () => {
                if (mainInput) mainInput.value = stickyInput.value;
                updateClearBtn(stickyInput.value);
                if (LinkManager.isShortened) LinkManager.resetBtn();
            });
        }

        // Tự động bỏ dấu cho mã tùy chỉnh
        const customInput = document.getElementById('customCode');
        if (customInput) {
            customInput.addEventListener('input', (e) => {
                const originalValue = e.target.value;
                const normalizedValue = StringHelper.removeAccents(originalValue);
                if (originalValue !== normalizedValue) {
                    e.target.value = normalizedValue;
                }
            });
        }
    });
</script>