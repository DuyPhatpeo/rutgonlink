@extends('layouts.app')

@section('title', 'LinkSnap - Trang chủ')

@section('content')
<main class="transition-all duration-500">

    @auth
    {{-- === LAYOUT CHO USER ĐÃ ĐĂNG NHẬP === --}}
    {{-- Viewport đầu tiên: Hero + Form + Widget biểu đồ --}}
    <div class="flex flex-col px-4 md:px-6 max-w-6xl mx-auto">
        <section class="animate-in fade-in duration-700 mt-4 md:mt-8 mb-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2.5 py-1 bg-blue-50 text-brand-blue text-[9px] font-black uppercase tracking-[0.2em] rounded-full border border-blue-100/50">Bảng điều khiển</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight italic leading-none">
                        Chào mừng trở lại, <span class="bg-gradient-to-r from-brand-blue to-indigo-600 bg-clip-text text-transparent">{{ auth()->user()->name }}!</span> 
                    </h2>
                    <p class="text-slate-400 font-bold text-xs md:text-sm uppercase tracking-widest mt-2 opacity-80">Hôm nay bạn muốn rút gọn link hay quản lý trang Bio?</p>
                </div>
                
                <div class="hidden md:flex items-center gap-3 bg-white p-2 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <div class="pr-4">
                        <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Ngày hiện tại</p>
                        <p class="text-[11px] font-black text-slate-700 italic">{{ now()->translatedFormat('d F, Y') }}</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Khu vực Nhập Link & Kết quả (Moved to Top) --}}
        <section class="max-w-6xl w-full animate-in slide-in-from-top-4 duration-700 delay-100 mb-10 relative">
            {{-- Form chính luôn chiếm 100% --}}
            <div class="bg-white rounded-[32px] md:rounded-[44px] p-2 md:p-3 shadow-xl shadow-blue-100/60 border border-white/80 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50/50 to-transparent opacity-0 group-focus-within:opacity-100 transition-opacity"></div>
                <form onsubmit="LinkManager.handleShorten(event)" class="relative flex flex-col md:flex-row items-stretch md:items-center gap-1.5 md:gap-2">
                    @csrf
                    <div class="flex-1 relative group">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-brand-blue transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" />
                            </svg>
                        </div>
                        <input type="url" id="url" placeholder="Dán link của bạn tại đây..."
                            class="w-full bg-transparent py-4 md:py-5 pl-14 pr-12 text-sm md:text-base font-bold text-slate-800 placeholder:text-slate-300 outline-none transition-all">
                        <button type="button" id="clearUrl" onclick="LinkManager.clearInput('url')" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-200 hover:text-rose-500 hidden transition-all p-1 active:scale-90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    <div class="md:w-44 border-t md:border-t-0 md:border-l border-slate-100 flex items-center">
                        <input type="text" id="customCode" placeholder="Mã tùy chỉnh"
                            class="w-full bg-transparent py-3 md:py-5 px-5 text-xs md:text-sm font-bold text-slate-800 placeholder:text-slate-300 outline-none transition-all">
                    </div>
                    <button type="submit" id="btnSubmit"
                        class="bg-brand-blue hover:bg-blue-700 text-white font-black px-7 md:px-9 py-4 md:py-5 rounded-2xl md:rounded-[36px] transition-all shadow-lg shadow-blue-200 uppercase tracking-widest active:scale-95 whitespace-nowrap text-xs md:text-sm">
                        Rút gọn link
                    </button>
                </form>
            </div>

            {{-- Nút Toggle Tùy Chọn Nâng Cao --}}
            <div class="flex justify-center mt-6">
                <button type="button" onclick="LinkManager.toggleAdvanced()" class="flex items-center gap-2 group">
                    <span class="text-[10px] font-black text-slate-400 group-hover:text-brand-blue uppercase tracking-[0.2em] transition-all">Tùy chọn nâng cao</span>
                    <div class="w-6 h-6 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-hover:border-brand-blue group-hover:text-brand-blue transition-all">
                        <svg id="advancedIcon" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </button>
            </div>

            {{-- Panel Tùy Chọn Nâng Cao --}}
            <div id="advancedPanel" class="animate-in slide-in-from-top-4 duration-500 mt-6 hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Bảo mật --}}
                <div class="bg-white/60 p-6 rounded-3xl border border-white shadow-sm space-y-4">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="p-2 bg-blue-50 rounded-lg text-brand-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <span class="text-xs font-black text-slate-700 uppercase tracking-widest">Bảo mật</span>
                    </div>
                    <div>
                        <input type="password" id="linkPassword" placeholder="Đặt mật khẩu bảo vệ..." 
                            class="w-full bg-white border border-slate-100 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 focus:border-brand-blue outline-none transition-all">
                    </div>
                </div>

                {{-- Giới hạn --}}
                <div class="bg-white/60 p-6 rounded-3xl border border-white shadow-sm space-y-4">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-black text-slate-700 uppercase tracking-widest">Giới hạn</span>
                    </div>
                    <div class="space-y-3">
                        <input type="datetime-local" id="expiresAt" title="Ngày giờ hết hạn"
                            class="w-full bg-white border border-slate-100 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 focus:border-brand-blue outline-none transition-all cursor-pointer">
                        <input type="number" id="clickLimit" placeholder="Giới hạn lượt click (số)" 
                            class="w-full bg-white border border-slate-100 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 focus:border-brand-blue outline-none transition-all">
                    </div>
                </div>

                {{-- Social Preview --}}
                <div class="bg-white/60 p-6 rounded-3xl border border-white shadow-sm space-y-4 lg:col-span-1">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                        </div>
                        <span class="text-xs font-black text-slate-700 uppercase tracking-widest">Xem trước mạng xã hội</span>
                    </div>
                    <div class="space-y-3">
                        <input type="text" id="metaTitle" placeholder="Tiêu đề hiển thị (OG Title)" 
                            class="w-full bg-white border border-slate-100 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 focus:border-brand-blue outline-none transition-all">
                        <input type="text" id="metaDescription" placeholder="Mô tả nội dung ngắn" 
                            class="w-full bg-white border border-slate-100 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 focus:border-brand-blue outline-none transition-all">
                        <input type="url" id="metaThumbnail" placeholder="Link ảnh đại diện (Thumbnail)..." 
                            class="w-full bg-white border border-slate-100 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 focus:border-brand-blue outline-none transition-all">
                    </div>
                </div>
            </div>
        </section>



        {{-- Quick Intro / Action Cards --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10 animate-in slide-in-from-bottom-4 duration-700 delay-200">
            <div class="group bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm hover:shadow-xl hover:border-brand-blue/20 transition-all cursor-pointer">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-brand-blue mb-4 transition-transform group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" /></svg>
                </div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-1 italic">Rút gọn link</h3>
                <p class="text-[10px] text-slate-400 font-bold leading-relaxed">Tạo liên kết ngắn chuyên nghiệp với mã QR và bảo mật nâng cao.</p>
            </div>

            <a href="{{ route('bio.index') }}" class="group bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-500 mb-4 transition-transform group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                </div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-1 italic">Trang Bio</h3>
                <p class="text-[10px] text-slate-400 font-bold leading-relaxed">Xây dựng trang landing page cá nhân tối ưu cho Instagram, TikTok.</p>
            </a>

            <div class="group bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm hover:shadow-xl hover:border-emerald-100 transition-all opacity-80 cursor-not-allowed">
                <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 mb-4 transition-transform group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                </div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-1 italic">Phân tích</h3>
                <p class="text-[10px] text-slate-400 font-bold leading-relaxed">Phân tích chi tiết lượt truy cập, thiết bị và địa lý (Sắp ra mắt).</p>
            </div>
        </section>

        {{-- Feature Spotlight: Bio Pages (Moved) --}}
        <section class="mb-10 animate-in slide-in-from-bottom-5 duration-700 delay-300">
            <div class="relative bg-gradient-to-br from-indigo-600 via-indigo-700 to-blue-800 rounded-[40px] p-8 md:p-10 overflow-hidden shadow-2xl shadow-indigo-200">
                {{-- Decorative background elements --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-12 translate-x-12 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-400/20 rounded-full translate-y-12 -translate-x-12 blur-2xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="max-w-xl text-center md:text-left">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 backdrop-blur-md rounded-full border border-white/30 mb-6">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-[10px] font-black text-white uppercase tracking-[0.2em]">Tính năng mới</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight italic mb-4 leading-tight">
                            Nâng tầm thương hiệu <br class="hidden md:block"> với Trang Bio
                        </h2>
                        <p class="text-indigo-100 font-bold text-sm md:text-base leading-relaxed opacity-90 mb-8 px-4 md:px-0">
                            Tạo một trang Profile duy nhất cho toàn bộ mạng xã hội của bạn. Tiết kiệm không gian, chuyên nghiệp hóa thương hiệu và theo dõi lượt click hiệu quả.
                        </p>
                        <div class="flex flex-wrap justify-center md:justify-start gap-4">
                            <a href="{{ route('bio.index') }}" class="bg-white text-indigo-700 font-black px-8 py-4 rounded-2xl shadow-xl transition-all hover:scale-105 active:scale-95 text-xs uppercase tracking-widest flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                                Bắt đầu ngay
                            </a>
                        </div>
                    </div>
                    
                    <div class="hidden lg:block w-72 h-72 relative">
                        <div class="absolute inset-0 bg-white/5 rounded-full border-4 border-white/10 animate-ping duration-[3000ms]"></div>
                        <div class="absolute inset-4 bg-white/10 rounded-full border border-white/20 flex items-center justify-center">
                            <div class="bg-white w-48 h-48 rounded-[44px] shadow-2xl flex flex-col items-center justify-center p-6 -rotate-6 transition-transform hover:rotate-0 duration-500">
                                <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                </div>
                                <div class="space-y-2 w-full">
                                    <div class="h-2 w-full bg-slate-100 rounded-full"></div>
                                    <div class="h-2 w-2/3 bg-slate-50 rounded-full"></div>
                                    <div class="h-2 w-1/2 bg-blue-50 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Nền xám trắng từ widget xuống --}}
    <div id="dashboard-stats" class="bg-slate-50 border-t border-slate-200/60">
        {{-- Widget Thống Kê --}}
        <div class="max-w-6xl mx-auto px-6 pt-12 pb-12">
            @include('components.stats-widget')
        </div>

        {{-- Bảng Links + Logs --}}
        <section class="max-w-[1340px] mx-auto px-4 md:px-6 pt-8 pb-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                @include('components.links-panel')
                @include('components.logs-panel')
            </div>
        </section>
    </div>

    @else
    {{-- === LAYOUT CHO KHÁCH === --}}
    
    {{-- Nền màu xanh nhạt cho phần Hero để tạo độ tương phản vắt vẻo --}}
    <div class="bg-[#eef6fc] pt-4 pb-36 border-b border-blue-50">
        <div class="container mx-auto">
            @include('components.hero')
        </div>
    </div>

    <div class="bg-white relative flow-root">
        {{-- Cách thức hoạt động --}}
        @include('components.stats')

        {{-- Bento Features --}}
        <div class="relative w-full pt-16 pb-12">
            @include('components.features')
        </div>

        {{-- NEW: Giới thiệu Trang Bio cho Khách (Moved Down & Fixed Clipping) --}}
        <section class="py-24 relative bg-white">
            {{-- Decorative accent --}}
            <div class="absolute top-1/2 left-0 w-64 h-64 bg-blue-50/50 rounded-full blur-3xl -translate-y-1/2 -translate-x-32"></div>
            
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
                <div class="order-2 lg:order-1 flex justify-center">
                    {{-- Mockup Bio Page --}}
                    <div class="relative group">
                        <div class="absolute inset-0 bg-blue-400 blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                        <div class="relative w-[280px] md:w-[320px] bg-slate-900 rounded-[50px] p-2.5 shadow-2xl border-4 border-slate-800 transform -rotate-3 hover:rotate-0 transition-transform duration-700">
                             <div class="bg-white h-[560px] md:h-[620px] rounded-[42px] overflow-hidden relative p-6 flex flex-col items-center">
                                 <div class="w-16 h-16 rounded-full bg-slate-100 border border-slate-200 mb-4 overflow-hidden">
                                     <img src="{{ asset('logo.png') }}" class="w-full h-full object-cover grayscale opacity-50">
                                 </div>
                                 <div class="h-4 w-32 bg-slate-100 rounded-full mb-2"></div>
                                 <div class="h-2 w-24 bg-slate-50 rounded-full mb-10"></div>
                                 
                                 <div class="w-full space-y-3">
                                     @foreach([1, 2, 3, 4] as $i)
                                     <div class="w-full h-12 bg-slate-50 rounded-2xl border border-slate-100 flex items-center px-4 gap-3">
                                         <div class="w-6 h-6 bg-slate-100 rounded-lg"></div>
                                         <div class="h-2 flex-1 bg-slate-200 rounded-full opacity-50"></div>
                                     </div>
                                     @endforeach
                                 </div>
                                 
                                 <div class="mt-auto h-1 w-20 bg-slate-100 rounded-full mb-2"></div>
                             </div>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-full border border-blue-100">
                        <span class="text-[10px] font-black text-brand-blue uppercase tracking-widest italic">Link-in-Bio</span>
                    </div>
                    <h2 class="font-vietnam text-3xl md:text-5xl font-black text-slate-800 tracking-tight leading-[1.2] italic py-2">
                        Trang cá nhân <br class="hidden md:block"> <span class="bg-gradient-to-r from-brand-blue to-indigo-600 bg-clip-text text-transparent border-b-[6px] border-blue-100/50 pb-1 pr-2">toàn diện nhất</span>
                    </h2>
                    <p class="text-slate-500 font-bold text-sm md:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Thay thế những đường dẫn dài và thô kệch bằng một trang Bio Profile chuyên nghiệp. Hiển thị toàn bộ mạng xã hội của bạn ngay trên một liên kết duy nhất.
                    </p>
                    <ul class="space-y-4 inline-block text-left">
                        <li class="flex items-center gap-3 text-slate-600 font-bold text-sm">
                            <div class="w-6 h-6 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            Tự động nhận diện Icon mạng xã hội
                        </li>
                        <li class="flex items-center gap-3 text-slate-600 font-bold text-sm">
                            <div class="w-6 h-6 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            Chỉnh sửa & Xem trực tiếp (Live Preview)
                        </li>
                        <li class="flex items-center gap-3 text-slate-600 font-bold text-sm">
                            <div class="w-6 h-6 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            Giao diện Glassmorphism đỉnh cao
                        </li>
                    </ul>
                    <div class="pt-4">
                        <button onclick="Modal.open('registerModal')" class="bg-brand-blue hover:bg-blue-700 text-white font-black px-10 py-5 rounded-3xl shadow-xl shadow-blue-100 transition-all hover:scale-105 active:scale-95 text-sm uppercase tracking-widest italic">Khám phá ngay &rarr;</button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Câu hỏi thường gặp --}}
    @include('components.faq')

    {{-- Final Call to Action --}}
    <section class="py-24 bg-slate-900 overflow-hidden relative">
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;20&quot; height=&quot;20&quot; viewBox=&quot;0 0 20 20&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M0 0h20L0 20z&quot; fill=&quot;%232563eb&quot; fill-opacity=&quot;0.4&quot;/%3E%3C/svg%3E');"></div>
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="font-vietnam text-3xl md:text-5xl font-black text-white mb-8 tracking-tight italic">Sẵn sàng để "Snap" <br class="md:hidden"> liên kết đầu tiên?</h2>
            <p class="text-blue-200 font-medium mb-12 max-w-2xl mx-auto uppercase tracking-widest text-xs md:text-sm">Tham gia cùng hàng nghìn người dùng đang quản lý link chuyên nghiệp mỗi ngày.</p>
            <div class="flex flex-wrap justify-center gap-6">
                <button onclick="Modal.open('registerModal')" class="px-12 py-5 bg-white text-slate-900 rounded-3xl font-black text-sm uppercase tracking-widest hover:bg-brand-blue hover:text-white transition-all transform hover:scale-105 active:scale-95 shadow-2xl">Đăng ký hoàn toàn miễn phí</button>
                <button onclick="window.scrollTo({top:0, behavior:'smooth'})" class="px-12 py-5 bg-transparent text-white border-2 border-white/20 rounded-3xl font-black text-sm uppercase tracking-widest hover:border-white transition-all active:scale-95 italic">Trải nghiệm ngay &uarr;</button>
            </div>
        </div>
    </section>
    @endauth

</main>
@endsection