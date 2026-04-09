@extends('layouts.app')

@section('title', $link->title ?? 'Đang chuyển hướng...')

{{-- Set Social Preview Tags --}}
@section('og_title', $link->title ?? 'LinkSnap - URL Shortener')
@section('og_description', $link->description ?? 'Đang chuyển hướng đến URL gốc...')
@section('og_image', $link->thumbnail ?? asset('logo.png'))

@section('content')
<div class="min-h-[70vh] flex flex-col items-center justify-center px-4 text-center">
    <div class="animate-in fade-in zoom-in duration-700">
        
        {{-- Thumbnail Display if exists --}}
        @if($link->thumbnail)
            <div class="mb-8 relative group">
                <div class="absolute -inset-4 bg-brand-blue/20 rounded-[40px] blur-2xl group-hover:bg-brand-blue/30 transition-all"></div>
                <img src="{{ $link->thumbnail }}" alt="Thumbnail" class="relative w-32 h-32 md:w-48 md:h-48 object-cover rounded-[32px] shadow-2xl border-4 border-white">
            </div>
        @else
            <div class="w-24 h-24 bg-blue-50 rounded-[32px] flex items-center justify-center mb-8 mx-auto animate-bounce duration-[2000ms]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" />
                </svg>
            </div>
        @endif

        <h1 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight mb-4">
            {{ $link->title ?? 'Đang chuẩn bị chuyển hướng...' }}
        </h1>
        
        <p class="text-slate-500 font-semibold mb-10 max-w-md mx-auto line-clamp-2">
            {{ $link->description ?? 'Vui lòng đợi trong giây lát, bạn đang được đưa đến địa chỉ đích.' }}
        </p>

        {{-- Thanh tiến trình (Loading bar) --}}
        <div class="w-64 h-2 bg-slate-100 rounded-full mx-auto overflow-hidden relative">
            <div class="absolute inset-y-0 left-0 bg-brand-blue w-1/3 rounded-full animate-[loading_1.5s_infinite_ease-in-out]"></div>
        </div>
        
        <p class="mt-6 text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">
            Redirecting in 2 seconds...
        </p>

    </div>
</div>

<style>
    @keyframes loading {
        0% { left: -40%; width: 40%; }
        50% { left: 40%; width: 60%; }
        100% { left: 100%; width: 40%; }
    }
</style>

<script>
    // Chuyển hướng sau 2 giây
    setTimeout(() => {
        window.location.assign("{{ $link->original_url }}");
    }, 2000);
</script>
@endsection
