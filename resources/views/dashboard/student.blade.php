<x-app-layout>
    <!-- Chart.js CDN for student learning charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-10">
            <!-- Student Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 p-8 rounded-3xl bg-[#04140a] border border-emerald-950/40 text-white relative overflow-hidden shadow-xl shadow-emerald-950/5">
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-2xl"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="w-16 h-16 rounded-2xl ring-4 ring-emerald-500/20">
                    <div>
                        <h1 class="heading-font text-2xl font-extrabold">{{ Auth::user()->name }}</h1>
                        <p class="text-xs text-emerald-250">Enrolled Student &bull; {{ Auth::user()->points }} Learning Points</p>
                    </div>
                </div>
                <!-- Mini Stats list -->
                <div class="flex gap-6 relative z-10 text-xs">
                    <div>
                        <span class="text-emerald-400 block">Enrolled Paths</span>
                        <span class="text-lg font-bold">{{ $enrollments->count() }}</span>
                    </div>
                    <div>
                        <span class="text-emerald-400 block">Certificates</span>
                        <span class="text-lg font-bold">{{ $certificates->count() }}</span>
                    </div>
                    <div>
                        <span class="text-emerald-400 block">Time Spent</span>
                        <span class="text-lg font-bold">{{ $totalMinutes }} mins</span>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-8">
                <!-- Left Main Content Column -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- Learning Progress Charts -->
                    <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-4">
                        <h3 class="heading-font font-bold text-sm text-slate-900 dark:text-white">Active Progress Analysis</h3>
                        <div class="h-64">
                            <canvas id="progressChart"></canvas>
                        </div>
                    </div>

                    <!-- Enrolled courses -->
                    <div class="space-y-4">
                        <h3 class="heading-font font-bold text-sm text-slate-900 dark:text-white">Active Courses Syllabus</h3>
                        
                        @if($enrollments->isEmpty())
                            <div class="p-8 rounded-3xl border border-dashed border-slate-200 dark:border-emerald-950/30 text-center">
                                <p class="text-xs text-slate-500">You are not enrolled in any courses yet.</p>
                                <a href="{{ route('courses.index') }}" class="inline-block mt-3 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-555 text-white text-xs font-semibold">Explore Syllabus</a>
                            </div>
                        @else
                            <div class="grid sm:grid-cols-2 gap-6">
                                @foreach($enrollments as $enr)
                                    <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 space-y-4 flex flex-col justify-between hover:shadow-md transition">
                                        <div class="space-y-2">
                                            <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">{{ $enr->course->level }}</span>
                                            <h4 class="heading-font font-bold text-base text-slate-900 dark:text-white leading-snug">{{ $enr->course->title }}</h4>
                                        </div>

                                        <!-- Progress Bar -->
                                        <div class="space-y-1">
                                            <div class="flex justify-between text-[10px] text-slate-450 font-bold">
                                                <span>PROGRESS</span>
                                                <span>{{ $enr->progress_percent }}%</span>
                                            </div>
                                            <div class="w-full h-1.5 rounded-full bg-slate-100 dark:bg-emerald-950/40 overflow-hidden">
                                                <div class="h-full bg-emerald-600 transition-all duration-300" style="width: {{ $enr->progress_percent }}%"></div>
                                            </div>
                                        </div>

                                        <a href="{{ route('courses.lesson', [$enr->course->slug, $enr->course->lessons->first()->slug ?? 'intro']) }}" class="w-full py-2 rounded-xl text-xs font-bold text-center block bg-slate-50 hover:bg-emerald-600 dark:bg-slate-950 dark:hover:bg-emerald-600 hover:text-white transition">
                                            Study Syllabus
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Side: Certificates & Bookmarks -->
                <div class="lg:col-span-4 space-y-8">
                    <!-- Verifiable Certificates Card -->
                    <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-4">
                        <h3 class="heading-font font-bold text-sm text-slate-900 dark:text-white pb-3 border-b border-slate-100 dark:border-emerald-950/20 flex items-center gap-2">
                            <i data-lucide="award" class="w-4 h-4 text-emerald-500"></i>
                            Your Certificates
                        </h3>
                        
                        @if($certificates->isEmpty())
                            <p class="text-xs text-slate-400">Finish a syllabus or final assessment to unlock official certificates.</p>
                        @else
                            <div class="space-y-3">
                                @foreach($certificates as $cert)
                                    <a href="{{ route('certificates.show', $cert->certificate_code) }}" class="block p-4 rounded-xl border border-slate-200 dark:border-emerald-950/20 bg-slate-50 dark:bg-[#020a05] hover:border-emerald-500/25 transition">
                                        <h4 class="font-bold text-xs text-slate-900 dark:text-white line-clamp-1">{{ $cert->course->title }}</h4>
                                        <span class="text-[9px] text-emerald-600 dark:text-emerald-400 font-bold block mt-1">VERIFY: {{ $cert->certificate_code }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Bookmarked Articles list -->
                    <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-4">
                        <h3 class="heading-font font-bold text-sm text-slate-900 dark:text-white pb-3 border-b border-slate-100 dark:border-emerald-950/20 flex items-center gap-2">
                            <i data-lucide="bookmarks" class="w-4 h-4 text-emerald-500"></i>
                            Bookmarks
                        </h3>

                        @if($bookmarks->isEmpty())
                            <p class="text-xs text-slate-400">Bookmarked articles will appear here for fast reading.</p>
                        @else
                            <div class="space-y-3">
                                @foreach($bookmarks as $bk)
                                    @if($bk->bookmarkable)
                                        <a href="{{ route('articles.show', $bk->bookmarkable->slug) }}" class="block text-xs font-semibold text-slate-700 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition">
                                            &bull; {{ $bk->bookmarkable->title }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script to draw Chart.js learning curve -->
    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($enrollments->pluck('course.title')->map(fn($t) => strlen($t) > 20 ? substr($t, 0, 20).'...' : $t)) !!},
                datasets: [{
                    label: 'Syllabus Progress Percent (%)',
                    data: {!! json_encode($enrollments->pluck('progress_percent')) !!},
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        grid: { color: 'rgba(16,185,129,0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
</x-app-layout>
