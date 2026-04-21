<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - NOT FOUND | LinkSnap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        space: ['"Space Grotesk"', 'sans-serif']
                    },
                    colors: { 
                        'brand-blue': '#2563eb', 
                    }
                }
            }
        }
    </script>
</head>
<body class="font-space bg-white min-h-screen flex items-center justify-center p-6 selection:bg-slate-900 selection:text-white">
    <div class="max-w-4xl w-full border-4 border-slate-900 p-8 md:p-16 shadow-[20px_20px_0px_0px_rgba(15,23,42,1)] animate-in fade-in zoom-in-95 duration-500">
        <div class="mb-12">
            <div class="inline-block px-3 py-1 bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                Error Code: 404
            </div>
            <h1 class="text-7xl md:text-[150px] font-black text-slate-900 tracking-tighter leading-[0.8] uppercase mb-12">
                NOT <br> <span class="text-brand-blue">FOUND.</span>
            </h1>
            <p class="text-[12px] md:text-sm font-black text-slate-400 uppercase tracking-[0.3em] leading-relaxed max-w-xl">
                Trang hoặc liên kết bạn đang tìm kiếm không tồn tại, đã bị xóa hoặc được chuyển sang một định danh đặc trưng khác.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-6">
            <a href="/" class="w-full sm:w-auto bg-slate-900 text-white font-black px-12 py-5 border-2 border-slate-900 hover:bg-white hover:text-slate-900 transition-all uppercase tracking-widest text-xs">
                Back to Dashboard
            </a>
            <button onclick="window.history.back()" class="w-full sm:w-auto text-slate-400 hover:text-slate-900 font-black uppercase tracking-widest text-xs py-5 px-6 border-2 border-transparent hover:border-slate-100 transition-all">
                Previous Page
            </button>
        </div>

        <div class="mt-20 pt-10 border-t-2 border-slate-100 flex justify-between items-center text-[9px] font-black text-slate-300 uppercase tracking-[0.4em]">
            <span>LINKSNAP PLATFORM</span>
            <span>2026 &copy; CORE_V4</span>
        </div>
    </div>
</body>
</html>
