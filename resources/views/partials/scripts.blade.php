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
                const res = await fetch(url, config);
                const data = await res.json();
                if (!res.ok) throw { status: res.status, data };
                return data;
            } catch (err) {
                console.error(`[Api Error] ${url}:`, err);
                throw err;
            }
        }
    };

    /**
     * Bộ điều khiển Modal (Ẩn/Hiện)
     */
    const Modal = {
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
        switch(oldId, newId) { this.close(oldId); this.open(newId); }
    };

    /**
     * Logic xử lý Xác thực (Login / Register)
     */
    const Auth = {
        async handleLogin(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            try {
                await Api.fetch('/api/login', { method: 'POST', body: Object.fromEntries(formData) });
                window.location.assign('/');
            } catch (err) {
                alert(err.data?.message || 'Thông tin đăng nhập không hợp lệ.');
            }
        },
        async handleRegister(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            try {
                await Api.fetch('/api/register', { method: 'POST', body: Object.fromEntries(formData) });
                window.location.assign('/');
            } catch (err) {
                const msg = err.data?.errors ? Object.values(err.data.errors).flat().join('\n') : (err.data?.message || 'Lỗi đăng ký');
                alert(msg);
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

            if (this.isShortened) {
                navigator.clipboard.writeText(input.value);
                const originalText = btn.innerHTML;
                btn.innerHTML = 'COPIED! ✨';
                setTimeout(() => { btn.innerHTML = originalText; }, 2000);
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '✨ SNAPPING...';

            try {
                const data = await Api.fetch('/api/shorten', { 
                    method: 'POST', 
                    body: { 
                        url: input.value,
                        custom_code: customInput ? customInput.value : null
                    } 
                });
                
                input.value = data.short_url;
                this.isShortened = true;
                btn.innerHTML = 'Sao chép link';
                btn.classList.replace('bg-brand-blue', 'bg-brand-green');
                
                // Hiển thị mã QR
                if (data.qr_code && qrContainer && qrImage) {
                    qrImage.src = data.qr_code;
                    qrContainer.classList.remove('hidden');
                    qrContainer.classList.add('flex');
                }
                
                if (IS_AUTHENTICATED) {
                    this.loadStats();
                }
            } catch (err) {
                const msg = err.data?.message || 'Lỗi: URL không hợp lệ hoặc mã tùy chỉnh đã tồn tại.';
                alert(msg);
                this.resetBtn();
            } finally {
                btn.disabled = false;
            }
        },

        resetBtn() {
            this.isShortened = false;
            const btn = document.getElementById('btnSubmit');
            const input = document.getElementById('url');
            const customInput = document.getElementById('customCode');
            const qrContainer = document.getElementById('qrContainer');

            if (qrContainer) {
                qrContainer.classList.add('hidden');
                qrContainer.classList.remove('flex');
            }

            if (input) input.value = '';
            if (customInput) customInput.value = '';

            if (btn) {
                btn.innerHTML = 'Rút gọn link';
                btn.classList.add('bg-brand-blue');
                btn.classList.remove('bg-brand-green');
            }
        },

        async loadStats() {
            const statsBody = document.getElementById('statsBody');
            if (!statsBody) return;
            
            try {
                const data = await Api.fetch('/api/stats');
                statsBody.innerHTML = '';
                
                if (data.length === 0) {
                    statsBody.innerHTML = `
                        <div class="bg-white rounded-[40px] p-20 shadow-sm border border-slate-100 flex flex-col items-center gap-4">
                            <span class="text-[10px] font-black text-slate-200 uppercase tracking-[0.2em]">Chưa có bản ghi nào.</span>
                        </div>
                    `;
                    return;
                }

                data.forEach(link => {
                    const card = document.createElement('div');
                    card.className = "p-6 md:p-8 hover:bg-slate-50/50 transition-all group relative border-b border-slate-50 last:border-0";
                    card.innerHTML = `
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="space-y-3 flex-1 min-w-0">
                                <h4 class="text-base md:text-lg font-bold text-slate-800 truncate" title="${link.original_url}">
                                    ${link.original_url.replace(/^https?:\/\//, '')}
                                </h4>
                                <div class="flex flex-wrap items-center gap-3">
                                    <a href="${link.full_short_url}" target="_blank" class="text-brand-blue font-black text-xs md:text-sm hover:underline underline-offset-4 decoration-2 truncate max-w-[200px] md:max-w-none">
                                        ${link.full_short_url.replace(/^https?:\/\//, '')}
                                    </a>
                                    <button onclick="Utils.copyToClipboard('${link.full_short_url}', this)" class="bg-blue-50 text-brand-blue text-[9px] md:text-[10px] font-black px-4 py-1.5 rounded-full hover:bg-brand-blue hover:text-white transition-all uppercase tracking-widest">
                                        Sao chép
                                    </button>
                                </div>
                                <div class="flex items-center gap-4 md:gap-6 pt-2">
                                    <span class="text-[9px] md:text-[10px] font-black text-slate-300 uppercase tracking-widest">${link.created_at}</span>
                                    <span class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                        ${link.clicks} Click
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <button onclick="LinkManager.deleteLink(${link.id})" class="p-4 text-slate-200 md:text-slate-100 hover:text-rose-500 hover:bg-rose-50 rounded-3xl transition-all md:opacity-0 md:group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `;
                    statsBody.appendChild(card);
                });
            } catch (e) {
                console.error('Stats loading failed.');
            }
        },

        async loadLogs() {
            const logsBody = document.getElementById('logsBody');
            if (!logsBody) return;
            
            try {
                const data = await Api.fetch('/api/logs');
                logsBody.innerHTML = '';
                
                if (data.length === 0) {
                    logsBody.innerHTML = `
                        <div class="py-12 flex flex-col items-center gap-4 text-center px-6">
                            <span class="text-[10px] font-black text-slate-200 uppercase tracking-[0.2em]">Chưa có hoạt động.</span>
                        </div>
                    `;
                    return;
                }

                data.forEach(log => {
                    const card = document.createElement('div');
                    card.className = "p-5 md:p-6 flex items-start gap-4 md:gap-5 hover:bg-slate-50/50 transition-all border-b border-slate-50 last:border-0";
                    
                    // Icons mapping
                    const osIcon = log.os === 'Windows' ? '🪟' : (log.os === 'MacOS' ? '🍎' : '📱');
                    const browserIcon = log.browser === 'Chrome' ? '🌐' : '🧭';

                    card.innerHTML = `
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-slate-50 rounded-xl md:rounded-2xl flex items-center justify-center text-lg md:text-xl shadow-inner italic font-black text-brand-blue shrink-0">
                            /
                        </div>
                        <div class="flex-1 min-w-0 space-y-2">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-1 md:gap-4">
                                <div class="flex items-center gap-2 min-w-0">
                                    <span class="text-xs font-black text-slate-800 tracking-tight shrink-0">/${log.short_code}</span>
                                    <a href="${log.original_url}" target="_blank" class="text-[10px] font-medium text-slate-400 hover:text-brand-blue truncate hover:underline underline-offset-2" title="${log.original_url}">
                                        ${log.original_url.replace(/^https?:\/\//, '')}
                                    </a>
                                </div>
                                <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest whitespace-nowrap">${log.created_at}</span>
                            </div>
                            <div class="flex flex-wrap items-center gap-2 md:gap-3 text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">
                                <span class="flex items-center gap-1.5 text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">
                                    <span class="w-1 h-1 md:w-1.5 md:h-1.5 bg-emerald-500 rounded-full"></span>
                                    ${log.ip}
                                </span>
                                <span class="flex items-center gap-1">${osIcon} ${log.os}</span>
                                <span class="flex items-center gap-1">${browserIcon} ${log.browser}</span>
                            </div>
                        </div>
                    `;
                    logsBody.appendChild(card);
                });


            } catch (e) {
                console.error('Logs loading failed.');
            }
        },

        async deleteLink(id) {
            if (!confirm('Xác nhận tiêu hủy liên kết này?')) return;
            try {
                await Api.fetch(`/api/delete/${id}`, { method: 'DELETE' });
                this.loadStats();
                this.loadLogs();
            } catch (e) {
                alert('Không thể thực hiện yêu cầu.');
            }
        }
    };


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
        }

        
        // Lắng nghe sự kiện nhập URL để reset lại nút bấm
        document.getElementById('url')?.addEventListener('input', () => {
            if (LinkManager.isShortened) LinkManager.resetBtn();
        });

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

