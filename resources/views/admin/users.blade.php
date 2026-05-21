<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-8" x-data="{ activeTab: 'users' }">
            <!-- Breadcrumbs / Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="heading-font text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                        <i data-lucide="shield-alert" class="text-emerald-600 dark:text-emerald-400"></i>
                        Admin Control Panel
                    </h1>
                    <p class="text-xs text-slate-500 mt-1">Manage global user accounts, review demographics, and monitor submitted contact form inquiries.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-semibold border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-350 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-850 transition">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to Control Panel
                </a>
            </div>

            <!-- Toast Notifications -->
            @if (session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-250 dark:border-emerald-900/50 text-emerald-800 dark:text-emerald-300 text-xs font-semibold flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 dark:text-emerald-450"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-955 border border-rose-250 dark:border-rose-900/50 text-rose-800 dark:text-rose-400 text-xs font-semibold flex items-center gap-2">
                    <i data-lucide="alert-octagon" class="w-4 h-4 text-rose-600 dark:text-rose-455"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Mini Stats Row -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 font-bold block uppercase tracking-wider">Total Accounts</span>
                        <span class="heading-font text-lg font-black text-slate-900 dark:text-white">{{ $totalUsers }}</span>
                    </div>
                </div>
                <div class="p-4 rounded-xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shrink-0">
                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 font-bold block uppercase tracking-wider">Students</span>
                        <span class="heading-font text-lg font-black text-slate-900 dark:text-white">{{ $studentCount }}</span>
                    </div>
                </div>
                <div class="p-4 rounded-xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-sky-500/10 text-sky-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                        <i data-lucide="award" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 font-bold block uppercase tracking-wider">Instructors</span>
                        <span class="heading-font text-lg font-black text-slate-900 dark:text-white">{{ $instructorCount }}</span>
                    </div>
                </div>
                <div class="p-4 rounded-xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                        <i data-lucide="message-square" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 font-bold block uppercase tracking-wider">Support Messages</span>
                        <span class="heading-font text-lg font-black text-slate-900 dark:text-white">{{ $supportMessages->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="flex border-b border-slate-200 dark:border-emerald-950/40">
                <button @click="activeTab = 'users'" :class="activeTab === 'users' ? 'border-b-2 border-emerald-600 dark:border-emerald-400 text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-350'" class="px-6 py-3 text-xs font-bold uppercase tracking-wider transition">
                    Registered Users Directory
                </button>
                <button @click="activeTab = 'support'" :class="activeTab === 'support' ? 'border-b-2 border-emerald-600 dark:border-emerald-400 text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-350'" class="px-6 py-3 text-xs font-bold uppercase tracking-wider transition flex items-center gap-2">
                    Support Messages ({{ $supportMessages->count() }})
                </button>
            </div>

            <!-- TAB 1: Registered Users Directory -->
            <div x-show="activeTab === 'users'" class="space-y-6">
                <!-- Search Filter Card -->
                <div class="p-4 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm">
                    <form action="{{ route('admin.users') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-grow">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, gender, or role..." class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/60 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 text-slate-700 dark:text-slate-350">
                            <div class="absolute left-3.5 top-2.5 text-slate-400">
                                <i data-lucide="search" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-555 text-white rounded-xl text-xs font-bold transition shadow-md shadow-emerald-500/10 shrink-0">
                                Apply Filter
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.users') }}" class="px-5 py-2 border border-slate-250 dark:border-slate-850 text-slate-600 dark:text-slate-350 rounded-xl text-xs font-bold transition hover:bg-slate-50 dark:hover:bg-slate-900 shrink-0 flex items-center justify-center">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Table Card -->
                <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-emerald-950/40 bg-white dark:bg-[#030d06] shadow-sm">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-950 text-slate-400 font-bold border-b border-slate-200 dark:border-emerald-950/20 uppercase tracking-wider">
                                <th class="p-4">User Details</th>
                                <th class="p-4">Demographics</th>
                                <th class="p-4">System Stats</th>
                                <th class="p-4">Role & Authority</th>
                                <th class="p-4 text-center">Points</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-emerald-950/20 text-slate-700 dark:text-slate-250">
                            @forelse($users as $usr)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors">
                                    <!-- User Details (Avatar, Name, Email, Joined) -->
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-emerald-500/20 bg-white dark:bg-slate-800 p-0.5 shrink-0">
                                                <img src="{{ $usr->avatar ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed='.urlencode($usr->name) }}" alt="Avatar" class="w-full h-full object-cover rounded-full">
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900 dark:text-white">{{ $usr->name }}</div>
                                                <div class="text-[10px] text-slate-450 font-medium">{{ $usr->email }}</div>
                                                <div class="text-[9px] text-slate-400 font-semibold block mt-0.5">Joined: {{ $usr->created_at->format('M d, Y') }} ({{ $usr->created_at->diffForHumans() }})</div>
                                            </div>
                                        </div>
                                        @if($usr->bio)
                                            <p class="text-[10px] text-slate-450 italic mt-1.5 line-clamp-1 max-w-xs">{{ $usr->bio }}</p>
                                        @endif
                                    </td>

                                    <!-- Demographics (Gender & Age) -->
                                    <td class="p-4 font-medium">
                                        <div class="space-y-0.5">
                                            <div class="flex items-center gap-1">
                                                @if(strtolower($usr->gender) === 'male')
                                                    <i data-lucide="gender-male" class="w-3.5 h-3.5 text-sky-500"></i>
                                                @elseif(strtolower($usr->gender) === 'female')
                                                    <i data-lucide="gender-female" class="w-3.5 h-3.5 text-pink-500"></i>
                                                @else
                                                    <i data-lucide="circle-dot" class="w-3.5 h-3.5 text-slate-450"></i>
                                                @endif
                                                <span class="capitalize text-slate-900 dark:text-white">{{ $usr->gender }}</span>
                                            </div>
                                            <div class="text-[10px] text-slate-400 font-semibold">{{ $usr->age }} years old</div>
                                        </div>
                                    </td>

                                    <!-- System Stats -->
                                    <td class="p-4 font-semibold text-slate-600 dark:text-slate-350">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-1.5 text-[10px]">
                                                <i data-lucide="book-open" class="w-3 h-3 text-slate-400"></i>
                                                <span>{{ $usr->enrolled_courses_count }} Course Enrolled</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 text-[10px]">
                                                <i data-lucide="play-circle" class="w-3 h-3 text-slate-400"></i>
                                                <span>{{ $usr->completed_lessons_count }} Lessons Done</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 text-[10px]">
                                                <i data-lucide="check-square" class="w-3 h-3 text-slate-400"></i>
                                                <span>{{ $usr->quiz_attempts_count }} Quizzes Taken</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Role & Authority -->
                                    <td class="p-4">
                                        <form action="{{ route('admin.users.role', $usr->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <select name="role" onchange="this.form.submit()" class="px-2 py-1 rounded bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-[10px] font-bold text-slate-700 dark:text-slate-250 focus:ring-1 focus:ring-emerald-500">
                                                <option value="student" {{ $usr->role === 'student' ? 'selected' : '' }}>Student</option>
                                                <option value="instructor" {{ $usr->role === 'instructor' ? 'selected' : '' }}>Instructor</option>
                                                <option value="admin" {{ $usr->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </form>
                                        <div class="mt-1">
                                            @if($usr->role === 'admin')
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[8px] font-extrabold uppercase bg-amber-50 dark:bg-amber-950/20 text-amber-600 dark:text-amber-400">Full Access</span>
                                            @elseif($usr->role === 'instructor')
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[8px] font-extrabold uppercase bg-sky-50 dark:bg-sky-950/20 text-sky-600 dark:text-sky-455">Content Creator</span>
                                            @else
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[8px] font-extrabold uppercase bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400">Student</span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Points -->
                                    <td class="p-4 text-center">
                                        <span class="px-2.5 py-1 rounded-full font-black text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/20">
                                            {{ $usr->points }} XP
                                        </span>
                                    </td>

                                    <!-- Actions (Delete user option) -->
                                    <td class="p-4 text-right">
                                        @if($usr->id !== Auth::id())
                                            <form action="{{ route('admin.users.delete', $usr->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure you want to permanently delete this user account ({{ $usr->name }})? This action is irreversible!')" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-rose-500 hover:text-rose-700 hover:bg-rose-50 dark:hover:bg-rose-955 rounded-lg transition" title="Delete User">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[9px] text-slate-400 italic font-semibold">You (Current Admin)</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-slate-400 italic">
                                        No registered users match your search criteria.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="pt-4">
                    {{ $users->links() }}
                </div>
            </div>

            <!-- TAB 2: Support Messages / Tickets -->
            <div x-show="activeTab === 'support'" class="space-y-6" style="display: none;">
                <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-emerald-950/40 bg-white dark:bg-[#030d06] shadow-sm">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-950 text-slate-400 font-bold border-b border-slate-200 dark:border-emerald-950/20 uppercase tracking-wider">
                                <th class="p-4 w-1/4">Sender Details</th>
                                <th class="p-4 w-1/2">Message Content</th>
                                <th class="p-4 w-1/6">Date Submitted</th>
                                <th class="p-4 text-right w-1/12">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-emerald-950/20 text-slate-700 dark:text-slate-250">
                            @forelse($supportMessages as $msg)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors">
                                    <td class="p-4">
                                        <div class="font-bold text-slate-900 dark:text-white">{{ $msg->name }}</div>
                                        <div class="text-[10px] text-slate-450 font-medium">{{ $msg->email }}</div>
                                    </td>
                                    <td class="p-4 whitespace-pre-wrap leading-relaxed text-slate-650 dark:text-slate-350">{{ $msg->message }}</td>
                                    <td class="p-4">
                                        <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $msg->created_at->format('M d, Y H:i') }}</span>
                                        <span class="block text-[9px] font-bold text-emerald-600 dark:text-emerald-450 mt-0.5">{{ $msg->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <form action="{{ route('admin.support.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this support inquiry?')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-rose-500 hover:text-rose-700 hover:bg-rose-50 dark:hover:bg-rose-955 rounded-lg transition" title="Delete Inquiry">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-slate-400 italic">
                                        No support messages have been received.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
