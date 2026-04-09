@extends('layouts.app')

@section('title', 'Yêu cầu mật khẩu - LinkSnap')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4">
    <div class="max-w-md w-full animate-in fade-in zoom-in duration-500">
        {{-- Card chính với hiệu ứng glassmorphism --}}
        <div class="bg-white/80 backdrop-blur-xl rounded-[40px] p-8 md:p-10 shadow-2xl shadow-blue-200/50 border border-white relative overflow-hidden">
            
            {{-- Icon khóa --}}
            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 mx-auto group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-brand-blue transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-2xl font-black text-slate-800 tracking-tight mb-2">Liên kết được bảo vệ</h1>
                <p class="text-slate-500 text-sm font-semibold italic">Vui lòng nhập mật khẩu để tiếp tục truy cập.</p>
            </div>

            <form action="{{ route('links.verify', $link->id) }}" method="POST" class="space-y-6">
                @csrf
                <div class="relative group">
                    <input type="password" name="password" id="password" required autofocus
                        placeholder="Mật khẩu của bạn..."
                        class="w-full bg-slate-50 border-2 border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold placeholder:text-slate-300 outline-none transition-all focus:border-brand-blue focus:bg-white focus:ring-4 focus:ring-blue-100">
                </div>

                <button type="submit"
                    class="w-full bg-brand-blue hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-200 uppercase tracking-[0.2em] text-xs transition-all active:scale-[0.98]">
                    Truy cập ngay
                </button>
            </form>

            {{-- Footer card --}}
            <div class="mt-10 pt-6 border-t border-slate-100 text-center">
                <a href="/" class="text-[10px] font-black text-slate-400 hover:text-brand-blue uppercase tracking-widest transition-all">
                    &larr; Quay lại trang chủ
                </a>
            </div>
        </div>

        {{-- Thông báo bản quyền nhỏ bên dưới --}}
        <p class="mt-8 text-center text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">
            Hệ thống bảo mật bởi LinkSnap Premium
        </p>
    </div>
</div>
@endsection
