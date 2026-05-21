<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- GFG Title Banner -->
        <div class="p-8 rounded-3xl bg-[#020a05] text-[#e8f5ed] relative overflow-hidden mb-12 border border-emerald-950/40">
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-2xl"></div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-400/20 text-xs font-semibold text-emerald-400 mb-4">
                Deep Tech & Code Library
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                <div>
                    <h1 class="heading-font text-3xl font-extrabold">Technical Library</h1>
                    <p class="text-slate-400 text-xs mt-2 max-w-xl">Search and study system design articles, algorithmic paradigms, code implementations, and software engineering structures.</p>
                </div>
                <!-- Search bar -->
                <form action="{{ route('articles.index') }}" method="GET" class="w-full md:w-80 flex gap-2">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('tag'))
                        <input type="hidden" name="tag" value="{{ request('tag') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search library..." class="w-full px-4 py-2.5 rounded-xl border border-emerald-950/60 bg-[#030d06] text-emerald-300 placeholder-slate-500 text-xs focus:ring-1 focus:ring-emerald-500 focus:outline-none">
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-555 text-white font-bold text-xs transition">Search</button>
                </form>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 gap-8">
            
            <!-- Left Sidebar Categories -->
            <div class="lg:col-span-3 space-y-6">
                <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 space-y-6 sticky top-20">
                    <h3 class="heading-font font-bold text-slate-900 dark:text-white pb-3 border-b border-slate-100 dark:border-emerald-950/20">Categories</h3>
                    <div class="space-y-1">
                        <a href="{{ route('articles.index') }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ !request('category') ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/20' : 'text-slate-650 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-emerald-950/10' }}">
                            All Articles
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('articles.index', ['category' => $cat->slug]) }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ request('category') === $cat->slug ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/20' : 'text-slate-650 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-emerald-950/10' }}">
                                {{ $cat->name }} ({{ $cat->articles_count }})
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Middle Columns: Article list (GFG list layout) -->
            <div class="lg:col-span-6 space-y-8">
                @if($articles->isEmpty())
                    <div class="text-center py-20 bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 rounded-3xl">
                        <i data-lucide="file-warning" class="w-12 h-12 text-slate-300 mx-auto"></i>
                        <h3 class="heading-font font-bold text-slate-900 dark:text-white mt-4">No Articles Found</h3>
                        <p class="text-xs text-slate-500 mt-2">Check another category or try a search.</p>
                    </div>
                @else
                    <div class="divide-y divide-slate-150 dark:divide-emerald-950/20">
                        @foreach($articles as $article)
                            <div class="py-6 first:pt-0 last:pb-0 group">
                                <div class="flex items-center gap-2 text-[10px] font-bold text-emerald-650 dark:text-emerald-400 uppercase tracking-wider">
                                    <span>{{ $article->category->name }}</span>
                                    <span class="text-slate-300 dark:text-emerald-950">&bull;</span>
                                    <span class="text-slate-450">{{ $article->created_at->format('M d, Y') }}</span>
                                </div>
                                <h2 class="heading-font font-bold text-lg text-slate-900 dark:text-white mt-2 group-hover:text-emerald-650 dark:group-hover:text-emerald-400 transition leading-snug">
                                    <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                                </h2>
                                <p class="text-xs text-slate-550 dark:text-slate-400 mt-2 line-clamp-2 leading-relaxed">
                                    {{ strip_tags($article->content) }}
                                </p>
                                
                                <div class="flex items-center justify-between mt-4">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ $article->author->avatar }}" alt="Author" class="w-6 h-6 rounded-full ring-2 ring-emerald-500/5">
                                        <span class="text-[11px] font-semibold text-slate-600 dark:text-slate-350">{{ $article->author->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-slate-400 text-[11px] font-medium">
                                        <span class="flex items-center gap-1"><i data-lucide="eye" class="w-3.5 h-3.5"></i> {{ $article->views_count }}</span>
                                        <span class="flex items-center gap-1"><i data-lucide="message-square" class="w-3.5 h-3.5"></i> {{ $article->comments->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pt-6 border-t border-slate-100 dark:border-emerald-950/20">
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>

            <!-- Right Sidebar: Interactive Content creation & Tags -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Submit an article card -->
                @auth
                    <div class="p-6 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white space-y-4 shadow-xl shadow-emerald-500/10" x-data="{ open: false }">
                        <i data-lucide="pen-tool" class="w-8 h-8 opacity-80"></i>
                        <h3 class="heading-font font-bold text-sm">Become an Author!</h3>
                        <p class="text-[11px] text-emerald-100 leading-normal">Write articles and document complex algorithms. Get approved by admins and earn 50 points per approved post!</p>
                        
                        <button @click="open = true" class="w-full py-2 rounded-xl bg-white text-emerald-600 hover:bg-slate-50 transition text-xs font-bold shadow-md">
                            Write Article
                        </button>

                        <!-- Alpine modal for article creation -->
                        <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm" x-cloak>
                            <div @click.away="open = false" class="w-full max-w-2xl p-8 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-[#041209] text-slate-800 dark:text-slate-100 space-y-4">
                                <div class="flex justify-between items-center pb-3 border-b border-slate-100 dark:border-emerald-950/20">
                                    <h3 class="heading-font font-bold text-base">Write Article</h3>
                                    <button @click="open = false" class="text-slate-400 hover:text-slate-650"><i data-lucide="x" class="w-5 h-5"></i></button>
                                </div>
                                <form action="{{ route('articles.store') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase block">Title</label>
                                        <input type="text" name="title" required placeholder="How to implement Red-Black Tree in C++" class="w-full p-2.5 rounded-xl border border-slate-200 dark:border-emerald-950/40 bg-slate-50 dark:bg-[#020a05] text-xs focus:ring-2 focus:ring-emerald-500 text-slate-700 dark:text-slate-300">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase block">Category</label>
                                        <select name="category_id" required class="w-full p-2.5 rounded-xl border border-slate-200 dark:border-emerald-950/40 bg-slate-50 dark:bg-[#020a05] text-xs focus:ring-2 focus:ring-emerald-500 text-slate-700 dark:text-slate-300">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[10px] font-bold text-slate-400 uppercase block">Content (Markdown supported)</label>
                                        <textarea name="content" required placeholder="Write article content using markdown syntax..." rows="8" class="w-full p-4 rounded-xl border border-slate-200 dark:border-emerald-950/40 bg-slate-50 dark:bg-[#020a05] text-xs font-mono focus:ring-2 focus:ring-emerald-500 text-slate-700 dark:text-slate-300"></textarea>
                                    </div>
                                    <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-550 transition text-white text-xs font-bold">
                                        Publish Article
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <!-- Popular tags list -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 space-y-4">
                    <h3 class="heading-font font-bold text-sm text-slate-900 dark:text-white">Popular Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tg)
                            <a href="{{ route('articles.index', ['tag' => $tg->slug]) }}" class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-slate-50 dark:bg-[#020a05] hover:bg-emerald-600 hover:text-white text-slate-500 dark:text-slate-450 transition">
                                #{{ $tg->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
