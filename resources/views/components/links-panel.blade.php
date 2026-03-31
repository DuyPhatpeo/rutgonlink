{{-- Panel: Liên kết gần đây --}}
<div class="lg:col-span-2 flex flex-col gap-4">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 px-1">
        <div class="flex items-center gap-3">
            <div class="w-1 h-5 bg-brand-blue rounded-full"></div>
            <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">Liên kết của bạn</h3>
        </div>
        
        {{-- Ô tìm kiếm --}}
        <div class="relative group max-w-xs w-full">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-brand-blue transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" id="searchLinks" placeholder="Tìm URL hoặc mã..." 
                class="w-full bg-white border border-slate-200 rounded-2xl py-2 pl-10 pr-4 text-[11px] font-bold text-slate-600 outline-none focus:border-brand-blue focus:ring-4 focus:ring-blue-50 transition-all placeholder:text-slate-300">
        </div>
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
