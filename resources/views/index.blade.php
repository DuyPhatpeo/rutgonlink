@extends('layouts.app')

@section('title', 'LinkSnap - Trang chủ')

@section('content')
<main class="container mx-auto px-6 max-w-6xl pt-16 pb-32 transition-all duration-500">
    <!-- Phần giới thiệu (Hero Section) - Chỉ hiện ch    @guest
    <section class="text-center space-y-8 md:space-y-12 mb-16 md:mb-24 animate-in fade-in duration-700">
        <div class="space-y-4 md:space-y-6">
            <div class="inline-block px-4 py-1.5 bg-blue-50 rounded-full border border-blue-100">
                <span class="text-[9px] md:text-[10px] font-black text-brand-blue uppercase tracking-[0.15em]">Rút gọn link chuyên nghiệp</span>
            </div>
            
            <h1 class="text-5xl md:text-8xl font-extrabold text-slate-900 tracking-tight leading-[0.9] italic px-4">
                Simple. Fast.<br><span class="text-brand-blue">Reliable.</span>
            </h1>
            <p class="text-slate-400 text-lg md:text-xl leading-relaxed max-w-xl mx-auto font-medium px-6">
                Tạo link ngắn tức thì và quản lý hiệu quả chỉ sau một lần đăng nhập.
            </p>
        </div>

        <div class="max-w-2xl mx-auto flex justify-center gap-4">
            <button onclick="Modal.open('loginModal')" class="bg-brand-blue hover:bg-blue-700 text-white font-black px-10 md:px-12 py-4 md:py-5 rounded-full transition-all text-base md:text-lg uppercase shadow-lg shadow-blue-200 active:scale-95">
                Tham gia ngay
            </button>
        </div>
    </section>
    @endguest


    <!-- Khu vực Rút gọn Link -->
    <section class="max-w-4xl mx-auto mb-20 md:mb-32 animate-in slide-in-from-bottom-10 duration-1000 delay-150 px-4 md:px-0">
        <div class="bg-white rounded-[32px] md:rounded-[50px] p-2 md:p-4 shadow-2xl shadow-blue-100/50 border border-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-50/50 to-transparent opacity-0 group-focus-within:opacity-100 transition-opacity"></div>
            
            <form onsubmit="LinkManager.handleShorten(event)" class="relative flex flex-col md:flex-row items-stretch md:items-center gap-2">
                @csrf
                <div class="flex-1 relative group">
                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-brand-blue transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" />
                        </svg>
                    </div>
                    <input type="url" id="url" placeholder="Dán link của bạn tại đây..." required
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

        <!-- Kết quả QR Code (Hệ thống sẽ render qua JS) -->
        <div id="qrContainer" class="hidden mt-8 md:mt-12 animate-in zoom-in-95 duration-500 flex-col items-center gap-6 bg-white p-6 md:p-10 rounded-[40px] md:rounded-[50px] shadow-2xl border border-slate-50 max-w-[280px] md:max-w-sm mx-auto text-center">
            <h4 class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Mã QR Truy Cập Nhanh</h4>
            <div class="p-4 md:p-6 bg-slate-50 rounded-[32px] md:rounded-[40px] border-4 border-white shadow-inner inline-block">
                <img id="qrImage" src="" alt="QR Code" class="w-24 h-24 md:w-32 md:h-32">
            </div>
            <button onclick="LinkManager.resetBtn()" class="text-[9px] md:text-[10px] font-black text-rose-500 hover:text-rose-600 transition-colors uppercase tracking-[0.2em] underline underline-offset-8 decoration-2 decoration-rose-100">
                Tạo Link Khác
            </button>
        </div>
    </section>

    <!-- Bảng Thống kê & Hoạt động (Chỉ cho User) -->
    @auth
    <section class="max-w-7xl mx-auto animate-in slide-in-from-bottom-12 duration-1000 delay-300 px-4 md:px-0">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-8">
            
            <!-- Cột trái: Liên kết gần đây -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between px-4">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-3">
                        <span class="w-2 h-2 bg-brand-blue rounded-full"></span>
                        Liên kết gần đây
                    </h3>
                </div>
                
                <div class="bg-white rounded-[32px] shadow-sm border border-slate-200/60 overflow-hidden">
                    <div id="statsBody">
                        <!-- Loading State -->
                        <div class="py-16 md:py-24 flex flex-col items-center gap-4 text-center px-6">
                            <div class="w-12 h-12 border-4 border-slate-50 border-t-brand-blue rounded-full animate-spin"></div>
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest italic">Hệ thống đang tải dữ liệu...</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Hoạt động gần đây -->
            <div class="space-y-6">
                <div class="flex items-center justify-between px-4">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-3">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                        Hoạt động gần đây
                    </h3>
                </div>

                <div class="bg-white rounded-[32px] shadow-sm border border-slate-200/60 overflow-hidden">
                    <div id="logsBody">
                        <!-- Loading State -->
                        <div class="py-12 flex flex-col items-center gap-4 text-center px-6">
                            <div class="w-10 h-10 border-4 border-slate-50 border-t-emerald-500 rounded-full animate-spin"></div>
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest italic">Hệ thống đang tải dữ liệu...</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endauth


</main>
@endsection
