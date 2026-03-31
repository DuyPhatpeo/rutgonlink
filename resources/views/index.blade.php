@extends('layouts.app')

@section('title', 'LinkSnap - Trang chủ')

@section('content')
<main class="transition-all duration-500">

    @auth
    {{-- === LAYOUT CHO USER ĐÃ ĐĂNG NHẬP === --}}
    {{-- Viewport đầu tiên: Hero + Form + Widget biểu đồ --}}
    <div class="flex flex-col px-6 max-w-6xl mx-auto pb-2">

        {{-- Hero compact --}}
        <section class="animate-in fade-in duration-700 pt-4 pb-2">
            <p class="text-lg font-black tracking-tight text-slate-700 leading-tight">
                <span class="bg-gradient-to-r from-brand-blue to-indigo-500 bg-clip-text text-transparent italic">Rút gọn link miễn phí.</span>
                <span class="text-slate-400 font-semibold text-sm ml-2">Tạo link ngắn, truy cập tức thì.</span>
            </p>
        </section>

        {{-- Form rút gọn --}}
        <section class="max-w-5xl w-full animate-in slide-in-from-bottom-6 duration-700 delay-100 pb-4">
            <div class="bg-white rounded-[32px] md:rounded-[44px] p-2 md:p-3 shadow-xl shadow-blue-100/60 border border-white/80 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50/50 to-transparent opacity-0 group-focus-within:opacity-100 transition-opacity"></div>
                <form onsubmit="LinkManager.handleShorten(event)" class="relative flex flex-col md:flex-row items-stretch md:items-center gap-2">
                    @csrf
                    <div class="flex-1 relative group">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-brand-blue transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" />
                            </svg>
                        </div>
                        <input type="url" id="url" placeholder="Dán link của bạn tại đây..."
                            class="w-full bg-transparent py-4 md:py-5 pl-14 pr-6 text-base font-bold text-slate-800 placeholder:text-slate-300 outline-none transition-all">
                    </div>
                    <div class="md:w-44 border-t md:border-t-0 md:border-l border-slate-100 flex items-center">
                        <input type="text" id="customCode" placeholder="Mã tùy chỉnh"
                            class="w-full bg-transparent py-4 md:py-5 px-5 text-sm font-bold text-slate-800 placeholder:text-slate-300 outline-none transition-all">
                    </div>
                    <button type="submit" id="btnSubmit"
                        class="bg-brand-blue hover:bg-blue-700 text-white font-black px-7 md:px-9 py-4 md:py-5 rounded-2xl md:rounded-[36px] transition-all shadow-lg shadow-blue-200 uppercase tracking-widest active:scale-95 whitespace-nowrap text-sm">
                        Rút gọn link
                    </button>
                </form>
            </div>
            {{-- QR Result --}}
            <div id="qrContainer" class="hidden mt-3 justify-center">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 inline-flex flex-col items-center gap-2">
                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Mã QR</div>
                    <img id="qrImage" src="" alt="QR Code" class="w-28 h-28 rounded-xl border border-slate-100">
                </div>
            </div>
        </section>

    {{-- Nền xám trắng từ widget xuống --}}
    <div class="bg-slate-50 border-t border-slate-200/60">

        {{-- Widget Thống Kê --}}
        <div class="max-w-6xl mx-auto px-6 pt-5 pb-4">
            @include('components.stats-widget')
        </div>

        {{-- Bảng Links + Logs --}}
        <section class="max-w-7xl mx-auto px-4 md:px-6 pb-32">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                @include('components.links-panel')
                @include('components.logs-panel')
            </div>
        </section>

    </div>

    @else
    {{-- === LAYOUT CHO KHÁCH === --}}
    <div class="container mx-auto px-6 max-w-6xl">
        @include('components.hero')
    </div>

    {{-- Phần giới thiệu nền trắng, tràn viền --}}
    <div class="bg-white border-t border-slate-100 relative w-full pt-10 pb-20">
        @include('components.features')
    </div>
    @endauth

</main>
@endsection