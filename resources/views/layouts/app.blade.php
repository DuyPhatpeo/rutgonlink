<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LinkSnap - Hệ thống rút gọn link chuyên nghiệp')</title>
    
    <!-- Dynamic Social Preview (OG Tags) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', 'LinkSnap - URL Shortener')">
    <meta property="og:description" content="@yield('og_description', 'Rút gọn liên kết nhanh chóng và bảo mật.')">
    <meta property="og:image" content="@yield('og_image', asset('logo.png'))">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'LinkSnap - URL Shortener')">
    <meta name="twitter:description" content="@yield('og_description', 'Rút gọn liên kết nhanh chóng và bảo mật.')">
    <meta name="twitter:image" content="@yield('og_image', asset('logo.png'))">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- High-Quality Logo Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        inter: ['Inter', 'sans-serif'],
                        vietnam: ['"Be Vietnam Pro"', 'sans-serif']
                    },
                    colors: { 
                        'brand-blue': '#2563eb', 
                        'brand-indigo': '#4f46e5',
                        'brand-green': '#059669', 
                        'bg-soft': '#f8fafc',
                    },
                    borderRadius: {
                        '4xl': '2rem',
                        '5xl': '3rem',
                    },
                    boxShadow: {
                        'premium': '0 20px 50px -12px rgba(37, 99, 235, 0.12)',
                        'glass': 'inset 0 0 0 1px rgba(255, 255, 255, 0.4)',
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
            .glass { 
                background-color: rgb(255 255 255 / 0.7);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border: 1px solid rgb(255 255 255 / 0.4);
                box-shadow: 0 20px 50px -12px rgba(37, 99, 235, 0.12);
            }
            .glass-dark {
                background-color: rgb(15 23 42 / 0.8);
                backdrop-filter: blur(24px);
                -webkit-backdrop-filter: blur(24px);
                border: 1px solid rgb(51 65 85 / 0.3);
                box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="font-vietnam min-h-screen text-slate-900 bg-white selection:bg-blue-100 selection:text-brand-blue" data-auth="{{ Auth::check() ? '1' : '0' }}">
    {{-- Background Blobs --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-blue-100/40 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute top-[20%] -right-[10%] w-[35%] h-[45%] bg-indigo-50/40 rounded-full blur-[100px] animate-pulse delay-700"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[50%] h-[30%] bg-sky-50/50 rounded-full blur-[120px]"></div>
    </div>
    <!-- Thanh điều hướng (Navbar) -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200/50 shadow-sm transition-all duration-300">
        <nav class="max-w-7xl mx-auto px-4 md:px-6 py-4 flex justify-between items-center transition-all">
            <div class="flex items-center gap-3 select-none cursor-pointer group active:scale-95 transition-all" onclick="window.location.assign('/')">
                <img src="{{ asset('logo.png') }}" alt="LinkSnap Logo" class="w-10 h-10 rounded-xl shadow-lg shadow-blue-100 group-hover:shadow-blue-200 transition-all">
                <span class="text-2xl md:text-3xl font-black text-slate-800 tracking-tighter italic">LinkSnap</span>
            </div>
            <div class="flex items-center gap-2 md:gap-6">
                <!-- Nút Gọi ý Ctrl K (toàn cục) -->
                <button onclick="window.globalActionShortcut && window.globalActionShortcut()" class="hidden md:flex items-center justify-between w-56 lg:w-64 px-3.5 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200/80 rounded-2xl text-slate-400 transition-all shadow-sm group active:scale-[0.98]" title="Rút gọn link nhanh">
                    <div class="flex items-center gap-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover:text-brand-blue transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        <span class="text-[11px] font-bold text-slate-500 group-hover:text-slate-700 transition-colors">Rút gọn nhanh...</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <kbd class="text-[9px] font-black font-sans text-slate-400 bg-white border border-slate-200 px-1.5 py-0.5 rounded-md shadow-sm group-hover:text-brand-blue group-hover:border-blue-200 transition-all tracking-widest">CTRL</kbd>
                        <kbd class="text-[9px] font-black font-sans text-slate-400 bg-white border border-slate-200 px-1.5 py-0.5 rounded-md shadow-sm group-hover:text-brand-blue group-hover:border-blue-200 transition-all tracking-widest">K</kbd>
                    </div>
                </button>

                @auth
                    {{-- Desktop Links --}}
                    <div class="hidden md:flex items-center gap-8 mr-6 border-r border-slate-200/60 pr-8">
                        <a href="/" class="text-xs font-black {{ Request::is('/') ? 'text-brand-blue' : 'text-slate-400' }} hover:text-brand-blue transition-all uppercase tracking-widest">Liên kết</a>
                        <a href="/bio" class="text-xs font-black {{ Request::is('bio*') ? 'text-brand-blue' : 'text-slate-400' }} hover:text-brand-blue transition-all uppercase tracking-widest">Trang Bio</a>
                    </div>
                    
                    {{-- Desktop User Info & Logout --}}
                    <div class="hidden md:flex items-center gap-4">
                        <div class="flex flex-col items-end">
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">Tài khoản</span>
                            <span class="text-slate-800 font-bold text-sm leading-none">{{ Auth::user()->name }}</span>
                        </div>
                        <form action="/api/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Đăng xuất">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            </button>
                        </form>
                    </div>

                    {{-- Mobile Hamburger --}}
                    <button onclick="Navbar.openMobileMenu()" class="flex md:hidden p-2 text-slate-400 hover:text-brand-blue hover:bg-blue-50 rounded-xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                @else
                    {{-- Guest Buttons --}}
                    <div class="flex items-center gap-2 md:gap-4">
                        <button onclick="Modal.open('loginModal')" class="text-[10px] md:text-xs font-black bg-brand-blue text-white px-4 md:px-6 py-2.5 md:py-3 rounded-2xl shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all uppercase tracking-widest">Đăng nhập</button>
                        <button onclick="Modal.open('registerModal')" class="hidden sm:block text-[10px] md:text-xs font-black text-slate-400 hover:text-slate-600 px-3 md:px-4 py-2.5 md:py-3 transition-all uppercase tracking-widest">Đăng ký</button>
                    </div>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Vùng nội dung chính -->
    <main>
        @yield('content')
    </main>

    <!-- Premium Footer Section -->
    <footer class="bg-white border-t border-slate-100 pt-16 pb-12 relative z-10 overflow-hidden">
        {{-- Decorative element --}}
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-50/50 rounded-full blur-3xl translate-y-32 translate-x-32 -z-10"></div>
        
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
                {{-- Column 1: Brand --}}
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('logo.png') }}" alt="LinkSnap" class="w-10 h-10 rounded-xl shadow-lg shadow-blue-100">
                        <span class="text-2xl font-black text-slate-800 tracking-tighter italic">LinkSnap</span>
                    </div>
                    <p class="text-slate-500 font-medium text-sm leading-relaxed max-w-xs">
                        Nền tảng rút gọn liên kết và tạo trang Bio Profile chuyên nghiệp, giúp bạn nâng tầm thương hiệu cá nhân trên mọi mạng xã hội.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-blue-50 hover:text-brand-blue transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-blue-50 hover:text-brand-blue transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.078.07-1.265.15-3.252 1.664-4.771 4.919-4.919 1.265-.057 1.644-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>
                
                {{-- Column 2: Products --}}
                <div class="space-y-6">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] italic">Khám phá</h4>
                    <ul class="space-y-4">
                        <li><a href="/" class="text-sm font-bold text-slate-600 hover:text-brand-blue transition-colors">Rút gọn liên kết</a></li>
                        <li><a href="{{ route('bio.index') }}" class="text-sm font-bold text-slate-600 hover:text-brand-blue transition-colors">Tạo Trang Bio</a></li>
                        <li><a href="#" class="text-sm font-bold text-slate-400 hover:text-brand-blue transition-colors opacity-60 cursor-not-allowed">Phân tích chuyên sâu</a></li>
                    </ul>
                </div>
                
                {{-- Column 3: Account --}}
                <div class="space-y-6">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] italic">Tài khoản</h4>
                    <ul class="space-y-4">
                        @auth
                            <li><a href="/" class="text-sm font-bold text-slate-600 hover:text-brand-blue transition-colors">Bảng điều khiển</a></li>
                            <li><a href="{{ route('bio.index') }}" class="text-sm font-bold text-slate-600 hover:text-brand-blue transition-colors">Quản lý Bio</a></li>
                        @else
                            <li><button onclick="Modal.open('loginModal')" class="text-sm font-bold text-slate-500 hover:text-brand-blue transition-colors">Đăng nhập</button></li>
                            <li><button onclick="Modal.open('registerModal')" class="text-sm font-bold text-slate-500 hover:text-brand-blue transition-colors">Tham gia ngay</button></li>
                        @endauth
                    </ul>
                </div>
            </div>
            
            {{-- Bottom Bar --}}
            <div class="pt-8 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">&copy; {{ date('Y') }} LINKSNAP</span>
                    <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em]">Phát triển bởi LinkSnap</span>
                </div>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-[10px] font-black text-slate-400 hover:text-slate-900 uppercase tracking-widest transition-colors">Điều khoản</a>
                    <a href="#" class="text-[10px] font-black text-slate-400 hover:text-slate-900 uppercase tracking-widest transition-colors">Bảo mật</a>
                </div>
            </div>
        </div>
    </footer>
    
    @auth
    {{-- Mobile Menu Drawer --}}
    <div id="mobileMenu" class="fixed inset-0 z-[100] invisible pointer-events-none transition-all duration-300">
        <!-- Backdrop -->
        <div id="mobileMenuBackdrop" onclick="Navbar.closeMobileMenu()" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm opacity-0 transition-opacity duration-300"></div>
        
        <!-- Drawer Content -->
        <div id="mobileMenuDrawer" class="absolute top-0 right-0 h-full w-80 bg-white shadow-2xl translate-x-full transition-transform duration-300 ease-out flex flex-col">
            {{-- Header --}}
            <div class="flex items-center justify-between p-6 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-9 h-9 rounded-xl shadow-lg shadow-blue-100">
                <span class="text-xl font-black text-slate-800 tracking-tighter italic">LinkSnap Menu</span>
            </div>
                <button onclick="Navbar.closeMobileMenu()" class="p-2 text-slate-400 hover:text-rose-500 bg-slate-50 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            {{-- Profile Section --}}
            <div class="p-6 bg-slate-50/50 border-b border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-blue flex items-center justify-center text-white text-xl font-black shadow-lg shadow-blue-100">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">Đăng nhập với</p>
                        <p class="text-slate-800 font-bold text-base leading-none">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>

            {{-- Links --}}
            <div class="flex-1 p-6 space-y-4">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] mb-4">Điều hướng</p>
                <a href="/" class="flex items-center justify-between px-5 py-4 rounded-3xl {{ Request::is('/') ? 'bg-brand-blue text-white shadow-lg shadow-blue-100' : 'bg-white text-slate-600 border border-slate-100' }} transition-all group active:scale-95">
                    <div class="flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826a4 4 0 015.656 0l4 4a4 4 0 01-5.656 5.656l-1.1-1.1" /></svg>
                        <span class="font-black text-xs uppercase tracking-widest">Liên kết của tôi</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                </a>

                <a href="/bio" class="flex items-center justify-between px-5 py-4 rounded-3xl {{ Request::is('bio*') ? 'bg-brand-blue text-white shadow-lg shadow-blue-100' : 'bg-white text-slate-600 border border-slate-100' }} transition-all group active:scale-95">
                    <div class="flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span class="font-black text-xs uppercase tracking-widest">Trang Bio</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>

            {{-- Footer / Logout --}}
            <div class="p-6 border-t border-slate-100">
                <form action="/api/logout" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-3 px-6 py-4 bg-rose-50 text-rose-500 rounded-3xl font-black text-xs uppercase tracking-widest hover:bg-rose-500 hover:text-white transition-all shadow-sm active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        Đăng xuất tài khoản
                    </button>
                </form>
                <p class="text-center text-slate-300 text-[9px] font-bold uppercase tracking-[0.3em] mt-6 italic">Built with snap &bull; v1.2</p>
            </div>
        </div>
    </div>
    @endauth

    <!-- Modals -->
    @include('partials.modals')

    <!-- Scripts -->
    @include('partials.scripts')
    @stack('scripts')

    {{-- Flash Data for JS --}}
    <div id="flash-data" 
         data-error="{{ session('error') }}" 
         data-success="{{ session('success') }}" 
         class="hidden"></div>

    {{-- Tự động hiển thị Toast từ Session Flash --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const flashData = document.getElementById('flash-data');
            const error = flashData.getAttribute('data-error');
            const success = flashData.getAttribute('data-success');

            if (error) Toast.show(error, 'error');
            if (success) Toast.show(success, 'success');
        });
    </script>
</body>
</html>
