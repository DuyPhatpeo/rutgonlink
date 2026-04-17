@guest
<section class="py-24 bg-white relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none">
        <div class="absolute top-[10%] left-[5%] w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-[10%] right-[5%] w-96 h-96 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        
        {{-- Section Header --}}
        <div class="max-w-3xl mb-16 md:mb-24">
            <h2 class="font-vietnam text-3xl md:text-5xl font-black text-slate-900 tracking-tight mb-6">
                Tính năng mạnh mẽ <br>
                <span class="text-slate-400">Cho trải nghiệm vượt bậc.</span>
            </h2>
            <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-2xl">
                Không chỉ dừng lại ở việc rút gọn link. LinkSnap cung cấp bộ công cụ quản lý chuyên nghiệp, 
                giúp bạn kiểm soát và tối ưu hóa mọi lượt truy cập.
            </p>
        </div>

        {{-- Bento Grid -> Stacked Rows --}}
        <div class="flex flex-col gap-8">
            
            {{-- Card: Analytics --}}
            <div class="bg-slate-50 rounded-3xl md:rounded-[40px] p-6 md:p-12 border border-slate-100 flex flex-col md:flex-row items-center gap-10 overflow-hidden group hover:shadow-2xl hover:shadow-blue-100/50 transition-all duration-500">
                <div class="flex-1 space-y-6">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-brand-blue shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="font-vietnam text-2xl md:text-3xl font-black text-slate-900">Thống kê chi tiết từng giây.</h3>
                    <p class="text-slate-500 font-medium leading-relaxed italic border-l-4 border-brand-blue pl-4">
                        "Biết chính xác ai đã click, từ đâu và sử dụng thiết bị gì."
                    </p>
                    <p class="text-slate-500 font-medium">Theo dõi biểu đồ click 14 ngày, phân tích Hệ điều hành và Trình duyệt người dùng một cách trực quan nhất.</p>
                </div>
                <div class="flex-1 w-full relative min-h-[240px]">
                    <div class="absolute inset-0 mx-auto max-w-sm w-full bg-white rounded-3xl shadow-xl p-6 transform rotate-3 group-hover:rotate-0 transition-transform duration-700">
                        <div class="h-full flex flex-col">
                            <div class="flex items-center justify-between mb-6">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Live Activity</span>
                                <div class="flex gap-1">
                                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></div>
                                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse delay-75"></div>
                                </div>
                            </div>
                            <div class="flex-1 flex flex-col gap-3">
                                <div class="h-2 w-full bg-slate-50 rounded-full overflow-hidden relative">
                                    <div class="absolute inset-y-0 left-0 w-3/4 bg-blue-500 rounded-full"></div>
                                </div>
                                <div class="h-2 w-full bg-slate-50 rounded-full overflow-hidden relative">
                                    <div class="absolute inset-y-0 left-0 w-1/2 bg-indigo-500 rounded-full"></div>
                                </div>
                                <div class="h-2 w-full bg-slate-50 rounded-full overflow-hidden relative">
                                    <div class="absolute inset-y-0 left-0 w-2/3 bg-emerald-500 rounded-full"></div>
                                </div>
                            </div>
                            <div class="mt-auto pt-4 border-t border-slate-50">
                                <span class="text-2xl font-black text-slate-800 tracking-tighter">12,482</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase ml-2">Total Clicks</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card: QR Code --}}
            <div class="bg-indigo-600 rounded-3xl md:rounded-[40px] p-6 md:p-12 flex flex-col md:flex-row-reverse items-center justify-between gap-10 text-white group hover:shadow-2xl hover:shadow-indigo-200 transition-all duration-500">
                <div class="flex-1 space-y-6">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-white shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <h3 class="font-vietnam text-2xl md:text-3xl font-black leading-tight">Mã QR tự động & <br>Tùy chỉnh.</h3>
                    <p class="text-indigo-100 font-medium text-lg max-w-sm">Tự động tạo mã QR cho mỗi link. Lưu lại và chia sẻ tức thì lên in ấn hoặc mạng xã hội. Nhanh chóng và chuyên nghiệp.</p>
                </div>
                <div class="flex-1 w-full flex justify-center md:justify-start">
                    <div class="w-48 h-48 md:w-64 md:h-64 bg-white p-4 rounded-3xl shadow-2xl transform group-hover:-rotate-3 group-hover:scale-105 transition-all duration-700 relative">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=premium" class="w-full h-full opacity-90 rounded-xl" alt="QR">
                        <div class="absolute -bottom-4 -right-4 bg-brand-blue text-white text-[10px] uppercase font-black tracking-widest px-4 py-2 rounded-xl shadow-lg transform rotate-6">Ready to scan</div>
                    </div>
                </div>
            </div>

            {{-- Card: Advanced Options --}}
            <div class="bg-white rounded-3xl md:rounded-[40px] p-6 md:p-12 border border-slate-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-10 group hover:border-brand-blue/30 transition-all duration-500">
                <div class="flex-1 space-y-6">
                    <div class="flex gap-2">
                         <div class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full">Premium</div>
                         <div class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-full">Security</div>
                    </div>
                    <h3 class="font-vietnam text-2xl md:text-3xl font-black text-slate-900 leading-tight">Mật khẩu & Hạn dùng.</h3>
                    <p class="text-slate-500 font-medium text-lg leading-relaxed max-w-sm">Bảo vệ liên kết của bạn bằng mật khẩu mạnh mẽ. Thiết lập ngày giờ hết hạn hoặc giới hạn tổng số lượt click để kiểm soát truy cập tuyệt đối.</p>
                </div>
                <div class="flex-1 w-full bg-slate-50/50 p-8 rounded-3xl border border-slate-100 shadow-inner">
                    <div class="flex flex-col gap-4 max-w-xs mx-auto">
                        <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transform group-hover:-translate-y-1 transition-transform">
                            <div class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center text-rose-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg></div>
                            <div class="flex-1">
                                <div class="h-2.5 w-1/2 bg-slate-200 rounded-full mb-2"></div>
                                <div class="h-2 w-3/4 bg-slate-100 rounded-full"></div>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 transform group-hover:-translate-y-1 transition-transform delay-75">
                            <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
                            <div class="flex-1">
                                <div class="h-2.5 w-2/3 bg-slate-200 rounded-full mb-2"></div>
                                <div class="h-2 w-1/2 bg-slate-100 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card: Custom Branding --}}
            <div class="bg-brand-blue rounded-3xl md:rounded-[40px] p-6 md:p-12 text-white relative overflow-hidden group hover:shadow-2xl hover:shadow-blue-200 transition-all duration-500">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row gap-8 items-center">
                    <div class="flex-1 space-y-6">
                        <h3 class="font-vietnam text-2xl md:text-3xl font-black leading-tight">Branding & <br>Social Preview.</h3>
                        <p class="text-blue-100 font-medium">Tùy chỉnh tiêu đề, mô tả và ảnh đại diện khi chia sẻ link lên Facebook, Zalo. Tạo ấn tượng chuyên nghiệp ngay khi người dùng chưa click vào.</p>
                        <ul class="space-y-2">
                             <li class="flex items-center gap-2 text-xs font-bold text-white/90">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-300" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                 Tùy chỉnh OG Title & Desc
                             </li>
                             <li class="flex items-center gap-2 text-xs font-bold text-white/90">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-300" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                 Upload Thumbnail tùy ý
                             </li>
                        </ul>
                    </div>
                    <div class="w-full md:w-56 aspect-[3/4] bg-white/10 backdrop-blur-md rounded-3xl border border-white/20 p-4 shadow-2xl relative group-hover:-translate-y-2 transition-transform duration-700">
                         <div class="w-full h-24 bg-white/20 rounded-xl mb-4"></div>
                         <div class="h-3 w-3/4 bg-white/30 rounded-full mb-2"></div>
                         <div class="h-3 w-1/2 bg-white/20 rounded-full mb-6"></div>
                         <div class="h-10 w-full bg-white rounded-xl"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
@endguest
