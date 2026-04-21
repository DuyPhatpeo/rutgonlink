<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Phiên làm việc hết hạn | LinkSnap</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif']
                    },
                    colors: {
                        'brand-blue': '#2563eb'
                    }
                }
            }
        }
    </script>
    <style>
        .bg-grid {
            background-image: radial-gradient(#f1f5f9 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>

<body class="font-inter bg-slate-50 min-h-screen flex items-center justify-center p-6 relative overflow-hidden selection:bg-brand-blue selection:text-white">
    {{-- Decorative Background Shapes --}}
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-100/50 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-100/50 rounded-full blur-[120px]"></div>
    <div class="absolute inset-0 bg-grid opacity-50"></div>

    <div class="max-w-xl w-full bg-white/70 backdrop-blur-2xl rounded-[48px] p-10 md:p-16 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] border border-white relative z-10 text-center animate-in fade-in zoom-in-95 duration-700">
        {{-- Status Code Badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-600 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] mb-8 border border-amber-100 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Page Expired
        </div>

        {{-- Big Title --}}
        <div class="relative mb-10">
            <h1 class="text-9xl font-black text-slate-100 select-none tracking-tighter opacity-70 absolute left-1/2 -translate-x-1/2 -top-10">419</h1>
            <h2 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight relative z-10 italic">
                Thời gian <br> <span class="text-brand-blue">đã dừng lại.</span>
            </h2>
        </div>

        <p class="text-slate-500 font-bold text-sm md:text-base leading-relaxed mb-12 max-w-sm mx-auto opacity-80">
            Phiên làm việc của bạn đã hết hạn do quá lâu không hoạt động. Vui lòng tải lại trang để tiếp tục.
        </p>

        {{-- Action Buttons --}}
        <div class="flex flex-col gap-4">
            <button onclick="window.location.reload()" class="w-full bg-slate-900 hover:bg-black text-white font-black py-5 rounded-3xl transition-all shadow-2xl shadow-slate-200 uppercase tracking-widest text-xs active:scale-95">
                Tải lại trang ngay
            </button>
            <a href="/" class="w-full text-slate-400 hover:text-slate-600 font-black uppercase tracking-widest text-[10px] py-4 transition-colors">
                Quay lại trang chủ
            </a>
        </div>

        {{-- Footer --}}
        <div class="mt-16 pt-10 border-t border-slate-100 flex flex-col items-center gap-4">
            <div class="flex items-center gap-2 text-slate-300 font-black text-[9px] uppercase tracking-[0.3em]">
                <span>Error Code: 419_CSRF_TIMEOUT</span>
                <span class="w-1.5 h-1.5 bg-slate-100 rounded-full"></span>
                <span>Session Security</span>
            </div>
        </div>
    </div>
</body>

</html>