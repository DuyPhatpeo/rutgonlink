<!-- Hệ thống Cửa sổ Modal (Đăng nhập / Đăng ký) -->

<!-- Modal Đăng nhập -->
<div id="loginModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 items-center justify-center p-4 hidden animate-in fade-in duration-300">
    <div class="bg-white rounded-[40px] p-8 md:p-12 w-full max-w-md shadow-2xl relative">
        <div class="text-center mb-8 md:mb-10">
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-3 tracking-tight">Chào mừng!</h2>
            <p class="text-slate-400 font-semibold text-xs md:text-sm italic">Đăng nhập để quản lý link snaps.</p>
        </div>
        <form onsubmit="Auth.handleLogin(event)" class="space-y-4 md:space-y-6">
            @csrf
            <div class="group">
                <label class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4 transition group-focus-within:text-brand-blue">Email</label>
                <input type="email" name="email" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3.5 md:py-4 px-5 md:px-6 outline-none focus:border-brand-blue focus:bg-white transition-all mt-1.5 md:mt-2 text-sm">
            </div>
            <div class="group relative">
                <label class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4 transition group-focus-within:text-brand-blue">Mật khẩu</label>
                <input type="password" id="loginPwd" name="password" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3.5 md:py-4 px-5 pr-12 md:px-6 md:pr-12 outline-none focus:border-brand-blue focus:bg-white transition-all mt-1.5 md:mt-2 text-sm">
                <button type="button" onclick="const p=document.getElementById('loginPwd'); p.type=p.type==='password'?'text':'password'; this.classList.toggle('text-brand-blue')" class="absolute right-4 bottom-3.5 md:bottom-4 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </button>
            </div>
            <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-black py-4 md:py-5 rounded-2xl transition-all shadow-xl shadow-slate-200 uppercase tracking-widest mt-4 md:mt-6 text-xs md:text-sm">Xác nhận</button>
            
            <div class="relative flex items-center py-2 md:py-3 mt-1">
                <div class="flex-grow border-t border-slate-100"></div>
                <span class="flex-shrink-0 mx-4 text-slate-300 text-[10px] font-black uppercase tracking-widest">Hoặc</span>
                <div class="flex-grow border-t border-slate-100"></div>
            </div>

            <a href="{{ route('google.login') }}" class="w-full bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-black py-3.5 md:py-4 rounded-2xl transition-all flex items-center justify-center gap-3 shadow-sm active:scale-95 text-xs md:text-sm uppercase tracking-widest">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20px" height="20px"><path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12 s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20 s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039 l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36 c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571 c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
                Tiếp tục với Google
            </a>

            <p class="text-center text-[10px] md:text-xs text-slate-500 font-medium">Chưa có tài khoản? <button type="button" onclick="Modal.switch('loginModal', 'registerModal')" class="text-brand-blue font-bold hover:underline underline-offset-4 decoration-2">Đăng ký ngay</button></p>
        </form>
        <button onclick="Modal.close('loginModal')" class="mt-6 md:mt-8 w-full text-[10px] font-black text-slate-300 hover:text-slate-500 transition-colors uppercase tracking-widest">Đóng</button>
    </div>
</div>

