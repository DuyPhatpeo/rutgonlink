{{-- Panel: Liên kết gần đây --}}
<div class="lg:col-span-2 flex flex-col gap-4">
    <div class="flex items-center gap-3 px-1">
        <div class="w-1 h-5 bg-brand-blue rounded-full"></div>
        <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">Liên kết gần đây</h3>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div id="statsBody">
            {{-- Skeleton loading rows --}}
            <div class="animate-pulse">
                @for ($i = 0; $i < 3; $i++)
                <div class="p-5 border-b border-slate-100 last:border-0 flex items-center gap-4">
                    <div class="flex-1 space-y-2.5">
                        <div class="h-3.5 bg-slate-100 rounded-full w-3/4"></div>
                        <div class="h-2.5 bg-slate-100 rounded-full w-1/2"></div>
                        <div class="flex gap-2 pt-1">
                            <div class="h-5 bg-slate-100 rounded-full w-20"></div>
                            <div class="h-5 bg-slate-100 rounded-full w-14"></div>
                        </div>
                    </div>
                    <div class="w-7 h-7 bg-slate-100 rounded-full shrink-0"></div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
