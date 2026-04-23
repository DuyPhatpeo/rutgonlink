{{-- Hero Section + URL Shortener Form --}}
<div class="flex flex-col pt-8 md:pt-16 pb-12 md:pb-24 overflow-hidden">
    
    {{-- Hero Text --}}
    <section class="relative z-10 animate-in fade-in slide-in-from-top-4 duration-1000">
        <div class="max-w-4xl mx-auto text-center px-4 md:px-6">
            {{-- Brand Badge --}}
            <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-blue-50/50 backdrop-blur-sm text-brand-blue rounded-2xl mb-8 border border-blue-100/50 shadow-sm animate-in zoom-in duration-1000">
                <img src="{{ asset('logo.png') }}" alt="L" class="w-6 h-6 rounded-lg shadow-sm">
                <span class="text-[10px] font-black uppercase tracking-[0.3em]">LinkSnap Platform</span>
            </div>

            <h1 class="font-vietnam text-4xl md:text-7xl font-black text-slate-900 leading-[1.1] tracking-tight mb-6">
                Rút gọn liên kết, <br class="hidden md:block">
                <span class="bg-gradient-to-r from-brand-blue via-indigo-600 to-violet-600 bg-clip-text text-transparent italic">Kiểm soát mọi thứ.</span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-slate-500 font-medium text-sm md:text-xl leading-relaxed mb-10">
                Rút gọn liên kết mạnh mẽ, bảo mật và hoàn toàn miễn phí. 
                Tùy chỉnh thương hiệu, đặt mật khẩu và theo dõi thông số thời gian thực.
            </p>

            @guest
            <div class="flex flex-wrap justify-center gap-4 mb-2">
                <button onclick="Modal.open('registerModal')" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-2xl shadow-slate-200 hover:bg-black transition-all active:scale-95">Bắt đầu ngay</button>
            </div>
            @endguest
        </div>
    </section>

    {{-- URL Input Form --}}
    <div class="w-full max-w-5xl mx-auto pt-12 md:pt-16 pb-8 md:px-6 relative px-4">
        {{-- Floating Decorations --}}
        <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-24 h-24 bg-blue-400 rotate-1 rounded-3xl blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute -right-4 top-0 w-32 h-32 bg-indigo-400 -rotate-3 rounded-full blur-3xl opacity-10 animate-pulse delay-500"></div>

        <section class="animate-in slide-in-from-bottom-8 duration-1000 delay-300 relative">
            <div class="bg-white rounded-[32px] md:rounded-[48px] p-2 md:p-3 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] border border-slate-100 group">
                <form onsubmit="LinkManager.handleShorten(event)" class="relative flex flex-col md:flex-row items-stretch md:items-center gap-1.5 md:gap-2">
                    @csrf
                    <div class="flex-1 relative">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-brand-blue transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" />
                            </svg>
                        </div>
                        <input type="url" id="url" placeholder="Dán link của bạn tại đây..."
                            class="w-full bg-transparent py-5 md:py-7 pl-16 pr-24 md:pr-14 text-base md:text-xl font-bold text-slate-800 placeholder:text-slate-300 outline-none transition-all">
                        <div class="absolute right-16 top-1/2 -translate-y-1/2 hidden md:flex items-center gap-1.5 opacity-40">
                             <kbd class="px-2 py-1 bg-slate-100 border border-slate-200 rounded-md text-[10px] font-black text-slate-400">⌘</kbd>
                             <kbd class="px-2 py-1 bg-slate-100 border border-slate-200 rounded-md text-[10px] font-black text-slate-400">K</kbd>
                        </div>
                        <button type="button" id="clearUrl" onclick="LinkManager.clearInput('url')" class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-200 hover:text-rose-500 hidden transition-all p-1 active:scale-90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    @auth
                    <div class="md:w-64 border-t md:border-t-0 md:border-l border-slate-100 flex items-center">
                        <input type="text" id="customCode" placeholder="Mã tùy chỉnh"
                            class="w-full bg-transparent py-4 md:py-6 px-8 text-sm font-bold text-slate-800 placeholder:text-slate-300 outline-none">
                    </div>
                    @endauth

                    <button type="submit" id="btnSubmit"
                        class="bg-brand-blue hover:bg-blue-700 text-white font-black px-10 md:px-14 py-5 md:py-7 rounded-2xl md:rounded-[40px] transition-all shadow-xl shadow-blue-200 uppercase tracking-widest active:scale-[0.98] whitespace-nowrap text-xs md:text-base">
                        Snap Link ✨
                    </button>
                </form>
            </div>
        </section>
    </div>
</div>
