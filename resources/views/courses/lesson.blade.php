<x-app-layout>
    <!-- Reading Progress Bar -->
    <div class="w-full h-1 bg-slate-100 dark:bg-emerald-950/20 sticky top-16 z-30">
        <div class="h-full bg-emerald-500 transition-all duration-150" style="width: {{ $enrollment->progress_percent }}%"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-6">
            <a href="{{ route('courses.index') }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Courses</a>
            <i data-lucide="chevron-right" class="w-3 h-3 text-slate-300"></i>
            <a href="{{ route('courses.show', $course->slug) }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">{{ $course->title }}</a>
            <i data-lucide="chevron-right" class="w-3 h-3 text-slate-300"></i>
            <span class="text-slate-600 dark:text-slate-300">{{ $lesson->title }}</span>
        </nav>

        <div class="grid lg:grid-cols-12 gap-8">
            
            <!-- Left Side: GFG-Style Technical Reading Article -->
            <div class="lg:col-span-8 space-y-8">
                
                <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-6">
                    
                    <!-- Article Header -->
                    <div class="space-y-3 pb-6 border-b border-slate-100 dark:border-emerald-950/20">
                        <span class="px-2.5 py-1 rounded bg-emerald-500/10 border border-emerald-400/20 text-[10px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">
                            Lesson {{ $lesson->sort_order }}
                        </span>
                        <h1 class="heading-font text-3xl font-extrabold text-slate-900 dark:text-white leading-tight">
                            {{ $lesson->title }}
                        </h1>
                        <div class="flex items-center gap-4 text-xs text-slate-400">
                            <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3.5 h-3.5"></i> {{ $lesson->duration_minutes }} Min Read</span>
                            <span>&bull;</span>
                            <span class="flex items-center gap-1"><i data-lucide="award" class="w-3.5 h-3.5"></i> 10 Points Reward</span>
                        </div>
                    </div>

                    <!-- Dynamic Key Concepts Summary Box -->
                    @php
                        preg_match_all('/(#{2,4})\s*(.*)/', $lesson->content, $headings);
                        preg_match_all('/- \s*(.*)/', $lesson->content, $bulletPoints);
                    @endphp
                    <div class="p-6 rounded-2xl bg-emerald-500/5 border border-emerald-500/15 space-y-4">
                        <div class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400 font-bold text-xs uppercase tracking-wider">
                            <i data-lucide="book-open" class="w-4 h-4 text-emerald-500"></i>
                            Key Takeaways & Core Concepts
                        </div>
                        <ul class="space-y-2.5 text-xs text-slate-650 dark:text-slate-300">
                            @if(!empty($bulletPoints[1]))
                                @foreach(array_slice($bulletPoints[1], 0, 3) as $bp)
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 mt-0.5">&bull;</span>
                                        <span>{!! strip_tags(Str::markdown($bp)) !!}</span>
                                    </li>
                                @endforeach
                            @elseif(!empty($headings[2]))
                                @foreach(array_slice($headings[2], 0, 3) as $hd)
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-500 mt-0.5">&bull;</span>
                                        <span>Master the mechanics of **{{ trim($hd) }}** in this chapter.</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="flex items-start gap-2">
                                    <span class="text-emerald-500 mt-0.5">&bull;</span>
                                    <span>Learn step-by-step structural declarations and syntax operations in this lesson.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-emerald-500 mt-0.5">&bull;</span>
                                    <span>Compile, run, and modify code patterns directly inside the practice playground.</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Main Markdown Body -->
                    <div class="prose prose-slate dark:prose-invert max-w-none">
                        <div class="text-slate-700 dark:text-slate-250 leading-relaxed text-sm space-y-4">
                            {!! Str::markdown($lesson->content ?? '') !!}
                        </div>
                    </div>
                </div>

                <!-- Navigation between lessons inside learning panel -->
                <div class="flex justify-between items-center bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 p-4 rounded-2xl shadow-sm">
                    <div class="flex items-center gap-3">
                        @if($isCompleted)
                            <span class="px-3 py-1.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-[10px] font-bold text-emerald-600 flex items-center gap-1">
                                <i data-lucide="check" class="w-3 h-3"></i> Finished Reading
                            </span>
                        @else
                            <form action="{{ route('courses.complete-lesson', [$course->slug, $lesson->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-550 hover:scale-[1.02] transition text-white text-[11px] font-bold shadow-md shadow-emerald-500/10">
                                    Mark as Completed & Next
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="flex gap-2">
                        @php
                            $prevLesson = $course->lessons()->where('sort_order', '<', $lesson->sort_order)->orderBy('sort_order', 'desc')->first();
                            $nextLesson = $course->lessons()->where('sort_order', '>', $lesson->sort_order)->orderBy('sort_order', 'asc')->first();
                        @endphp
                        
                        @if($prevLesson)
                            <a href="{{ route('courses.lesson', [$course->slug, $prevLesson->slug]) }}" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-emerald-950/30 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-emerald-950/10 transition text-[11px] font-bold flex items-center gap-1">
                                &larr; Prev Chapter
                            </a>
                        @endif

                        @if($nextLesson)
                            <a href="{{ route('courses.lesson', [$course->slug, $nextLesson->slug]) }}" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-emerald-950/30 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-emerald-950/10 transition text-[11px] font-bold flex items-center gap-1">
                                Next Chapter &rarr;
                            </a>
                        @endif

                        @if(!$nextLesson && $course->quizzes->isNotEmpty())
                            <a href="{{ route('quizzes.show', $course->quizzes->first()->slug) }}" class="px-4 py-2 rounded-xl border border-amber-500/30 text-amber-500 hover:bg-amber-500/5 transition text-[11px] font-bold">
                                Final Assessment
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Learning Player Discussion/Comments Panel -->
                <div class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-6">
                    <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white pb-3 border-b border-slate-100 dark:border-emerald-950/20">
                        Discussion & Notes
                    </h3>
                    
                    <!-- Add Comment form -->
                    <form action="{{ route('comments.store') }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="commentable_type" value="App\Models\Lesson">
                        <input type="hidden" name="commentable_id" value="{{ $lesson->id }}">
                        
                        <textarea name="content" placeholder="Share your code questions or learning notes here..." rows="3" class="w-full p-4 rounded-2xl border border-slate-200 dark:border-emerald-950/40 bg-slate-50 dark:bg-[#020a05] text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-slate-700 dark:text-slate-350"></textarea>
                        
                        <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-550 transition text-white text-xs font-bold shadow-md shadow-emerald-500/10">
                            Submit Contribution
                        </button>
                    </form>

                    <!-- Comments lists -->
                    <div class="space-y-4">
                        @if($comments->isEmpty())
                            <p class="text-xs text-slate-400">No discussions yet. Be the first to ask a question!</p>
                        @else
                            @foreach($comments as $comment)
                                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-[#020a05] border border-slate-100 dark:border-emerald-950/20 flex gap-4">
                                    <img src="{{ $comment->user->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed='.urlencode($comment->user->name).'&mouth=smile&eyes=happy' }}" alt="Avatar" class="w-8 h-8 rounded-lg">
                                    <div class="space-y-1 flex-grow">
                                        <div class="flex justify-between items-center">
                                            <h4 class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                                {{ $comment->user->name }}
                                                <span class="text-[9px] font-bold text-emerald-650 uppercase">{{ $comment->user->role }}</span>
                                            </h4>
                                            <span class="text-[10px] text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-xs text-slate-650 dark:text-slate-300 leading-normal">{{ $comment->content }}</p>
                                    </div>
                                </div>
                              @endforeach
                          @endif
                      </div>
                </div>

            </div>

            <!-- Right Side: Playlist Sidebar & Live practice compiler -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Course Index Sidebar -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-4">
                    <h3 class="heading-font font-bold text-sm text-slate-900 dark:text-white pb-2 border-b border-slate-100 dark:border-emerald-950/20">
                        Course Chapters
                    </h3>

                    <div class="space-y-2 max-h-96 overflow-y-auto pr-1">
                        @foreach($course->lessons as $index => $les)
                            <a href="{{ route('courses.lesson', [$course->slug, $les->slug]) }}" 
                               class="flex items-center gap-3 p-3.5 rounded-xl border text-left transition duration-150 {{ $les->id === $lesson->id ? 'bg-emerald-50/50 dark:bg-emerald-950/20 border-emerald-500/25 text-emerald-650 dark:text-emerald-400' : 'border-transparent text-slate-700 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-[#020a05]' }}">
                                
                                <!-- Check status -->
                                @if(Auth::user()->completedLessons()->where('lesson_id', $les->id)->exists())
                                    <span class="w-5 h-5 rounded-md bg-emerald-500/10 text-emerald-500 flex items-center justify-center shrink-0">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </span>
                                @else
                                    <span class="w-5 h-5 rounded-md bg-slate-100 dark:bg-emerald-950/20 text-slate-400 font-bold text-[10px] flex items-center justify-center shrink-0">
                                        {{ $index + 1 }}
                                    </span>
                                @endif

                                <div class="space-y-0.5">
                                    <span class="font-bold text-xs line-clamp-1 leading-snug">{{ $les->title }}</span>
                                    <span class="text-[10px] text-slate-400 font-semibold block">{{ $les->duration_minutes }} min read</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Live Practice Code Sandbox Widget -->
                <div class="p-6 rounded-3xl bg-[#020a05] text-[#e8f5ed] border border-emerald-950/60 shadow-xl space-y-4" x-data="{
                    activeTab: '{{ Str::contains(strtolower($course->title), 'python') ? 'python' : 'web' }}',
                    pyDefault: `print('Hello from CodeSpire Python Sandbox!')\n\n# Try loops, lists, and functions:\nfor i in range(5):\n    print(f'Item {i}')\n`,
                    webDefault: `<!-- Practice what you learned! Write HTML/JS here -->\n<div class='text-center p-6 bg-emerald-950/25 rounded-2xl border border-emerald-800/20'>\n  <h3 class='text-emerald-400 font-bold text-sm'>Live Practice Area</h3>\n  <p class='text-slate-400 text-xs mt-1'>Type code & click Run</p>\n</div>`,
                    pyCode: `print('Hello from CodeSpire Python Sandbox!')\n\n# Try loops, lists, and functions:\nfor i in range(5):\n    print(f'Item {i}')\n`,
                    webCode: `<!-- Practice what you learned! Write HTML/JS here -->\n<div class='text-center p-6 bg-emerald-950/25 rounded-2xl border border-emerald-800/20'>\n  <h3 class='text-emerald-400 font-bold text-sm'>Live Practice Area</h3>\n  <p class='text-slate-400 text-xs mt-1'>Type code & click Run</p>\n</div>`,
                    pyOutput: '',
                    loadingPy: false,
                    pyodideInstance: null,
                    downloadFile(content, filename) {
                        const blob = new Blob([content], { type: 'text/plain' });
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                        URL.revokeObjectURL(url);
                    },
                    async initPyodide() {
                        if (this.pyodideInstance) return;
                        this.loadingPy = true;
                        this.pyOutput = 'Loading Python runtime in browser...';
                        try {
                            if (typeof loadPyodide === 'undefined') {
                                const script = document.createElement('script');
                                script.src = 'https://cdn.jsdelivr.net/pyodide/v0.25.0/full/pyodide.js';
                                document.head.appendChild(script);
                                await new Promise((resolve) => { script.onload = resolve; });
                            }
                            this.pyodideInstance = await loadPyodide();
                            this.pyOutput = 'Python runtime loaded successfully!\nClick Run to execute code.';
                        } catch (e) {
                            this.pyOutput = 'Failed to load Python runtime. Please check connection.';
                        } finally {
                            this.loadingPy = false;
                        }
                    },
                    async runPython() {
                        if (!this.pyodideInstance) {
                            await this.initPyodide();
                        }
                        this.pyOutput = 'Running...';
                        try {
                            let stdout = '';
                            this.pyodideInstance.setStdout({
                                write: (text) => {
                                    stdout += text;
                                    return text.length;
                                }
                            });
                            await this.pyodideInstance.runPythonAsync(this.pyCode);
                            this.pyOutput = stdout || 'Code executed successfully with no output.';
                        } catch (err) {
                            this.pyOutput = err.message;
                        }
                    },
                    runWeb() {
                        const iframe = $refs.lessonFrame;
                        const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                        iframeDoc.open();
                        iframeDoc.write('<html><head><script src=\'https://cdn.tailwindcss.com\'><\/script><\/head><body class=\'bg-transparent p-4 flex items-center justify-center min-h-screen text-slate-150\'>' + this.webCode + '<\/body><\/html>');
                        iframeDoc.close();
                    }
                }" x-init="if (activeTab === 'python') { initPyodide(); } else { setTimeout(() => runWeb(), 100); }">
                    
                    <!-- Sandbox Header with Language Tabs -->
                    <div class="flex flex-col gap-3 pb-3 border-b border-emerald-950/50">
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-xs text-emerald-400 flex items-center gap-1.5">
                                <i data-lucide="code-2" class="w-4 h-4"></i> Interactive Practice
                            </h4>
                            <button @click="activeTab === 'python' ? runPython() : runWeb()" class="px-3 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-555 text-white font-bold text-[10px] transition flex items-center gap-1">
                                <i data-lucide="play" class="w-3 h-3 fill-white"></i> Run
                            </button>
                        </div>
                        
                        <!-- Tabs & Utilities -->
                        <div class="flex justify-between items-center">
                            <div class="flex gap-2">
                                <button @click="activeTab = 'python'; initPyodide()" :class="activeTab === 'python' ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400' : 'border-transparent text-slate-400 hover:text-slate-200'" class="px-2.5 py-1 rounded-lg border text-[9px] font-bold tracking-wider uppercase transition">
                                    Python
                                </button>
                                <button @click="activeTab = 'web'; setTimeout(() => runWeb(), 50)" :class="activeTab === 'web' ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400' : 'border-transparent text-slate-400 hover:text-slate-200'" class="px-2.5 py-1 rounded-lg border text-[9px] font-bold tracking-wider uppercase transition">
                                    HTML/CSS/JS
                                </button>
                            </div>
                            
                            <div class="flex gap-1.5">
                                <button @click="if (confirm('Reset editor back to starter template?')) { activeTab === 'python' ? pyCode = pyDefault : webCode = webDefault; activeTab === 'python' ? runPython() : runWeb(); }" class="p-1 rounded hover:bg-emerald-950/40 text-slate-400 hover:text-emerald-400 transition" title="Reset template">
                                    <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                                </button>
                                <button @click="downloadFile(activeTab === 'python' ? pyCode : webCode, activeTab === 'python' ? 'main.py' : 'index.html')" class="p-1 rounded hover:bg-emerald-950/40 text-slate-400 hover:text-emerald-400 transition" title="Download workspace file">
                                    <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Editor Area -->
                    <div x-show="activeTab === 'python'">
                        <textarea x-model="pyCode" rows="7" class="w-full p-3 rounded-xl border border-emerald-950/65 bg-[#030d06] text-emerald-300 font-mono text-xs focus:ring-1 focus:ring-emerald-500 focus:outline-none"></textarea>
                    </div>
                    <div x-show="activeTab === 'web'">
                        <textarea x-model="webCode" rows="7" class="w-full p-3 rounded-xl border border-emerald-950/65 bg-[#030d06] text-emerald-300 font-mono text-xs focus:ring-1 focus:ring-emerald-500 focus:outline-none"></textarea>
                    </div>

                    <!-- Output Area -->
                    <div class="space-y-1.5">
                        <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">Output Console</span>
                        
                        <!-- Python output text -->
                        <div x-show="activeTab === 'python'" class="w-full h-36 bg-[#030d06] rounded-xl border border-emerald-950/50 p-3 overflow-y-auto text-xs font-mono text-emerald-400 whitespace-pre-wrap leading-relaxed">
                            <span x-text="pyOutput"></span>
                        </div>
                        
                        <!-- Web preview iframe -->
                        <div x-show="activeTab === 'web'" class="w-full h-36 bg-emerald-950/10 rounded-xl border border-emerald-950/35 overflow-hidden">
                            <iframe x-ref="lessonFrame" class="w-full h-full border-none"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
