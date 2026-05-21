<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-12" 
         x-data="{ 
            timeLeft: {{ $quiz->time_limit_minutes * 60 }},
            formatTime(seconds) {
                const mins = Math.floor(seconds / 60);
                const secs = seconds % 60;
                return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
            }
         }" 
         x-init="setInterval(() => {
             if (timeLeft > 0) {
                 timeLeft--;
             } else {
                 $refs.quizForm.submit();
             }
         }, 1000)">
        
        <div class="space-y-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-8 rounded-3xl shadow-sm">
            <!-- Header with static/dynamic timer -->
            <div class="flex justify-between items-center pb-4 border-b border-slate-100 dark:border-slate-800">
                <div>
                    <span class="text-[10px] text-slate-450 uppercase font-bold tracking-widest">Assessment Player</span>
                    <h1 class="heading-font text-xl font-bold text-slate-900 dark:text-white mt-1">{{ $quiz->title }}</h1>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-600 font-extrabold text-xs">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    <span x-text="formatTime(timeLeft)"></span>
                </div>
            </div>

            <!-- Form -->
            <form x-ref="quizForm" action="{{ route('quizzes.submit', $quiz->id) }}" method="POST" class="space-y-8">
                @csrf
                @foreach($quiz->questions as $index => $q)
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold text-[11px] flex items-center justify-center shrink-0">
                                {{ $index + 1 }}
                            </span>
                            <h3 class="heading-font font-bold text-slate-900 dark:text-white text-sm pt-0.5 leading-snug">
                                {{ $q->question_text }}
                            </h3>
                        </div>

                        <!-- Options checkboxes -->
                        <div class="grid gap-3 pl-9">
                            @foreach($q->options as $optIndex => $option)
                                <label class="flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-850 cursor-pointer transition">
                                    <input type="radio" name="answers[{{ $q->id }}]" value="{{ $optIndex }}" required class="w-4 h-4 text-indigo-600 border-slate-300 focus:ring-indigo-500 dark:bg-slate-950 dark:border-slate-850">
                                    <span class="text-xs text-slate-700 dark:text-slate-250 font-medium">{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="pt-4">
                    <button type="submit" class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-550 transition font-bold text-xs text-white shadow-lg shadow-indigo-500/20">
                        Submit Final Answers
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
