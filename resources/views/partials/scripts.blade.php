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
                await Api.fetch('/login', { method: 'POST', body: Object.fromEntries(formData) });
                window.location.assign('/');
            } catch (err) {
                alert(err.data?.message || 'Thông tin đăng nhập không hợp lệ.');
            }
        },
        async handleRegister(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            try {
                await Api.fetch('/register', { method: 'POST', body: Object.fromEntries(formData) });
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
                    statsBody.innerHTML = `<tr><td colspan="4" class="px-8 py-20 text-center text-slate-300 font-bold uppercase tracking-widest text-xs italic">Chưa có bản ghi nào.</td></tr>`;
                    return;
                }

                data.forEach(link => {
                    const fullUrl = `${window.location.origin}/${link.short_code}`;
                    const row = document.createElement('tr');
                    row.className = "hover:bg-slate-50 transition-all group border-b border-slate-50/50 last:border-0 text-slate-900";
                    row.innerHTML = `
                        <td class="px-8 py-8 max-w-[200px] md:max-w-[300px] truncate text-slate-500 text-sm font-semibold italic" title="${link.original_url}">
                            ${link.original_url}
                        </td>
                        <td class="px-8 py-8 max-w-[250px] md:max-w-none">
                            <a href="${fullUrl}" target="_blank" 
                               class="font-black text-brand-blue hover:text-blue-700 underline underline-offset-8 decoration-2 decoration-blue-50 hover:decoration-blue-200 transition-all text-xl tracking-tight block truncate" 
                               title="${fullUrl}">
                                ${fullUrl}
                            </a>
                        </td>
                        <td class="px-8 py-8 text-center font-black text-slate-800 text-lg">${link.clicks}</td>
                        <td class="px-8 py-8 text-right">
                            <button onclick="LinkManager.deleteLink(${link.id})" class="p-3 text-slate-200 hover:text-rose-500 hover:bg-rose-50 rounded-2xl transition-all">🗑️</button>
                        </td>
                    `;
                    statsBody.appendChild(row);
                });
            } catch (e) {
                console.error('Stats loading failed.');
            }
        },

        async deleteLink(id) {
            if (!confirm('Xác nhận tiêu hủy liên kết này?')) return;
            try {
                await Api.fetch(`/api/delete/${id}`, { method: 'DELETE' });
                this.loadStats();
            } catch (e) {
                alert('Không thể thực hiện yêu cầu.');
            }
        }
    };

    // Khởi tạo các sự kiện khi trang đã tải xong (DOMContentLoaded)
    document.addEventListener('DOMContentLoaded', () => {
        // Nếu đã đăng nhập, tự động tải danh sách link
        if (IS_AUTHENTICATED) {
            LinkManager.loadStats();
        }
        
        // Lắng nghe sự kiện nhập URL để reset lại nút bấm
        document.getElementById('url')?.addEventListener('input', () => {
            if (LinkManager.isShortened) LinkManager.resetBtn();
        });
    });
</script>
