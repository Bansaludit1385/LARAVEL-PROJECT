<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-10">
            <!-- Title -->
            <div>
                <h1 class="heading-font text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Admin Control Panel</h1>
                <p class="text-xs text-slate-500 mt-1">Manage global user accounts, moderate submitted code articles, and review core stats metrics.</p>
            </div>

            <!-- Stats grid -->
            <div class="grid sm:grid-cols-3 gap-6">
                <!-- User account counter -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Registered Accounts</span>
                        <span class="heading-font text-2xl font-black text-slate-900 dark:text-white">{{ $totalUsers }}</span>
                    </div>
                </div>
                <!-- Course Counter -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                        <i data-lucide="book-open" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Active Courses</span>
                        <span class="heading-font text-2xl font-black text-slate-900 dark:text-white">{{ $totalCourses }}</span>
                    </div>
                </div>
                <!-- Article Counter -->
                <div class="p-6 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Total Articles</span>
                        <span class="heading-font text-2xl font-black text-slate-900 dark:text-white">{{ $totalArticles }}</span>
                    </div>
                </div>
            </div>

            <!-- GFG Articles awaiting moderation -->
            <div class="space-y-4">
                <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white">Pending Articles Moderation Queue</h3>
                
                @if($pendingArticles->isEmpty())
                    <p class="text-xs text-slate-505 p-6 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-emerald-950/20">No pending articles awaiting review.</p>
                @else
                    <div class="space-y-3">
                        @foreach($pendingArticles as $art)
                            <div class="p-5 rounded-2xl bg-white dark:bg-[#030d06] border border-slate-200 dark:border-emerald-950/40 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div>
                                    <h4 class="font-bold text-xs text-slate-900 dark:text-white">{{ $art->title }}</h4>
                                    <span class="text-[10px] text-slate-400 font-semibold block">Author: {{ $art->author->name }} &bull; {{ $art->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('articles.show', $art->slug) }}" target="_blank" class="px-3.5 py-1.5 rounded-lg border border-slate-200 dark:border-slate-800 text-xs font-semibold text-slate-600 dark:text-slate-350 hover:bg-slate-50 dark:hover:bg-slate-850">Review Content</a>
                                    <form action="{{ route('admin.approve-article', $art->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-555 transition text-white text-xs font-bold shadow-md shadow-emerald-500/10">Approve & Publish</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- User administration -->
            <div class="space-y-4">
                <h3 class="heading-font font-bold text-base text-slate-900 dark:text-white">Registered User Directory</h3>
                
                <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-emerald-950/40 bg-white dark:bg-[#030d06]">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-950 text-slate-400 font-bold border-b border-slate-200 dark:border-emerald-950/20 uppercase tracking-wider">
                                <th class="p-4">Name</th>
                                <th class="p-4">Email</th>
                                <th class="p-4">Current Role</th>
                                <th class="p-4">Points</th>
                                <th class="p-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-emerald-950/20 text-slate-700 dark:text-slate-250">
                            @foreach($users as $usr)
                                <tr>
                                    <td class="p-4 font-semibold text-slate-900 dark:text-white">{{ $usr->name }}</td>
                                    <td class="p-4">{{ $usr->email }}</td>
                                    <td class="p-4">
                                        <span class="px-2 py-0.5 rounded-md font-bold text-[10px] capitalize bg-emerald-50/50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400">{{ $usr->role }}</span>
                                    </td>
                                    <td class="p-4 font-bold">{{ $usr->points }} pts</td>
                                    <td class="p-4 text-right">
                                        <form action="{{ route('admin.users.role', $usr->id) }}" method="POST" class="inline-flex gap-2 items-center">
                                            @csrf
                                            <select name="role" onchange="this.form.submit()" class="p-1 rounded bg-slate-50 dark:bg-slate-955 border border-slate-200 dark:border-slate-800 text-[10px] font-semibold text-slate-700 dark:text-slate-250 focus:ring-1 focus:ring-emerald-500">
                                                <option value="student" {{ $usr->role === 'student' ? 'selected' : '' }}>Student</option>
                                                <option value="instructor" {{ $usr->role === 'instructor' ? 'selected' : '' }}>Instructor</option>
                                                <option value="admin" {{ $usr->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
