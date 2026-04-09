<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        {{-- Section Header --}}
        <div class="text-center mb-16 md:mb-20">
            <h2 class="font-vietnam text-3xl md:text-5xl font-black text-slate-800 tracking-tight mb-6">Câu hỏi thường gặp</h2>
            <p class="text-slate-500 font-medium text-lg">Mọi thứ bạn cần biết về hệ thống rút gọn link LinkSnap.</p>
        </div>

        {{-- Accordion List --}}
        <div class="space-y-4">
            {{-- Question 1 --}}
            <div class="group border border-slate-100 rounded-[32px] overflow-hidden transition-all hover:border-brand-blue/30 hover:shadow-xl hover:shadow-blue-50">
                <button onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.arrow').classList.toggle('rotate-180')" class="w-full flex items-center justify-between p-6 md:p-8 text-left transition-all outline-none">
                    <span class="font-vietnam text-base md:text-lg font-black text-slate-800 tracking-tight">Liên kết rút gọn có bị hết hạn không?</span>
                    <div class="arrow w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </button>
                <div class="hidden px-8 pb-8 animate-in slide-in-from-top-2 duration-300">
                    <p class="text-slate-500 font-medium leading-relaxed">Mặc định, các liên kết được tạo trên LinkSnap là **vĩnh viễn** và không bao giờ tự động xóa. Tuy nhiên, nếu bạn là người dùng có tài khoản, bạn có thể tự thiết lập ngày giờ hết hạn cụ thể cho từng link trong phần Cấu hình nâng cao.</p>
                </div>
            </div>

            {{-- Question 2 --}}
            <div class="group border border-slate-100 rounded-[32px] overflow-hidden transition-all hover:border-brand-blue/30 hover:shadow-xl hover:shadow-blue-50">
                <button onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.arrow').classList.toggle('rotate-180')" class="w-full flex items-center justify-between p-6 md:p-8 text-left transition-all outline-none">
                    <span class="font-vietnam text-base md:text-lg font-black text-slate-800 tracking-tight">Tính năng bảo mật mật khẩu hoạt động như thế nào?</span>
                    <div class="arrow w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </button>
                <div class="hidden px-8 pb-8 animate-in slide-in-from-top-2 duration-300">
                    <p class="text-slate-500 font-medium leading-relaxed">Khi bạn đặt mật khẩu cho một liên kết, người truy cập buộc phải nhập đúng mật khẩu mới có thể chuyển hướng đến URL gốc. Hệ thống sử dụng mã hóa hai chiều để bảo mật và cho phép bạn xem lại hoặc đổi mật khẩu bất kỳ lúc nào.</p>
                </div>
            </div>

            {{-- Question 3 --}}
            <div class="group border border-slate-100 rounded-[32px] overflow-hidden transition-all hover:border-brand-blue/30 hover:shadow-xl hover:shadow-blue-50">
                <button onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.arrow').classList.toggle('rotate-180')" class="w-full flex items-center justify-between p-6 md:p-8 text-left transition-all outline-none">
                    <span class="font-vietnam text-base md:text-lg font-black text-slate-800 tracking-tight">Tôi có thể thay đổi URL gốc sau khi đã rút gọn không?</span>
                    <div class="arrow w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </button>
                <div class="hidden px-8 pb-8 animate-in slide-in-from-top-2 duration-300">
                    <p class="text-slate-500 font-medium leading-relaxed">Hoàn toàn được! Nếu bạn đã đăng nhập, bạn có thể vào trang Dashboard, chọn link cần sửa và cập nhật URL gốc mới mà không làm thay đổi link rút gọn đã chia sẻ.</p>
                </div>
            </div>

            {{-- Question 4 --}}
            <div class="group border border-slate-100 rounded-[32px] overflow-hidden transition-all hover:border-brand-blue/30 hover:shadow-xl hover:shadow-blue-50">
                <button onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.arrow').classList.toggle('rotate-180')" class="w-full flex items-center justify-between p-6 md:p-8 text-left transition-all outline-none">
                    <span class="font-vietnam text-base md:text-lg font-black text-slate-800 tracking-tight">Làm thế nào để tùy chỉnh Social Preview (Thumbnail)?</span>
                    <div class="arrow w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </button>
                <div class="hidden px-8 pb-8 animate-in slide-in-from-top-2 duration-300">
                    <p class="text-slate-500 font-medium leading-relaxed">Trong phần "Tùy chọn nâng cao" khi rút gọn link, bạn có thể nhập Tiêu đề, Mô tả và dán link ảnh Thumbnail. Khi bạn chia sẻ link rút gọn lên Facebook hoặc Zalo, các thông tin này sẽ hiện ra một cách chuyên nghiệp.</p>
                </div>
            </div>
        </div>
    </div>
</section>
