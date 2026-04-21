@extends('layouts.app')

@section('title', 'Thống kê - ' . str_replace(['http://', 'https://'], '', url($link->short_code)) . ' · LinkSnap')

@section('content')
<main class="min-h-screen bg-slate-50/50 pt-8 pb-32">
    <div class="max-w-7xl mx-auto px-4 md:px-6">

        {{-- Header Section --}}
        <div class="bg-white/70 backdrop-blur-xl rounded-[40px] p-8 md:p-10 border border-white shadow-premium mb-10 flex flex-col md:flex-row md:items-center justify-between gap-10 animate-in fade-in slide-in-from-top-4 duration-1000">
            <div class="space-y-4">
                <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">
                    <a href="/" class="hover:text-brand-blue transition-colors">Trang chủ</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    <a href="/links" class="hover:text-brand-blue transition-colors font-black">Liên kết</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-brand-blue/60 italic">Chi tiết</span>
                </nav>
                <div class="space-y-1">
                    <div class="flex items-center gap-4">
                        <h1 class="font-vietnam text-3xl md:text-5xl font-black text-slate-900 tracking-tight">Thống kê liên kết</h1>
                        @if(!$link->is_active)
                            <span class="px-3 py-1 bg-rose-50 border border-rose-200 text-rose-500 text-xs font-black uppercase tracking-widest rounded-xl shadow-sm">Đã khóa</span>
                        @endif
                    </div>
                    {{-- Short URL display --}}
                    <div class="flex items-center gap-3 pt-2">
                        <div class="px-4 py-2 bg-blue-50 rounded-2xl flex items-center gap-3 border border-blue-100/50 group hover:border-brand-blue/30 transition-all">
                            <a href="{{ url($link->short_code) }}" target="_blank"
                               class="text-brand-blue font-vietnam font-black text-lg md:text-2xl decoration-brand-blue/30 underline decoration-2 underline-offset-8 hover:decoration-brand-blue transition-all break-all">
                                {{ str_replace(['http://', 'https://'], '', url($link->short_code)) }}
                            </a>
                            <button onclick="Utils.copyToClipboard('{{ url($link->short_code) }}', this)"
                                    title="Sao chép"
                                    class="shrink-0 text-brand-blue/40 hover:text-brand-blue transition-all active:scale-90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <button onclick="LinkManager.toggleStatus('{{ $link->short_code }}')"
                        class="flex items-center gap-2 px-6 py-4 mr-2 bg-white {{ $link->is_active ? 'text-slate-600' : 'text-rose-500 border-rose-100 bg-rose-50/50' }} font-vietnam font-black text-xs uppercase tracking-[0.2em] rounded-3xl border-2 border-slate-100 shadow-sm hover:border-brand-blue/30 hover:text-brand-blue transition-all active:scale-[0.98]">
                    @if($link->is_active)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        Khóa
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
                        Mở Khóa
                    @endif
                </button>
                
                <div class="hidden md:block w-px h-8 bg-slate-200 mr-2"></div>

                <button onclick="LinkManager.showQR('{{ url($link->short_code) }}')"
                        class="flex items-center gap-2 px-6 py-4 bg-white text-slate-600 font-vietnam font-black text-xs uppercase tracking-[0.2em] rounded-3xl border-2 border-slate-100 shadow-sm hover:border-brand-blue/30 hover:text-brand-blue transition-all active:scale-[0.98]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    QR
                </button>
                <button onclick="LinkManager.deleteLink('{{ $link->short_code }}')"
                        class="flex items-center gap-2 px-6 py-4 bg-rose-50 text-rose-500 font-vietnam font-black text-xs uppercase tracking-[0.2em] rounded-3xl border-2 border-rose-100 hover:bg-rose-500 hover:text-white transition-all active:scale-[0.98]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Xoá
                </button>
            </div>
        </div>

        {{-- ====== PREMIUM METRIC CARDS ====== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12 animate-in fade-in slide-in-from-bottom-8 duration-1000 delay-200">
            {{-- Tổng click --}}
            <div class="bg-white rounded-[40px] p-8 border border-white shadow-premium group hover:-translate-y-2 transition-all duration-500">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-blue-50 rounded-[28px] flex items-center justify-center text-brand-blue group-hover:bg-brand-blue group-hover:text-white transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" /></svg>
                    </div>
                    <div>
                        <div class="font-vietnam text-3xl font-black text-slate-800 tracking-tighter">{{ number_format($link->clicks) }}</div>
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mt-1">Tổng click</div>
                    </div>
                </div>
            </div>

            {{-- Click hôm nay --}}
            <div class="bg-white rounded-[40px] p-8 border border-white shadow-premium group hover:-translate-y-2 transition-all duration-500">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-emerald-50 rounded-[28px] flex items-center justify-center text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div>
                        <div class="font-vietnam text-3xl font-black text-slate-800 tracking-tighter">{{ number_format($clicksToday) }}</div>
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mt-1">Hôm nay</div>
                    </div>
                </div>
            </div>

            {{-- Unique visitors --}}
            <div class="bg-white rounded-[40px] p-8 border border-white shadow-premium group hover:-translate-y-2 transition-all duration-500">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-violet-50 rounded-[28px] flex items-center justify-center text-violet-500 group-hover:bg-violet-500 group-hover:text-white transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="font-vietnam text-3xl font-black text-slate-800 tracking-tighter">{{ number_format($uniqueVisitors) }}</div>
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mt-1">IP Duy nhất</div>
                    </div>
                </div>
            </div>

            {{-- Create Date --}}
            <div class="bg-slate-900 rounded-[40px] p-8 border border-slate-800 shadow-premium group hover:-translate-y-2 transition-all duration-500">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-white/10 rounded-[28px] flex items-center justify-center text-white/80 group-hover:bg-brand-blue group-hover:text-white transition-all duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <div class="font-vietnam text-xl font-black text-white tracking-tighter">{{ $link->created_at->format('d/m/Y') }}</div>
                        <div class="text-[9px] font-bold uppercase tracking-[0.2em] text-slate-500 mt-1 italic">{{ $link->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ====== MAIN GRID ====== --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT: URL Info + Chart + Distribution --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Original URL Info FIRST --}}
                <div class="bg-white rounded-[40px] p-8 md:p-10 border border-slate-100 shadow-premium animate-in fade-in duration-700 delay-300">
                    <h3 class="font-vietnam text-sm font-black text-slate-700 uppercase tracking-[0.2em] mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-4 bg-brand-blue rounded-full"></span>
                        Thông tin liên kết
                    </h3>
                    <div class="space-y-6">
                        <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100/50">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Link gốc</p>
                            <a href="{{ $link->original_url }}" target="_blank"
                               class="text-sm md:text-base font-bold text-slate-700 hover:text-brand-blue transition-colors break-all leading-relaxed flex items-center gap-2 group">
                                {{ $link->original_url }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                        <div class="bg-blue-50/50 p-6 rounded-3xl border border-blue-100/30">
                            <p class="text-[10px] font-black uppercase tracking-widest text-brand-blue/60 mb-2">Link rút gọn</p>
                            <a href="{{ url($link->short_code) }}" target="_blank"
                               class="text-base md:text-lg font-black text-brand-blue hover:underline underline-offset-8 break-all">
                                {{ url($link->short_code) }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Advanced Configurations --}}
                @if($link->password || $link->expires_at || $link->click_limit || $link->title || $link->description)
                <div class="bg-white/60 backdrop-blur-sm rounded-[40px] p-8 md:p-10 border border-white shadow-premium animate-in fade-in duration-700 delay-400">
                    <h3 class="font-vietnam text-sm font-black text-slate-700 uppercase tracking-[0.2em] mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                        Cấu hình nâng cao
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @if($link->password)
                        @php
                            try {
                                $decryptedPwd = \Illuminate\Support\Facades\Crypt::decryptString($link->password);
                            } catch (\Exception $e) {
                                $decryptedPwd = '[Đã mã hóa 1 chiều]';
                            }
                        @endphp
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition-all hover:shadow-md">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 flex items-center gap-1.5 mb-4"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg> Mật khẩu</p>
                            <div class="flex items-center gap-2">
                                <form id="pwdUpdateForm" onsubmit="LinkApi.updatePwd(event, '{{ $link->short_code }}')" class="relative flex-1 group" style="display:none;">
                                    @csrf
                                    <input type="text" name="password" required class="w-full bg-white border-2 border-brand-blue rounded-xl text-xs font-bold text-slate-700 px-4 py-2 pr-16 focus:ring-0 focus:outline-none transition-all">
                                    <button type="submit" class="absolute right-1 top-1 bottom-1 px-3 bg-brand-blue text-white text-[10px] font-black uppercase rounded-lg hover:bg-blue-600 transition-all">Lưu</button>
                                </form>
                                <div id="pwdDisplayArea" class="relative flex-1 group">
                                    <input type="password" id="displayPassword" value="{{ $decryptedPwd }}" readonly class="w-full bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold text-brand-blue px-4 py-2 pr-10 focus:ring-0 focus:outline-none transition-all cursor-pointer" onclick="this.select()">
                                    <button type="button" onclick="const p=document.getElementById('displayPassword'); p.type=p.type==='password'?'text':'password'; this.classList.toggle('text-brand-blue')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 hover:text-brand-blue transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                </div>
                                <button type="button" id="pwdEditBtn" onclick="document.getElementById('pwdDisplayArea').style.display='none'; document.getElementById('pwdUpdateForm').style.display='block'; this.style.display='none';" class="p-2 shrink-0 bg-slate-50 text-slate-400 hover:text-brand-blue border border-slate-100 rounded-xl transition-all" title="Chỉnh sửa">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </button>
                            </div>
                        </div>
                        @else
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-center gap-1 transition-all hover:shadow-md">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 flex items-center gap-1.5 mb-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg> Mật khẩu</p>
                            <form id="pwdUpdateForm" onsubmit="LinkApi.updatePwd(event, '{{ $link->short_code }}')" class="relative flex-1 group">
                                @csrf
                                <input type="text" name="password" placeholder="Chưa thiết lập..." class="w-full bg-slate-50 border border-slate-100 rounded-xl text-xs font-bold text-slate-700 px-4 py-2 pr-14 focus:ring-0 focus:outline-none focus:border-brand-blue focus:shadow-inner transition-all">
                                <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 px-3 bg-brand-blue text-white text-[9px] font-black uppercase rounded-lg hover:bg-blue-600 transition-all opacity-0 group-focus-within:opacity-100 hover:opacity-100">Lưu</button>
                            </form>
                        </div>
                        @endif

                        @if($link->expires_at)
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden flex flex-col justify-center transition-all hover:shadow-md">
                            @if($link->expires_at->isPast())
                                <div class="absolute inset-0 bg-rose-50/30"></div>
                            @endif
                            <div class="relative">
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 flex items-center gap-1.5"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Hết hạn</p>
                                <p class="text-xs font-black {{ $link->expires_at->isPast() ? 'text-rose-500' : 'text-slate-800' }} tracking-tight">{{ $link->expires_at->format('H:i d/m/Y') }}</p>
                                @if($link->expires_at->isPast())
                                    <p class="text-[9px] font-black uppercase tracking-widest text-rose-500 mt-1 italic">Đã hết hạn</p>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if($link->click_limit)
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-center transition-all hover:shadow-md">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 flex items-center gap-1.5"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" /></svg> Giới hạn Click</p>
                            <p class="text-xs font-black text-slate-800 tracking-tight">{{ $link->click_limit }} lượt</p>
                            @if($link->clicks >= $link->click_limit)
                                <p class="text-[9px] font-black uppercase tracking-widest text-rose-500 mt-1 italic">Đã đạt mức tối đa</p>
                            @endif
                        </div>
                        @endif

                        @if($link->title || $link->description)
                        <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm lg:col-span-3 hover:shadow-md transition-all">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg> Hiển thị trên mạng xã hội</p>
                            <div class="flex flex-col md:flex-row gap-6 items-center md:items-start text-center md:text-left">
                                @if($link->thumbnail)
                                    <div class="shrink-0 p-1.5 bg-blue-50/50 rounded-3xl border border-blue-100 shadow-sm">
                                        <img src="{{ $link->thumbnail }}" alt="Thumb" class="w-20 h-20 md:w-24 md:h-24 object-cover rounded-[22px]">
                                    </div>
                                @endif
                                <div class="space-y-2">
                                    @if($link->title)<p class="font-vietnam text-base md:text-xl font-black text-brand-blue leading-tight">{{ $link->title }}</p>@endif
                                    @if($link->description)<p class="text-xs md:text-sm font-bold text-slate-500 leading-relaxed max-w-xl">{{ $link->description }}</p>@endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Area Chart --}}
                <div class="bg-white rounded-[40px] p-8 md:p-12 border border-blue-50/30 shadow-premium animate-in fade-in slide-in-from-bottom-8 duration-1000 delay-500">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="font-vietnam text-xl md:text-2xl font-black text-slate-900 leading-none">Lịch sử click</h2>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mt-2">14 ngày gần nhất</p>
                        </div>
                        <div class="flex items-center gap-3 bg-blue-50/50 px-5 py-3 rounded-2xl border border-blue-100/30">
                            <span class="w-2.5 h-2.5 bg-brand-blue rounded-full shadow-[0_0_10px_rgba(37,99,235,0.4)] animate-pulse"></span>
                            <span class="text-[11px] font-black uppercase tracking-widest text-brand-blue">Cập nhật trực tiếp</span>
                        </div>
                    </div>
                    <div class="h-80 w-full">
                        <canvas id="linkClicksChart"></canvas>
                    </div>
                </div>

                {{-- Distribution Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-in fade-in slide-in-from-bottom-8 duration-1000 delay-600 pb-10">
                    {{-- OS Distribution --}}
                    <div class="bg-white rounded-[40px] p-8 md:p-10 border border-slate-100 shadow-premium">
                        <h3 class="font-vietnam text-base font-black text-slate-900 mb-1">Hệ điều hành</h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-8">Phân bố thiết bị truy cập</p>
                        @if(count($osDist) > 0)
                            @php $total = array_sum($osDist); @endphp
                            <div class="space-y-5">
                                @foreach($osDist as $os => $count)
                                @php
                                    $pct = $total > 0 ? round($count / $total * 100) : 0;
                                    $osIcons = ['Windows'=>'🪟','MacOS'=>'🍎','Linux'=>'🐧','Android'=>'🤖','iOS'=>'📱'];
                                    $icon = $osIcons[$os] ?? '💻';
                                    $colors = ['Windows'=>'bg-blue-500','MacOS'=>'bg-slate-700','Linux'=>'bg-amber-500','Android'=>'bg-emerald-500','iOS'=>'bg-violet-500'];
                                    $bar = $colors[$os] ?? 'bg-slate-400';
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs md:text-sm font-black text-slate-700 flex items-center gap-2.5">{{ $icon }} {{ $os }}</span>
                                        <span class="text-[10px] font-black text-slate-400">{{ $count }} ({{ $pct }}%)</span>
                                    </div>
                                    <div class="h-2.5 bg-slate-50 rounded-full overflow-hidden">
                                        <div class="{{ $bar }} h-full rounded-full transition-all duration-1000 ease-out shadow-sm" @style(['width' => $pct . '%'])></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-12 text-center text-slate-300 text-xs font-black uppercase tracking-widest italic opacity-60">Chưa có dữ liệu thống kê</div>
                        @endif
                    </div>

                    {{-- Browser Distribution --}}
                    <div class="bg-white rounded-[40px] p-8 md:p-10 border border-slate-100 shadow-premium">
                        <h3 class="font-vietnam text-base font-black text-slate-900 mb-1">Trình duyệt</h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-8">Phân bố trình duyệt web</p>
                        @if(count($browserDist) > 0)
                            @php $total = array_sum($browserDist); @endphp
                            <div class="space-y-5">
                                @foreach($browserDist as $browser => $count)
                                @php
                                    $pct = $total > 0 ? round($count / $total * 100) : 0;
                                    $bIcons = ['Chrome'=>'🌐','Firefox'=>'🦊','Safari'=>'🧭','Edge'=>'🔷','Opera'=>'🎭'];
                                    $icon = $bIcons[$browser] ?? '🌍';
                                    $bColors = ['Chrome'=>'bg-brand-blue','Firefox'=>'bg-orange-500','Safari'=>'bg-sky-500','Edge'=>'bg-indigo-500','Opera'=>'bg-red-500'];
                                    $bar = $bColors[$browser] ?? 'bg-slate-400';
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs md:text-sm font-black text-slate-700 flex items-center gap-2.5">{{ $icon }} {{ $browser }}</span>
                                        <span class="text-[10px] font-black text-slate-400">{{ $count }} ({{ $pct }}%)</span>
                                    </div>
                                    <div class="h-2.5 bg-slate-50 rounded-full overflow-hidden">
                                        <div class="{{ $bar }} h-full rounded-full transition-all duration-1000 ease-out shadow-sm" @style(['width' => $pct . '%'])></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-12 text-center text-slate-300 text-xs font-black uppercase tracking-widest italic opacity-60">Chưa có dữ liệu thống kê</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- RIGHT: Recent Activity --}}
            <div class="space-y-8 animate-in fade-in slide-in-from-right-8 duration-1000 delay-300">
                <div class="bg-white/80 backdrop-blur-md rounded-[40px] border border-white shadow-premium overflow-hidden sticky top-8">
                    <div class="px-8 py-7 border-b border-slate-100/50 flex items-center justify-between bg-white/40">
                        <div>
                            <h3 class="font-vietnam text-sm font-black text-slate-900 uppercase tracking-widest">Nhật ký truy cập</h3>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-1.5">{{ count($logs) }} bản ghi mới nhất</p>
                        </div>
                        <div class="w-3 h-3 bg-emerald-400 rounded-full shadow-[0_0_12px_rgba(52,211,153,0.6)] animate-pulse"></div>
                    </div>

                    <div class="overflow-y-auto max-h-[720px] divide-y divide-slate-100/50 scrollbar-hide">
                        @forelse($logs as $log)
                        @php
                            $osIcons = ['Windows'=>'🪟','MacOS'=>'🍎','Linux'=>'🐧','Android'=>'🤖','iOS'=>'📱'];
                            $bIcons = ['Chrome'=>'🌐','Firefox'=>'🦊','Safari'=>'🧭','Edge'=>'🔷','Opera'=>'🎭'];
                            $osIcon = $osIcons[$log['os']] ?? '💻';
                            $bIcon = $bIcons[$log['browser']] ?? '🌍';
                        @endphp
                        <div class="px-8 py-6 hover:bg-blue-50/30 transition-all duration-300 group">
                            <div class="flex items-start justify-between gap-4 mb-4">
                                <span class="text-[11px] font-mono font-black text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-100 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                                    {{ $log['ip'] }}
                                </span>
                                <span class="text-[9px] font-bold text-slate-400 whitespace-nowrap pt-1 uppercase italic tracking-tighter">{{ $log['created_at'] }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-[10px] font-black text-slate-600 bg-white border border-slate-100 px-3 py-1.5 rounded-xl shadow-sm flex items-center gap-1.5">
                                    {{ $osIcon }} {{ $log['os'] }}
                                </span>
                                <span class="text-[10px] font-black text-slate-600 bg-white border border-slate-100 px-3 py-1.5 rounded-xl shadow-sm flex items-center gap-1.5">
                                    {{ $bIcon }} {{ $log['browser'] }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="py-24 text-center px-8">
                            <div class="w-20 h-20 bg-slate-50 rounded-[32px] flex items-center justify-center mx-auto mb-6 border border-slate-100 shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Hiện tại chưa có dữ liệu <br> truy cập nào</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="p-6 bg-slate-50/50 border-t border-slate-100/50 text-center">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Dữ liệu được cập nhật thời gian thực</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
const LinkApi = {
    async updatePwd(event, linkId) {
        event.preventDefault();
        const form = event.target;
        const btn = form.querySelector('button[type="submit"]');
        const input = form.querySelector('input[name="password"]');
        const pwdValue = input.value.trim();
        
        btn.disabled = true;
        btn.innerHTML = '...';
        
        try {
            const body = {};
            if (pwdValue === '') {
                body.remove_password = true;
            } else {
                body.password = pwdValue;
            }

            await Api.fetch(`/api/links/${linkId}`, { // Actually linkId here should be short_code if we want true consistency, but let's see where it's called.
                method: 'PATCH',
                body: body
            });
            Toast.show(pwdValue === '' ? ' Đã gỡ bỏ mật khẩu!' : 'Đã cập nhật mật khẩu!', 'success');
            setTimeout(() => window.location.reload(), 800);
        } catch(err) {
            Toast.show(err.data?.message || 'Có lỗi xảy ra', 'error');
            btn.disabled = false;
            btn.innerHTML = 'LƯU';
        }
    }
};

document.addEventListener('DOMContentLoaded', function () {
    const d = <?php echo json_encode($dailyClicks); ?>;
    const canvas = document.getElementById('linkClicksChart');
    if (!canvas || !window.Chart) return;

    const labels = d.map(item => {
        const dt = new Date(item.date);
        return `${dt.getDate()}/${dt.getMonth() + 1}`;
    });
    const values = d.map(item => item.count);
    const maxVal = Math.max(...values, 1);

    const ctx = canvas.getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 260);
    gradient.addColorStop(0, 'rgba(37, 99, 235, 0.18)');
    gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Click',
                data: values,
                borderColor: '#2563eb',
                borderWidth: 2.5,
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointRadius: values.map(v => v === maxVal ? 6 : 3),
                pointBackgroundColor: values.map(v => v === maxVal ? '#fff' : '#2563eb'),
                pointBorderColor: values.map(v => v === maxVal ? '#2563eb' : '#fff'),
                pointBorderWidth: values.map(v => v === maxVal ? 3 : 2),
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: '#0f172a',
                    titleColor: '#94a3b8',
                    bodyColor: '#fff',
                    titleFont: { size: 10, weight: '700', family: 'inherit' },
                    bodyFont: { size: 14, weight: '800', family: 'inherit' },
                    padding: 14,
                    cornerRadius: 14,
                    displayColors: false,
                    callbacks: {
                        title: items => items[0].label,
                        label: ctx => `${ctx.parsed.y} click`
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { font: { size: 10, weight: '700' }, color: '#cbd5e1', maxRotation: 0 }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#f1f5f9' },
                    border: { display: false, dash: [4, 4] },
                    ticks: { font: { size: 10, weight: '700' }, color: '#cbd5e1', stepSize: 1, precision: 0 }
                }
            }
        }
    });
});
</script>
@endpush
@endsection
