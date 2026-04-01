@extends('layouts.app')

@section('title', 'Thống kê - ' . str_replace(['http://', 'https://'], '', url($link->short_code)) . ' · LinkSnap')

@section('content')
<main class="min-h-screen bg-slate-50/50 pt-8 pb-32">
    <div class="max-w-7xl mx-auto px-4 md:px-6">

        {{-- Header Section --}}
        <div class="bg-white/40 backdrop-blur-sm rounded-[32px] p-6 md:p-8 border border-white shadow-sm mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6 animate-in fade-in duration-500">
            <div class="space-y-2">
                <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400">
                    <a href="/" class="hover:text-brand-blue transition-colors">Dashboard</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    <a href="/links" class="hover:text-brand-blue transition-colors">Danh sách liên kết</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-slate-600 truncate max-w-[120px]">Thống kê liên kết</span>
                </nav>
                <h1 class="text-2xl md:text-4xl font-black text-slate-800 tracking-tight">Thống kê liên kết</h1>
                {{-- Short URL display --}}
                <div class="flex items-center gap-3 pt-1">
                    <a href="{{ url($link->short_code) }}" target="_blank"
                       class="text-brand-blue font-black text-base md:text-xl hover:underline underline-offset-4 decoration-2 break-all">
                        {{ str_replace(['http://', 'https://'], '', url($link->short_code)) }}
                    </a>
                    <button onclick="Utils.copyToClipboard('{{ url($link->short_code) }}', this)"
                            title="Sao chép"
                            class="shrink-0 bg-blue-50 text-brand-blue p-2 rounded-xl border border-blue-100 hover:bg-brand-blue hover:text-white transition-all active:scale-90">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <button onclick="LinkManager.showQR('{{ url($link->short_code) }}')"
                        class="flex items-center gap-2 px-5 py-3 bg-white text-slate-600 font-black text-xs uppercase tracking-widest rounded-2xl border-2 border-slate-100 shadow-sm hover:border-brand-blue/30 hover:text-brand-blue transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                    Mã QR
                </button>
                <button onclick="LinkManager.deleteLink('{{ $link->id }}')"
                        class="flex items-center gap-2 px-5 py-3 bg-rose-50 text-rose-500 font-black text-xs uppercase tracking-widest rounded-2xl border-2 border-rose-100 hover:bg-rose-500 hover:text-white hover:border-rose-500 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Xoá
                </button>
            </div>
        </div>

        {{-- ====== METRIC CARDS ====== --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-100">
            {{-- Tổng click --}}
            <div class="bg-white rounded-[24px] p-6 border border-slate-100 shadow-sm hover:shadow-lg transition-all group relative overflow-hidden">
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-blue-50 rounded-full opacity-60 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative">
                    <div class="w-10 h-10 bg-blue-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-brand-blue group-hover:text-white transition-all text-brand-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" /></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 mb-1">Tổng click</p>
                    <p class="text-3xl md:text-4xl font-black text-slate-800 leading-none">{{ number_format($link->clicks) }}</p>
                </div>
            </div>

            {{-- Click hôm nay --}}
            <div class="bg-white rounded-[24px] p-6 border border-slate-100 shadow-sm hover:shadow-lg transition-all group relative overflow-hidden">
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-emerald-50 rounded-full opacity-60 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative">
                    <div class="w-10 h-10 bg-emerald-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:text-white transition-all text-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 mb-1">Hôm nay</p>
                    <p class="text-3xl md:text-4xl font-black text-slate-800 leading-none">{{ number_format($clicksToday) }}</p>
                </div>
            </div>

            {{-- Unique visitors --}}
            <div class="bg-white rounded-[24px] p-6 border border-slate-100 shadow-sm hover:shadow-lg transition-all group relative overflow-hidden">
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-violet-50 rounded-full opacity-60 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative">
                    <div class="w-10 h-10 bg-violet-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-violet-500 group-hover:text-white transition-all text-violet-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 mb-1">IP duy nhất</p>
                    <p class="text-3xl md:text-4xl font-black text-slate-800 leading-none">{{ number_format($uniqueVisitors) }}</p>
                </div>
            </div>

            {{-- Ngày tạo --}}
            <div class="bg-white rounded-[24px] p-6 border border-slate-100 shadow-sm hover:shadow-lg transition-all group relative overflow-hidden">
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-amber-50 rounded-full opacity-60 group-hover:opacity-100 transition-opacity"></div>
                <div class="relative">
                    <div class="w-10 h-10 bg-amber-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-amber-400 group-hover:text-white transition-all text-amber-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 mb-1">Tạo lúc</p>
                    <p class="text-base md:text-lg font-black text-slate-800 leading-tight">{{ $link->created_at->format('d/m/Y') }}</p>
                    <p class="text-[10px] text-slate-400 font-bold mt-0.5">{{ $link->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>

        {{-- ====== MAIN GRID ====== --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT: URL Info + Chart + Distribution --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Original URL Info FIRST --}}
                <div class="bg-white rounded-[28px] p-6 md:p-8 border border-slate-100 shadow-sm animate-in fade-in duration-500 delay-100">
                    <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest mb-4">Thông tin liên kết</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">Link gốc</p>
                            <a href="{{ $link->original_url }}" target="_blank"
                               class="text-sm font-bold text-slate-700 hover:text-brand-blue transition-colors break-all leading-relaxed">
                                {{ $link->original_url }}
                            </a>
                        </div>
                        <div class="border-t border-slate-100 pt-4">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1.5">Link rút gọn</p>
                            <a href="{{ url($link->short_code) }}" target="_blank"
                               class="text-sm font-black text-brand-blue hover:underline underline-offset-4 break-all">
                                {{ url($link->short_code) }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Area Chart --}}
                <div class="bg-white rounded-[28px] p-6 md:p-8 border border-slate-100 shadow-sm animate-in fade-in slide-in-from-bottom-4 duration-500 delay-150">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-black text-slate-800">Lịch sử click</h2>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">14 ngày gần nhất</p>
                        </div>
                        <div class="flex items-center gap-2 bg-blue-50 px-3 py-2 rounded-2xl">
                            <span class="w-2 h-2 bg-brand-blue rounded-full"></span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-brand-blue">Clicks</span>
                        </div>
                    </div>
                    <div class="h-64 w-full">
                        <canvas id="linkClicksChart"></canvas>
                    </div>
                </div>

                {{-- Distribution Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-200">
                    {{-- OS Distribution --}}
                    <div class="bg-white rounded-[28px] p-6 border border-slate-100 shadow-sm">
                        <h3 class="text-sm font-black text-slate-800 mb-1">Hệ điều hành</h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-5">Phân bố người dùng</p>
                        @if(count($osDist) > 0)
                            @php $total = array_sum($osDist); @endphp
                            <div class="space-y-3">
                                @foreach($osDist as $os => $count)
                                @php
                                    $pct = $total > 0 ? round($count / $total * 100) : 0;
                                    $osIcons = ['Windows'=>'🪟','MacOS'=>'🍎','Linux'=>'🐧','Android'=>'🤖','iOS'=>'📱'];
                                    $icon = $osIcons[$os] ?? '💻';
                                    $colors = ['Windows'=>'bg-blue-500','MacOS'=>'bg-slate-700','Linux'=>'bg-amber-500','Android'=>'bg-emerald-500','iOS'=>'bg-violet-500'];
                                    $bar = $colors[$os] ?? 'bg-slate-400';
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-black text-slate-700 flex items-center gap-1.5">{{ $icon }} {{ $os }}</span>
                                        <span class="text-[10px] font-black text-slate-400">{{ $count }} ({{ $pct }}%)</span>
                                    </div>
                                    <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="{{ $bar }} h-full rounded-full transition-all duration-700" style="width: {{ $pct }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-8 text-center text-slate-300 text-xs font-black uppercase tracking-widest">Chưa có dữ liệu</div>
                        @endif
                    </div>

                    {{-- Browser Distribution --}}
                    <div class="bg-white rounded-[28px] p-6 border border-slate-100 shadow-sm">
                        <h3 class="text-sm font-black text-slate-800 mb-1">Trình duyệt</h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-5">Phân bố trình duyệt</p>
                        @if(count($browserDist) > 0)
                            @php $total = array_sum($browserDist); @endphp
                            <div class="space-y-3">
                                @foreach($browserDist as $browser => $count)
                                @php
                                    $pct = $total > 0 ? round($count / $total * 100) : 0;
                                    $bIcons = ['Chrome'=>'🌐','Firefox'=>'🦊','Safari'=>'🧭','Edge'=>'🔷','Opera'=>'🎭'];
                                    $icon = $bIcons[$browser] ?? '🌍';
                                    $bColors = ['Chrome'=>'bg-brand-blue','Firefox'=>'bg-orange-500','Safari'=>'bg-sky-500','Edge'=>'bg-indigo-500','Opera'=>'bg-red-500'];
                                    $bar = $bColors[$browser] ?? 'bg-slate-400';
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-black text-slate-700 flex items-center gap-1.5">{{ $icon }} {{ $browser }}</span>
                                        <span class="text-[10px] font-black text-slate-400">{{ $count }} ({{ $pct }}%)</span>
                                    </div>
                                    <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="{{ $bar }} h-full rounded-full transition-all duration-700" style="width: {{ $pct }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-8 text-center text-slate-300 text-xs font-black uppercase tracking-widest">Chưa có dữ liệu</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- RIGHT: Recent Activity --}}
            <div class="space-y-6">
                <div class="bg-white rounded-[28px] border border-slate-100 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-500 delay-100 sticky top-6">
                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-black text-slate-800">Nhật ký truy cập</h3>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">{{ count($logs) }} bản ghi gần nhất</p>
                        </div>
                        <div class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse"></div>
                    </div>

                    <div class="overflow-y-auto max-h-[600px] divide-y divide-slate-50">
                        @forelse($logs as $log)
                        @php
                            $osIcons = ['Windows'=>'🪟','MacOS'=>'🍎','Linux'=>'🐧','Android'=>'🤖','iOS'=>'📱'];
                            $bIcons = ['Chrome'=>'🌐','Firefox'=>'🦊','Safari'=>'🧭','Edge'=>'🔷','Opera'=>'🎭'];
                            $osIcon = $osIcons[$log['os']] ?? '💻';
                            $bIcon = $bIcons[$log['browser']] ?? '🌍';
                        @endphp
                        <div class="px-5 py-4 hover:bg-slate-50/60 transition-colors">
                            <div class="flex items-start justify-between gap-3 mb-2.5">
                                <span class="text-[10px] font-black text-emerald-700 bg-emerald-50 px-2.5 py-1.5 rounded-xl border border-emerald-100 font-mono">
                                    {{ $log['ip'] }}
                                </span>
                                <span class="text-[9px] font-bold text-slate-400 whitespace-nowrap pt-1">{{ $log['created_at'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-bold text-slate-600 bg-slate-50 border border-slate-200 px-2.5 py-1 rounded-xl">
                                    {{ $osIcon }} {{ $log['os'] }}
                                </span>
                                <span class="text-[10px] font-bold text-slate-600 bg-slate-50 border border-slate-200 px-2.5 py-1 rounded-xl">
                                    {{ $bIcon }} {{ $log['browser'] }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="py-20 text-center">
                            <div class="w-14 h-14 bg-slate-50 rounded-[20px] flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Chưa có dữ liệu truy cập</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const d = @json($dailyClicks);
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
