@extends('layouts.app')

@section('title', 'Chỉnh sửa Bio Page - ' . $bioPage->title)

@section('content')
<div class="bg-[#F8F9FB] min-h-screen">
    {{-- Top Navigation Bar --}}
    <div class="bg-white border-b border-slate-100 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 md:px-6 h-16 md:h-20 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 md:gap-6 min-w-0">
                <a href="{{ route('bio.index') }}" class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-xl text-slate-400 hover:text-slate-900 transition-all border border-slate-100 group shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
                </a>
                <div class="h-8 w-px bg-slate-100 shrink-0"></div>
                <div class="min-w-0">
                    <h1 class="text-base md:text-lg font-black text-slate-800 tracking-tight italic truncate">{{ $bioPage->title }}</h1>
                    <div class="hidden sm:flex items-center gap-2 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <p class="text-slate-400 font-bold uppercase tracking-widest text-[9px]">Biên tập viên trực tiếp</p>
                    </div>
                </div>
            </div>

            {{-- Tabs Control (Desktop only) --}}
            <div class="hidden md:flex items-center bg-slate-50 p-1.5 rounded-2xl border border-slate-100 shrink-0">
                <button onclick="Editor.setTab('links')" id="tab-btn-links" class="tab-btn active px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Liên kết</button>
                <button onclick="Editor.setTab('appearance')" id="tab-btn-appearance" class="tab-btn px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all text-slate-400 hover:text-slate-600">Giao diện</button>
                <button onclick="Editor.setTab('settings')" id="tab-btn-settings" class="tab-btn px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all text-slate-400 hover:text-slate-600">Cài đặt</button>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                {{-- View button: icon-only on mobile, full on desktop --}}
                <a href="{{ route('bio.show', $bioPage->slug) }}" target="_blank" class="flex items-center gap-2 text-slate-500 hover:text-brand-blue font-black text-[10px] uppercase tracking-widest px-3 md:px-4 py-2 hover:bg-blue-50 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                    <span class="hidden md:inline">Xem trang</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Mobile Tab Bar --}}
    <div class="md:hidden sticky top-16 z-20 bg-white border-b border-slate-100 px-4 py-2">
        <div class="flex items-center bg-slate-50 p-1 rounded-2xl border border-slate-100">
            <button onclick="Editor.setTab('links')" id="tab-btn-links-mobile" class="mobile-tab-btn flex-1 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all bg-white text-slate-800 shadow-sm">Liên kết</button>
            <button onclick="Editor.setTab('appearance')" id="tab-btn-appearance-mobile" class="mobile-tab-btn flex-1 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all text-slate-400">Giao diện</button>
            <button onclick="Editor.setTab('settings')" id="tab-btn-settings-mobile" class="mobile-tab-btn flex-1 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all text-slate-400">Cài đặt</button>
            <button onclick="Editor.setTab('preview')" id="tab-btn-preview-mobile" class="mobile-tab-btn flex-1 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all text-slate-400">Xem trước</button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-start">
            
            {{-- Bảng điều khiển bên trái --}}
            <div class="md:col-span-7 space-y-8">
                
                {{-- TAB: LINKS --}}
                <div id="tab-links" class="tab-content transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10">
                        <div class="space-y-1">
                            <h2 class="text-2xl font-black text-slate-800 tracking-tight italic">Quản lý liên kết</h2>
                            <p class="text-slate-400 font-bold text-xs">Dễ dàng thêm, sửa hoặc thay đổi vị trí các liên kết của bạn.</p>
                        </div>
                        <button onclick="Editor.openLinkModal()" class="w-full sm:w-auto flex items-center justify-center gap-3 bg-slate-900 hover:bg-slate-800 text-white font-black px-10 py-5 rounded-3xl shadow-xl shadow-slate-200 transition-all active:scale-95 text-[11px] uppercase tracking-[0.2em]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                            Thêm link mới
                        </button>
                    </div>


                    @php
                        $socialLinks = $bioPage->links->where('type', 'social_icon');
                        $buttonLinks = $bioPage->links->where('type', 'button');
                    @endphp

                    {{-- Social Icons Section --}}
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Social Icons</span>
                            </div>
                            <div class="flex-1 h-px bg-slate-100"></div>
                            <span class="text-[10px] font-bold text-slate-300">{{ $socialLinks->count() }}</span>
                        </div>

                        <div id="socialIconsList" class="space-y-3">
                            @forelse($socialLinks as $link)
                            <div data-sort-id="{{ $link->id }}" class="group flex items-center gap-4 bg-white p-4 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-md hover:border-blue-100 transition-all">
                                <div class="drag-handle cursor-move text-slate-200 group-hover:text-slate-400 transition-colors p-1.5 -ml-1 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 8h16M4 16h16" /></svg>
                                </div>
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-50 rounded-xl shrink-0">
                                    @if($link->icon)
                                        <div class="w-6 h-6">{!! $link->icon !!}</div>
                                    @else
                                        <svg class="w-5 h-5 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1"/></svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-black text-slate-800 text-sm truncate">{{ $link->label }}</h4>
                                    <p class="text-slate-400 text-[10px] font-bold truncate mt-0.5">{{ $link->url }}</p>
                                </div>
                                <div class="flex items-center gap-1 shrink-0">
                                    <button data-id="{{ $link->id }}" data-label="{{ $link->label }}" data-url="{{ $link->url }}" data-type="{{ $link->type }}" data-icon="{{ $link->icon }}"
                                        onclick="Editor.openEditModal(this)"
                                        class="p-2.5 text-slate-400 hover:text-brand-blue bg-slate-50 hover:bg-blue-50 rounded-xl transition-all" title="Chỉnh sửa">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </button>
                                    <button onclick="Editor.deleteLink('{{ $link->id }}')"
                                        class="p-2.5 text-slate-400 hover:text-rose-500 bg-slate-50 hover:bg-rose-50 rounded-xl transition-all" title="Xóa">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </div>
                            @empty
                            <div class="bg-slate-50/50 rounded-[20px] p-6 text-center border border-dashed border-slate-200">
                                <p class="text-slate-400 text-xs font-bold">Chưa có icon mạng xã hội nào. Thêm link và chọn kiểu "Social Icon".</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Button Links Section --}}
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-violet-400"></div>
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nút bấm (Buttons)</span>
                            </div>
                            <div class="flex-1 h-px bg-slate-100"></div>
                            <span class="text-[10px] font-bold text-slate-300">{{ $buttonLinks->count() }}</span>
                        </div>

                        <div id="buttonLinksList" class="space-y-3">
                            @forelse($buttonLinks as $link)
                            <div data-sort-id="{{ $link->id }}" class="group flex items-center gap-4 bg-white p-4 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-md hover:border-violet-100 transition-all">
                                <div class="drag-handle cursor-move text-slate-200 group-hover:text-slate-400 transition-colors p-1.5 -ml-1 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 8h16M4 16h16" /></svg>
                                </div>
                                <div class="w-10 h-10 flex items-center justify-center bg-violet-50 rounded-xl shrink-0">
                                    <svg class="w-5 h-5 text-violet-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-black text-slate-800 text-sm truncate">{{ $link->label }}</h4>
                                    <p class="text-slate-400 text-[10px] font-bold truncate mt-0.5">{{ $link->url }}</p>
                                </div>
                                <div class="flex items-center gap-1 shrink-0">
                                    <button data-id="{{ $link->id }}" data-label="{{ $link->label }}" data-url="{{ $link->url }}" data-type="{{ $link->type }}" data-icon="{{ $link->icon }}"
                                        onclick="Editor.openEditModal(this)"
                                        class="p-2.5 text-slate-400 hover:text-brand-blue bg-slate-50 hover:bg-blue-50 rounded-xl transition-all" title="Chỉnh sửa">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </button>
                                    <button onclick="Editor.deleteLink('{{ $link->id }}')"
                                        class="p-2.5 text-slate-400 hover:text-rose-500 bg-slate-50 hover:bg-rose-50 rounded-xl transition-all" title="Xóa">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </div>
                            @empty
                            <div class="bg-slate-50/50 rounded-[20px] p-6 text-center border border-dashed border-slate-200">
                                <p class="text-slate-400 text-xs font-bold">Chưa có nút bấm nào. Thêm link và chọn kiểu "Nút bấm".</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    @if($bioPage->links->isEmpty())
                    <div class="bg-white rounded-[32px] p-16 text-center border-2 border-dashed border-slate-100 flex flex-col items-center mt-6">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" /></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-2">Chưa có liên kết nào</h3>
                        <p class="text-slate-400 max-w-xs mx-auto text-xs font-bold leading-relaxed mb-8">Bắt đầu bằng cách thêm liên kết đầu tiên của bạn để chia sẻ với mọi người.</p>
                        <button onclick="Editor.openLinkModal()" class="bg-slate-900 text-white font-black px-10 py-4 rounded-2xl shadow-xl transition-all text-[10px] uppercase tracking-widest">Thêm link đầu tiên</button>
                    </div>
                    @endif
                </div>

                {{-- TAB: APPEARANCE --}}
                <div id="tab-appearance" class="tab-content hidden animate-in fade-in slide-in-from-bottom-4 duration-300">
                    <section class="bg-white rounded-[44px] p-8 md:p-10 shadow-sm border border-slate-100">
                        <div class="mb-10">
                            <h2 class="text-2xl font-black text-slate-800 tracking-tight italic">Thiết kế trang</h2>
                            <p class="text-slate-400 font-bold text-xs mt-1">Tùy chỉnh màu sắc, hình ảnh và phong cách riêng của bạn.</p>
                        </div>

                        <form onsubmit="Editor.saveInfo(event)" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Tiêu đề (Tên của bạn)</label>
                                        <input type="text" name="title" value="{{ $bioPage->title }}" required
                                            class="w-full bg-slate-50 border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold focus:bg-white focus:border-brand-blue outline-none transition-all shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Tiểu sử ngắn (Bio)</label>
                                        <textarea name="bio" rows="4"
                                            class="w-full bg-slate-50 border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold focus:bg-white focus:border-brand-blue outline-none transition-all resize-none shadow-sm">{{ $bioPage->bio }}</textarea>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <div class="relative group">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Profile Image URL</label>
                                        <div class="relative">
                                            <input type="url" name="profile_image" id="profileImageInput" value="{{ $bioPage->profile_image }}" placeholder="https://..."
                                                oninput="Editor.updateAvatarPreview(this.value)"
                                                class="w-full bg-slate-50 border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold focus:bg-white focus:border-brand-blue outline-none transition-all shadow-sm">
                                            <div class="absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full overflow-hidden border border-slate-100">
                                                <img id="profileImagePreview" src="{{ $bioPage->profile_image ?? asset('avatar-placeholder.png') }}" class="w-full h-full object-cover">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6 bg-blue-50/50 rounded-3xl border border-blue-100/50">
                                        <h4 class="text-[10px] font-black text-blue-600 uppercase tracking-widest mb-2">Mẹo thiết kế</h4>
                                        <p class="text-xs text-blue-700 font-bold leading-relaxed opacity-80">Sử dụng ảnh đại diện hình vuông và tiêu đề ngắn gọn để trang Bio trông chuyên nghiệp nhất trên di động.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-slate-50 flex justify-end">
                                <button type="submit" class="bg-brand-blue hover:bg-blue-700 text-white font-black px-10 py-4 rounded-2xl shadow-xl shadow-blue-100 transition-all active:scale-95 text-[11px] uppercase tracking-[0.2em]">Cập nhật giao diện</button>
                            </div>
                        </form>
                    </section>
                </div>

                {{-- TAB: SETTINGS --}}
                <div id="tab-settings" class="tab-content hidden animate-in fade-in slide-in-from-bottom-4 duration-300">
                    <section class="bg-white rounded-[44px] p-8 md:p-10 shadow-sm border border-slate-100">
                         <div class="mb-10">
                            <h2 class="text-2xl font-black text-slate-800 tracking-tight italic">Cài đặt trang</h2>
                            <p class="text-slate-400 font-bold text-xs mt-1">Quản lý đường dẫn và trạng thái của Bio Page.</p>
                        </div>
                        
                        <div class="space-y-8">
                            <div class="flex items-center justify-between p-6 bg-slate-50 rounded-[32px] border border-slate-100">
                                <div>
                                    <h4 class="font-black text-slate-800 text-sm italic">Đường dẫn Bio</h4>
                                    <p class="text-brand-blue font-bold text-[11px] mt-1 tracking-tight">{{ request()->getHttpHost() }}/b/{{ $bioPage->slug }}</p>
                                </div>
                                <button onclick="Editor.copyBioLink(this)" 
                                    data-url="{{ route('bio.show', $bioPage->slug) }}"
                                    class="bg-white text-slate-900 font-black px-4 py-2.5 rounded-xl border border-slate-100 text-[9px] uppercase tracking-widest hover:bg-slate-100 transition-all shadow-sm">
                                    Sao chép
                                </button>
                            </div>

                            <div class="p-8 border-2 border-dashed border-rose-100 rounded-[32px] bg-rose-50/10">
                                <h4 class="font-black text-rose-600 text-sm italic mb-2">Khu vực nguy hiểm</h4>
                                <p class="text-slate-500 text-xs font-bold leading-relaxed mb-6">Xóa Bio Page này sẽ dẫn đến việc mất toàn bộ dữ liệu và liên kết. Hành động này không thể hoàn tác.</p>
                                <button onclick="Editor.deleteBio()" class="bg-rose-500 hover:bg-rose-600 text-white font-black px-8 py-3.5 rounded-xl transition-all active:scale-95 text-[10px] uppercase tracking-widest shadow-lg shadow-rose-100">Xóa Bio Page này</button>
                            </div>
                        </div>
                    </section>
                </div>

                {{-- TAB: PREVIEW (Mobile Only) --}}
                <div id="tab-preview" class="tab-content hidden md:hidden animate-in fade-in slide-in-from-bottom-4 duration-300">
                    <div class="bg-white rounded-[44px] p-6 shadow-sm border border-slate-100">
                        <div class="mb-6 flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-black text-slate-800 tracking-tight italic">Xem trước</h2>
                                <p class="text-slate-400 font-bold text-[10px] mt-1 uppercase tracking-widest">Cách trang của bạn hiển thị trên di động</p>
                            </div>
                            <button onclick="Editor.refreshPreview()" class="p-3 bg-slate-50 text-slate-400 hover:text-brand-blue rounded-xl transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                            </button>
                        </div>
                        
                        {{-- Mobile Preview Frame --}}
                        <div class="relative mx-auto rounded-[40px] overflow-hidden border-8 border-slate-900 shadow-2xl" style="height: 600px; max-width: 320px;">
                            <iframe id="previewFrameMobile" src="{{ route('bio.show', $bioPage->slug) }}" 
                                class="w-full h-full border-none">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Preview Mobile bên phải --}}
            <div class="md:col-span-5 md:sticky md:top-28 hidden md:block">
                {{-- Label --}}
                <div class="text-center mb-4">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Live Preview</span>
                </div>
                
                <div class="relative mx-auto" style="width: 320px">
                    {{-- Outer frame --}}
                    <div class="relative rounded-[52px] p-[10px] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.35),0_0_0_1px_rgba(255,255,255,0.08)]"
                        style="background: linear-gradient(145deg, #2a2d35 0%, #1a1c22 100%)">
                        
                        {{-- Side buttons --}}
                        <div class="absolute -left-[3px] top-28 w-[3px] h-8 rounded-l-full" style="background:#2a2d35"></div>
                        <div class="absolute -left-[3px] top-44 w-[3px] h-12 rounded-l-full" style="background:#2a2d35"></div>
                        <div class="absolute -left-[3px] top-60 w-[3px] h-12 rounded-l-full" style="background:#2a2d35"></div>
                        <div class="absolute -right-[3px] top-40 w-[3px] h-16 rounded-r-full" style="background:#2a2d35"></div>

                        {{-- Screen --}}
                        <div class="bg-white rounded-[44px] overflow-hidden relative" style="height: 660px">
                            {{-- Dynamic Island --}}
                            <div class="absolute top-3 left-1/2 -translate-x-1/2 z-50">
                                <div class="w-28 h-[30px] bg-black rounded-full flex items-center justify-center gap-2.5 px-4">
                                    <div class="w-2 h-2 rounded-full bg-slate-800"></div>
                                    <div class="w-8 h-[3px] rounded-full bg-slate-800"></div>
                                </div>
                            </div>

                            {{-- iframe content --}}
                            <iframe id="previewFrame" src="{{ route('bio.show', $bioPage->slug) }}" 
                                class="w-full h-full border-none pointer-events-none"
                                style="transform-origin: top; display: block">
                            </iframe>

                            {{-- Home indicator --}}
                            <div class="absolute bottom-2 left-1/2 -translate-x-1/2 w-28 h-1 bg-black/20 rounded-full z-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

