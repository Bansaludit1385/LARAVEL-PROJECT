<x-app-layout>
    <div class="max-w-xl mx-auto px-4 py-16">
        <div class="p-8 sm:p-10 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-6">
            
            <div class="space-y-2">
                <h1 class="heading-font text-2xl font-extrabold text-slate-900 dark:text-white">Contact CodeSpire Support</h1>
                <p class="text-xs text-slate-500">Reach out to our global technical support, academic partners, or admin team.</p>
            </div>

            <!-- Session success banner -->
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase">Your Name</label>
                    <input type="text" name="name" required placeholder="Sam Student" class="w-full p-2.5 rounded-xl border border-slate-200 dark:border-emerald-950/30 bg-slate-50 dark:bg-[#020a05] text-xs text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase">Email Address</label>
                    <input type="email" name="email" required placeholder="sam@example.com" class="w-full p-2.5 rounded-xl border border-slate-200 dark:border-emerald-950/30 bg-slate-50 dark:bg-[#020a05] text-xs text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase">Message</label>
                    <textarea name="message" required placeholder="Write your support inquiry here..." rows="4" class="w-full p-4 rounded-xl border border-slate-200 dark:border-emerald-950/30 bg-slate-50 dark:bg-[#020a05] text-xs text-slate-700 dark:text-slate-350 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition"></textarea>
                </div>
                <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-555 transition font-bold text-xs text-white shadow-lg shadow-emerald-500/20">
                    Dispatch Message
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
