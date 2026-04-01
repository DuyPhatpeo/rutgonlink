@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col sm:flex-row items-center justify-between gap-4">

    {{-- Info text --}}
    <div class="text-[10px] font-black uppercase tracking-widest text-slate-400">
        Hiển thị
        <span class="text-slate-600">{{ $paginator->firstItem() }}</span>
        –
        <span class="text-slate-600">{{ $paginator->lastItem() }}</span>
        trong tổng số
        <span class="text-slate-600">{{ $paginator->total() }}</span>
        liên kết
    </div>

    {{-- Page buttons --}}
    <div class="flex items-center gap-1.5">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-slate-50 text-slate-300 border-2 border-slate-100 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-white text-slate-500 border-2 border-slate-100 hover:border-brand-blue/40 hover:text-brand-blue transition-all shadow-sm active:scale-90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="inline-flex items-center justify-center w-10 h-10 text-slate-300 text-xs font-black">···</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                              class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-brand-blue text-white font-black text-xs shadow-lg shadow-blue-200 border-2 border-brand-blue">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-white text-slate-500 font-black text-xs border-2 border-slate-100 hover:border-brand-blue/40 hover:text-brand-blue transition-all shadow-sm active:scale-90">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-white text-slate-500 border-2 border-slate-100 hover:border-brand-blue/40 hover:text-brand-blue transition-all shadow-sm active:scale-90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
            </a>
        @else
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-slate-50 text-slate-300 border-2 border-slate-100 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
            </span>
        @endif
    </div>
</nav>
@endif
