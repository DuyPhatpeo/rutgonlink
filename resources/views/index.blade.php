@extends('layouts.app')

@section('title', 'LinkSnap - Trang chủ')

@section('content')
<main class="container mx-auto px-6 max-w-6xl pt-16 pb-32 transition-all duration-500">
    <!-- Phần giới thiệu (Hero Section) -->
    <section class="text-center space-y-12 mb-24 animate-in fade-in duration-700">
        <div class="space-y-6">
            <div class="inline-block px-4 py-1.5 bg-blue-50 rounded-full border border-blue-100">
                <span class="text-[10px] font-black text-brand-blue uppercase tracking-[0.15em]">Hệ thống quản lý</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 tracking-tight leading-[0.9] italic">
                Simple. Fast.<br><span class="text-brand-blue">Reliable.</span>
            </h1>
            <p class="text-slate-400 text-xl leading-relaxed max-w-xl mx-auto font-medium">
                Chào mừng bạn đến với hệ thống quản lý tập trung! Vui lòng đăng nhập hoặc đăng ký để bắt đầu sử dụng các tính năng của chúng tôi.
            </p>
        </div>

        <div class="max-w-2xl mx-auto flex justify-center gap-4">
            @auth
                <div class="flex flex-col items-center gap-6">
                    <h2 class="text-2xl font-bold text-slate-800">Xin chào, <span class="text-brand-blue">{{ Auth::user()->name }}</span>! 👋</h2>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white font-black px-12 py-4 rounded-full transition-all text-sm uppercase shadow-lg shadow-rose-100 active:scale-95">
                            Đăng xuất tài khoản
                        </button>
                    </form>
                </div>
            @else
                <button onclick="Modal.open('loginModal')" class="bg-brand-blue hover:bg-blue-700 text-white font-black px-12 py-5 rounded-full transition-all text-lg uppercase shadow-lg shadow-blue-200 active:scale-95">
                    Đăng nhập ngay
                </button>
            @endauth
        </div>
    </section>
</main>
@endsection
