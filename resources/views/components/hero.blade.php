{{-- Hero Section + URL Shortener Form --}}
<div class="flex flex-col pt-2 md:pt-8">

    {{-- Hero Text --}}
    <section class="animate-in fade-in duration-1000 mt-4 md:mt-8">
        <div class="max-w-4xl mx-auto space-y-4 md:space-y-6 text-center px-4 md:px-6">
            <p class="text-xl md:text-4xl font-black tracking-tight text-slate-800 leading-tight px-6 md:px-8">
                <span class="bg-gradient-to-r from-brand-blue to-indigo-600 bg-clip-text text-transparent italic text-2xl md:text-4xl block md:inline mb-2 md:mb-0">Rút gọn link miễn phí.</span>
                Tạo link ngắn và truy cập với độ trễ thấp.
                <span class="text-slate-400 font-bold block mt-3 md:mt-4 text-xs md:text-xl opacity-90 uppercase tracking-widest md:normal-case md:tracking-normal">
                    Dữ liệu được <span class="text-brand-blue underline decoration-slate-200 underline-offset-4">lưu giữ vĩnh viễn</span>.
                </span>
            </p>
            @guest
            <div class="pt-4 md:pt-6 flex justify-center px-4">
                <button onclick="Modal.open('loginModal')" class="w-full md:w-auto px-6 py-2.5 bg-slate-50 rounded-full border border-slate-100 shadow-sm inline-flex items-center justify-center gap-2 animate-pulse hover:bg-white hover:border-brand-blue/20 transition-all active:scale-95 group/auth">
                    <span class="w-2.5 h-2.5 bg-brand-blue rounded-full shrink-0"></span>
                    <span class="text-[10px] md:text-[12px] font-black text-slate-400 group-hover/auth:text-brand-blue uppercase tracking-widest truncate">Đăng nhập để sử dụng nhiều tính năng hơn</span>
                </button>
            </div>
            @endguest
        </div>
    </section>

    {{-- URL Input Form --}}
    <div class="flex-1 flex flex-col justify-center pt-6 md:pt-10 pb-12 md:pb-20">
        <section class="max-w-6xl w-full mx-auto animate-in slide-in-from-bottom-10 duration-1000 delay-150 px-4 md:px-6 relative">
            <div class="bg-white rounded-[32px] md:rounded-[50px] p-2 md:p-3 shadow-2xl shadow-blue-100/60 border border-white relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50/50 to-transparent opacity-0 group-focus-within:opacity-100 transition-opacity"></div>

                <form onsubmit="LinkManager.handleShorten(event)" class="relative flex flex-col md:flex-row items-stretch md:items-center gap-1.5 md:gap-2">
                    @csrf
                    <div class="flex-1 relative group">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-brand-blue transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 md:h-6 w-5 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" />
                            </svg>
                        </div>
                        <input type="url" id="url" placeholder="Dán link của bạn tại đây..."
                            class="w-full bg-transparent py-4 md:py-6 pl-14 md:pl-16 pr-12 md:pr-14 text-sm md:text-lg font-bold text-slate-800 placeholder:text-slate-300 outline-none transition-all">
                        <button type="button" id="clearUrl" onclick="LinkManager.clearInput('url')" class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 text-slate-300 hover:text-rose-500 hidden transition-all p-1 active:scale-90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    @auth
                    <div class="md:w-48 lg:w-64 border-t md:border-t-0 md:border-l border-slate-100 flex items-center">
                        <input type="text" id="customCode" placeholder="Mã tùy chỉnh"
                            class="w-full bg-transparent py-4 md:py-6 px-6 text-xs md:text-sm font-bold text-slate-800 placeholder:text-slate-300 outline-none transition-all">
                    </div>
                    @endauth

                    <button type="submit" id="btnSubmit"
                        class="bg-brand-blue hover:bg-blue-700 text-white font-black px-8 md:px-10 py-4 md:py-6 rounded-2xl md:rounded-[40px] transition-all shadow-xl shadow-blue-100 uppercase tracking-widest active:scale-95 whitespace-nowrap text-xs md:text-base">
                        Rút gọn link
                    </button>
                </form>
            </div>

        </section>
    </div>
</div>
