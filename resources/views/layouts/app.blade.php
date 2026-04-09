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
                @apply bg-white/70 backdrop-blur-xl border border-white/40 shadow-premium;
            }
            .glass-dark {
                @apply bg-slate-900/80 backdrop-blur-xl border border-slate-700/30 shadow-2xl;
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
                @auth
                    <div class="flex items-center gap-3 md:gap-4">
                        <span class="text-slate-500 font-semibold hidden md:inline">Chào, <span class="text-slate-800 font-bold">{{ Auth::user()->name }}</span>!</span>
                        <form action="/api/logout" method="POST">
                            @csrf
                            <button type="submit" class="text-[10px] md:text-xs font-black text-rose-500 hover:bg-rose-50 px-4 md:px-5 py-2 md:py-2.5 rounded-2xl transition-all border border-transparent hover:border-rose-100 uppercase tracking-widest">Đăng xuất</button>
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

    {{-- Tự động hiển thị Toast từ Session Flash --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('error'))
                Toast.show({!! json_encode(session('error')) !!}, 'error');
            @endif
            @if(session('success'))
                Toast.show({!! json_encode(session('success')) !!}, 'success');
            @endif
        });
    </script>
</body>
</html>
