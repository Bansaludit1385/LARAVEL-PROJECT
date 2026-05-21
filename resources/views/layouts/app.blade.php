<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" 
      :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Instant dark mode checking -->
        <script>
            if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <title>{{ $title ?? 'CodeSpire - High Performance Learning' }}</title>

        <!-- Premium Fonts: Outfit & Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Lucide Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>

        <!-- Prism.js Syntax Highlighting -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />

        <!-- Tailwind CSS & Vite App Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Extra HSL Dynamic Modern Aesthetics -->
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            .heading-font {
                font-family: 'Outfit', sans-serif;
            }
            .glassmorphism {
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(16px);
                border: 1px solid rgba(16, 185, 129, 0.15);
            }
            .dark .glassmorphism {
                background: rgba(2, 10, 5, 0.75);
                backdrop-filter: blur(16px);
                border: 1px solid rgba(16, 185, 129, 0.1);
            }
            /* Smooth custom scrollbars */
            ::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }
            ::-webkit-scrollbar-track {
                background: transparent;
            }
            ::-webkit-scrollbar-thumb {
                background: #10b981;
                border-radius: 3px;
            }
            .dark ::-webkit-scrollbar-thumb {
                background: #047857;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-[#f7faf9] dark:bg-[#020a05] text-[#1f2e26] dark:text-[#e8f5ed] transition-colors duration-300">
        
        <!-- Toast notifications wrapper -->
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 4000)" 
             class="fixed bottom-5 right-5 z-50">
             @if(session('success'))
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl shadow-xl bg-emerald-600 text-white transform transition duration-500 hover:scale-105">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl shadow-xl bg-rose-600 text-white transform transition duration-500 hover:scale-105">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            @endif
            @if(session('info'))
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl shadow-xl bg-teal-600 text-white transform transition duration-500 hover:scale-105">
                    <i data-lucide="info" class="w-5 h-5"></i>
                    <span class="text-sm font-medium">{{ session('info') }}</span>
                </div>
            @endif
        </div>

        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Main view container -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Premium Footer -->
            <footer class="border-t border-emerald-100 dark:border-emerald-950/40 bg-white dark:bg-[#040e08] py-8 mt-12 transition-colors duration-300">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-extrabold heading-font text-lg shadow-lg">S</div>
                            <span class="heading-font font-bold text-xl tracking-tight text-slate-900 dark:text-white">Code<span class="text-emerald-600 dark:text-emerald-400">Spire</span></span>
                        </div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            &copy; {{ date('Y') }} CodeSpire. All rights reserved.
                        </p>
                        <div class="flex gap-4">
                            @auth
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.users') }}" class="text-sm text-slate-500 hover:text-emerald-600 dark:hover:text-emerald-400 font-semibold">Admin Panel</a>
                                @endif
                            @endauth
                            <a href="{{ route('about') }}" class="text-sm text-slate-500 hover:text-emerald-600 dark:hover:text-emerald-400">About Us</a>
                            <a href="{{ route('contact') }}" class="text-sm text-slate-500 hover:text-emerald-600 dark:hover:text-emerald-400">Contact</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Initialize Lucide Icons -->
        <script>
            lucide.createIcons();
        </script>
        <!-- Prism.js Code highlighting -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-c.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-cpp.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-java.min.js"></script>
    </body>
</html>
