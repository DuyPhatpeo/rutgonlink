<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LinkSnap - Hệ thống rút gọn link chuyên nghiệp')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { inter: ['Inter', 'sans-serif'] },
                    colors: { 
                        'brand-blue': '#2563eb', 
                        'brand-green': '#059669', 
                        'bg-soft': '#f8fafc' 
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-bg-soft font-inter min-h-screen text-slate-900" data-auth="{{ Auth::check() ? '1' : '0' }}">
    <!-- Thanh điều hướng (Navbar) -->
    <nav class="container mx-auto px-6 py-8 flex justify-between items-center">
        <div class="text-3xl font-black text-brand-blue tracking-tighter select-none cursor-pointer" onclick="window.location.assign('/')">LinkSnap</div>
        <div class="flex items-center gap-6">
            @auth
                <div class="flex items-center gap-4">
                    <span class="text-slate-500 font-semibold hidden md:inline">Chào, <span class="text-slate-800 font-bold">{{ Auth::user()->name }}</span>!</span>
                    <form action="/api/logout" method="POST">
                        @csrf
                        <button type="submit" class="text-xs font-black text-rose-500 hover:bg-rose-50 px-5 py-2.5 rounded-2xl transition-all border border-transparent hover:border-rose-100 uppercase">Đăng xuất</button>
                    </form>
                </div>
            @else
                <div class="flex items-center gap-4">
                    <button onclick="Modal.open('loginModal')" class="text-sm font-black text-slate-600 hover:text-brand-blue transition-colors uppercase">Đăng nhập</button>
                    <button onclick="Modal.open('registerModal')" class="text-sm font-black bg-white border border-slate-200 px-6 py-3 rounded-2xl shadow-sm hover:shadow-md transition-all uppercase">Đăng ký</button>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Vùng nội dung chính -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="container mx-auto px-6 pb-20 text-center space-y-6 animate-in fade-in duration-1000 delay-500">
        <p class="text-slate-300 text-[10px] font-black uppercase tracking-[0.3em]">
            &copy; 2026 LinkSnap &bull; Thiết kế bởi Trần Duy Phát
        </p>
    </footer>

    <!-- Modals -->
    @include('partials.modals')

    <!-- Scripts -->
    @include('partials.scripts')
    @stack('scripts')
</body>
</html>
