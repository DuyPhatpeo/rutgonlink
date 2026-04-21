<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Cấm truy cập | LinkSnap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], space: ['"Space Grotesk"', 'sans-serif'] },
                    colors: { 'brand-blue': '#2563eb' }
                }
            }
        }
    </script>
    <style>
        .text-outline { -webkit-text-stroke: 1.5px rgba(15, 23, 42, 0.1); color: transparent; }
    </style>
</head>
<body class="font-sans bg-white min-h-screen flex items-center justify-center p-6 sm:p-24 selection:bg-rose-600 selection:text-white">
    <div class="max-w-5xl w-full flex flex-col items-center sm:items-start space-y-8 animate-in fade-in slide-in-from-bottom-10 duration-1000">
        <div class="relative w-full">
            <div class="absolute -top-32 sm:-top-48 left-1/2 sm:left-0 -translate-x-1/2 sm:translate-x-0 font-space text-[200px] sm:text-[350px] font-bold text-outline select-none tracking-tighter opacity-70">
                403
            </div>
            <div class="relative z-10 space-y-4 text-center sm:text-left">
                <div class="inline-block px-3 py-1 bg-rose-600 text-white text-[10px] font-black uppercase tracking-[0.3em] mb-4">
                    Access Denied
                </div>
                <h1 class="text-4xl sm:text-7xl font-bold text-slate-900 tracking-tight leading-[1.1] font-space uppercase">
                    Bạn không có quyền <br> <span class="text-rose-600">truy cập trang này.</span>
                </h1>
                <p class="text-slate-500 font-medium max-w-lg text-sm sm:text-lg leading-relaxed pt-2">
                    Mã lỗi <span class="font-bold text-slate-800">403</span>. Khu vực này bị hạn chế truy cập. Nếu bạn tin rằng đây là một nhầm lẫn, vui lòng liên hệ quản trị viên.
                </p>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-center gap-6 pt-12 relative z-10">
            <a href="/" class="w-full sm:w-auto bg-slate-900 text-white font-bold px-12 py-5 rounded-none hover:bg-rose-600 transition-all active:scale-95 uppercase tracking-widest text-xs">
                Quay lại trang chủ
            </a>
            <button onclick="window.history.back()" class="w-full sm:w-auto group flex items-center justify-center gap-3 text-slate-400 hover:text-slate-900 transition-colors py-2 font-bold uppercase tracking-widest text-xs">
                Trở về trang trước
            </button>
        </div>
    </div>
</body>
</html>
