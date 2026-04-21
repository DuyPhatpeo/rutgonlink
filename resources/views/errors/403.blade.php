<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Truy cập bị từ chối | LinkSnap</title>
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

<body class="font-inter bg-slate-50 min-h-screen flex items-center justify-center p-6 relative overflow-hidden selection:bg-rose-500 selection:text-white">
    {{-- Decorative Background Shapes --}}
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-rose-100/50 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-orange-100/50 rounded-full blur-[120px]"></div>
    <div class="absolute inset-0 bg-grid opacity-50"></div>

    <div class="max-w-xl w-full bg-white/70 backdrop-blur-2xl rounded-[48px] p-10 md:p-16 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] border border-white relative z-10 text-center animate-in fade-in zoom-in-95 duration-700">
        {{-- Status Code Badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-rose-500 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] mb-8 shadow-lg shadow-rose-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            Access Denied
        </div>

        {{-- Big Title --}}
        <div class="relative mb-10">
            <h1 class="text-9xl font-black text-slate-100 select-none tracking-tighter opacity-70 absolute left-1/2 -translate-x-1/2 -top-10">403</h1>
            <h2 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight relative z-10 italic pt-6">
                Dừng lại! <br> <span class="text-rose-500">Khu vực cấm.</span>
            </h2>
        </div>

        <p class="text-slate-500 font-bold text-sm md:text-base leading-relaxed mb-12 max-w-sm mx-auto opacity-80">
            Bạn không có đủ quyền hạn để truy cập vào tài nguyên này. Vui lòng quay lại hoặc đăng nhập bằng tài khoản khác.
        </p>

        {{-- Action Buttons --}}
        <div class="flex flex-col gap-4">
            <a href="/" class="w-full bg-slate-900 hover:bg-black text-white font-black py-5 rounded-3xl transition-all shadow-2xl shadow-slate-200 uppercase tracking-widest text-xs active:scale-95">
                Quay lại trang chủ
            </a>
            <button onclick="window.history.back()" class="w-full text-slate-400 hover:text-slate-600 font-black uppercase tracking-widest text-[10px] py-4 transition-colors">
                Trở về trang trước đó
            </button>
        </div>

        {{-- Footer --}}
        <div class="mt-16 pt-10 border-t border-slate-100 flex flex-col items-center gap-4">
            <div class="flex items-center gap-2 text-slate-300 font-black text-[9px] uppercase tracking-[0.3em]">
                <span>LinkSnap Security</span>
                <span class="w-1.5 h-1.5 bg-slate-100 rounded-full"></span>
                <span>Access Logs: Recorded</span>
            </div>
        </div>
    </div>
</body>

</html>