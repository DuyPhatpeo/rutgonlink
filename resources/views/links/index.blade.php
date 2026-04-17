@extends('layouts.app')

@section('title', 'Danh sách liên kết - LinkSnap')

@section('content')
<main class="min-h-screen pt-8 pb-32">
    <div class="max-w-7xl mx-auto px-4 md:px-6">
        
        {{-- Header Section --}}
        <div class="bg-white/40 backdrop-blur-sm rounded-[32px] p-6 md:p-8 border border-white shadow-sm mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400">
                    <a href="/" class="hover:text-brand-blue transition-colors">Trang chủ</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                    <span class="text-slate-600 font-black">Liên kết</span>
                </nav>
                <h1 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight">Danh sách liên kết</h1>
                <p class="text-slate-500 font-medium italic">Quản lý và theo dõi hiệu quả các liên kết đã rút gọn.</p>
            </div>

            {{-- Search Bar --}}
            <div class="w-full md:w-96">
                <form action="{{ route('links.index') }}" method="GET" class="relative group">
                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-brand-blue transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Tìm kiếm link hoặc mã..." 
                        class="w-full bg-white/80 border-2 border-slate-100 py-3.5 pl-14 pr-6 rounded-2xl outline-none focus:border-brand-blue/30 focus:shadow-xl focus:shadow-blue-100/50 transition-all font-bold text-slate-700 text-sm">
                </form>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-[32px] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-6 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">Thông tin liên kết</th>
                            <th class="px-8 py-6 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Lượt Click</th>
                            <th class="px-8 py-6 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Ngày tạo</th>
                            <th class="px-8 py-6 text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($links as $link)
                        <tr class="hover:bg-slate-50/30 transition-colors group">
                            <td class="px-8 py-6 max-w-sm">
                                <div class="flex flex-col gap-1.5">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ url($link->short_code) }}" target="_blank" class="text-brand-blue font-black text-base hover:underline underline-offset-4 decoration-2 truncate">
                                            {{ str_replace(['http://', 'https://'], '', url($link->short_code)) }}
                                        </a>
                                        <button onclick="Utils.copyToClipboard('{{ url($link->short_code) }}', this)" class="text-slate-300 hover:text-brand-blue transition-colors p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                        </button>
                                    </div>
                                    <span class="text-xs font-bold text-slate-400 truncate block opacity-60" title="{{ $link->original_url }}">
                                        {{ str_replace(['http://', 'https://'], '', $link->original_url) }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-brand-blue rounded-xl font-black text-xs border border-blue-100 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" /></svg>
                                    {{ number_format($link->clicks) }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                                    {{ $link->created_at->format('d/m/Y') }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="LinkManager.toggleStatus('{{ $link->id }}', this)" class="p-2.5 rounded-xl transition-all shadow-sm active:scale-90 mr-3 {{ $link->is_active ? 'bg-emerald-50 text-emerald-500 hover:bg-emerald-500 hover:text-white' : 'bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white' }}" title="{{ $link->is_active ? 'Đang hoạt động (Nhấn để khóa)' : 'Bị khóa (Nhấn để bật)' }}">
                                        @if($link->is_active)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                        @endif
                                    </button>
                                    <div class="w-px h-6 bg-slate-200 mr-1"></div>
                                    <a href="{{ route('links.show', $link->id) }}" class="p-2.5 rounded-xl bg-slate-100 text-slate-500 hover:bg-brand-blue hover:text-white transition-all shadow-sm active:scale-90" title="Thống kê">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                                    </a>
                                    <button onclick="LinkManager.showQR('{{ url($link->short_code) }}')" class="p-2.5 rounded-xl bg-slate-100 text-slate-500 hover:bg-indigo-500 hover:text-white transition-all shadow-sm active:scale-90" title="Mã QR">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                                    </button>
                                    <button onclick="LinkManager.deleteLink('{{ $link->id }}')" class="p-2.5 rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all shadow-sm active:scale-90" title="Xoá">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" /></svg>
                                    </div>
                                    <p class="text-slate-400 font-extrabold text-sm uppercase tracking-widest">Không tìm thấy liên kết nào.</p>
                                    @if(request('search'))
                                        <a href="{{ route('links.index') }}" class="text-brand-blue font-black text-xs uppercase tracking-widest hover:underline decoration-2 underline-offset-4">Xoá tìm kiếm</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-8 py-6 bg-slate-50/60 border-t border-slate-100">
                {{ $links->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</main>

@endsection
