<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="space-y-8">
            <!-- Header -->
            <div class="border-b border-emerald-950/20 pb-4">
                <h1 class="heading-font text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Secure Checkout Gateway</h1>
                <p class="text-xs text-slate-500 mt-1">Complete your registration to CodeSpire premium learning tracks.</p>
            </div>

            <!-- Grid -->
            <div class="grid md:grid-cols-12 gap-8 items-start">
                
                <!-- Billing Form -->
                <div class="md:col-span-7 p-6 sm:p-8 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-6">
                    <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="credit-card" class="w-5 h-5 text-emerald-500"></i>
                        Card Information
                    </h3>

                    @if ($errors->any())
                        <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-xs font-semibold text-rose-600 dark:text-rose-400">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>&bull; {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('courses.checkout.process', $course->slug) }}" method="POST" class="space-y-4" x-data="{ processing: false, submitForm() { this.processing = true; $el.submit(); } }" @submit.prevent="submitForm()">
                        @csrf
                        
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase">Cardholder Name</label>
                            <input type="text" name="card_name" required value="{{ Auth::user()->name }}" class="w-full p-2.5 rounded-xl border border-slate-200 dark:border-emerald-950/30 bg-slate-50 dark:bg-[#020a05] text-xs text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-slate-400 uppercase">Card Number</label>
                            <div class="relative">
                                <input type="text" name="card_number" required placeholder="4111 2222 3333 4444" minlength="16" maxlength="19" class="w-full p-2.5 pl-10 rounded-xl border border-slate-200 dark:border-emerald-950/30 bg-slate-50 dark:bg-[#020a05] text-xs text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                                <div class="absolute left-3 top-3 text-slate-400">
                                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">Expiration (MM/YY)</label>
                                <input type="text" name="card_expiry" required placeholder="12/28" class="w-full p-2.5 rounded-xl border border-slate-200 dark:border-emerald-950/30 bg-slate-50 dark:bg-[#020a05] text-xs text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase">CVV</label>
                                <input type="password" name="card_cvv" required placeholder="123" maxlength="3" class="w-full p-2.5 rounded-xl border border-slate-200 dark:border-emerald-950/30 bg-slate-50 dark:bg-[#020a05] text-xs text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition">
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-[#020a05] border border-slate-100 dark:border-emerald-950/20 text-[10px] text-slate-400 space-y-1">
                            <p class="font-bold text-slate-500">MOCK PAYMENT SANDBOX:</p>
                            <p>You can use any valid card details and mock credentials. Card number must have at least 16 digits, and CVV must have 3 digits.</p>
                        </div>

                        <button type="submit" :disabled="processing" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-555 transition font-bold text-xs text-white shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2">
                            <template x-if="processing">
                                <span class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing secure payment...
                                </span>
                            </template>
                            <template x-if="!processing">
                                <span class="flex items-center gap-2">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                    Authorize Charge of ${{ number_format($course->price, 2) }}
                                </span>
                            </template>
                        </button>
                    </form>
                </div>

                <!-- Course Summary Card -->
                <div class="md:col-span-5 space-y-6">
                    <div class="p-6 rounded-3xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm space-y-4">
                        <h3 class="heading-font font-bold text-xs uppercase tracking-wider text-slate-400">Order Summary</h3>
                        
                        <div class="flex items-center gap-3">
                            <img src="{{ $course->thumbnail }}" class="w-16 h-12 rounded-xl object-cover" alt="">
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 dark:text-white leading-tight line-clamp-2">{{ $course->title }}</h4>
                                <span class="text-[10px] text-emerald-600 dark:text-emerald-400 font-bold block capitalize mt-0.5">{{ $course->level }} Level</span>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 dark:border-emerald-950/20 pt-4 space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-450">Syllabus Access</span>
                                <span class="font-semibold text-slate-800 dark:text-slate-200">Lifetime</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-450">Certificate Allocation</span>
                                <span class="font-semibold text-slate-800 dark:text-slate-200">Included</span>
                            </div>
                            <div class="flex justify-between border-t border-dashed border-slate-200 dark:border-emerald-950/20 pt-2 font-bold text-sm">
                                <span class="text-slate-900 dark:text-white">Amount Due</span>
                                <span class="text-emerald-600 dark:text-emerald-400">${{ number_format($course->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
