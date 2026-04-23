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
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Biểu tượng mạng xã hội</span>
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
                                <p class="text-slate-400 text-xs font-bold">Chưa có icon mạng xã hội nào.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Button Links Section --}}
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-violet-400"></div>
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Danh sách nút bấm</span>
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
                                <p class="text-slate-400 text-xs font-bold">Chưa có nút bấm nào.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- TAB: APPEARANCE --}}
                <div id="tab-appearance" class="tab-content hidden animate-in fade-in slide-in-from-bottom-4 duration-300">
                    @php $theme = $bioPage->theme_data ?? []; @endphp
                    <section class="bg-white rounded-[44px] p-8 md:p-10 shadow-sm border border-slate-100">
                        <div class="mb-10">
                            <h2 class="text-2xl font-black text-slate-800 tracking-tight italic">Thiết kế trang</h2>
                            <p class="text-slate-400 font-bold text-xs mt-1">Tùy chỉnh phong cách trang Bio của bạn.</p>
                        </div>

                        <form onsubmit="Editor.saveInfo(event)" class="space-y-12">
                            @csrf
                            
                            {{-- SECTION 1: Thông tin cơ bản --}}
                            <div class="space-y-8">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest italic">1. Thông tin cơ bản</h3>
                                    <div class="flex-1 h-px bg-slate-50"></div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Tiêu đề (Tên của bạn)</label>
                                            <input type="text" name="title" value="{{ $bioPage->title }}" required
                                                oninput="Editor.updatePreviewLive('title', this.value)"
                                                class="w-full bg-slate-50 border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold focus:bg-white focus:border-brand-blue outline-none transition-all shadow-sm">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Tiểu sử ngắn (Bio)</label>
                                            <textarea name="bio" rows="4"
                                                oninput="Editor.updatePreviewLive('bio', this.value)"
                                                class="w-full bg-slate-50 border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold focus:bg-white focus:border-brand-blue outline-none transition-all resize-none shadow-sm">{{ $bioPage->bio }}</textarea>
                                        </div>
                                    </div>

                                    <div class="space-y-6">
                                        <div class="relative group">
                                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Ảnh đại diện (URL)</label>
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
                                            <p class="text-[11px] text-blue-700 font-bold leading-relaxed">Sử dụng ảnh đại diện và tiểu sử ngắn gọn để tối ưu hiển thị trên di động.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- SECTION 2: Màu sắc Trang --}}
                            <div class="space-y-8 pt-4">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest italic">2. Màu sắc Trang</h3>
                                    <div class="flex-1 h-px bg-slate-50"></div>
                                </div>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                    <div>
                                        <label class="block text-[9px] font-bold text-slate-400 uppercase mb-2 ml-1">Màu nền trang</label>
                                        <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 p-2.5 rounded-2xl min-w-0">
                                            <div class="relative w-8 h-8 shrink-0 rounded-lg overflow-hidden border border-slate-100">
                                                <input type="color" name="theme_data[background]" value="{{ $theme['background'] ?? '#f0f2f8' }}"
                                                    oninput="this.parentElement.nextElementSibling.innerText = this.value.toUpperCase(); Editor.updatePreviewLive('background', this.value)"
                                                    class="absolute -inset-2 w-[150%] h-[150%] cursor-pointer">
                                            </div>
                                            <span class="text-[9px] font-black text-slate-600 uppercase truncate">{{ $theme['background'] ?? '#F0F2F8' }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-[9px] font-bold text-slate-400 uppercase mb-2 ml-1">Màu chữ chính & Icon</label>
                                        <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 p-2.5 rounded-2xl min-w-0">
                                            <div class="relative w-8 h-8 shrink-0 rounded-lg overflow-hidden border border-slate-100">
                                                <input type="color" name="theme_data[text_color]" value="{{ $theme['text_color'] ?? '#0f172a' }}"
                                                    oninput="this.parentElement.nextElementSibling.innerText = this.value.toUpperCase(); Editor.updatePreviewLive('text_color', this.value)"
                                                    class="absolute -inset-2 w-[150%] h-[150%] cursor-pointer">
                                            </div>
                                            <span class="text-[9px] font-black text-slate-600 uppercase truncate">{{ $theme['text_color'] ?? '#0F172A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- SECTION 3: Tùy chỉnh Bio --}}
                            <div class="space-y-8 pt-4">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest italic">3. Tùy chỉnh nội dung Bio</h3>
                                    <div class="flex-1 h-px bg-slate-50"></div>
                                </div>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Màu chữ Bio</label>
                                        <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 p-2.5 rounded-2xl min-w-0">
                                            <div class="relative w-8 h-8 shrink-0 rounded-lg overflow-hidden border border-slate-100">
                                                <input type="color" name="theme_data[bio_text_color]" value="{{ $theme['bio_text_color'] ?? '#64748b' }}"
                                                    oninput="this.parentElement.nextElementSibling.innerText = this.value.toUpperCase(); Editor.updatePreviewLive('bio_text_color', this.value)"
                                                    class="absolute -inset-2 w-[150%] h-[150%] cursor-pointer">
                                            </div>
                                            <span class="text-[9px] font-black text-slate-600 uppercase truncate">{{ $theme['bio_text_color'] ?? '#64748B' }}</span>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Màu nền Bio</label>
                                        <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 p-2.5 rounded-2xl min-w-0">
                                            <div class="relative w-8 h-8 shrink-0 rounded-lg overflow-hidden border border-slate-100">
                                                <input type="color" name="theme_data[bio_bg_color]" value="{{ $theme['bio_bg_color'] ?? '#ffffff' }}"
                                                    oninput="this.parentElement.nextElementSibling.innerText = (this.value === '#ffffff' ? 'Không có' : this.value.toUpperCase()); Editor.updatePreviewLive('bio_bg_color', this.value)"
                                                    class="absolute -inset-2 w-[150%] h-[150%] cursor-pointer">
                                            </div>
                                            <span class="text-[9px] font-black text-slate-600 uppercase truncate">{{ (isset($theme['bio_bg_color']) && $theme['bio_bg_color'] !== 'transparent' && $theme['bio_bg_color'] !== '#ffffff') ? $theme['bio_bg_color'] : 'Không có' }}</span>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Căn lề</label>
                                        <div class="flex p-1 bg-slate-50 rounded-2xl border border-slate-100">
                                            <button type="button" onclick="Editor.setBioAlign('left')" id="align-btn-left"
                                                class="bio-align-btn flex-1 py-3 rounded-xl transition-all flex items-center justify-center {{ ($theme['bio_text_align'] ?? 'center') === 'left' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h10M4 18h16"/></svg>
                                            </button>
                                            <button type="button" onclick="Editor.setBioAlign('center')" id="align-btn-center"
                                                class="bio-align-btn flex-1 py-3 rounded-xl transition-all flex items-center justify-center {{ ($theme['bio_text_align'] ?? 'center') === 'center' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M7 12h10M4 18h16"/></svg>
                                            </button>
                                            <button type="button" onclick="Editor.setBioAlign('right')" id="align-btn-right"
                                                class="bio-align-btn flex-1 py-3 rounded-xl transition-all flex items-center justify-center {{ ($theme['bio_text_align'] ?? 'right') === 'right' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M10 12h10M4 18h16"/></svg>
                                            </button>
                                        </div>
                                        <input type="hidden" name="theme_data[bio_text_align]" id="bioTextAlign" value="{{ $theme['bio_text_align'] ?? 'center' }}">
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Kích cỡ & Độ đậm</label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <select name="theme_data[bio_text_size]" 
                                                onchange="Editor.updatePreviewLive('bio_text_size', this.value)"
                                                class="w-full bg-slate-50 border border-slate-100 py-3.5 px-4 rounded-2xl text-[11px] font-black text-slate-700 outline-none focus:bg-white focus:border-brand-blue transition-all">
                                                <option value="text-[12px]" {{ ($theme['bio_text_size'] ?? '') === 'text-[12px]' ? 'selected' : '' }}>Nhỏ</option>
                                                <option value="text-[14px]" {{ ($theme['bio_text_size'] ?? 'text-[14px]') === 'text-[14px]' ? 'selected' : '' }}>Vừa</option>
                                                <option value="text-[16px]" {{ ($theme['bio_text_size'] ?? '') === 'text-[16px]' ? 'selected' : '' }}>Lớn</option>
                                            </select>
                                            <select name="theme_data[bio_text_weight]" 
                                                onchange="Editor.updatePreviewLive('bio_text_weight', this.value)"
                                                class="w-full bg-slate-50 border border-slate-100 py-3.5 px-4 rounded-2xl text-[11px] font-black text-slate-700 outline-none focus:bg-white focus:border-brand-blue transition-all">
                                                <option value="font-normal" {{ ($theme['bio_text_weight'] ?? '') === 'font-normal' ? 'selected' : '' }}>Thường</option>
                                                <option value="font-medium" {{ ($theme['bio_text_weight'] ?? 'font-medium') === 'font-medium' ? 'selected' : '' }}>Vừa</option>
                                                <option value="font-bold" {{ ($theme['bio_text_weight'] ?? '') === 'font-bold' ? 'selected' : '' }}>Đậm</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- SECTION 4: Phong cách Nút bấm --}}
                            <div class="space-y-8 pt-4">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest italic">4. Phong cách Nút bấm</h3>
                                    <div class="flex-1 h-px bg-slate-50"></div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-[9px] font-bold text-slate-400 uppercase mb-3 ml-1">Kiểu hiển thị</label>
                                            <div class="flex p-1 bg-slate-50 rounded-2xl border border-slate-100">
                                                <button type="button" onclick="Editor.setButtonType('solid')" id="type-btn-solid"
                                                    class="btn-type-btn flex-1 py-2.5 rounded-xl text-[9px] font-black uppercase transition-all {{ ($theme['button_type'] ?? 'solid') === 'solid' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                    Đầy
                                                </button>
                                                <button type="button" onclick="Editor.setButtonType('outline')" id="type-btn-outline"
                                                    class="btn-type-btn flex-1 py-2.5 rounded-xl text-[9px] font-black uppercase transition-all {{ ($theme['button_type'] ?? '') === 'outline' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                    Viền
                                                </button>
                                                <button type="button" onclick="Editor.setButtonType('soft')" id="type-btn-soft"
                                                    class="btn-type-btn flex-1 py-2.5 rounded-xl text-[9px] font-black uppercase transition-all {{ ($theme['button_type'] ?? '') === 'soft' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                    Mờ
                                                </button>
                                            </div>
                                            <input type="hidden" name="theme_data[button_type]" id="buttonType" value="{{ $theme['button_type'] ?? 'solid' }}">
                                        </div>

                                        <div>
                                            <label class="block text-[9px] font-bold text-slate-400 uppercase mb-3 ml-1">Độ bo góc</label>
                                            <div class="flex p-1 bg-slate-50 rounded-2xl border border-slate-100 overflow-x-auto no-scrollbar">
                                                <button type="button" onclick="Editor.setButtonStyle('none')" id="style-btn-none"
                                                    class="btn-style-btn flex-1 min-w-[60px] py-2.5 rounded-xl text-[9px] font-black uppercase transition-all {{ ($theme['button_style'] ?? '2xl') === 'none' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                    Vuông
                                                </button>
                                                <button type="button" onclick="Editor.setButtonStyle('xl')" id="style-btn-xl"
                                                    class="btn-style-btn flex-1 min-w-[60px] py-2.5 rounded-xl text-[9px] font-black uppercase transition-all {{ ($theme['button_style'] ?? '2xl') === 'xl' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                    Vừa
                                                </button>
                                                <button type="button" onclick="Editor.setButtonStyle('2xl')" id="style-btn-2xl"
                                                    class="btn-style-btn flex-1 min-w-[60px] py-2.5 rounded-xl text-[9px] font-black uppercase transition-all {{ ($theme['button_style'] ?? '2xl') === '2xl' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                    Lớn
                                                </button>
                                                <button type="button" onclick="Editor.setButtonStyle('full')" id="style-btn-full"
                                                    class="btn-style-btn flex-1 min-w-[60px] py-2.5 rounded-xl text-[9px] font-black uppercase transition-all {{ ($theme['button_style'] ?? '2xl') === 'full' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-400 hover:text-slate-600' }}">
                                                    Tròn
                                                </button>
                                            </div>
                                            <input type="hidden" name="theme_data[button_style]" id="buttonStyle" value="{{ $theme['button_style'] ?? '2xl' }}">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[9px] font-bold text-slate-400 uppercase mb-2 ml-1">Màu nền nút</label>
                                            <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 p-2.5 rounded-2xl min-w-0">
                                                <div class="relative w-8 h-8 shrink-0 rounded-lg overflow-hidden border border-slate-100">
                                                    <input type="color" name="theme_data[button_bg]" value="{{ $theme['button_bg'] ?? '#2563eb' }}"
                                                        oninput="this.parentElement.nextElementSibling.innerText = this.value.toUpperCase(); Editor.updatePreviewLive('button_bg', this.value)"
                                                        class="absolute -inset-2 w-[150%] h-[150%] cursor-pointer">
                                                </div>
                                                <span class="text-[9px] font-black text-slate-600 uppercase truncate">{{ $theme['button_bg'] ?? '#2563EB' }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-[9px] font-bold text-slate-400 uppercase mb-2 ml-1">Màu chữ nút</label>
                                            <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 p-2.5 rounded-2xl min-w-0">
                                                <div class="relative w-8 h-8 shrink-0 rounded-lg overflow-hidden border border-slate-100">
                                                    <input type="color" name="theme_data[button_text]" value="{{ $theme['button_text'] ?? '#ffffff' }}"
                                                        oninput="this.parentElement.nextElementSibling.innerText = this.value.toUpperCase(); Editor.updatePreviewLive('button_text', this.value)"
                                                        class="absolute -inset-2 w-[150%] h-[150%] cursor-pointer">
                                                </div>
                                                <span class="text-[9px] font-black text-slate-600 uppercase truncate">{{ $theme['button_text'] ?? '#FFFFFF' }}</span>
                                            </div>
                                        </div>
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
                                <p class="text-slate-500 text-xs font-bold leading-relaxed mb-6">Hành động này không thể hoàn tác.</p>
                                <button onclick="Editor.deleteBio()" class="bg-rose-500 hover:bg-rose-600 text-white font-black px-8 py-3.5 rounded-xl transition-all active:scale-95 text-[10px] uppercase tracking-widest shadow-lg shadow-rose-100">Xóa Bio Page này</button>
                            </div>
                        </div>
                    </section>
                </div>

                {{-- TAB: PREVIEW (Mobile Only) --}}
                <div id="tab-preview" class="tab-content hidden md:hidden animate-in fade-in slide-in-from-bottom-4 duration-300">
                    <div class="bg-white rounded-[44px] p-6 shadow-sm border border-slate-100">
                        <div class="mb-6 flex items-center justify-between">
                            <h2 class="text-xl font-black text-slate-800 tracking-tight italic">Xem trước</h2>
                            <button onclick="Editor.refreshPreview()" class="p-3 bg-slate-50 text-slate-400 hover:text-brand-blue rounded-xl transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                            </button>
                        </div>
                        <div class="relative mx-auto rounded-[40px] overflow-hidden border-8 border-slate-900 shadow-2xl" style="height: 600px; max-width: 320px;">
                            <iframe id="previewFrameMobile" src="{{ route('bio.show', $bioPage->slug) }}" class="w-full h-full border-none"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Preview Mobile bên phải (Desktop) --}}
            <div class="md:col-span-5 md:sticky md:top-28 hidden md:block">
                <div class="text-center mb-4">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Xem trước trực tiếp</span>
                </div>
                <div class="relative mx-auto" style="width: 320px">
                    <div class="relative rounded-[52px] p-[10px] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.35),0_0_0_1px_rgba(255,255,255,0.08)]" style="background: linear-gradient(145deg, #2a2d35 0%, #1a1c22 100%)">
                        <div class="bg-white rounded-[44px] overflow-hidden relative" style="height: 660px">
                            <iframe id="previewFrame" src="{{ route('bio.show', $bioPage->slug) }}" class="w-full h-full border-none pointer-events-none"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tab-btn.active { background-color: white; color: #0f172a; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05); }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

{{-- Modal Thêm/Sửa Link --}}
<div id="linkModal" class="fixed inset-0 z-[100] hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm">
    <div onclick="if(event.target===this) Editor.closeLinkModal()" class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-xl bg-white rounded-[44px] shadow-2xl p-8 md:p-12 animate-in zoom-in-95 duration-300">
            <button onclick="Editor.closeLinkModal()" class="absolute top-10 right-10 text-slate-300 hover:text-slate-900 bg-slate-50 w-10 h-10 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
            <div class="mb-10 text-center">
                <h2 id="modalTitle" class="text-3xl font-black text-slate-800 tracking-tight italic mb-2">Liên kết</h2>
            </div>
            <form id="linkForm" onsubmit="Editor.saveLink(event)" class="space-y-6">
                @csrf
                <input type="hidden" name="link_id" id="linkIdInput">
                <div class="p-6 bg-slate-50 rounded-[32px] border border-slate-100 space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Đường dẫn URL</label>
                        <input type="url" name="url" id="linkUrl" required class="w-full bg-white border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold outline-none focus:border-brand-blue">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Tên hiển thị</label>
                        <input type="text" name="label" id="linkLabel" required class="w-full bg-white border border-slate-100 py-4 px-6 rounded-2xl text-slate-800 font-bold outline-none focus:border-brand-blue">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Kiểu hiển thị</label>
                    <div class="flex p-1 bg-slate-50 rounded-2xl border border-slate-100">
                        <button type="button" onclick="Editor.setType('button')" id="type-btn-button" class="flex-1 py-3 px-4 rounded-xl text-[10px] font-black uppercase transition-all">Nút bấm</button>
                        <button type="button" onclick="Editor.setType('social_icon')" id="type-btn-social_icon" class="flex-1 py-3 px-4 rounded-xl text-[10px] font-black uppercase transition-all">Icon</button>
                    </div>
                    <input type="hidden" name="type" id="linkType" value="button">
                    <input type="hidden" name="icon" id="linkIcon">
                </div>
                <button type="submit" id="modalSubmitBtn" class="w-full bg-brand-blue text-white font-black py-5 rounded-[24px] shadow-xl text-[11px] uppercase tracking-widest">Lưu liên kết</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const CONFIG = { bioPageId: "{{ $bioPage->slug }}", avatarPlaceholder: "{{ asset('avatar-placeholder.png') }}", csrfToken: "{{ csrf_token() }}", indexRoute: "{{ route('bio.index') }}" };
const Editor = {
    platforms: {
        facebook: { regex: /(facebook\.com|fb\.com|fb\.watch)/i, name: "Facebook", icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>` },
        instagram: { regex: /instagram\.com/i, name: "Instagram", icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>` },
        tiktok: { regex: /tiktok\.com/i, name: "TikTok", icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>` },
        youtube: { regex: /(youtube\.com|youtu\.be)/i, name: "YouTube", icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2C1 8.11 1 12 1 12s0 3.89.46 5.58a2.78 2.78 0 0 0 1.94 2C5.12 20 12 20 12 20s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2C23 15.89 23 12 23 12s0-3.89-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>` },
        github: { regex: /github\.com/i, name: "GitHub", icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>` }
    },
    init() {
        const urlInput = document.getElementById("linkUrl");
        if (urlInput) urlInput.addEventListener("input", (e) => this.detectPlatform(e.target.value));
    },
    setTab(tab) {
        document.querySelectorAll(".tab-btn, .mobile-tab-btn").forEach(btn => {
            btn.classList.remove("active", "bg-white", "shadow-sm", "text-slate-900", "text-slate-800");
            btn.classList.add("text-slate-400");
        });
        document.querySelectorAll(".tab-content").forEach(c => c.classList.add("hidden"));
        const btn = document.getElementById(`tab-btn-${tab}`);
        if (btn) { btn.classList.add("active", "bg-white", "shadow-sm", "text-slate-900"); btn.classList.remove("text-slate-400"); }
        const mBtn = document.getElementById(`tab-btn-${tab}-mobile`);
        if (mBtn) { mBtn.classList.add("bg-white", "shadow-sm", "text-slate-800"); mBtn.classList.remove("text-slate-400"); }
        const cont = document.getElementById(`tab-${tab}`);
        if (cont) cont.classList.remove("hidden");
    },
    detectPlatform(url) {
        if (!url) return;
        const labelInput = document.getElementById("linkLabel");
        const iconInput = document.getElementById("linkIcon");
        for (const [key, platform] of Object.entries(this.platforms)) {
            if (platform.regex.test(url)) {
                this.setType("social_icon");
                if (labelInput && !labelInput.value) labelInput.value = platform.name;
                if (iconInput) iconInput.value = platform.icon;
                break;
            }
        }
    },
    openLinkModal() {
        document.getElementById("linkForm").reset();
        document.getElementById("linkIdInput").value = "";
        this.setType("button");
        document.getElementById("modalTitle").innerText = "Thêm liên kết";
        document.getElementById("linkModal").classList.remove("hidden");
    },
    closeLinkModal() { document.getElementById("linkModal").classList.add("hidden"); },
    openEditModal(btn) {
        document.getElementById("linkIdInput").value = btn.getAttribute("data-id");
        document.getElementById("linkLabel").value = btn.getAttribute("data-label");
        document.getElementById("linkUrl").value = btn.getAttribute("data-url");
        document.getElementById("linkIcon").value = btn.getAttribute("data-icon");
        this.setType(btn.getAttribute("data-type"));
        document.getElementById("modalTitle").innerText = "Chỉnh sửa liên kết";
        document.getElementById("linkModal").classList.remove("hidden");
    },
    async deleteLink(id) {
        Confirm.show("Xóa liên kết này?", async () => {
            const r = await fetch(`/api/bio/links/${id}`, { method: "DELETE", headers: { "X-CSRF-TOKEN": CONFIG.csrfToken } });
            if (r.ok) { Toast.show("Đã xóa!"); location.reload(); }
        });
    },
    async deleteBio() {
        Confirm.show("Xóa Bio Page này?", async () => {
            const r = await fetch(`/api/bio/${CONFIG.bioPageId}`, { method: "DELETE", headers: { "X-CSRF-TOKEN": CONFIG.csrfToken } });
            if (r.ok) location.href = CONFIG.indexRoute;
        });
    },
    refreshPreview() {
        const d = document.getElementById("previewFrame");
        const m = document.getElementById("previewFrameMobile");
        if (d) d.contentWindow.location.reload();
        if (m) m.contentWindow.location.reload();
    },
    setBioAlign(align) {
        document.getElementById("bioTextAlign").value = align;
        document.querySelectorAll(".bio-align-btn").forEach(b => { b.classList.remove("bg-white", "shadow-sm", "text-slate-900"); b.classList.add("text-slate-400"); });
        document.getElementById(`align-btn-${align}`).classList.add("bg-white", "shadow-sm", "text-slate-900");
        this.updatePreviewLive('bio_text_align', align);
    },
    setButtonStyle(style) {
        document.getElementById("buttonStyle").value = style;
        document.querySelectorAll(".btn-style-btn").forEach(b => { b.classList.remove("bg-white", "shadow-sm", "text-slate-900"); b.classList.add("text-slate-400"); });
        document.getElementById(`style-btn-${style}`).classList.add("bg-white", "shadow-sm", "text-slate-900");
        this.updatePreviewLive('button_style', style);
    },
    setButtonType(type) {
        document.getElementById("buttonType").value = type;
        document.querySelectorAll(".btn-type-btn").forEach(b => { b.classList.remove("bg-white", "shadow-sm", "text-slate-900"); b.classList.add("text-slate-400"); });
        document.getElementById(`type-btn-${type}`).classList.add("bg-white", "shadow-sm", "text-slate-900");
        this.updatePreviewLive('button_type', type);
    },
    updatePreviewLive(key, value) {
        const d = document.getElementById("previewFrame");
        const m = document.getElementById("previewFrameMobile");
        const update = (f) => {
            if (!f || !f.contentDocument) return;
            const doc = f.contentDocument;
            switch(key) {
                case 'background': doc.body.style.backgroundColor = value; break;
                case 'text_color': const t = doc.getElementById('preview-title'); if (t) t.style.color = value; doc.querySelectorAll('.social-icon-wrap').forEach(i => i.style.color = value); break;
                case 'bio_text_color': const bt = doc.getElementById('preview-bio-text'); if (bt) bt.style.color = value; break;
                case 'bio_bg_color': const bc = doc.getElementById('preview-bio-container'); if (bc) { bc.style.backgroundColor = value; if (value !== 'transparent' && value !== '#ffffff') bc.classList.add('px-6', 'py-4', 'rounded-3xl', 'shadow-sm', 'border', 'border-black/5'); else bc.classList.remove('px-6', 'py-4', 'rounded-3xl', 'shadow-sm', 'border', 'border-black/5'); } break;
                case 'bio_text_align': const bp = doc.getElementById('preview-bio-text'); if (bp) bp.style.textAlign = value; break;
                case 'bio_text_size': const bs = doc.getElementById('preview-bio-text'); if (bs) { bs.classList.remove('text-[12px]', 'text-[14px]', 'text-[16px]'); bs.classList.add(value); } break;
                case 'bio_text_weight': const bw = doc.getElementById('preview-bio-text'); if (bw) { bw.classList.remove('font-normal', 'font-medium', 'font-bold'); bw.classList.add(value); } break;
                case 'button_bg': doc.querySelectorAll('.bio-link-btn').forEach(b => b.style.backgroundColor = value); break;
                case 'button_text': doc.querySelectorAll('.bio-link-btn').forEach(b => b.style.color = value); break;
                case 'button_type': doc.querySelectorAll('.bio-link-btn').forEach(b => { const bg = document.querySelector('input[name="theme_data[button_bg]"]').value; b.style.backgroundColor = value === 'solid' ? bg : 'transparent'; b.style.border = value === 'outline' ? `2px solid ${bg}` : 'none'; b.style.color = value === 'solid' ? '#fff' : bg; }); break;
                case 'button_style': doc.querySelectorAll('.bio-link-btn').forEach(b => { b.classList.remove('rounded-none', 'rounded-xl', 'rounded-2xl', 'rounded-full'); b.classList.add(`rounded-${value}`); }); break;
                case 'title': const pt = doc.getElementById('preview-title'); if (pt) pt.innerText = value; break;
                case 'bio': const pb = doc.getElementById('preview-bio-text'); if (pb) pb.innerText = value; break;
            }
        };
        update(d); update(m);
    },
    async saveInfo(e) {
        e.preventDefault();
        const f = e.target;
        const fd = new FormData(f);
        const data = {};
        const td = {};
        for (const [k, v] of fd.entries()) { if (k.startsWith('theme_data[')) { const tk = k.match(/\[(.*?)\]/)[1]; td[tk] = v; } else data[k] = v; }
        data.theme_data = td;
        const r = await fetch(`/api/bio/${CONFIG.bioPageId}`, { method: "PATCH", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": CONFIG.csrfToken }, body: JSON.stringify(data) });
        if (r.ok) Toast.show("Đã lưu!");
    },
    async saveLink(e) {
        e.preventDefault();
        const f = e.target;
        const fd = new FormData(f);
        const data = Object.fromEntries(fd.entries());
        const id = data.link_id;
        const url = id ? `/api/bio/links/${id}` : `/api/bio/${CONFIG.bioPageId}/links`;
        const r = await fetch(url, { method: id ? "PATCH" : "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": CONFIG.csrfToken }, body: JSON.stringify(data) });
        if (r.ok) location.reload();
    },
    async reorder() {
        const items = document.querySelectorAll("#socialIconsList [data-sort-id], #buttonLinksList [data-sort-id]");
        const order = Array.from(items).map(i => i.getAttribute("data-sort-id"));
        await fetch(`/api/bio/${CONFIG.bioPageId}/reorder`, { method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": CONFIG.csrfToken }, body: JSON.stringify({ order }) });
    },
    setType(type) {
        document.getElementById("linkType").value = type;
        const b = document.getElementById("type-btn-button");
        const s = document.getElementById("type-btn-social_icon");
        if (type === "button") { b.classList.add("bg-white", "shadow-sm"); s.classList.remove("bg-white", "shadow-sm"); }
        else { s.classList.add("bg-white", "shadow-sm"); b.classList.remove("bg-white", "shadow-sm"); }
    },
    updateAvatarPreview(v) { const i = document.getElementById("profileImagePreview"); if (i) i.src = v || CONFIG.avatarPlaceholder; },
    copyBioLink(b) { navigator.clipboard.writeText(b.getAttribute("data-url")); Toast.show("Đã chép link!"); }
};
Editor.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
    (function() {
        function init() {
            const make = (id) => {
                const el = document.getElementById(id);
                if (el) Sortable.create(el, { handle: '.drag-handle', animation: 200, onEnd: () => Editor.reorder() });
            };
            make('socialIconsList'); make('buttonLinksList');
        }
        init();
    })();
</script>
@endpush