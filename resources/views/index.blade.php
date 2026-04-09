@extends('layouts.app')

@section('title', 'LinkSnap - Trang chủ')

@section('content')
<main class="transition-all duration-500">

    @auth
    {{-- === LAYOUT CHO USER ĐÃ ĐĂNG NHẬP === --}}
    {{-- Viewport đầu tiên: Hero + Form + Widget biểu đồ --}}
    <div class="flex flex-col px-4 md:px-6 max-w-6xl mx-auto">
        {{-- Hero compact --}}
        <section class="animate-in fade-in duration-700 bg-white/40 backdrop-blur-sm rounded-[32px] p-6 md:p-8 border border-white shadow-sm mt-4 md:mt-8 mb-6">
            <p class="text-base md:text-lg font-black tracking-tight text-slate-700 leading-tight">
                <span class="bg-gradient-to-r from-brand-blue to-indigo-500 bg-clip-text text-transparent italic block md:inline mb-1 md:mb-0">Rút gọn link miễn phí.</span>
                <span class="text-slate-400 font-semibold text-xs md:text-sm md:ml-2">Tạo link ngắn, truy cập tức thì.</span>
            </p>
        </section>

        {{-- Khu vực Nhập Link & Kết quả --}}
        <section class="max-w-6xl w-full animate-in slide-in-from-bottom-6 duration-700 delay-100 pb-6 md:pb-10 relative">
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

            {{-- Panel Tùy Chọn Nâng Cao (Ẩn định) --}}
            <div id="advancedPanel" class="hidden animate-in slide-in-from-top-4 duration-500 mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
                        <span class="text-xs font-black text-slate-700 uppercase tracking-widest">Social Preview</span>
                    </div>
                    <div class="space-y-3">
                        <input type="text" id="metaTitle" placeholder="Tiêu đề (OG Title)" 
                            class="w-full bg-white border border-slate-100 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 focus:border-brand-blue outline-none transition-all">
                        <input type="text" id="metaDescription" placeholder="Mô tả ngắn" 
                            class="w-full bg-white border border-slate-100 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 focus:border-brand-blue outline-none transition-all">
                        <input type="url" id="metaThumbnail" placeholder="Link ảnh thumbnail..." 
                            class="w-full bg-white border border-slate-100 py-3 px-4 rounded-xl text-xs font-bold text-slate-800 focus:border-brand-blue outline-none transition-all">
                    </div>
                </div>
            </div>

        </section>

    {{-- Nền xám trắng từ widget xuống --}}
    <div class="bg-slate-50 border-t border-slate-200/60">
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
        <div class="relative w-full pt-16 pb-24">
            @include('components.features')
        </div>
    </div>

    {{-- Câu hỏi thường gặp --}}
    @include('components.faq')

    {{-- Final Call to Action --}}
    <section class="py-24 bg-slate-900 overflow-hidden relative">
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M0 0h20L0 20z\" fill=\"%232563eb\" fill-opacity=\"0.4\"/%3E%3C/svg%3E');"></div>
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="font-vietnam text-3xl md:text-5xl font-black text-white mb-8 tracking-tight italic">Sẵn sàng để "Snap" <br class="md:hidden"> liên kết đầu tiên?</h2>
            <p class="text-blue-200 font-medium text-lg mb-12 max-w-2xl mx-auto uppercase tracking-widest text-xs md:text-sm">Tham gia cùng hàng nghìn người dùng đang quản lý link chuyên nghiệp mỗi ngày.</p>
            <div class="flex flex-wrap justify-center gap-6">
                <button onclick="Modal.open('registerModal')" class="px-12 py-5 bg-white text-slate-900 rounded-3xl font-black text-sm uppercase tracking-widest hover:bg-brand-blue hover:text-white transition-all transform hover:scale-105 active:scale-95 shadow-2xl">Đăng ký hoàn toàn miễn phí</button>
                <button onclick="window.scrollTo({top:0, behavior:'smooth'})" class="px-12 py-5 bg-transparent text-white border-2 border-white/20 rounded-3xl font-black text-sm uppercase tracking-widest hover:border-white transition-all active:scale-95 italic">Trải nghiệm ngay &uarr;</button>
            </div>
        </div>
    </section>
    @endauth

</main>
@endsection