<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $bioPage->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,900;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            /* Beautiful abstract gradient background */
            background-color: #f0f2f8;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(147,197,253,0.35) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 100%, rgba(196,181,253,0.3) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 50%, rgba(251,207,232,0.2) 0%, transparent 70%);
        }
        .profile-avatar {
            position: relative;
        }
        .profile-avatar::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6, #ec4899);
            z-index: -1;
        }
        .bio-btn {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.9);
            color: #0f172a;
            transition: all 0.25s cubic-bezier(0.23, 1, 0.32, 1);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06), 0 0 0 1px rgba(0,0,0,0.03);
        }
        .bio-btn:hover {
            transform: translateY(-2px) scale(1.01);
            background: rgba(255,255,255,0.98);
            box-shadow: 0 12px 28px rgba(0,0,0,0.1), 0 0 0 1px rgba(0,0,0,0.04);
        }
        .bio-btn:active {
            transform: translateY(0) scale(0.99);
        }
        .social-icon-wrap {
            transition: all 0.2s cubic-bezier(0.23, 1, 0.32, 1);
            color: #334155;
        }
        .social-icon-wrap:hover {
            transform: translateY(-3px) scale(1.15);
            color: #0f172a;
        }
        .social-icon-wrap svg {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <div class="max-w-[420px] w-full mx-auto px-5 py-14 flex flex-col flex-1">

        {{-- Profile Header --}}
        <div class="flex flex-col items-center text-center mb-10">

            {{-- Avatar with gradient ring --}}
            <div class="profile-avatar mb-5">
                <div class="w-24 h-24 rounded-full overflow-hidden bg-white relative z-10 ring-4 ring-white shadow-xl">
                    @if($bioPage->profile_image)
                        <img src="{{ $bioPage->profile_image }}" alt="{{ $bioPage->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                            <svg viewBox="0 0 24 24" fill="none" class="w-10 h-10 text-slate-400" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Name + Verified --}}
            <div class="flex items-center justify-center gap-1.5 mb-1.5">
                <h1 class="text-[22px] font-black tracking-tight text-slate-900" style="letter-spacing: -0.02em">{{ $bioPage->title }}</h1>
                <svg viewBox="0 0 24 24" class="w-5 h-5 text-blue-500 flex-shrink-0" fill="currentColor">
                    <path d="M22.5 12.5c0-1.58-.88-2.95-2.18-3.66.54-1.27.43-2.74-.32-3.89s-2.07-1.78-3.41-1.78c-.71 0-1.39.17-2 .49-.71-1.3-2.08-2.18-3.65-2.18s-2.95.88-3.64 2.17c-.61-.31-1.27-.47-1.94-.47-1.34 0-2.6.59-3.41 1.63s-1 2.5-.54 3.79c-1.3.71-2.18 2.08-2.18 3.65s.88 2.95 2.18 3.66c-.54 1.27-.43 2.74.32 3.89s2.07 1.78 3.41 1.78c.71 0 1.39-.17 2-.49.71 1.3 2.08 2.18 3.65 2.18s2.95-.88 3.64-2.17c.61.31 1.27.47 1.94.47 1.34 0 2.6-.59 3.41-1.63s1-2.5.54-3.79c1.3-.71 2.18-2.08 2.18-3.65zM10.29 16.72l-3.32-3.32c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0l1.91 1.91 4.9-4.9c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41l-6.31 6.31z"/>
                </svg>
            </div>

            {{-- Bio text --}}
            @if($bioPage->bio)
            <p class="text-slate-500 text-[14px] font-medium leading-relaxed max-w-[280px]">{{ $bioPage->bio }}</p>
            @endif

            {{-- Social Icons Row --}}
            @php
                $socialLinks = $bioPage->links->where('type', 'social_icon');
                $otherLinks  = $bioPage->links->where('type', 'button');
            @endphp

            @if($socialLinks->count() > 0)
            <div class="flex items-center justify-center gap-5 mt-6">
                @foreach($socialLinks as $link)
                    @if($link->icon)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="social-icon-wrap" title="{{ $link->label }}">
                        <div class="w-[26px] h-[26px]">
                            {!! $link->icon !!}
                        </div>
                    </a>
                    @endif
                @endforeach
            </div>
            @endif
        </div>

        {{-- Buttons List --}}
        @if($otherLinks->count() > 0)
        <div class="space-y-3 w-full">
            @foreach($otherLinks as $link)
            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
               class="bio-btn flex items-center justify-center w-full py-4 px-6 rounded-2xl text-center relative group">
                <span class="font-semibold text-slate-800 text-[14.5px] tracking-tight">{{ $link->label }}</span>
                <svg class="absolute right-5 w-4 h-4 text-slate-300 group-hover:text-slate-500 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
            @endforeach
        </div>
        @endif

        {{-- Footer --}}
        <div class="mt-auto pt-16 flex flex-col items-center">
            <a href="/" class="flex items-center gap-1.5 opacity-25 hover:opacity-50 transition-opacity">
                <div class="w-4 h-4 rounded-md bg-slate-900 flex items-center justify-center text-white font-black text-[7px]">L</div>
                <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-slate-500">Powered by LinkSnap</span>
            </a>
        </div>
    </div>
</body>
</html>
