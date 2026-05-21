<x-app-layout>
    <x-slot name="title">Coding Practice - CodeSpire</x-slot>
<div class="py-10 min-h-screen transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Premium Header Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#061c0e] to-[#010904] border border-emerald-950/60 p-8 md:p-12 shadow-2xl">
            <!-- Decorative Glow Grid -->
            <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-emerald-500/10 blur-[120px] pointer-events-none"></div>
            <div class="absolute -left-16 -bottom-16 w-80 h-80 rounded-full bg-teal-500/5 blur-[120px] pointer-events-none"></div>
            
            <div class="relative max-w-3xl space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold tracking-widest text-emerald-400 bg-emerald-950/40 border border-emerald-800/30 uppercase">
                    <i data-lucide="code-2" class="w-3.5 h-3.5"></i> Interactive Coding Challenges
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight heading-font">
                    Practice Arena
                </h1>
                <p class="text-sm md:text-base text-slate-300 leading-relaxed font-light">
                    Sharpen your software engineering skills with our curated collection of classic algorithmic challenges. Master data structures, optimize space/time complexity, and run your solutions in-browser.
                </p>
            </div>
        </div>

        <!-- Stat Counter Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Easy Card -->
            <div class="relative group overflow-hidden p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/30 hover:border-emerald-500/30 shadow-sm transition duration-300">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Easy Level</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-emerald-50">{{ $easyCount }} Problems</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/25 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                </div>
                <div class="mt-4 w-full bg-slate-100 dark:bg-slate-900 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>

            <!-- Medium Card -->
            <div class="relative group overflow-hidden p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/30 hover:border-amber-500/30 shadow-sm transition duration-300">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Medium Level</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-amber-50">{{ $mediumCount }} Problems</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/25 flex items-center justify-center text-amber-600 dark:text-amber-400">
                        <i data-lucide="shield-alert" class="w-5 h-5"></i>
                    </div>
                </div>
                <div class="mt-4 w-full bg-slate-100 dark:bg-slate-900 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-amber-500 h-1.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>

            <!-- Hard Card -->
            <div class="relative group overflow-hidden p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/30 hover:border-rose-500/30 shadow-sm transition duration-300">
                <div class="flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Hard Level</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-rose-50">{{ $hardCount }} Problems</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-rose-500/10 border border-rose-500/25 flex items-center justify-center text-rose-600 dark:text-rose-400">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                    </div>
                </div>
                <div class="mt-4 w-full bg-slate-100 dark:bg-slate-900 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-rose-500 h-1.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- Filter and Table Section -->
        <div class="bg-white dark:bg-[#020a05] border border-slate-200 dark:border-emerald-950/60 rounded-3xl p-6 md:p-8 shadow-xl">
            <!-- Search & Difficulty Selection -->
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between pb-6 border-b border-slate-150 dark:border-emerald-950/50">
                <!-- Tabs -->
                <div class="flex flex-wrap gap-2 w-full md:w-auto">
                    <a href="{{ route('practice.index', ['search' => request('search')]) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition {{ !request('difficulty') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/20' : 'bg-slate-50 dark:bg-emerald-950/20 border border-slate-200 dark:border-emerald-900/30 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-emerald-950/40' }}">
                        All Difficulties
                    </a>
                    <a href="{{ route('practice.index', ['difficulty' => 'easy', 'search' => request('search')]) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('difficulty') === 'easy' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/20' : 'bg-slate-50 dark:bg-emerald-950/20 border border-slate-200 dark:border-emerald-900/30 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-emerald-950/40' }}">
                        Easy
                    </a>
                    <a href="{{ route('practice.index', ['difficulty' => 'medium', 'search' => request('search')]) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('difficulty') === 'medium' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/20' : 'bg-slate-50 dark:bg-emerald-950/20 border border-slate-200 dark:border-emerald-900/30 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-emerald-950/40' }}">
                        Medium
                    </a>
                    <a href="{{ route('practice.index', ['difficulty' => 'hard', 'search' => request('search')]) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition {{ request('difficulty') === 'hard' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/20' : 'bg-slate-50 dark:bg-emerald-950/20 border border-slate-200 dark:border-emerald-900/30 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-emerald-950/40' }}">
                        Hard
                    </a>
                </div>

                <!-- Search Input -->
                <form action="{{ route('practice.index') }}" method="GET" class="relative w-full md:w-80">
                    @if(request('difficulty'))
                        <input type="hidden" name="difficulty" value="{{ request('difficulty') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search challenge by name..." class="w-full pl-10 pr-4 py-2.5 rounded-2xl border border-slate-200 dark:border-emerald-950/40 bg-slate-50 dark:bg-[#010603] text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 text-slate-700 dark:text-slate-300">
                    <div class="absolute left-3.5 top-3 text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </div>
                </form>
            </div>

            <!-- Problem Standings Table -->
            <div class="overflow-x-auto mt-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-150 dark:border-emerald-950/40 text-[10px] uppercase font-bold text-slate-400 tracking-wider">
                            <th class="py-3 px-4 w-12">Status</th>
                            <th class="py-3 px-4">Challenge Name</th>
                            <th class="py-3 px-4">Category</th>
                            <th class="py-3 px-4">Difficulty</th>
                            <th class="py-3 px-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-emerald-950/25">
                        @forelse($problems as $prob)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-emerald-950/10 transition duration-150">
                                <!-- Dynamic check status (rendered in browser context) -->
                                <td class="py-4.5 px-4">
                                    <div id="status-{{ $prob->slug }}" class="text-slate-300 dark:text-slate-750">
                                        <i data-lucide="circle" class="w-4 h-4"></i>
                                    </div>
                                </td>
                                
                                <td class="py-4.5 px-4 font-semibold text-slate-800 dark:text-emerald-100 text-sm">
                                    <a href="{{ route('practice.show', $prob->slug) }}" class="hover:text-emerald-500 transition">
                                        {{ $prob->title }}
                                    </a>
                                </td>
                                
                                <td class="py-4.5 px-4 text-xs font-medium text-slate-500 dark:text-slate-400">
                                    <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-emerald-950/30 text-slate-600 dark:text-slate-350 border border-slate-200/40 dark:border-emerald-900/10">
                                        {{ $prob->category }}
                                    </span>
                                </td>
                                
                                <td class="py-4.5 px-4 text-xs font-bold">
                                    @if(strtolower($prob->difficulty) === 'easy')
                                        <span class="text-emerald-500 dark:text-emerald-400">Easy</span>
                                    @elseif(strtolower($prob->difficulty) === 'medium')
                                        <span class="text-amber-500 dark:text-amber-400">Medium</span>
                                    @else
                                        <span class="text-rose-500 dark:text-rose-400">Hard</span>
                                    @endif
                                </td>
                                
                                <td class="py-4.5 px-4 text-right">
                                    <a href="{{ route('practice.show', $prob->slug) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-550 transition shadow-md shadow-emerald-500/5">
                                        Solve Challenge <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-slate-400 dark:text-slate-500 text-sm">
                                    <i data-lucide="folder-open" class="w-8 h-8 mx-auto mb-2 text-slate-300 dark:text-slate-700"></i>
                                    No practice challenges found matching your filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Read solved challenges from local storage and update statuses
        const solved = JSON.parse(localStorage.getItem('codespire_solved_problems') || '{}');
        
        Object.keys(solved).forEach(slug => {
            const container = document.getElementById(`status-${slug}`);
            if (container) {
                container.innerHTML = `<i data-lucide="check-circle" class="w-4 h-4 text-emerald-500 fill-emerald-500/10"></i>`;
            }
        });
        
        // Re-initialize lucide icons for dynamic html updates
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
</x-app-layout>
