<!-- Hệ thống Cửa sổ Modal (Đăng nhập / Đăng ký) -->

<!-- Modal Đăng nhập -->
<div id="loginModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 items-center justify-center p-4 hidden animate-in fade-in duration-300">
    <div class="bg-white rounded-[40px] p-12 w-full max-w-md shadow-2xl relative">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-black text-slate-800 mb-3 tracking-tight">Chào mừng!</h2>
            <p class="text-slate-400 font-semibold text-sm italic">Đăng nhập để quản lý link snaps.</p>
        </div>
        <form onsubmit="Auth.handleLogin(event)" class="space-y-6">
            @csrf
            <div class="group">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4 transition group-focus-within:text-brand-blue">Email</label>
                <input type="email" name="email" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 outline-none focus:border-brand-blue focus:bg-white transition-all mt-2" required>
            </div>
            <div class="group">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4 transition group-focus-within:text-brand-blue">Mật khẩu</label>
                <input type="password" name="password" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 outline-none focus:border-brand-blue focus:bg-white transition-all mt-2" required>
            </div>
            <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-slate-200 uppercase tracking-[0.2em] mt-6">Xác nhận</button>
            <p class="text-center text-xs text-slate-500 font-medium">Chưa có tài khoản? <button type="button" onclick="Modal.switch('loginModal', 'registerModal')" class="text-brand-blue font-bold hover:underline underline-offset-4 decoration-2">Đăng ký ngay</button></p>
        </form>
        <button onclick="Modal.close('loginModal')" class="mt-8 w-full text-xs font-black text-slate-300 hover:text-slate-500 transition-colors uppercase tracking-[0.1em]">Đóng</button>
    </div>
</div>

<!-- Modal Đăng ký -->
<div id="registerModal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 items-center justify-center p-4 hidden animate-in fade-in duration-300">
    <div class="bg-white rounded-[40px] p-12 w-full max-w-md shadow-2xl relative">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-black text-slate-800 mb-3 tracking-tight">Tham gia ngay</h2>
            <p class="text-slate-400 font-semibold text-sm italic">Quản lý link Snap chuyên nghiệp nhất.</p>
        </div>
        <form onsubmit="Auth.handleRegister(event)" class="space-y-4">
            @csrf
            <div class="group">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4">Họ và Tên</label>
                <input type="text" name="name" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 outline-none focus:border-brand-blue focus:bg-white transition-all" required>
            </div>
            <div class="group">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4">Email</label>
                <input type="email" name="email" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 outline-none focus:border-brand-blue focus:bg-white transition-all" required>
            </div>
            <div class="group">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4">Mật khẩu</label>
                <input type="password" name="password" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 outline-none focus:border-brand-blue focus:bg-white transition-all" required>
            </div>
            <div class="group">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4">Xác nhận</label>
                <input type="password" name="password_confirmation" class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 outline-none focus:border-brand-blue focus:bg-white transition-all" required>
            </div>
            <button type="submit" class="w-full bg-brand-blue hover:bg-blue-700 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-blue-100 uppercase tracking-[0.2em] mt-6">Đăng ký hoàn tất</button>
        </form>
        <button onclick="Modal.close('registerModal')" class="mt-8 w-full text-xs font-black text-slate-300 hover:text-slate-500 transition-colors uppercase tracking-[0.1em]">Đóng</button>
    </div>
</div>
