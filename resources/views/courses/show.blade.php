<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-12 gap-12">
            
            <!-- Left Info Block: Description & Curriculum -->
            <div class="lg:col-span-8 space-y-10">
                <!-- Info Header -->
                <div class="space-y-4">
                    <span class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-400/20 text-xs font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">
                        {{ $course->category->name }}
                    </span>
                    <h1 class="heading-font text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white leading-tight">
                        {{ $course->title }}
                    </h1>
                    <p class="text-sm text-slate-650 dark:text-slate-400 leading-relaxed">
                        {{ $course->description }}
                    </p>
                </div>

                <!-- Structured Syllabus Grid (Coursera Style) -->
                <div class="space-y-6">
                    <h2 class="heading-font text-xl font-bold text-slate-900 dark:text-white pb-3 border-b border-slate-200 dark:border-emerald-950/20">
                        Course syllabus ({{ $course->lessons->count() }} lessons)
                    </h2>

                    <div class="space-y-4" x-data="{ activeAccordion: 0 }">
                        @foreach($course->lessons as $index => $les)
                            <div class="rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 overflow-hidden">
                                <button @click="activeAccordion = (activeAccordion === {{ $index }} ? -1 : {{ $index }})" class="w-full flex items-center justify-between p-5 text-left transition focus:outline-none">
                                    <div class="flex items-center gap-4">
                                        @if(Auth::check() && Auth::user()->completedLessons()->where('lesson_id', $les->id)->exists())
                                            <span class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-600 dark:text-emerald-450 font-bold text-xs flex items-center justify-center shrink-0" title="Completed">
                                                <i data-lucide="check" class="w-4 h-4"></i>
                                            </span>
                                        @else
                                            <span class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold text-xs flex items-center justify-center shrink-0">
                                                {{ sprintf("%02d", $index + 1) }}
                                            </span>
                                        @endif
                                        <div>
                                            <h3 class="heading-font font-bold text-slate-900 dark:text-white text-sm">
                                                {{ $les->title }}
                                            </h3>
                                            <p class="text-[10px] text-slate-400 font-semibold flex items-center gap-1.5 mt-0.5">
                                                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                                {{ $les->duration_minutes }} minutes
                                            </p>
                                        </div>
                                    </div>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transform transition-transform duration-200" :class="activeAccordion === {{ $index }} ? 'rotate-180' : ''"></i>
                                </button>

                                <div x-show="activeAccordion === {{ $index }}" x-collapse class="px-5 pb-5 border-t border-slate-100 dark:border-emerald-950/20 pt-4 bg-slate-50/50 dark:bg-emerald-950/5">
                                    <div class="prose prose-sm dark:prose-invert max-w-none text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                        Learn advanced algorithms, dynamic complexities, and standard data structure approaches corresponding to this chapter block.
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Assessments Assessment Engine Card -->
                @if($course->quizzes->isNotEmpty())
                    <div class="p-6 rounded-3xl bg-amber-500/5 border border-amber-500/20 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                                <i data-lucide="award" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="heading-font font-bold text-slate-900 dark:text-white text-sm">Final Assessment Available</h3>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">Complete the course assessment to unlock certificate credentials.</p>
                            </div>
                        </div>
                        <div class="divide-y divide-amber-500/10">
                            @foreach($course->quizzes as $quiz)
                                <div class="py-3 flex justify-between items-center text-xs">
                                    <span class="font-semibold text-slate-800 dark:text-slate-250">{{ $quiz->title }}</span>
                                    <span class="text-slate-500">Min. score to pass: {{ $quiz->pass_percentage }}%</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Sidebar: Enrolling Options & Author -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Enrollment Panel -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-6">
                    <div class="space-y-1">
                        <span class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">Course Price</span>
                        <p class="heading-font text-3xl font-black text-slate-900 dark:text-white">
                            {{ $course->price > 0 ? '$'.number_format($course->price, 2) : 'Free' }}
                        </p>
                    </div>

                    <div class="space-y-3">
                        @if($isEnrolled)
                            <a href="{{ route('courses.lesson', [$course->slug, $course->lessons->first()->slug ?? 'intro']) }}" class="w-full py-3 rounded-xl text-xs font-bold text-center block bg-emerald-600 hover:bg-emerald-550 hover:scale-105 active:scale-95 text-white transition shadow-lg shadow-emerald-500/20">
                                Resume Syllabus ({{ $progress }}% Done)
                            </a>
                        @else
                            @auth
                                <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-3 rounded-xl text-xs font-bold text-center bg-emerald-600 hover:bg-emerald-550 hover:scale-105 active:scale-95 text-white transition shadow-lg shadow-emerald-500/20">
                                        Enroll Now
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="w-full py-3 rounded-xl text-xs font-bold text-center block bg-emerald-600 hover:bg-emerald-550 hover:scale-105 active:scale-95 text-white transition shadow-lg shadow-emerald-500/20">
                                    Sign In to Enroll
                                </a>
                            @endauth
                        @endif
                    </div>

                    <!-- Meta specifications -->
                    <div class="divide-y divide-slate-100 dark:divide-emerald-950/20 pt-2 text-xs">
                        <div class="py-2.5 flex justify-between">
                            <span class="text-slate-450">Difficulty level</span>
                            <span class="font-bold text-slate-900 dark:text-white capitalize">{{ $course->level }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <span class="text-slate-450">Total lessons</span>
                            <span class="font-bold text-slate-900 dark:text-white">{{ $course->lessons->count() }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <span class="text-slate-450">Certificate upon completion</span>
                            <span class="font-bold text-emerald-600">Yes</span>
                        </div>
                    </div>
                </div>

                <!-- Gold-Glass Certificate Mockup -->
                <div class="p-6 rounded-3xl bg-gradient-to-tr from-amber-600/90 to-yellow-500/90 text-white space-y-4 shadow-xl border border-yellow-400/35 relative overflow-hidden">
                    <div class="absolute -right-12 -bottom-12 w-32 h-32 bg-white/5 rounded-full blur-xl"></div>
                    <div class="flex justify-between items-start">
                        <i data-lucide="award" class="w-8 h-8 text-yellow-100"></i>
                        <span class="text-[9px] font-bold tracking-widest uppercase bg-black/10 px-2 py-0.5 rounded-full">GOLD CREDENTIAL</span>
                    </div>
                    <h4 class="heading-font font-bold text-sm">Verifiable Certificate</h4>
                    <p class="text-[10px] text-yellow-150 leading-relaxed">Instantly download a premium, printable completion certificate containing a cryptographic verification link upon passing the course assessments.</p>
                </div>

                <!-- Instructor Card -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 space-y-4">
                    <h3 class="heading-font font-bold text-sm text-slate-900 dark:text-white">Your Instructor</h3>
                    <div class="flex items-center gap-3">
                        <img src="{{ $course->instructor->avatar }}" alt="Avatar" class="w-12 h-12 rounded-xl object-cover ring-2 ring-emerald-500/10">
                        <div>
                            <h4 class="font-bold text-sm text-slate-900 dark:text-white">{{ $course->instructor->name }}</h4>
                            <span class="text-[10px] text-emerald-650 font-semibold uppercase tracking-wider capitalize">{{ $course->instructor->role }}</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">{{ $course->instructor->bio }}</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
