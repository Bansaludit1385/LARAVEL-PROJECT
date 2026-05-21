<x-app-layout>
    <!-- Glowing Emerald Hero Section -->
    <div class="relative overflow-hidden bg-[#020a05] text-[#e8f5ed] py-20 lg:py-24 transition-colors duration-300 border-b border-emerald-950/30">
        <!-- Abstract gradient glows -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-emerald-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-[600px] h-[600px] bg-teal-600/5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <!-- Premium Badge -->
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-400/20 text-xs font-semibold text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                        CodeSpire Unified Learning Platform
                    </div>

                    <h1 class="heading-font text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-none text-transparent bg-clip-text bg-gradient-to-r from-white via-emerald-100 to-emerald-300">
                        Master Computer Science <br>
                        <span class="text-emerald-400">Step-by-Step & Deep.</span>
                    </h1>

                    <p class="text-slate-400 text-base sm:text-lg max-w-xl leading-relaxed">
                        Access detailed database indexing studies, consistent hash designs, timed assessment engines, and live compiled sandbox systems.
                    </p>

                    <!-- Large Search Bar Hero -->
                    <form action="{{ route('search') }}" method="GET" class="relative max-w-xl">
                        <input type="text" name="q" placeholder="Search algorithms, system designs, Laravel SaaS..." class="w-full pl-12 pr-28 py-3.5 rounded-2xl border border-emerald-950/40 bg-emerald-950/15 text-sm text-slate-100 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 shadow-inner">
                        <div class="absolute left-4 top-4 text-emerald-500">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </div>
                        <button type="submit" class="absolute right-2 top-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition duration-150">
                            Search DB
                        </button>
                    </form>
                </div>

                <!-- GFG Pseudo Terminal Mockup -->
                <div class="lg:col-span-5 hidden lg:block">
                    <div class="p-6 rounded-3xl border border-emerald-950/60 bg-[#040e08] shadow-2xl relative">
                        <div class="flex items-center justify-between pb-4 border-b border-emerald-950/60">
                            <div class="flex gap-1.5">
                                <span class="w-3 h-3 rounded-full bg-rose-500/80"></span>
                                <span class="w-3 h-3 rounded-full bg-amber-500/80"></span>
                                <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
                            </div>
                            <span class="text-[10px] font-mono text-emerald-400/85">dijkstra_shortest_path.cpp</span>
                        </div>
                        <pre class="pt-4 text-xs font-mono text-emerald-300/90 leading-relaxed overflow-x-auto"><code>void shortestPath(vector<vector<pair<int, int>>>& adj, int src, int V) {
    priority_queue<pair<int, int>, vector<pair<int, int>>, greater<pair<int, int>>> pq;
    vector<int> dist(V, INF);

    pq.push(make_pair(0, src));
    dist[src] = 0;

    while (!pq.empty()) {
        int u = pq.top().second;
        pq.pop();
        // ... relaxation logic ...
    }
}</code></pre>
                        
                        <!-- Floating Glass Metric Card -->
                        <div class="absolute -bottom-6 -left-6 px-4 py-3 rounded-2xl glassmorphism shadow-xl flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center font-bold">
                                <i data-lucide="zap" class="w-5 h-5 text-emerald-500"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Algorithm Speed</p>
                                <p class="text-xs font-extrabold text-slate-900 dark:text-white">O((V + E) log V)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-20">
        
        <!-- Category Syllabus Tracks -->
        <section class="space-y-6">
            <div class="flex justify-between items-end">
                <div class="space-y-1">
                    <h2 class="heading-font text-2xl font-extrabold text-slate-900 dark:text-white">Computer Science Syllabus Tracks</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Structured paths designed from computer engineering basics to high-end scaling systems.</p>
                </div>
                <a href="{{ route('courses.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                    All Tracks <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
            
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('courses.index', ['category' => $category->slug]) }}" class="group p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200/60 dark:border-emerald-950/40 hover:shadow-xl hover:border-emerald-500/30 hover:-translate-y-1 transition duration-300">
                        <div class="flex justify-between items-start">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center transition group-hover:scale-110">
                                @if($category->slug === 'web-development')
                                    <i data-lucide="layers" class="w-6 h-6"></i>
                                @elseif($category->slug === 'data-science-ai')
                                    <i data-lucide="brain-circuit" class="w-6 h-6"></i>
                                @elseif($category->slug === 'database-engineering')
                                    <i data-lucide="database" class="w-6 h-6"></i>
                                @elseif($category->slug === 'interview-prep')
                                    <i data-lucide="award" class="w-6 h-6"></i>
                                @else
                                    <i data-lucide="cpu" class="w-6 h-6"></i>
                                @endif
                            </div>
                            <span class="text-[10px] font-extrabold text-slate-400 bg-slate-50 dark:bg-emerald-950/20 px-2.5 py-1 rounded-full group-hover:bg-emerald-600 group-hover:text-white transition duration-200">
                                {{ $category->courses_count + $category->articles_count }} modules
                            </span>
                        </div>
                        <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white mt-4 group-hover:text-emerald-650 dark:group-hover:text-emerald-400 transition">{{ $category->name }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">{{ $category->description }}</p>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Interactive DSA Algorithm Visualizer Sandbox Widget -->
        <section class="space-y-6" x-data="{
            array: [35, 12, 85, 45, 23, 60, 15],
            pointers: { i: -1, j: -1, minIdx: -1, sortedUpTo: -1 },
            algorithm: 'selection',
            speed: 500,
            isPlaying: false,
            stepIndex: 0,
            steps: [],
            initSteps() {
                this.steps = [];
                let arr = [...this.array];
                let n = arr.length;
                if (this.algorithm === 'bubble') {
                    for (let i = 0; i < n - 1; i++) {
                        for (let j = 0; j < n - i - 1; j++) {
                            // Comparison step
                            this.steps.push({
                                type: 'compare',
                                pointers: { i: i, j: j, target: j + 1 },
                                arr: [...arr]
                            });
                            if (arr[j] > arr[j + 1]) {
                                let temp = arr[j];
                                arr[j] = arr[j + 1];
                                arr[j + 1] = temp;
                                // Swap step
                                this.steps.push({
                                    type: 'swap',
                                    pointers: { i: i, j: j, target: j + 1 },
                                    arr: [...arr]
                                });
                            }
                        }
                    }
                } else if (this.algorithm === 'selection') {
                    for (let i = 0; i < n - 1; i++) {
                        let minIdx = i;
                        this.steps.push({
                            type: 'setMin',
                            pointers: { i: i, j: i, minIdx: minIdx },
                            arr: [...arr]
                        });
                        for (let j = i + 1; j < n; j++) {
                            this.steps.push({
                                type: 'compare',
                                pointers: { i: i, j: j, minIdx: minIdx },
                                arr: [...arr]
                            });
                            if (arr[j] < arr[minIdx]) {
                                minIdx = j;
                                this.steps.push({
                                    type: 'updateMin',
                                    pointers: { i: i, j: j, minIdx: minIdx },
                                    arr: [...arr]
                                });
                            }
                        }
                        if (minIdx !== i) {
                            let temp = arr[i];
                            arr[i] = arr[minIdx];
                            arr[minIdx] = temp;
                            this.steps.push({
                                type: 'swap',
                                pointers: { i: i, j: minIdx, minIdx: minIdx },
                                arr: [...arr]
                            });
                        }
                    }
                } else if (this.algorithm === 'insertion') {
                    for (let i = 1; i < n; i++) {
                        let key = arr[i];
                        let j = i - 1;
                        this.steps.push({
                            type: 'compare',
                            pointers: { i: i, j: j, target: i },
                            arr: [...arr]
                        });
                        while (j >= 0 && arr[j] > key) {
                            arr[j + 1] = arr[j];
                            j = j - 1;
                            this.steps.push({
                                type: 'swap',
                                pointers: { i: i, j: j, target: j + 1 },
                                arr: [...arr]
                            });
                        }
                        arr[j + 1] = key;
                        this.steps.push({
                            type: 'insert',
                            pointers: { i: i, j: j, target: j + 1 },
                            arr: [...arr]
                        });
                    }
                } else if (this.algorithm === 'merge') {
                    let mergeSortHelper = (l, r) => {
                        if (l < r) {
                            let m = Math.floor((l + r) / 2);
                            mergeSortHelper(l, m);
                            mergeSortHelper(m + 1, r);
                            merge(l, m, r);
                        }
                    };
                    let merge = (l, m, r) => {
                        let n1 = m - l + 1;
                        let n2 = r - m;
                        let L = [];
                        let R = [];
                        for (let i = 0; i < n1; i++) L[i] = arr[l + i];
                        for (let j = 0; j < n2; j++) R[j] = arr[m + 1 + j];
                        let i = 0, j = 0, k = l;
                        while (i < n1 && j < n2) {
                            this.steps.push({
                                type: 'compare',
                                pointers: { i: l + i, j: m + 1 + j, target: k },
                                arr: [...arr]
                            });
                            if (L[i] <= R[j]) {
                                arr[k] = L[i];
                                i++;
                            } else {
                                arr[k] = R[j];
                                j++;
                            }
                            this.steps.push({
                                type: 'overwrite',
                                pointers: { i: l + i - 1, j: m + 1 + j - 1, target: k },
                                arr: [...arr]
                            });
                            k++;
                        }
                        while (i < n1) {
                            arr[k] = L[i];
                            this.steps.push({
                                type: 'overwrite',
                                pointers: { i: l + i, j: -1, target: k },
                                arr: [...arr]
                            });
                            i++;
                            k++;
                        }
                        while (j < n2) {
                            arr[k] = R[j];
                            this.steps.push({
                                type: 'overwrite',
                                pointers: { i: -1, j: m + 1 + j, target: k },
                                arr: [...arr]
                            });
                            j++;
                            k++;
                        }
                    };
                    mergeSortHelper(0, n - 1);
                } else if (this.algorithm === 'quick') {
                    let quickSortHelper = (low, high) => {
                        if (low < high) {
                            let pi = partition(low, high);
                            quickSortHelper(low, pi - 1);
                            quickSortHelper(pi + 1, high);
                        }
                    };
                    let partition = (low, high) => {
                        let pivot = arr[high];
                        let i = low - 1;
                        this.steps.push({
                            type: 'pivot',
                            pointers: { i: i, j: high, minIdx: high },
                            arr: [...arr]
                        });
                        for (let j = low; j < high; j++) {
                            this.steps.push({
                                type: 'compare',
                                pointers: { i: i, j: j, minIdx: high },
                                arr: [...arr]
                            });
                            if (arr[j] < pivot) {
                                i++;
                                let temp = arr[i];
                                arr[i] = arr[j];
                                arr[j] = temp;
                                this.steps.push({
                                    type: 'swap',
                                    pointers: { i: i, j: j, minIdx: high },
                                    arr: [...arr]
                                });
                            }
                        }
                        let temp = arr[i + 1];
                        arr[i + 1] = arr[high];
                        arr[high] = temp;
                        this.steps.push({
                            type: 'swap',
                            pointers: { i: i + 1, j: high, minIdx: high },
                            arr: [...arr]
                        });
                        return i + 1;
                    };
                    quickSortHelper(0, n - 1);
                }
                this.stepIndex = 0;
            },
            nextStep() {
                if (this.steps.length === 0) this.initSteps();
                if (this.stepIndex < this.steps.length) {
                    let step = this.steps[this.stepIndex];
                    this.array = [...step.arr];
                    this.pointers = step.pointers;
                    this.stepIndex++;
                } else {
                    this.isPlaying = false;
                    this.pointers = { i: -1, j: -1, minIdx: -1, sortedUpTo: -1 };
                }
            },
            reset() {
                this.isPlaying = false;
                this.array = [35, 12, 85, 45, 23, 60, 15];
                this.pointers = { i: -1, j: -1, minIdx: -1, sortedUpTo: -1 };
                this.stepIndex = 0;
                this.steps = [];
            },
            togglePlay() {
                this.isPlaying = !this.isPlaying;
                if (this.isPlaying) {
                    let runner = () => {
                        if (!this.isPlaying) return;
                        this.nextStep();
                        setTimeout(runner, this.speed);
                    };
                    runner();
                }
            }
        }" x-init="initSteps()">
            <div class="space-y-1">
                <h2 class="heading-font text-2xl font-bold text-slate-900 dark:text-white">Interactive DSA Algorithm Visualizer</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Step through sorting algorithms live inside a modern visual environment.</p>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 bg-[#020a05] p-8 rounded-3xl border border-emerald-950/60 shadow-2xl relative">
                <!-- Sandbox Left Console Control -->
                <div class="lg:col-span-4 flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-2">Select Algorithm</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                <button @click="algorithm = 'selection'; reset(); initSteps()" :class="algorithm === 'selection' ? 'bg-emerald-600 text-white' : 'bg-emerald-950/20 text-emerald-400 border border-emerald-900/50'" class="px-3 py-2 rounded-xl text-[10px] font-bold transition">
                                    Selection
                                </button>
                                <button @click="algorithm = 'bubble'; reset(); initSteps()" :class="algorithm === 'bubble' ? 'bg-emerald-600 text-white' : 'bg-emerald-950/20 text-emerald-400 border border-emerald-900/50'" class="px-3 py-2 rounded-xl text-[10px] font-bold transition">
                                    Bubble
                                </button>
                                <button @click="algorithm = 'insertion'; reset(); initSteps()" :class="algorithm === 'insertion' ? 'bg-emerald-600 text-white' : 'bg-emerald-950/20 text-emerald-400 border border-emerald-900/50'" class="px-3 py-2 rounded-xl text-[10px] font-bold transition">
                                    Insertion
                                </button>
                                <button @click="algorithm = 'merge'; reset(); initSteps()" :class="algorithm === 'merge' ? 'bg-emerald-600 text-white' : 'bg-emerald-950/20 text-emerald-400 border border-emerald-900/50'" class="px-3 py-2 rounded-xl text-[10px] font-bold transition">
                                    Merge
                                </button>
                                <button @click="algorithm = 'quick'; reset(); initSteps()" :class="algorithm === 'quick' ? 'bg-emerald-600 text-white' : 'bg-emerald-950/20 text-emerald-400 border border-emerald-900/50'" class="px-3 py-2 rounded-xl text-[10px] font-bold transition">
                                    Quick
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-2">Simulate Speed</label>
                            <input type="range" min="150" max="1000" x-model="speed" class="w-full accent-emerald-500 bg-emerald-950/50 h-2 rounded-lg cursor-pointer">
                        </div>
                    </div>

                    <!-- Simulator Controls -->
                    <div class="flex items-center gap-2">
                        <button @click="togglePlay()" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-550 transition font-bold text-xs text-white flex items-center gap-1.5 shadow-md">
                            <span x-show="!isPlaying"><i data-lucide="play" class="w-3.5 h-3.5 fill-white"></i> Play</span>
                            <span x-show="isPlaying"><i data-lucide="pause" class="w-3.5 h-3.5 fill-white"></i> Pause</span>
                        </button>
                        <button @click="nextStep()" :disabled="isPlaying" class="px-4 py-2.5 rounded-xl bg-emerald-950/30 text-emerald-400 border border-emerald-900/50 hover:bg-emerald-900/20 transition font-bold text-xs disabled:opacity-50">
                            Single Step
                        </button>
                        <button @click="reset()" class="px-4 py-2.5 rounded-xl bg-rose-950/30 text-rose-450 border border-rose-900/50 hover:bg-rose-900/20 transition font-bold text-xs">
                            Reset
                        </button>
                    </div>
                </div>

                <!-- Simulation Visual Board -->
                <div class="lg:col-span-8 flex flex-col justify-end bg-emerald-950/15 p-6 rounded-2xl border border-emerald-900/30 min-h-64 relative">
                    <div class="flex items-end justify-around w-full h-full gap-2 z-10">
                        <template x-for="(val, index) in array" :key="index">
                            <div class="flex flex-col items-center w-full">
                                <span class="text-[10px] font-mono font-bold text-emerald-400 mb-1" x-text="val"></span>
                                <div class="w-full rounded-t-lg transition-all duration-300"
                                     :style="`height: ${val * 1.8}px;`"
                                     :class="{
                                         'bg-emerald-500 shadow-md shadow-emerald-500/20': pointers.j === index,
                                         'bg-rose-500 shadow-md shadow-rose-500/20': pointers.minIdx === index || pointers.target === index,
                                         'bg-emerald-700': pointers.i === index,
                                         'bg-emerald-900/60 border border-emerald-800/35': pointers.j !== index && pointers.minIdx !== index && pointers.target !== index && pointers.i !== index
                                     }">
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="absolute top-4 right-4 text-[9px] font-mono text-emerald-500/60 uppercase">
                        Step: <span x-text="stepIndex"></span> / <span x-text="steps.length"></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Course Syllabus Grid Highlights -->
        <section class="space-y-8">
            <div class="flex justify-between items-end">
                <div class="space-y-1">
                    <h2 class="heading-font text-2xl font-bold text-slate-900 dark:text-white">Top Structured Courses</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Step-by-step masterclasses authored by experienced computer science educators.</p>
                </div>
                <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                    View Course Directory
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredCourses as $course)
                    <div class="group flex flex-col rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200/60 dark:border-emerald-950/40 shadow-sm overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="relative h-44 overflow-hidden bg-slate-100">
                            <img src="{{ $course->thumbnail ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=600' }}" alt="Course Cover" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
                            <span class="absolute top-4 right-4 px-2.5 py-1 rounded-lg text-[10px] font-bold tracking-wide uppercase text-white bg-emerald-600/90 backdrop-blur-md">
                                {{ $course->level }}
                            </span>
                        </div>
                        <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                            <div class="space-y-2">
                                <span class="text-[10px] font-extrabold text-emerald-650 dark:text-emerald-400 uppercase tracking-wider">{{ $course->category->name }}</span>
                                <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition leading-snug">
                                    <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                </h3>
                                <p class="text-xs text-slate-550 dark:text-slate-400 line-clamp-2 leading-relaxed">{{ $course->description }}</p>
                            </div>
                            <div class="border-t border-slate-100 dark:border-emerald-950/20 pt-4 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <img src="{{ $course->instructor->avatar }}" alt="Instructor Avatar" class="w-6.5 h-6.5 rounded-full ring-2 ring-emerald-500/10">
                                    <span class="text-[11px] font-semibold text-slate-600 dark:text-slate-350">{{ $course->instructor->name }}</span>
                                </div>
                                <span class="text-sm font-extrabold text-slate-950 dark:text-white">
                                    {{ $course->price > 0 ? '$'.number_format($course->price, 2) : 'Free' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Trending Code Articles Section -->
        <section class="grid lg:grid-cols-12 gap-12">
            <!-- Left Side: Recent Articles -->
            <div class="lg:col-span-8 space-y-6">
                <div class="space-y-1">
                    <h2 class="heading-font text-2xl font-bold text-slate-900 dark:text-white">Deep-Dive Tech Articles</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Read clear documentation, system design reviews, and tested code implementations.</p>
                </div>

                <div class="divide-y divide-slate-150 dark:divide-emerald-950/30">
                    @foreach($recentArticles as $article)
                        <div class="py-6 first:pt-0 last:pb-0 group">
                            <div class="flex items-center gap-2 text-[10px] font-bold text-emerald-650 dark:text-emerald-400 uppercase tracking-wider">
                                <span>{{ $article->category->name }}</span>
                                <span class="text-slate-300 dark:text-emerald-950">&bull;</span>
                                <span class="text-slate-450">{{ $article->created_at->format('M d, Y') }}</span>
                            </div>
                            <h3 class="heading-font font-bold text-lg text-slate-900 dark:text-white mt-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition leading-snug">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 line-clamp-2 leading-relaxed">{{ strip_tags($article->content) }}</p>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center gap-2">
                                    <img src="{{ $article->author->avatar }}" alt="Author Avatar" class="w-5.5 h-5.5 rounded-full">
                                    <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400">{{ $article->author->name }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-slate-400 text-[11px]">
                                    <span class="flex items-center gap-1"><i data-lucide="eye" class="w-3.5 h-3.5"></i> {{ $article->views_count }}</span>
                                    <span class="flex items-center gap-1"><i data-lucide="message-square" class="w-3.5 h-3.5"></i> {{ $article->comments()->count() }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Side: Trending list like GFG -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Trending Topics widget -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200/60 dark:border-emerald-950/40">
                    <h3 class="heading-font font-extrabold text-sm uppercase tracking-wider text-slate-900 dark:text-white pb-3 border-b border-slate-100 dark:border-emerald-950/20 flex items-center gap-2">
                        <i data-lucide="trending-up" class="w-4 h-4 text-emerald-500"></i>
                        Trending Topics
                    </h3>

                    <div class="divide-y divide-slate-100 dark:divide-emerald-950/20 mt-4">
                        @foreach($trendingArticles as $index => $article)
                            <div class="py-3.5 first:pt-0 last:pb-0 flex gap-3.5">
                                <span class="heading-font font-black text-2xl text-emerald-250 dark:text-emerald-950 leading-none">{{ sprintf("%02d", $index + 1) }}</span>
                                <div>
                                    <a href="{{ route('articles.show', $article->slug) }}" class="text-xs font-semibold text-slate-850 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 leading-normal line-clamp-2">
                                        {{ $article->title }}
                                    </a>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-1">{{ $article->views_count }} views</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Gamified Weekly Challenge widget -->
                <div class="p-6 rounded-3xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white space-y-4 shadow-lg shadow-emerald-500/10">
                    <i data-lucide="calendar" class="w-8 h-8 opacity-80"></i>
                    <h3 class="heading-font font-bold text-sm">Weekly Coding Challenge</h3>
                    <p class="text-[11px] text-emerald-100 leading-normal">Solve algorithmic problems this week to double your leaderboard scores!</p>
                    <a href="{{ route('courses.index') }}" class="w-full text-center block py-2 rounded-xl bg-white text-emerald-600 hover:bg-slate-50 transition text-xs font-bold shadow-md">
                        Challenge Console
                    </a>
                </div>
            </div>
        </section>

    </div>
</x-app-layout>
