{{-- Widget Thống Kê: 2 Stat Cards + Biểu đồ 14 ngày --}}
{{-- Skeleton (hiện trước khi data tải xong) --}}
<div id="statsWidgetSkeleton" class="h-full">
    <div class="flex flex-col md:flex-row gap-3 h-full animate-pulse">
        <div class="flex flex-col gap-3 shrink-0">
            <div class="w-40 aspect-square bg-blue-100/40 rounded-2xl"></div>
            <div class="w-40 aspect-square bg-blue-100/40 rounded-2xl"></div>
        </div>
        <div class="flex-1 bg-blue-100/40 rounded-2xl min-h-[200px]"></div>
    </div>
</div>

{{-- Widget thật (ẩn, hiện sau khi API trả về) --}}
<div id="statsWidget" class="hidden h-full">
    <div class="flex flex-col md:flex-row gap-3 h-full">

        {{-- Stat Cards (dọc, vuông) --}}
        <div class="flex flex-col gap-3 shrink-0">

            {{-- Card: Liên kết --}}
            <div class="w-40 aspect-square bg-white rounded-2xl border border-blue-100/60 shadow-sm overflow-hidden relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent pointer-events-none"></div>
                <div class="relative h-full flex flex-col justify-center px-5">
                    <div class="text-[9px] font-black text-blue-400 uppercase tracking-[0.2em] mb-2">Liên kết</div>
                    <div id="statTotalLinks" class="text-4xl font-black text-slate-900 leading-none tabular-nums mb-1.5">—</div>
                    <div id="statTodayLinks" class="text-[9px] font-semibold text-slate-400">
                        <span>+0 hôm nay</span>
                    </div>
                </div>
            </div>

            {{-- Card: Click --}}
            <div class="w-40 aspect-square bg-white rounded-2xl border border-indigo-100/60 shadow-sm overflow-hidden relative">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-transparent pointer-events-none"></div>
                <div class="relative h-full flex flex-col justify-center px-5">
                    <div class="text-[9px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-2">Lượt Click</div>
                    <div id="statTotalClicks" class="text-4xl font-black text-slate-900 leading-none tabular-nums mb-1.5">—</div>
                    <div id="statTodayClicks" class="text-[9px] font-semibold text-slate-400">
                        <span>+0 hôm nay</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Chart --}}
        <div class="flex-1 bg-white/80 backdrop-blur-sm rounded-2xl border border-blue-100/60 shadow-sm px-5 pt-4 pb-3 flex flex-col min-h-0">
            <div class="text-[9px] font-black text-blue-400 uppercase tracking-[0.2em] mb-3 shrink-0">Click 14 ngày gần nhất</div>
            <div class="flex-1 min-h-0">
                <canvas id="clicksChart" class="w-full h-full"></canvas>
            </div>
        </div>

    </div>
</div>
