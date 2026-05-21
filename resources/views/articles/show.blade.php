<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-12 gap-12">
            
            <!-- Left Panel: Article Body & Comments -->
            <div class="lg:col-span-8 space-y-10">
                
                <!-- Article Header Meta -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2 text-[10px] font-bold text-emerald-650 dark:text-emerald-400 uppercase tracking-wider">
                        <span>{{ $article->category->name }}</span>
                        <span class="text-slate-350 dark:text-emerald-950">&bull;</span>
                        <span>{{ $article->created_at->format('M d, Y') }}</span>
                    </div>

                    <h1 class="heading-font text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white leading-tight">
                        {{ $article->title }}
                    </h1>

                    <div class="flex items-center justify-between py-4 border-y border-slate-100 dark:border-emerald-950/20 text-xs">
                        <div class="flex items-center gap-2.5">
                            <img src="{{ $article->author->avatar }}" alt="Author Avatar" class="w-9 h-9 rounded-xl">
                            <div>
                                <p class="font-bold text-slate-900 dark:text-white">{{ $article->author->name }}</p>
                                <p class="text-[10px] text-slate-400 font-semibold capitalize">{{ $article->author->role }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 text-slate-400 font-medium">
                            <span class="flex items-center gap-1"><i data-lucide="eye" class="w-4 h-4"></i> {{ $article->views_count }} views</span>
                            
                            <div class="flex items-center gap-2">
                                <!-- Share button -->
                                <div x-data="{ copied: false }">
                                    <button @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-emerald-950/40 hover:bg-slate-50 dark:hover:bg-[#030d06] text-xs font-bold text-slate-650 dark:text-slate-350 transition">
                                        <i data-lucide="share-2" class="w-3.5 h-3.5" :class="copied ? 'text-emerald-500' : ''"></i>
                                        <span x-text="copied ? 'Copied!' : 'Share'"></span>
                                    </button>
                                </div>

                                <!-- Bookmark button -->
                                @auth
                                    <form action="{{ route('bookmarks.toggle') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="type" value="App\Models\Article">
                                        <input type="hidden" name="id" value="{{ $article->id }}">
                                        <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-emerald-950/40 hover:bg-slate-50 dark:hover:bg-[#030d06] text-xs font-bold transition">
                                            @if(Auth::user()->bookmarks()->where('bookmarkable_type', 'App\Models\Article')->where('bookmarkable_id', $article->id)->exists())
                                                <i data-lucide="bookmark" class="w-4 h-4 fill-emerald-500 text-emerald-500"></i>
                                                <span class="text-emerald-600 dark:text-emerald-400">Bookmarked</span>
                                            @else
                                                <i data-lucide="bookmark" class="w-4 h-4"></i>
                                                <span>Save</span>
                                            @endif
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Markdown Content Render Pane -->
                <div class="prose prose-slate dark:prose-invert max-w-none text-slate-700 dark:text-slate-250 leading-relaxed text-sm space-y-4">
                    {!! Str::markdown($article->content ?? '') !!}
                </div>

                <!-- Interactive Comment Form & Feed -->
                <div class="space-y-6 pt-10 border-t border-slate-100 dark:border-emerald-950/20">
                    <h3 class="heading-font font-bold text-lg text-slate-900 dark:text-white">Discussion & Comments ({{ $article->comments->count() }})</h3>
                    
                    @auth
                        <form action="{{ route('comments.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="hidden" name="commentable_type" value="App\Models\Article">
                            <input type="hidden" name="commentable_id" value="{{ $article->id }}">
                            
                            <textarea name="content" required placeholder="Contribute to this article by sharing code insights or questions..." rows="4" class="w-full p-4 rounded-2xl border border-slate-200 dark:border-emerald-950/40 bg-slate-50 dark:bg-[#020a05] text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition text-slate-700 dark:text-slate-350"></textarea>
                            
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-555 transition text-white text-xs font-bold shadow-md shadow-emerald-500/10">
                                Post Comment
                            </button>
                        </form>
                    @else
                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-emerald-950/5 text-center text-xs text-slate-500">
                            Please <a href="{{ route('login') }}" class="text-emerald-600 dark:text-emerald-400 font-bold hover:underline">sign in</a> to post comments.
                        </div>
                    @endauth

                    <div class="space-y-4 mt-6">
                        @if($article->comments->isEmpty())
                            <p class="text-xs text-slate-500 dark:text-slate-400">No comments posted yet. Start the conversation!</p>
                        @else
                            @foreach($article->comments as $comment)
                                <div class="p-5 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 flex gap-4">
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

            <!-- Right Sidebar: Author Biography & Actions -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Author block -->
                <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 space-y-4">
                    <h3 class="heading-font font-bold text-sm text-slate-900 dark:text-white">Author Profile</h3>
                    <div class="flex items-center gap-3">
                        <img src="{{ $article->author->avatar }}" alt="Avatar" class="w-12 h-12 rounded-xl object-cover ring-2 ring-emerald-500/10">
                        <div>
                            <h4 class="font-bold text-sm text-slate-900 dark:text-white">{{ $article->author->name }}</h4>
                            <span class="text-[10px] text-emerald-650 font-semibold uppercase tracking-wider capitalize">{{ $article->author->role }}</span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-550 dark:text-slate-400 leading-relaxed">{{ $article->author->bio }}</p>
                    <div class="pt-2 flex justify-between items-center text-xs">
                        <span class="text-slate-450">Author Points</span>
                        <span class="font-black text-emerald-600">{{ $article->author->points }} pts</span>
                    </div>
                </div>

                <!-- Premium code visual highlights panel -->
                <div class="p-6 rounded-3xl bg-[#020a05] text-[#e8f5ed] border border-emerald-950/60 shadow-xl space-y-4">
                    <div class="flex items-center gap-2 text-emerald-400">
                        <i data-lucide="code-2" class="w-5 h-5"></i>
                        <h4 class="font-bold text-xs uppercase tracking-wider">Syntax Highlighter</h4>
                    </div>
                    <p class="text-[10px] text-slate-400 leading-relaxed">This portal supports high-precision, theme-colored code blocks highlighting for PHP, Python, C++, Java, and Bash.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
