<x-app-layout>
    <div class="max-w-xl mx-auto px-4 py-16">
        <div class="p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm text-center space-y-6">
            
            <div class="w-16 h-16 rounded-2xl mx-auto flex items-center justify-center shrink-0 {{ $attempt->passed ? 'bg-emerald-500/10 text-emerald-500' : 'bg-rose-500/10 text-rose-500' }}">
                @if($attempt->passed)
                    <i data-lucide="check-circle" class="w-10 h-10"></i>
                @else
                    <i data-lucide="alert-circle" class="w-10 h-10"></i>
                @endif
            </div>

            <div class="space-y-2">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Assessment Completed</span>
                <h1 class="heading-font text-2xl font-black text-slate-900 dark:text-white">
                    @if($attempt->passed)
                        Congratulations! You Passed!
                    @else
                        Syllabus Assessment Failed
                    @endif
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 max-w-sm mx-auto">
                    @if($attempt->passed)
                        Excellent score! You have successfully mastered this assessment topic. Your official certificate is unlocked in your dashboard.
                    @else
                        You scored below the passing rate of {{ $attempt->quiz->pass_percentage }}%. Review the lecture notes and try again!
                    @endif
                </p>
            </div>

            <!-- Score badge -->
            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950 inline-block font-mono text-center">
                <span class="text-[10px] text-slate-400 block uppercase font-bold tracking-wider">Your Score</span>
                <span class="text-2xl font-extrabold {{ $attempt->passed ? 'text-emerald-500' : 'text-rose-500' }}">{{ number_format($attempt->score, 1) }}%</span>
            </div>

            <div class="pt-4 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('dashboard') }}" class="w-full py-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 dark:bg-slate-850 dark:hover:bg-slate-800 text-xs font-bold text-slate-700 dark:text-slate-200 transition">
                    Return to Dashboard
                </a>
                @if(!$attempt->passed)
                    <a href="{{ route('quizzes.show', $attempt->quiz->slug) }}" class="w-full py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-550 text-xs font-bold text-white transition shadow-lg shadow-indigo-500/10">
                        Try Again
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
