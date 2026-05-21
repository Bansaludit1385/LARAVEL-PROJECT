<nav class="border-b border-emerald-100 dark:border-emerald-950/40 bg-white/85 dark:bg-[#020a05]/85 backdrop-blur-md sticky top-0 z-40 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-white font-extrabold heading-font text-lg shadow-md shadow-emerald-500/20">S</div>
                    <span class="heading-font font-extrabold text-xl tracking-tight text-slate-900 dark:text-white">Code<span class="text-emerald-600 dark:text-emerald-400">Spire</span></span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center gap-1">
                    <a href="{{ route('courses.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('courses.*') ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/30' : 'text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                        Courses
                    </a>
                    <a href="{{ route('articles.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('articles.*') ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/30' : 'text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                        Articles
                    </a>
                    <a href="{{ route('practice.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('practice.*') ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/30' : 'text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                        Practice
                    </a>
                    <a href="{{ route('leaderboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition duration-200 {{ request()->routeIs('leaderboard') ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/30' : 'text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-slate-50 dark:hover:bg-slate-800/50' }}">
                        Leaderboard
                    </a>
                </div>
            </div>

            <!-- Global Search and User Area -->
            <div class="flex items-center gap-4">
                <!-- Search bar (Desktop) -->
                <form action="{{ route('search') }}" method="GET" class="hidden md:block relative">
                    <input type="text" name="q" placeholder="Search courses, articles, code..." class="w-64 pl-10 pr-4 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/60 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 text-slate-700 dark:text-slate-300">
                    <div class="absolute left-3 top-2 text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                </form>

                <!-- Dark / Light Mode Switcher -->
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                        type="button" 
                        class="p-2 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800/50 text-slate-500 dark:text-slate-400 transition duration-150">
                    <span x-show="!darkMode"><i data-lucide="moon" class="w-4 h-4"></i></span>
                    <span x-show="darkMode"><i data-lucide="sun" class="w-4 h-4"></i></span>
                </button>

                @auth
                    <!-- Profile dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-2.5 p-1 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                            <img src="{{ Auth::user()->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed='.urlencode(Auth::user()->name).'&mouth=smile&eyes=happy' }}" alt="Avatar" class="w-7 h-7 rounded-lg object-cover ring-2 ring-emerald-500/10">
                            <span class="hidden lg:block text-xs font-semibold text-slate-700 dark:text-slate-200">{{ Auth::user()->name }}</span>
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-850 shadow-xl py-2 z-50">
                            
                            <!-- Role Info -->
                            <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-800">
                                <p class="text-[10px] font-bold tracking-wider text-slate-400 uppercase">Role</p>
                                <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 capitalize">{{ Auth::user()->role }}</p>
                            </div>

                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 dark:text-slate-250 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                                <i data-lucide="layout-dashboard" class="w-4 h-4 text-slate-400"></i>
                                Dashboard
                            </a>
                            
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 dark:text-slate-250 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                                <i data-lucide="user-cog" class="w-4 h-4 text-slate-400"></i>
                                Settings
                            </a>

                            <div class="border-t border-slate-150 dark:border-slate-800 my-1"></div>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-xs font-medium text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/20 transition">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-4 py-1.5 rounded-xl text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition duration-150">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-1.5 rounded-xl text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-550 transition duration-150 shadow-md shadow-emerald-500/10">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
