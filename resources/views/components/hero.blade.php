{{-- Hero Section + URL Shortener Form --}}
<div class="min-h-[60vh] flex flex-col pt-2 md:pt-4">

    {{-- Hero Text --}}
    <section class="animate-in fade-in duration-1000 mt-4 md:mt-6">
        <div class="max-w-4xl mx-auto space-y-4 text-center">
            <p class="text-xl md:text-2xl font-black tracking-tight text-slate-800 leading-tight px-8">
                <span class="bg-gradient-to-r from-brand-blue to-indigo-600 bg-clip-text text-transparent italic">Rút gọn link miễn phí.</span>
                Tạo link ngắn và truy cập với độ trễ thấp.
                <span class="text-slate-400 font-bold block mt-2 text-base md:text-lg opacity-90">
                    Dữ liệu được <span class="text-brand-blue underline decoration-slate-200 underline-offset-4">lưu giữ vĩnh viễn</span>.
                </span>
            @guest
            <div class="pt-4 flex justify-center">
                <button onclick="Modal.open('loginModal')" class="px-5 py-2 bg-slate-50 rounded-full border border-slate-100 shadow-sm inline-flex items-center gap-2 animate-pulse hover:bg-white hover:border-brand-blue/20 transition-all active:scale-95 group/auth">
                    <span class="w-2 h-2 bg-brand-blue rounded-full"></span>
                    <span class="text-[11px] font-black text-slate-400 group-hover/auth:text-brand-blue uppercase tracking-widest">Đăng nhập để sử dụng các tính năng khác</span>
                </button>
            </div>
            @endguest
            </p>
        </div>
    </section>

    {{-- URL Input Form --}}
    <div class="flex-1 flex flex-col justify-center pb-8 md:pb-12">
        <section class="max-w-5xl w-full mx-auto animate-in slide-in-from-bottom-10 duration-1000 delay-150 px-4 md:px-0">
            <div class="bg-white rounded-[32px] md:rounded-[50px] p-2 md:p-3 shadow-2xl shadow-blue-100/60 border border-white relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50/50 to-transparent opacity-0 group-focus-within:opacity-100 transition-opacity"></div>

                <form onsubmit="LinkManager.handleShorten(event)" class="relative flex flex-col md:flex-row items-stretch md:items-center gap-2">
                    @csrf
                    <div class="flex-1 relative group">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-brand-blue transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" />
                            </svg>
                        </div>
                        <input type="url" id="url" placeholder="Dán link của bạn tại đây..."
                            class="w-full bg-transparent py-5 md:py-6 pl-16 pr-8 text-base md:text-lg font-bold text-slate-800 placeholder:text-slate-300 outline-none transition-all">
                    </div>

                    @auth
                    <div class="md:w-48 lg:w-64 border-t md:border-t-0 md:border-l border-slate-100 flex items-center">
                        <input type="text" id="customCode" placeholder="Mã tùy chỉnh"
                            class="w-full bg-transparent py-5 md:py-6 px-6 text-sm font-bold text-slate-800 placeholder:text-slate-300 outline-none transition-all">
                    </div>
                    @endauth

                    <button type="submit" id="btnSubmit"
                        class="bg-brand-blue hover:bg-blue-700 text-white font-black px-8 md:px-10 py-5 md:py-6 rounded-2xl md:rounded-[40px] transition-all shadow-xl shadow-blue-100 uppercase tracking-widest active:scale-95 whitespace-nowrap">
                        Rút gọn link
                    </button>
                </form>
            </div>

            {{-- QR Code Result --}}
            <div id="qrContainer" class="hidden mt-4 justify-center">
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 inline-flex flex-col items-center gap-3">
                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Mã QR liên kết</div>
                    <img id="qrImage" src="" alt="QR Code" class="w-36 h-36 rounded-2xl border border-slate-100">
                </div>
            </div>
        </section>
    </div>
</div>
