@extends('layouts.app')

@section('title', 'Quản lý Bio Pages - LinkSnap')

@section('content')
<div class="bg-slate-50 min-h-screen pt-8 pb-32">
    <div class="max-w-6xl mx-auto px-4 md:px-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 md:mb-12">
            <div>
                <h1 class="text-2xl md:text-4xl font-black text-slate-800 tracking-tight italic">Bio Pages</h1>
                <p class="text-slate-500 font-medium mt-1 md:mt-2 uppercase tracking-widest text-[10px] md:text-xs">Tạo trang landing page chuyên nghiệp cho mạng xã hội của bạn.</p>
            </div>
            <button onclick="BioManager.openCreateModal()" class="flex items-center gap-2 bg-brand-blue hover:bg-blue-700 text-white font-black px-8 py-4 rounded-2xl shadow-lg shadow-blue-100 transition-all active:scale-95 text-xs uppercase tracking-widest whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                Tạo Bio Page mới
            </button>
        </div>

        {{-- List --}}
        @if($bioPages->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @foreach($bioPages as $page)
            <div class="bg-white rounded-3xl p-5 md:p-6 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group relative cursor-pointer">

                {{-- Invisible full-card link --}}
                <a href="{{ route('bio.edit', $page->slug) }}" class="absolute inset-0 rounded-3xl z-0" aria-label="Mở Bio Page {{ $page->title }}"></a>

                {{-- Badge hover --}}
                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity z-10 pointer-events-none">
                    <span class="bg-blue-50 text-brand-blue text-[9px] font-black px-2.5 py-1 rounded-full uppercase tracking-widest">Sửa</span>
                </div>

                {{-- Card Header: Avatar + Info --}}
                <div class="flex items-center gap-3 md:gap-4 mb-5">
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 flex items-center justify-center text-brand-blue shadow-inner overflow-hidden shrink-0">
                        @if($page->profile_image)
                            <img src="{{ $page->profile_image }}" class="w-full h-full object-cover" alt="{{ $page->title }}">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-7 md:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        @endif
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="font-black text-slate-800 text-base md:text-lg leading-tight truncate">{{ $page->title }}</h3>
                        <p class="text-slate-400 font-bold text-[10px] md:text-xs mt-0.5 truncate">/b/{{ $page->slug }}</p>
                    </div>
                </div>

                {{-- Card Footer: Stats + Actions --}}
                <div class="relative z-10 flex items-center justify-between pt-4 border-t border-slate-100">
                    <div class="flex items-center gap-1.5 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" /></svg>
                        <span class="text-[11px] md:text-xs font-bold">{{ $page->links_count }} links</span>
                    </div>
                    <div class="flex gap-1.5">
                        <a href="{{ route('bio.show', $page->slug) }}" target="_blank" class="relative z-20 p-2 md:p-2.5 bg-slate-50 text-slate-400 hover:text-brand-blue hover:bg-blue-50 rounded-xl transition-all" title="Xem công khai">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                        <button onclick="event.stopPropagation(); BioManager.deletePage('{{ $page->slug }}')" class="relative z-20 p-2 md:p-2.5 bg-rose-50 text-rose-400 hover:text-rose-600 hover:bg-rose-100 rounded-xl transition-all" title="Xóa trang">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-3xl p-10 md:p-16 text-center border-2 border-dashed border-slate-100 flex flex-col items-center">
            <div class="w-16 h-16 md:w-24 md:h-24 bg-blue-50 rounded-full flex items-center justify-center text-brand-blue mb-6 md:mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 md:h-10 md:w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            </div>
            <h2 class="text-xl md:text-2xl font-black text-slate-800 mb-3">Bạn chưa có Bio Page nào</h2>
            <p class="text-slate-500 max-w-xs md:max-w-md mx-auto mb-8 md:mb-10 font-medium text-sm">Tạo một trang landing page cá nhân để chia sẻ tất cả các liên kết quan trọng của bạn chỉ với một URL duy nhất.</p>
            <button onclick="BioManager.openCreateModal()" class="bg-brand-blue hover:bg-blue-700 text-white font-black px-8 md:px-12 py-4 md:py-5 rounded-[28px] shadow-2xl transition-all active:scale-95 uppercase tracking-widest text-xs md:text-sm">Bắt đầu tạo ngay</button>
        </div>
        @endif
    </div>
</div>

{{-- Modal tạo Bio Page --}}
<div id="createBioModal" onclick="if(event.target===this) BioManager.closeCreateModal()" class="fixed inset-0 z-[100] hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm">
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-xl bg-white rounded-[44px] shadow-2xl p-8 md:p-12 animate-in zoom-in-95 duration-300">
            <button onclick="BioManager.closeCreateModal()" class="absolute top-8 right-8 text-slate-300 hover:text-slate-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-black text-slate-800 tracking-tight italic mb-2">Tạo Bio Page mới</h2>
                <p class="text-slate-400 font-bold uppercase tracking-[0.2em] text-[10px]">Thiết lập trang cá nhân của bạn</p>
            </div>
            <form id="createBioForm" onsubmit="BioManager.handleCreate(event)" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Tiêu đề trang</label>
                    <input type="text" name="title" placeholder="VD: Duy Phất | Creative Developer" required
                        class="w-full bg-slate-50 border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold focus:bg-white focus:border-brand-blue outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Đường dẫn Custom (Slug)</label>
                    <div class="relative group">
                        <span id="slugPrefix" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xs hidden sm:block">{{ request()->getHttpHost() }}/b/</span>
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xs sm:hidden">/b/</span>
                        <input type="text" name="slug" placeholder="username" required
                            class="w-full bg-slate-50 border border-slate-100 py-4 pl-12 sm:pl-36 pr-6 rounded-2xl text-slate-800 font-bold focus:bg-white focus:border-brand-blue outline-none transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Tiểu sử ngắn (Bio)</label>
                    <textarea name="bio" placeholder="Giới thiệu một chút về bản thân..." rows="3"
                        class="w-full bg-slate-50 border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold focus:bg-white focus:border-brand-blue outline-none transition-all resize-none"></textarea>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-brand-blue hover:bg-blue-700 text-white font-black py-5 rounded-[28px] shadow-xl transition-all active:scale-95 uppercase tracking-widest text-sm">Tiếp tục thiết lập &rarr;</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const BioManager = {
    openCreateModal() {
        document.getElementById('createBioModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    },
    closeCreateModal() {
        document.getElementById('createBioModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    },
    async handleCreate(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        const btn = form.querySelector('button[type="submit"]');

        try {
            btn.disabled = true;
            btn.innerText = 'ĐANG XỬ LÝ...';
            
            const response = await fetch('/api/bio', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || data._token
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                Toast.show(result.message, 'success');
                window.location.assign(result.redirect);
            } else {
                Toast.show(result.message || 'Lỗi xảy ra!', 'error');
            }
        } catch (err) {
            Toast.show('Đã xảy ra lỗi hệ thống.', 'error');
        } finally {
            btn.disabled = false;
            btn.innerText = 'TIẾP TỤC THIẾT LẬP →';
        }
    },

    async deletePage(id) {
        Confirm.show('Bạn có chắc chắn muốn xóa Bio Page này? Hành động này không thể hoàn tác.', async () => {
            try {
                const response = await fetch(`/api/bio/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    }
                });

                const result = await response.json();
                if (response.ok) {
                    Toast.show(result.message, 'success');
                    location.reload();
                } else {
                    Toast.show(result.message, 'error');
                }
            } catch (err) {
                Toast.show('Lỗi hệ thống.', 'error');
            }
        }, { title: 'Xác nhận xóa Bio?' });
    }
};
</script>
@endpush
