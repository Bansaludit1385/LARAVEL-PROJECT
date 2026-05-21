<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-6">
            <h1 class="heading-font text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">
                Search Results for: <span class="text-indigo-600 dark:text-indigo-400">"{{ $query }}"</span>
            </h1>

            <div class="grid lg:grid-cols-12 gap-12">
                <!-- Courses Column -->
                <div class="lg:col-span-6 space-y-6">
                    <h2 class="heading-font text-lg font-bold text-slate-800 dark:text-slate-200 pb-2 border-b border-slate-200 dark:border-slate-800 flex items-center gap-2">
                        <i data-lucide="book-open" class="w-5 h-5 text-indigo-500"></i>
                        Courses Found ({{ $courses->count() }})
                    </h2>
                    
                    @if($courses->isEmpty())
                        <p class="text-xs text-slate-500 dark:text-slate-400">No courses match your query.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($courses as $course)
                                <a href="{{ route('courses.show', $course->slug) }}" class="block p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:shadow-md transition">
                                    <span class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">{{ $course->level }}</span>
                                    <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white mt-1">{{ $course->title }}</h3>
                                    <p class="text-xs text-slate-550 dark:text-slate-400 line-clamp-2 mt-2 leading-relaxed">{{ $course->description }}</p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Articles Column -->
                <div class="lg:col-span-6 space-y-6">
                    <h2 class="heading-font text-lg font-bold text-slate-800 dark:text-slate-200 pb-2 border-b border-slate-200 dark:border-slate-800 flex items-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5 text-indigo-500"></i>
                        Articles Found ({{ $articles->count() }})
                    </h2>

                    @if($articles->isEmpty())
                        <p class="text-xs text-slate-500 dark:text-slate-400">No articles match your query.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($articles as $article)
                                <a href="{{ route('articles.show', $article->slug) }}" class="block p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:shadow-md transition">
                                    <span class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">{{ $article->category->name }}</span>
                                    <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white mt-1">{{ $article->title }}</h3>
                                    <p class="text-xs text-slate-550 dark:text-slate-400 line-clamp-2 mt-2 leading-relaxed">{{ strip_tags($article->content) }}</p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
