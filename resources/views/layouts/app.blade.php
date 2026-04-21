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
            <div class="text-2xl md:text-3xl font-black text-brand-blue tracking-tighter select-none cursor-pointer hover:opacity-80 active:scale-95 transition-all" onclick="window.location.assign('/')">LinkSnap</div>
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
                    <div class="flex items-center gap-4 md:gap-8 mr-2 md:mr-6 border-r border-slate-200/60 pr-4 md:pr-8">
                        <a href="/" class="text-[10px] md:text-xs font-black {{ Request::is('/') ? 'text-brand-blue' : 'text-slate-400' }} hover:text-brand-blue transition-all uppercase tracking-widest">Links</a>
                        <a href="/bio" class="text-[10px] md:text-xs font-black {{ Request::is('bio*') ? 'text-brand-blue' : 'text-slate-400' }} hover:text-brand-blue transition-all uppercase tracking-widest">Bio Pages</a>
                    </div>
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="flex flex-col items-end">
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">Owner</span>
                            <span class="text-slate-800 font-bold text-sm hidden md:inline leading-none">{{ Auth::user()->name }}</span>
                        </div>
                        <form action="/api/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Đăng xuất">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-2 md:gap-4">
                        <button onclick="Modal.open('loginModal')" class="text-[10px] md:text-xs font-black bg-brand-blue text-white px-4 md:px-6 py-2.5 md:py-3 rounded-2xl shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all uppercase tracking-widest">Đăng nhập</button>
                        <button onclick="Modal.open('registerModal')" class="text-[10px] md:text-xs font-black text-slate-400 hover:text-slate-600 px-3 md:px-4 py-2.5 md:py-3 transition-all uppercase tracking-widest">Đăng ký</button>
                    </div>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Vùng nội dung chính -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200/60 bg-white">
        <div class="max-w-6xl mx-auto px-4 md:px-6 py-12 flex flex-col items-center gap-6 animate-in fade-in duration-1000 delay-500">
            {{-- Logo Mark --}}
            <div class="flex items-center gap-2 cursor-pointer select-none" onclick="window.scrollTo({top:0, behavior:'smooth'})">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-brand-blue to-indigo-500 flex items-center justify-center text-white font-black text-lg shadow-md shadow-blue-200">
                    L
                </div>
                <span class="text-xl font-black text-slate-800 tracking-tight">LinkSnap</span>
            </div>
            
            {{-- Copyright --}}
            <div class="flex flex-col items-center gap-2">
                <p class="text-slate-400 text-xs font-semibold">
                    Hệ thống rút gọn link minh bạch, nhanh chóng và miễn phí.
                </p>
                <div class="flex items-center gap-2 text-slate-300 text-[10px] font-black uppercase tracking-[0.2em] mt-2">
                    <span>&copy; {{ date('Y') }}</span>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <span>LinkSnap</span>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <span>Tác giả: Trần Duy Phát</span>
                </div>
            </div>
        </div>
    </footer>

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
