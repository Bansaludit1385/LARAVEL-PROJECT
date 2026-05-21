<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-10">
            <!-- Header banner -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 p-8 rounded-3xl bg-[#04140a] border border-emerald-950/40 text-white relative overflow-hidden shadow-lg">
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-2xl"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-16 h-16 rounded-2xl ring-4 ring-emerald-500/20">
                    <div>
                        <h1 class="heading-font text-2xl font-extrabold">{{ Auth::user()->name }}</h1>
                        <p class="text-xs text-emerald-300">Authorized Instructor Portal &bull; CodeSpire Contributor</p>
                    </div>
                </div>
            </div>

            <!-- Stats grid -->
            <div class="grid sm:grid-cols-3 gap-6">
                <!-- Stat 1 -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Total Students</span>
                        <span class="heading-font text-2xl font-black text-slate-900 dark:text-white">{{ $totalStudents }}</span>
                    </div>
                </div>
                <!-- Stat 2 -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                        <i data-lucide="dollar-sign" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Mock Earnings</span>
                        <span class="heading-font text-2xl font-black text-slate-900 dark:text-white">${{ number_format($totalEarnings, 2) }}</span>
                    </div>
                </div>
                <!-- Stat 3 -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                        <i data-lucide="book-open" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Authored Modules</span>
                        <span class="heading-font text-2xl font-black text-slate-900 dark:text-white">{{ $courses->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Main Content grid -->
            <div class="grid lg:grid-cols-12 gap-8">
                <!-- Left Column: Courses Created -->
                <div class="lg:col-span-8 space-y-6">
                    <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white">Active Authored Courses</h3>
                    
                    <div class="grid sm:grid-cols-2 gap-6">
                        @foreach($courses as $course)
                            <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 space-y-4">
                                <h4 class="heading-font font-bold text-sm text-slate-900 dark:text-white">{{ $course->title }}</h4>
                                <div class="flex justify-between items-center text-[10px] text-slate-450 font-semibold">
                                    <span>{{ $course->lessons_count }} Lessons</span>
                                    <span>{{ $course->students_count }} Students</span>
                                </div>
                                <div class="border-t border-slate-100 dark:border-emerald-950/20 pt-3 flex justify-between items-center text-xs">
                                    <span class="font-bold text-slate-900 dark:text-white">${{ number_format($course->price, 2) }}</span>
                                    <a href="{{ route('courses.show', $course->slug) }}" class="text-emerald-650 dark:text-emerald-400 font-bold hover:underline">Syllabus Overview &rarr;</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Column: Recent enrollments feed -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-4">
                        <h3 class="heading-font font-bold text-xs uppercase tracking-wider text-slate-450">Recent Student Enrolls</h3>
                        
                        <div class="divide-y divide-slate-100 dark:divide-emerald-950/25">
                            @foreach($recentEnrollments as $enr)
                                <div class="py-3 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ $enr->user->avatar }}" class="w-6 h-6 rounded-full" alt="">
                                        <div class="space-y-0.5">
                                            <span class="font-bold text-[11px] text-slate-900 dark:text-white block">{{ $enr->user->name }}</span>
                                            <span class="text-[9px] text-slate-450 block">{{ $enr->course->title }}</span>
                                        </div>
                                    </div>
                                    <span class="text-[9px] text-slate-400 font-medium">{{ $enr->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