{{-- Custom CSS for Tab Buttons & Scrollbars --}}
<style>
    .tab-btn.active {
        background-color: white;
        color: #0f172a;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05);
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    @keyframes shine {
        100% { transform: translateX(100%); }
    }
</style>

{{-- Modal Thêm/Sửa Link (Redesigned) --}}
<div id="linkModal" class="fixed inset-0 z-[100] hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm">
    <div onclick="if(event.target===this) Editor.closeLinkModal()" class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-xl bg-white rounded-[44px] shadow-2xl p-8 md:p-12 animate-in zoom-in-95 duration-300">
            <button onclick="Editor.closeLinkModal()" class="absolute top-10 right-10 text-slate-300 hover:text-slate-900 transition-colors bg-slate-50 w-10 h-10 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
            <div class="mb-10 text-center">
                <h2 id="modalTitle" class="text-3xl font-black text-slate-800 tracking-tight italic mb-2">Thêm liên kết mới</h2>
                <p class="text-slate-400 font-bold uppercase tracking-[0.2em] text-[9px]">Dán link và hệ thống sẽ tự thiết lập icon</p>
            </div>

            <form id="linkForm" onsubmit="Editor.saveLink(event)" class="space-y-6">
                @csrf
                <input type="hidden" name="link_id" id="linkIdInput">
                
                <div class="p-6 bg-slate-50 rounded-[32px] border border-slate-100 space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 ml-1">Đường dẫn URL</label>
                        <input type="url" name="url" id="linkUrl" placeholder="https://..." required
                            class="w-full bg-white border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold focus:border-brand-blue outline-none transition-all shadow-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 ml-1">Tên hiển thị</label>
                        <input type="text" name="label" id="linkLabel" placeholder="VD: TikTok cá nhân" required
                            class="w-full bg-white border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold focus:border-brand-blue outline-none transition-all shadow-sm">
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Kiểu hiển thị</label>
                        <div class="flex p-1 bg-slate-50 rounded-2xl border border-slate-100">
                            <button type="button" onclick="Editor.setType('button')" id="type-btn-button"
                                class="flex-1 py-3 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                Nút bấm
                            </button>
                            <button type="button" onclick="Editor.setType('social_icon')" id="type-btn-social_icon"
                                class="flex-1 py-3 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                Social Icon
                            </button>
                        </div>
                        <input type="hidden" name="type" id="linkType" value="button">
                    </div>
                    <input type="hidden" name="icon" id="linkIcon">
                </div>

                <div class="pt-6">
                    <button type="submit" id="modalSubmitBtn" class="w-full bg-brand-blue hover:bg-blue-700 text-white font-black py-5 rounded-[24px] shadow-2xl shadow-blue-100 transition-all active:scale-[0.98] text-[11px] uppercase tracking-[0.2em]">Thêm liên kết ngay</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
/**
 * Editor Configuration
 * Separated to avoid IDE parsing issues with Blade tags inside JS objects
 */
const CONFIG = {
    bioPageId: "{{ $bioPage->slug }}",
    avatarPlaceholder: "{{ asset('avatar-placeholder.png') }}",
    csrfToken: "{{ csrf_token() }}",
    indexRoute: "{{ route('bio.index') }}"
};

const Editor = {
    platforms: {
        facebook: {
            regex: /(facebook\.com|fb\.com|fb\.watch)/i,
            name: "Facebook",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>`
        },
        instagram: {
            regex: /instagram\.com/i,
            name: "Instagram",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>`
        },
        tiktok: {
            regex: /tiktok\.com/i,
            name: "TikTok",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>`
        },
        youtube: {
            regex: /(youtube\.com|youtu\.be)/i,
            name: "YouTube",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.11 1 12 1 12s0 3.89.46 5.58a2.78 2.78 0 0 0 1.94 2C5.12 20 12 20 12 20s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.89 23 12 23 12s0-3.89-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>`
        },
        twitter: {
            regex: /(twitter\.com|x\.com)/i,
            name: "X (Twitter)",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M4 4l11.733 16H20L8.267 4H4z"/><path d="M4 20l6.768-6.768m2.464-2.464L20 4"/></svg>`
        },
        github: {
            regex: /github\.com/i,
            name: "GitHub",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>`
        },
        linkedin: {
            regex: /linkedin\.com/i,
            name: "LinkedIn",
            icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>`
        }
    },

    init() {
        const urlInput = document.getElementById("linkUrl");
        if (urlInput) {
            urlInput.addEventListener("input", (e) => this.detectPlatform(e.target.value));
        }
    },

    setTab(tab) {
        // Reset all tab buttons (desktop and mobile)
        document.querySelectorAll(".tab-btn, .mobile-tab-btn").forEach(btn => {
            btn.classList.remove("active", "bg-white", "shadow-sm", "text-slate-900", "text-slate-800");
            btn.classList.add("text-slate-400");
        });
        document.querySelectorAll(".tab-content").forEach(content => content.classList.add("hidden"));

        // Activate desktop tab button
        const targetBtn = document.getElementById(`tab-btn-${tab}`);
        if (targetBtn) {
            targetBtn.classList.add("active", "bg-white", "shadow-sm", "text-slate-900");
            targetBtn.classList.remove("text-slate-400");
        }

        // Activate mobile tab button
        const targetMobileBtn = document.getElementById(`tab-btn-${tab}-mobile`);
        if (targetMobileBtn) {
            targetMobileBtn.classList.add("bg-white", "shadow-sm", "text-slate-800");
            targetMobileBtn.classList.remove("text-slate-400");
        }

        const targetContent = document.getElementById(`tab-${tab}`);
        if (targetContent) {
            targetContent.classList.remove("hidden");
        }

        // Scroll to top of content on mobile
        if (window.innerWidth < 768) {
            window.scrollTo({ top: 100, behavior: 'smooth' });
        }
    },

    detectPlatform(url) {
        if (!url) return;
        const labelInput = document.getElementById("linkLabel");
        const iconInput = document.getElementById("linkIcon");
        
        for (const [key, platform] of Object.entries(this.platforms)) {
            if (platform.regex.test(url)) {
                this.setType("social_icon");
                if (labelInput && (!labelInput.value || labelInput.value.trim() === "")) labelInput.value = platform.name;
                if (iconInput && (!iconInput.value || iconInput.value.trim() === "")) {
                    iconInput.value = platform.icon;
                    Toast.show(`Đã nhận diện: ${platform.name}`, "success");
                    if (labelInput) labelInput.focus();
                }
                break;
            }
        }
    },

    openLinkModal() {
        const form = document.getElementById("linkForm");
        if (form) form.reset();
        
        const idInput = document.getElementById("linkIdInput");
        if (idInput) idInput.value = "";
        
        this.setType("button");
        document.getElementById("modalTitle").innerText = "Thêm liên kết mới";
        document.getElementById("modalSubmitBtn").innerText = "Thêm liên kết ngay";
        document.getElementById("linkModal").classList.remove("hidden");
        
        setTimeout(() => {
            const urlInput = document.getElementById("linkUrl");
            if (urlInput) urlInput.focus();
        }, 100);
    },
    
    closeLinkModal() {
        document.getElementById("linkModal").classList.add("hidden");
    },

    openEditModal(btn) {
        const id = btn.getAttribute("data-id");
        const label = btn.getAttribute("data-label");
        const url = btn.getAttribute("data-url");
        const type = btn.getAttribute("data-type");
        const icon = btn.getAttribute("data-icon");

        const idInput = document.getElementById("linkIdInput");
        const labelInput = document.getElementById("linkLabel");
        const urlInput = document.getElementById("linkUrl");
        const iconInput = document.getElementById("linkIcon");

        if (idInput) idInput.value = id;
        if (labelInput) labelInput.value = label;
        if (urlInput) urlInput.value = url;
        if (iconInput) iconInput.value = icon;
        
        this.setType(type);
        document.getElementById("modalTitle").innerText = "Chỉnh sửa liên kết";
        document.getElementById("modalSubmitBtn").innerText = "Lưu thay đổi";
        document.getElementById("linkModal").classList.remove("hidden");
    },

    async deleteLink(id) {
        Confirm.show("Bạn có chắc chắn muốn xóa liên kết này?", async () => {
            try {
                const response = await fetch(`/api/bio/links/${id}`, {
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CONFIG.csrfToken }
                });
                if (response.ok) {
                    Toast.show("Đã xóa liên kết!", "success");
                    location.reload();
                }
            } catch (err) { 
                console.error(err);
                Toast.show("Lỗi xóa link.", "error"); 
            }
        }, { title: "Xác nhận xóa liên kết?" });
    },

    async deleteBio() {
        Confirm.show("Hành động này không thể hoàn tác! Bạn có thực sự muốn xóa Bio Page này?", async () => {
            try {
                const response = await fetch(`/api/bio/${CONFIG.bioPageId}`, {
                    method: "DELETE",
                    headers: { "X-CSRF-TOKEN": CONFIG.csrfToken }
                });
                const result = await response.json();
                if (response.ok) {
                    Toast.show(result.message, "success");
                    window.location.href = CONFIG.indexRoute;
                }
            } catch (err) { 
                console.error(err);
                Toast.show("Lỗi xóa Bio Page.", "error"); 
            }
        }, { title: "Xác nhận xóa Bio?" });
    },

    refreshPreview() {
        const desktopFrame = document.getElementById("previewFrame");
        const mobileFrame = document.getElementById("previewFrameMobile");
        
        if (desktopFrame && desktopFrame.contentWindow) {
            desktopFrame.contentWindow.location.reload();
        }
        if (mobileFrame && mobileFrame.contentWindow) {
            mobileFrame.contentWindow.location.reload();
        }
    },

    async saveInfo(e) {
        e.preventDefault();
        const form = e.target;
        const btn = form.querySelector('button[type="submit"]');
        const originalText = btn.innerText;

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            btn.disabled = true;
            btn.innerText = "ĐANG LƯU...";

            const response = await fetch(`/api/bio/${CONFIG.bioPageId}`, {
                method: "PATCH",
                headers: { 
                    "Content-Type": "application/json", 
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": CONFIG.csrfToken 
                },
                body: JSON.stringify(data)
            });
            
            const isJson = response.headers.get("content-type")?.includes("application/json");
            const result = isJson ? await response.json() : null;

            if (response.ok) {
                Toast.show("Đã lưu thay đổi!", "success");
                this.refreshPreview();
            } else {
                Toast.show(result?.message || "Lỗi lưu thông tin", "error");
            }
        } catch (err) {
            console.error(err);
            Toast.show("Lỗi kết nối máy chủ", "error");
        } finally {
            btn.disabled = false;
            btn.innerText = originalText;
        }
    },

    async saveLink(e) {
        e.preventDefault();
        const form = e.target;
        const btn = form.querySelector('button[type="submit"]');
        const originalText = btn.innerText;

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        
        if (data.url && !data.url.includes("://")) {
            data.url = "https://" + data.url;
        }

        const linkId = data.link_id;
        const url = linkId ? `/api/bio/links/${linkId}` : `/api/bio/${CONFIG.bioPageId}/links`;
        const method = linkId ? "PATCH" : "POST";
        
        try {
            btn.disabled = true;
            btn.innerText = "ĐANG XỬ LÝ...";

            const response = await fetch(url, {
                method: method,
                headers: { 
                    "Content-Type": "application/json", 
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": CONFIG.csrfToken 
                },
                body: JSON.stringify(data)
            });
            
            const isJson = response.headers.get("content-type")?.includes("application/json");
            const result = isJson ? await response.json() : null;

            if (response.ok) {
                Toast.show(linkId ? "Đã cập nhật!" : "Đã thêm link!", "success");
                this.closeLinkModal();
                location.reload();
            } else {
                const errorMsg = result?.errors ? Object.values(result.errors).flat()[0] : (result?.message || "Lỗi lưu liên kết");
                Toast.show(errorMsg, "error");
            }
        } catch (err) {
            console.error(err);
            Toast.show("Lỗi kết nối máy chủ", "error");
        } finally {
            btn.disabled = false;
            btn.innerText = originalText;
        }
    },

    async reorder() {
        const items = document.querySelectorAll("#socialIconsList [data-sort-id], #buttonLinksList [data-sort-id]");
        const order = Array.from(items).map(item => item.getAttribute("data-sort-id"));
        
        try {
            const response = await fetch(`/api/bio/${CONFIG.bioPageId}/reorder`, {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json", 
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": CONFIG.csrfToken 
                },
                body: JSON.stringify({ order })
            });
            if (response.ok) {
                Toast.show("Đã cập nhật thứ tự!", "success");
                this.refreshPreview();
            }
        } catch (err) {
            console.error(err);
        }
    },

    setType(type) {
        const typeInput = document.getElementById("linkType");
        if (!typeInput) return;
        
        typeInput.value = type;
        const btnButton = document.getElementById("type-btn-button");
        const btnSocial = document.getElementById("type-btn-social_icon");
        
        if (!btnButton || !btnSocial) return;

        if (type === "button") {
            btnButton.classList.add("bg-white", "text-slate-900", "shadow-sm");
            btnButton.classList.remove("text-slate-400");
            btnSocial.classList.remove("bg-white", "text-slate-900", "shadow-sm");
            btnSocial.classList.add("text-slate-400");
        } else {
            btnSocial.classList.add("bg-white", "text-slate-900", "shadow-sm");
            btnSocial.classList.remove("text-slate-400");
            btnButton.classList.remove("bg-white", "text-slate-900", "shadow-sm");
            btnButton.classList.add("text-slate-400");
        }
    },

    updateAvatarPreview(value) {
        const img = document.getElementById("profileImagePreview");
        if (img) img.src = value || CONFIG.avatarPlaceholder;
    },

    copyBioLink(btn) {
        const url = btn.getAttribute("data-url");
        if (url) {
            navigator.clipboard.writeText(url);
            Toast.show("Đã sao chép link!", "success");
        }
    }
};

Editor.init();
</script>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
    (function() {
        function initSortable() {
            const makeList = (id) => {
                const el = document.getElementById(id);
                if (el && typeof Sortable !== 'undefined') {
                    Sortable.create(el, {
                        handle: '.drag-handle',
                        animation: 200,
                        ghostClass: 'opacity-40',
                        onEnd: () => Editor.reorder()
                    });
                }
            };
            makeList('socialIconsList');
            makeList('buttonLinksList');
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSortable);
        } else {
            initSortable();
        }
    })();
</script>
@endpush
