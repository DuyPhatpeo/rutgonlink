{{-- Panel: Hoạt động gần đây (Logs) --}}
<div class="flex flex-col gap-4">
    <div class="space-y-1">
        <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] block">Recent Traffic</span>
        <h3 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2 px-1">
            <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
            Hoạt động gần đây
        </h3>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div id="logsBody">
            {{-- Skeleton loading rows --}}
            <div class="animate-pulse">
                @for ($i = 0; $i < 4; $i++)
                    <div class="p-5 md:p-6 flex items-start gap-4 border-b border-slate-100 last:border-0">
                    {{-- Icon skeleton --}}
                    <div class="w-9 h-9 bg-slate-100 rounded-2xl shrink-0 mt-0.5"></div>
                    <div class="flex-1 space-y-2.5">
                        {{-- URL skeleton --}}
                        <div class="h-3.5 bg-slate-100 rounded-full w-4/5"></div>
                        {{-- Short code --}}
                        <div class="h-2.5 bg-slate-100 rounded-full w-1/3"></div>
                        {{-- Badges --}}
                        <div class="flex gap-2 pt-1">
                            <div class="h-5 bg-slate-100 rounded-lg w-16"></div>
                            <div class="h-5 bg-slate-100 rounded-lg w-20"></div>
                            <div class="h-5 bg-slate-100 rounded-lg w-16"></div>
                        </div>
                    </div>
                    {{-- Time skeleton --}}
                    <div class="h-4 bg-slate-100 rounded-full w-20 shrink-0"></div>
            </div>
            @endfor
        </div>
    </div>
</div>
</div>