<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Lỗi máy chủ | LinkSnap</title>
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
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-100/50 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-slate-200/50 rounded-full blur-[120px]"></div>
    <div class="absolute inset-0 bg-grid opacity-50"></div>

    <div class="max-w-xl w-full bg-white/70 backdrop-blur-2xl rounded-[48px] p-10 md:p-16 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] border border-white relative z-10 text-center animate-in fade-in zoom-in-95 duration-700">
        {{-- Status Code Badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] mb-8 shadow-lg shadow-slate-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </svg>
            System Error
        </div>

        {{-- Big Title --}}
        <div class="relative mb-10">
            <h1 class="text-9xl font-black text-slate-100 select-none tracking-tighter opacity-70 absolute left-1/2 -translate-x-1/2 -top-10">500</h1>
            <h2 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight relative z-10 italic pt-6">
                Máy chủ <br> <span class="text-brand-blue">đang mệt.</span>
            </h2>
        </div>

        <p class="text-slate-500 font-bold text-sm md:text-base leading-relaxed mb-12 max-w-sm mx-auto opacity-80">
            Hệ thống đã xảy ra sự cố đột ngột. Đội ngũ kỹ thuật đã được thông báo và đang tiến hành khắc phục ngay lập tức.
        </p>

        {{-- Action Buttons --}}
        <div class="flex flex-col gap-4">
            <button onclick="window.location.reload()" class="w-full bg-brand-blue hover:bg-blue-700 text-white font-black py-5 rounded-3xl transition-all shadow-2xl shadow-blue-100 uppercase tracking-widest text-xs active:scale-95">
                Thử tải lại trang
            </button>
            <a href="/" class="w-full text-slate-400 hover:text-slate-600 font-black uppercase tracking-widest text-[10px] py-4 transition-colors">
                Quay lại trang chủ
            </a>
        </div>

        {{-- Footer --}}
        <div class="mt-16 pt-10 border-t border-slate-100 flex flex-col items-center gap-4">
            <div class="flex items-center gap-2 text-slate-300 font-black text-[9px] uppercase tracking-[0.3em]">
                <span>Error Code: 500_INTERNAL</span>
                <span class="w-1.5 h-1.5 bg-slate-100 rounded-full"></span>
                <span>Automatic Report Sent</span>
            </div>
        </div>
    </div>
</body>

</html>