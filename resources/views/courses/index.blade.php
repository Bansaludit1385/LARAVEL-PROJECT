<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-8">
            <!-- Breadcrumbs / Top Banner -->
            <div class="p-8 rounded-3xl bg-[#020a05] text-[#e8f5ed] relative overflow-hidden border border-emerald-950/40">
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-2xl"></div>
                <h1 class="heading-font text-3xl font-extrabold">Learning Paths & Courses</h1>
                <p class="text-emerald-300 text-sm mt-2 max-w-xl">Explore fully structured academic curricula. Complete video lessons, read comprehensive notes, pass timed quizzes, and earn verifiable certificates.</p>
            </div>

            <!-- Directory Grid -->
            <div class="grid lg:grid-cols-12 gap-8">
                
                <!-- Left Sidebar Filters -->
                <div class="lg:col-span-3 space-y-6">
                    <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 space-y-6 sticky top-20">
                        <h3 class="heading-font font-bold text-slate-900 dark:text-white pb-3 border-b border-slate-100 dark:border-emerald-950/20">Filters</h3>

                        <!-- Categories -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Categories</label>
                            <div class="space-y-1">
                                <a href="{{ route('courses.index') }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ !request('category') ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/20' : 'text-slate-650 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-emerald-950/10' }}">
                                    All Courses
                                </a>
                                @foreach($categories as $cat)
                                    <a href="{{ route('courses.index', ['category' => $cat->slug]) }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ request('category') === $cat->slug ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/20' : 'text-slate-650 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-emerald-950/10' }}">
                                        {{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Languages & Tools -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Languages & Tools</label>
                            <div class="flex flex-wrap gap-1.5">
                                <a href="{{ route('courses.index') }}" class="inline-block px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider transition {{ !request('tag') ? 'bg-emerald-600 text-white' : 'bg-slate-50 dark:bg-emerald-950/10 text-slate-600 dark:text-slate-350 hover:bg-slate-100 dark:hover:bg-emerald-950/20' }}">
                                    All
                                </a>
                                @foreach($tags as $t)
                                    <a href="{{ route('courses.index', ['tag' => $t->slug]) }}" class="inline-block px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider transition {{ request('tag') === $t->slug ? 'bg-emerald-600 text-white' : 'bg-slate-50 dark:bg-emerald-950/10 text-slate-600 dark:text-slate-350 hover:bg-slate-100 dark:hover:bg-emerald-950/20' }}">
                                        {{ $t->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Levels -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Difficulties</label>
                            <div class="space-y-1">
                                <a href="{{ route('courses.index', ['level' => 'beginner']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ request('level') === 'beginner' ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/20' : 'text-slate-655 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-emerald-950/10' }}">
                                    Beginner
                                </a>
                                <a href="{{ route('courses.index', ['level' => 'intermediate']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ request('level') === 'intermediate' ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/20' : 'text-slate-655 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-emerald-950/10' }}">
                                    Intermediate
                                </a>
                                <a href="{{ route('courses.index', ['level' => 'advanced']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ request('level') === 'advanced' ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/20' : 'text-slate-655 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-emerald-950/10' }}">
                                    Advanced
                                </a>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Price Plans</label>
                            <div class="space-y-1">
                                <a href="{{ route('courses.index', ['price' => 'free']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ request('price') === 'free' ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/20' : 'text-slate-655 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-emerald-950/10' }}">
                                    Free
                                </a>
                                <a href="{{ route('courses.index', ['price' => 'paid']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold {{ request('price') === 'paid' ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-950/20' : 'text-slate-655 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-emerald-950/10' }}">
                                    Premium Paid
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Grid Cards -->
                <div class="lg:col-span-9 space-y-8">
                    @if($courses->isEmpty())
                        <div class="text-center py-20 bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 rounded-3xl">
                            <i data-lucide="folder-open" class="w-12 h-12 text-slate-300 mx-auto"></i>
                            <h3 class="heading-font font-bold text-slate-900 dark:text-white mt-4">No Courses Available</h3>
                            <p class="text-xs text-slate-500 mt-2">Adjust your filters to see more listings.</p>
                        </div>
                    @else
                        <div class="grid sm:grid-cols-2 gap-6">
                            @foreach($courses as $course)
                                <div class="group flex flex-col rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200/60 dark:border-emerald-950/40 shadow-sm overflow-hidden hover:shadow-xl transition duration-300">
                                    <div class="relative h-44 overflow-hidden bg-slate-100">
                                        <img src="{{ $course->thumbnail ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=600' }}" alt="Course Cover" class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
                                        
                                        @if($course->level === 'beginner')
                                            <span class="absolute top-4 right-4 px-2.5 py-1 rounded-lg text-[10px] font-bold tracking-wide uppercase text-white bg-emerald-600/90 backdrop-blur-md">
                                                Beginner
                                            </span>
                                        @elseif($course->level === 'intermediate')
                                            <span class="absolute top-4 right-4 px-2.5 py-1 rounded-lg text-[10px] font-bold tracking-wide uppercase text-white bg-amber-600/90 backdrop-blur-md">
                                                Intermediate
                                            </span>
                                        @else
                                            <span class="absolute top-4 right-4 px-2.5 py-1 rounded-lg text-[10px] font-bold tracking-wide uppercase text-white bg-rose-600/90 backdrop-blur-md">
                                                Advanced
                                            </span>
                                        @endif
                                    </div>
                                    <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                                        <div class="space-y-2">
                                            <div class="flex items-center justify-between">
                                                <span class="text-[10px] font-extrabold text-emerald-650 dark:text-emerald-400 uppercase tracking-wider">{{ $course->category->name }}</span>
                                            </div>
                                            <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition leading-snug">
                                                <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                            </h3>
                                            <div class="flex flex-wrap gap-1 py-1">
                                                @foreach($course->tags as $t)
                                                    <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider bg-slate-50 dark:bg-emerald-950/20 text-slate-500 dark:text-emerald-350 border border-slate-100 dark:border-emerald-950/40">
                                                        {{ $t->name }}
                                                    </span>
                                                @endforeach
                                            </div>
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

                        <!-- Pagination Links -->
                        <div class="pt-6">
                            {{ $courses->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
