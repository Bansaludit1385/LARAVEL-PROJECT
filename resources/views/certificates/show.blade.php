<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap');

        .certificate-title {
            font-family: 'Montserrat', sans-serif;
            color: #0b2c5c;
        }
        .certificate-name {
            font-family: 'Alex Brush', cursive;
            color: #2b4260;
        }
        .certificate-body {
            font-family: 'Playfair Display', serif;
            color: #5d6b79;
        }
        .signature-font {
            font-family: 'Alex Brush', cursive;
            color: #2b4260;
        }
        .certificate-label {
            font-family: 'Montserrat', sans-serif;
            color: #0b2c5c;
        }
    </style>

    <div class="max-w-5xl mx-auto px-4 py-16">
        
        <!-- Printable Certificate A4 Landscape Card -->
        <div class="w-full aspect-[1.414] bg-white border border-slate-200 shadow-2xl relative select-none overflow-hidden transition duration-300 rounded-2xl flex flex-col justify-between p-12 sm:p-16">
            
            <!-- Double-Swoosh Curves (Gold and Dark Blue) -->
            <svg class="absolute top-0 right-0 h-full w-[45%] pointer-events-none select-none" viewBox="0 0 100 100" preserveAspectRatio="none" fill="none">
                <!-- Gold/Yellow Background Curve -->
                <path d="M50,0 C25,40 50,75 35,100 L100,100 L100,0 Z" fill="url(#goldGradient)" />
                <!-- Dark Blue Foreground Curve -->
                <path d="M63,0 C45,45 65,75 50,100 L100,100 L100,0 Z" fill="#0b2c5c" />
                
                <defs>
                    <linearGradient id="goldGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#fbbf24" />
                        <stop offset="50%" stop-color="#f59e0b" />
                        <stop offset="100%" stop-color="#d97706" />
                    </linearGradient>
                </defs>
            </svg>

            <!-- Angled Frame Borders (Top-Left and Bottom-Left) -->
            <div class="absolute top-8 left-8 w-24 h-24 border-t-[3px] border-l-[3px] border-[#2b4260]"></div>
            <div class="absolute bottom-8 left-8 w-24 h-24 border-b-[3px] border-l-[3px] border-[#2b4260]"></div>

            <!-- Content Grid -->
            <div class="relative z-10 grid grid-cols-12 h-full items-center">
                <!-- Left Details Content -->
                <div class="col-span-8 space-y-8 pr-6 text-left">
                    <!-- Title Block -->
                    <div class="space-y-1">
                        <h1 class="certificate-title text-4xl sm:text-5xl font-extrabold tracking-[0.12em] uppercase">
                            Certificate
                        </h1>
                        <span class="certificate-label text-xs sm:text-sm font-extrabold tracking-[0.25em] uppercase block pl-1">
                            Of Achievement
                        </span>
                    </div>

                    <!-- Recipient Name Block -->
                    <div class="space-y-1 py-2">
                        <h2 class="certificate-name text-5xl sm:text-6xl pl-1">
                            {{ $certificate->user->name }}
                        </h2>
                    </div>

                    <!-- Description Block -->
                    <p class="certificate-body text-xs sm:text-[13px] leading-relaxed max-w-[480px]">
                        This certificate is proudly presented for successfully completing all technical lectures, coding assignments, assessment quizzes, and practical code implementations for the course <strong class="text-slate-800 font-medium">"{{ $certificate->course->title }}"</strong> on the CodeSpire Learning Platform.
                    </p>

                    <!-- Date & Signature Block -->
                    <div class="grid grid-cols-2 gap-8 max-w-[400px] pt-4">
                        <div class="space-y-1.5">
                            <span class="certificate-label text-[9px] font-extrabold uppercase tracking-wider block">DATE</span>
                            <div class="border-t border-[#0b2c5c]/40 pt-2 font-serif text-sm text-[#0b2c5c] pl-0.5">
                                {{ $certificate->issued_at->format('Y / m / d') }}
                            </div>
                        </div>
                        <div class="space-y-0.5">
                            <span class="certificate-label text-[9px] font-extrabold uppercase tracking-wider block">SIGNATURE</span>
                            <div class="border-t border-[#0b2c5c]/40 pt-1.5">
                                <span class="signature-font text-3xl text-[#0b2c5c] inline-block -mt-3.5 pl-1 select-none">Clara Coder</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Seal Content Overlaying Swoosh -->
                <div class="col-span-4 h-full relative flex items-end justify-end pb-8 pr-4">
                    <!-- Circular Gold Seal with Circular SVG Text -->
                    <svg class="w-36 h-36 relative" viewBox="0 0 100 100">
                        <!-- Circle path for text -->
                        <path id="textCircle" d="M 50, 50 m -34, 0 a 34,34 0 1,1 68,0 a 34,34 0 1,1 -68,0" fill="none" />
                        
                        <!-- Curved Text wrapping seal -->
                        <text class="text-[6.2px] fill-white/80 font-bold uppercase tracking-[0.25em]">
                            <textPath href="#textCircle" startOffset="0%">
                                certificate of achievement &bull; code spire &bull;
                            </textPath>
                        </text>
                        
                        <!-- Central Golden Badge with Concentric Circles -->
                        <circle cx="50" cy="50" r="22" fill="url(#goldBadgeGradient)" filter="url(#dropShadow)" class="stroke-[2.5] stroke-[#d97706]/40" />
                        <circle cx="50" cy="50" r="18" fill="none" class="stroke-[0.8] stroke-white/50 stroke-dasharray" stroke-dasharray="2,2" />
                        <circle cx="50" cy="50" r="8" fill="none" class="stroke-[1.5] stroke-white/80" />
                        
                        <defs>
                            <linearGradient id="goldBadgeGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#fde047" />
                                <stop offset="35%" stop-color="#fbbf24" />
                                <stop offset="70%" stop-color="#d97706" />
                                <stop offset="100%" stop-color="#b45309" />
                            </linearGradient>
                            <filter id="dropShadow" x="-10%" y="-10%" width="120%" height="120%">
                                <feDropShadow dx="1" dy="1.5" stdDeviation="1" flood-opacity="0.35" />
                            </filter>
                        </defs>
                    </svg>
                </div>
            </div>

            <!-- Verification Footer Bar -->
            <div class="absolute bottom-4 left-0 w-full text-center text-[8px] text-slate-400 font-mono tracking-wider">
                Accreditation Code: {{ $certificate->certificate_code }} &nbsp;&bull;&nbsp; Verified at codespire.io/verify
            </div>
        </div>

        <!-- Utility buttons -->
        <div class="mt-8 flex justify-center gap-4">
            <button onclick="window.print()" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-555 transition font-bold text-xs text-white flex items-center gap-2 shadow-lg shadow-emerald-500/10">
                <i data-lucide="printer" class="w-4 h-4"></i> Print Certificate
            </button>
            <a href="{{ route('dashboard') }}" class="px-6 py-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 dark:bg-slate-850 dark:hover:bg-slate-800 transition font-bold text-xs text-slate-700 dark:text-slate-200">
                Return Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
