<x-layouts.main-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb & Actions Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                <a href="{{ route('dashboard.projects.show', $project) }}" class="hover:text-brand-600 transition-colors">{{ $project->title }}</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <a href="{{ route('dashboard.projects.tasks.index', $project) }}" class="hover:text-brand-600 transition-colors">Tasks</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-slate-700 font-semibold">Task #{{ $task->id }}</span>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard.projects.tasks.edit', [$project, $task]) }}"
                   class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-all flex items-center gap-1.5 border border-slate-200">
                    <span class="material-symbols-outlined text-[16px]">edit</span>
                    Edit Task
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left 2 Cols: Main Task Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Main Task Detail Card -->
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-soft-sm p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded">
                            #{{ $task->id }}
                        </span>
                        <div class="flex items-center gap-2">
                            @if($task->status === 'done')
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold text-xs uppercase">Done</span>
                            @elseif($task->status === 'in_progress')
                                <span class="px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200 font-bold text-xs uppercase">In Progress</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200 font-bold text-xs uppercase">Todo</span>
                            @endif
                        </div>
                    </div>

                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                        {{ $task->title }}
                    </h1>

                    @if($task->cover_image)
                        <div class="overflow-hidden rounded-xl border border-slate-200 max-h-64 bg-slate-50">
                            <img src="{{ asset('storage/' . $task->cover_image) }}" alt="Task Cover" class="w-full h-auto object-cover max-h-64">
                        </div>
                    @endif

                    <div>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Description</h3>
                        @if($task->description)
                            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed bg-slate-50/70 p-4 rounded-xl border border-slate-200/60 whitespace-pre-line">
                                {{ $task->description }}
                            </div>
                        @else
                            <p class="text-xs text-slate-400 italic">No description provided for this task.</p>
                        @endif
                    </div>
                </div>

                <!-- Task Activity History Timeline -->
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-soft-sm p-6">
                    <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100">
                        <span class="material-symbols-outlined text-brand-600 text-[20px]">history</span>
                        <h3 class="font-bold text-sm text-slate-800 tracking-tight">Activity Log History</h3>
                        <span class="px-2 py-0.5 text-xs font-bold bg-slate-100 text-slate-600 rounded-full">
                            {{ $task->activities->count() }}
                        </span>
                    </div>

                    <div class="relative pl-4 space-y-4 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200">
                        @forelse($task->activities as $act)
                            <div class="relative flex items-start gap-3">
                                <span class="absolute -left-[1.35rem] top-1 w-2.5 h-2.5 rounded-full bg-brand-600 ring-4 ring-white"></span>
                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/70 w-full text-xs">
                                    <div class="flex items-center justify-between text-slate-500 mb-1">
                                        <span class="font-semibold text-slate-800">
                                            {{ $act->user ? $act->user->name : 'System' }}
                                        </span>
                                        <span class="text-[10px] text-slate-400 font-mono">
                                            {{ $act->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-slate-600">
                                        {{ $act->description }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400">
                                <span class="material-symbols-outlined text-2xl text-slate-300 mb-1">history_toggle_off</span>
                                <p class="text-xs font-medium">No activity logged yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right 1 Col: Task Metadata Panel -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-soft-sm p-5 space-y-4">
                    <h3 class="font-bold text-xs uppercase tracking-wider text-slate-400 border-b border-slate-100 pb-2">Task Details</h3>

                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Priority</span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold border {{ $task->priority === 'high' ? 'bg-rose-50 text-rose-700 border-rose-200' : ($task->priority === 'medium' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-slate-100 text-slate-700 border-slate-200') }}">
                            <span class="material-symbols-outlined text-[14px]">flag</span>
                            {{ ucfirst($task->priority ?? 'Medium') }}
                        </span>
                    </div>

                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Sprint</span>
                        <div class="flex items-center gap-1.5 text-xs text-slate-700 font-medium bg-slate-50 p-2 rounded-xl border border-slate-200/60">
                            <span class="material-symbols-outlined text-[16px] text-brand-600">bolt</span>
                            <span>{{ $task->sprint ? $task->sprint->name : 'Product Backlog (Unassigned)' }}</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Due Date</span>
                        <div class="flex items-center gap-1.5 text-xs text-slate-700 font-medium bg-slate-50 p-2 rounded-xl border border-slate-200/60">
                            <span class="material-symbols-outlined text-[16px] text-slate-400">calendar_today</span>
                            <span>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}</span>
                        </div>
                    </div>

                    @php
                        $lastAct = $task->latestActivity;
                        $lastUser = $lastAct && $lastAct->user ? $lastAct->user : $task->user;
                        $lastType = $lastAct ? $lastAct->type : 'created';
                        $lastTime = $lastAct ? $lastAct->created_at->diffForHumans() : $task->created_at->diffForHumans();
                    @endphp

                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Created By</span>
                        <div class="flex items-center gap-2 text-xs text-slate-700 font-medium">
                            <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-[10px]">
                                {{ strtoupper(substr($task->user->name ?? 'U', 0, 2)) }}
                            </div>
                            <span>{{ $task->user->name ?? 'Unknown' }}</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Last Updated By</span>
                        <div class="flex items-center justify-between gap-2 text-xs text-slate-700 font-medium bg-slate-50 p-2 rounded-xl border border-slate-200/60">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-[10px]">
                                    {{ strtoupper(substr($lastUser->name ?? 'U', 0, 2)) }}
                                </div>
                                <span>{{ $lastUser->name ?? 'System' }}</span>
                            </div>
                            <span class="text-[10px] text-slate-400 font-mono">{{ $lastTime }}</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block mb-1">Last Action</span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase bg-slate-100 text-slate-700 border border-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span>
                            {{ str_replace('_', ' ', $lastType) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>