<!-- Modal Đăng ký -->
<div id="registerModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 items-center justify-center p-4 hidden animate-in fade-in duration-300">
    <div class="bg-white rounded-[40px] p-8 md:p-12 w-full max-w-md shadow-2xl relative">
        <div class="text-center mb-8 md:mb-10">
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-3 tracking-tight">Tham gia ngay</h2>
            <p class="text-slate-400 font-semibold text-xs md:text-sm italic">Quản lý link Snap chuyên nghiệp nhất.</p>
        </div>
        <form onsubmit="Auth.handleRegister(event)" class="space-y-3 md:space-y-4">
            @csrf
            <div class="group">
                <label class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4">Họ và Tên</label>
                <input type="text" name="name" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3.5 md:py-4 px-5 md:px-6 outline-none focus:border-brand-blue focus:bg-white transition-all text-sm">
            </div>
            <div class="group">
                <label class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4">Email</label>
                <input type="email" name="email" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3.5 md:py-4 px-5 md:px-6 outline-none focus:border-brand-blue focus:bg-white transition-all text-sm">
            </div>
            <div class="group relative">
                <label class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4">Mật khẩu</label>
                <input type="password" id="regPwd" name="password" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3.5 md:py-4 px-5 pr-12 md:px-6 md:pr-12 outline-none focus:border-brand-blue focus:bg-white transition-all text-sm">
                <button type="button" onclick="const p=document.getElementById('regPwd'); p.type=p.type==='password'?'text':'password'; this.classList.toggle('text-brand-blue')" class="absolute right-4 bottom-3.5 md:bottom-4 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </button>
            </div>
            <div class="group relative">
                <label class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4">Xác nhận</label>
                <input type="password" id="regPwdConfirm" name="password_confirmation" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-3.5 md:py-4 px-5 pr-12 md:px-6 md:pr-12 outline-none focus:border-brand-blue focus:bg-white transition-all text-sm">
                <button type="button" onclick="const p=document.getElementById('regPwdConfirm'); p.type=p.type==='password'?'text':'password'; this.classList.toggle('text-brand-blue')" class="absolute right-4 bottom-3.5 md:bottom-4 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </button>
            </div>
            <button type="submit" class="w-full bg-brand-blue hover:bg-blue-700 text-white font-black py-4 md:py-5 rounded-2xl transition-all shadow-xl shadow-blue-100 uppercase tracking-widest mt-4 md:mt-6 text-xs md:text-sm">Đăng ký hoàn tất</button>
            
            <div class="relative flex items-center py-2 md:py-3 mt-1">
                <div class="flex-grow border-t border-slate-100"></div>
                <span class="flex-shrink-0 mx-4 text-slate-300 text-[10px] font-black uppercase tracking-widest">Hoặc</span>
                <div class="flex-grow border-t border-slate-100"></div>
            </div>

            <a href="{{ route('google.login') }}" class="w-full bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-black py-3.5 md:py-4 rounded-2xl transition-all flex items-center justify-center gap-3 shadow-sm active:scale-95 text-xs md:text-sm uppercase tracking-widest">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20px" height="20px"><path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12 s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20 s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039 l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36 c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571 c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
                Tiếp tục với Google
            </a>

            <p class="text-center text-[10px] md:text-xs text-slate-500 font-medium">Đã có tài khoản? <button type="button" onclick="Modal.switch('registerModal', 'loginModal')" class="text-brand-blue font-bold hover:underline underline-offset-4 decoration-2">Đăng nhập ngay</button></p>
        </form>
        <button onclick="Modal.close('registerModal')" class="mt-6 md:mt-8 w-full text-[10px] font-black text-slate-300 hover:text-slate-500 transition-colors uppercase tracking-widest">Đóng</button>
    </div>
</div>
<!-- Modal Hiển thị Mã QR -->
<div id="qrModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 items-center justify-center p-4 hidden animate-in zoom-in duration-300">
    <div class="bg-white rounded-[40px] p-8 md:p-10 w-full max-w-sm shadow-2xl relative flex flex-col items-center text-center gap-6">
        <div class="space-y-1">
            <h3 class="text-xl font-black text-slate-800 tracking-tight uppercase">Mã QR của bạn</h3>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-loose italic">Dùng để quét và truy cập nhanh liên kết</p>
        </div>

        {{-- Ảnh QR Lớn --}}
        <div class="relative w-48 h-48 bg-slate-50 rounded-3xl border border-slate-100 p-2 shadow-inner group/qr overflow-hidden">
            <img id="qrModalImage" src="" alt="QR Code" class="w-full h-full rounded-2xl">
            {{-- Hover overlay for Save --}}
            <button onclick="LinkManager.saveQR()" class="absolute inset-0 bg-brand-blue/80 opacity-0 group-hover/qr:opacity-100 transition-opacity flex items-center justify-center text-white flex-col gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                <span class="text-[10px] items-center font-black uppercase tracking-widest">Tải về máy</span>
            </button>
        </div>
        
        {{-- Link Rút gọn để Copy --}}
        <div class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-4 flex items-center justify-between gap-3 group/link cursor-pointer hover:bg-slate-100/50 transition-all active:scale-[0.98]" onclick="LinkManager.copyCurrentQRLink()">
            <div class="flex-1 min-w-0 flex flex-col items-start gap-0.5 text-left">
                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest leading-none">Liên kết rút gọn</span>
                <span id="qrShortUrlDisplay" class="text-xs font-black text-brand-blue truncate w-full tracking-tight">...</span>
            </div>
            <div class="bg-white p-2 rounded-xl shadow-sm border border-slate-100 text-slate-400 group-hover/link:text-brand-blue transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
        </div>


        {{-- Các nút Hành động (Nằm ngang) --}}
        <div class="w-full flex items-center gap-3">
            <button onclick="LinkManager.shareLink()" class="flex-1 bg-brand-blue hover:bg-blue-700 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-blue-100 uppercase tracking-widest text-[10px] flex items-center justify-center gap-2 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                </svg>
                Chia sẻ
            </button>
            <button onclick="LinkManager.saveQR()" class="flex-1 bg-slate-50 hover:bg-slate-100 text-slate-500 font-black py-4 rounded-2xl transition-all border border-slate-100 uppercase tracking-widest text-[10px] flex items-center justify-center gap-2 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                Lưu QR
            </button>
        </div>

        {{-- Nút Đóng --}}
        <button onclick="Modal.close('qrModal')" class="w-full py-4 text-xs font-black text-slate-300 hover:text-rose-500 transition-colors uppercase tracking-[0.2em] border-t border-slate-50 mt-2">
            Đóng cửa sổ
        </button>
    </div>
</div>
