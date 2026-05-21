<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="space-y-10">
            <!-- Header -->
            <div class="text-center space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center mx-auto shadow-md">
                    <i data-lucide="trophy" class="w-6 h-6"></i>
                </div>
                <h1 class="heading-font text-3xl font-extrabold text-slate-900 dark:text-white">Global Leaderboard</h1>
                <p class="text-xs text-slate-500 max-w-md mx-auto">Earn points by finishing lessons, solving quizzes, and publishing technical articles.</p>

                <!-- Search Form -->
                <form action="{{ route('leaderboard') }}" method="GET" class="w-full max-w-md mx-auto flex gap-2 pt-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search developer name..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-emerald-950/40 bg-white dark:bg-[#030d06] text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-600 text-xs focus:ring-1 focus:ring-emerald-500 focus:outline-none">
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-555 text-white font-bold text-xs transition">Search</button>
                </form>
            </div>

            <!-- Standings Table -->
            <div class="rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100 dark:divide-emerald-950/20">
                    @foreach($users as $index => $usr)
                        <div class="p-5 flex items-center justify-between transition hover:bg-slate-50/50 dark:hover:bg-[#020a05]">
                            <div class="flex items-center gap-4">
                                <!-- Rank Rank badge -->
                                @if($index === 0 && !request('search'))
                                    <span class="w-7 h-7 rounded-lg bg-amber-500/10 text-amber-500 font-extrabold text-xs flex items-center justify-center shrink-0">
                                        🥇
                                    </span>
                                @elseif($index === 1 && !request('search'))
                                    <span class="w-7 h-7 rounded-lg bg-slate-300/20 text-slate-500 dark:text-slate-400 font-bold text-xs flex items-center justify-center shrink-0">
                                        🥈
                                    </span>
                                @elseif($index === 2 && !request('search'))
                                    <span class="w-7 h-7 rounded-lg bg-amber-700/15 text-amber-700 font-bold text-xs flex items-center justify-center shrink-0">
                                        🥉
                                    </span>
                                @else
                                    <span class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-emerald-950/25 text-slate-400 font-bold text-xs flex items-center justify-center shrink-0">
                                        {{ $index + 1 }}
                                    </span>
                                @endif

                                <!-- Avatar & Details -->
                                <img src="{{ $usr->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed='.urlencode($usr->name).'&mouth=smile&eyes=happy' }}" alt="Avatar" class="w-9 h-9 rounded-xl object-cover ring-2 ring-emerald-500/10">
                                <div>
                                    <h3 class="font-bold text-sm text-slate-900 dark:text-white flex items-center gap-2">
                                        {{ $usr->name }}
                                        @if($usr->role === 'admin')
                                            <span class="px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-400/20 text-[9px] font-bold text-emerald-650 uppercase">Admin</span>
                                        @elseif($usr->role === 'instructor')
                                            <span class="px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-400/20 text-[9px] font-bold text-emerald-650 uppercase">Author</span>
                                        @endif
                                    </h3>
                                    <p class="text-[10px] text-slate-400 font-semibold truncate max-w-xs">{{ $usr->bio ?? 'Active CodeSpire student building scalable software.' }}</p>
                                </div>
                            </div>

                            <!-- Info & Points -->
                            <div class="flex items-center gap-6">
                                <div class="hidden sm:flex gap-4 text-center text-[10px] font-bold text-slate-450 uppercase tracking-wider">
                                    <div>
                                        <span class="block text-xs font-extrabold text-slate-700 dark:text-slate-350">{{ $usr->enrolled_courses_count }}</span>
                                        Courses
                                    </div>
                                    <div>
                                        <span class="block text-xs font-extrabold text-slate-700 dark:text-slate-350">{{ $usr->certificates_count }}</span>
                                        Certs
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="heading-font font-black text-sm text-slate-950 dark:text-white">{{ $usr->points }}</span>
                                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">points</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Gamified Tips -->
            <div class="grid sm:grid-cols-2 gap-6 pt-4">
                <div class="p-6 rounded-2xl bg-emerald-500/5 border border-emerald-500/15 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center shrink-0">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-xs">Complete Lessons (+10 pts)</h4>
                        <p class="text-[10px] text-slate-500 dark:text-slate-450 mt-1 leading-relaxed">Finishing structured video and text chapters unlocks quick rank points immediately.</p>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-emerald-500/5 border border-emerald-500/15 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center shrink-0">
                        <i data-lucide="file-check" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-xs">Pass Assessments (+30 pts)</h4>
                        <p class="text-[10px] text-slate-500 dark:text-slate-450 mt-1 leading-relaxed">Score above the target pass percentage in final course tests to earn point boosts.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
