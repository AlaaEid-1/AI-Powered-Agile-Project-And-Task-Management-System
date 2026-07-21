<x-layouts.main-layout>
    <div class="max-w-[1400px] mx-auto">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-1">
                    <a href="{{ route('dashboard.projects.show', $project) }}" class="hover:text-brand-600 transition-colors">{{ $project->title }}</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-slate-700 font-semibold">All Tasks</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Project Tasks</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Detailed list view of all tasks for {{ $project->title }}.</p>
            </div>
            <a href="{{ route('dashboard.projects.tasks.create', $project) }}"
                class="bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs sm:text-sm px-4 py-2.5 rounded-xl shadow-sm shadow-brand-500/20 hover:shadow-md transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Create Task</span>
            </a>
        </div>

        @if(session('status'))
            <div class="bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-semibold p-3.5 rounded-xl mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600 text-[18px]">check_circle</span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- Filter Bar (Status Tabs) -->
        <div class="bg-white rounded-2xl p-2 shadow-soft-xs mb-6 border border-slate-200/80 flex items-center justify-between flex-wrap gap-2">
            <!-- Status Tabs Container -->
            <div class="flex items-center gap-1.5 overflow-x-auto custom-scrollbar w-full sm:w-auto pb-1 sm:pb-0">
                @foreach ($status_options as $option)
                    <a href="{{ route('dashboard.projects.tasks.index', [$project, 'status' => $option['value']]) }}"
                       class="px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap transition-all flex items-center gap-2 {{ $status === $option['value'] ? 'bg-slate-900 text-white shadow-soft-xs' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        <span>{{ $option['label'] }}</span>
                        <span class="px-1.5 py-0.5 rounded-md text-[10px] font-bold {{ $status === $option['value'] ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-700' }}">
                            {{ $option['count'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Task List Table Container -->
        <div class="bg-white rounded-2xl shadow-soft-sm overflow-hidden border border-slate-200/90">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-4 py-3.5 w-16 text-center">ID</th>
                            <th class="px-4 py-3.5">Task Name</th>
                            <th class="px-4 py-3.5">Status</th>
                            <th class="px-4 py-3.5">Priority</th>
                            <th class="px-4 py-3.5">Due Date</th>
                            <th class="px-4 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($tasks as $task)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-4 py-3.5 text-center">
                                    <span class="text-xs font-mono font-medium text-slate-400">#{{ $task->id }}</span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-xs sm:text-sm text-slate-800 group-hover:text-brand-600 transition-colors">
                                            {{ $task->title }}
                                        </span>
                                        @if($task->description)
                                            <span class="text-xs text-slate-400 line-clamp-1 mt-0.5 font-normal">
                                                {{ $task->description }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3.5">
                                    @if ($task->status == 'done')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 font-semibold text-[11px] uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Done
                                        </span>
                                    @elseif ($task->status == 'in_progress')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200/60 font-semibold text-[11px] uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                                            In Progress
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200 font-semibold text-[11px] uppercase">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            Todo
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    @php
                                        $p = strtolower($task->priority ?? 'medium');
                                        $pBadge = [
                                            'low' => 'text-slate-600 bg-slate-100',
                                            'medium' => 'text-amber-700 bg-amber-50',
                                            'high' => 'text-rose-700 bg-rose-50',
                                        ][$p] ?? 'text-slate-600 bg-slate-100';
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md font-semibold text-[11px] uppercase {{ $pBadge }}">
                                        <span class="material-symbols-outlined text-[13px]">flag</span>
                                        {{ ucfirst($p) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 text-xs text-slate-500 font-medium">
                                    @if($task->due_date)
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('dashboard.projects.tasks.edit', [$project, $task]) }}"
                                           class="p-1.5 rounded-lg text-slate-400 hover:text-brand-600 hover:bg-slate-100 transition-all"
                                           title="Edit Task">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </a>
                                        <button type="button"
                                                onclick="if(confirm('Are you sure you want to delete this task?')) document.getElementById('deletetask{{ $task->id }}').submit();"
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-all"
                                                title="Delete Task">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                        <form style="display: none;" id="deletetask{{ $task->id }}"
                                              action="{{ route('dashboard.projects.tasks.destroy', [$project, $task]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-12 text-center text-slate-400">
                                    <span class="material-symbols-outlined text-3xl mb-1 text-slate-300">task</span>
                                    <p class="text-xs font-semibold text-slate-600">No tasks found for this status</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">Try selecting another status tab or create a new task.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.main-layout>

