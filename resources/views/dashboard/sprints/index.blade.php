<x-layouts.main-layout>

<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-1">
            <a href="{{ route('dashboard.projects.show', $project) }}" class="hover:text-brand-600 transition-colors">{{ $project->title }}</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-slate-700 font-semibold">Sprints</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Sprints Management</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Plan, track, and manage agile sprint cycles for {{ $project->title }}.</p>
    </div>

    <a href="{{ route('dashboard.projects.sprints.create', $project) }}"
       class="bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs sm:text-sm px-4 py-2.5 rounded-xl shadow-sm shadow-brand-500/20 hover:shadow-md transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
        <span class="material-symbols-outlined text-[20px]">add</span>
        <span>New Sprint</span>
    </a>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-semibold p-3.5 rounded-xl mb-6 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600 text-[18px]">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Sprints Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($sprints as $sprint)
        @php
            $tasksCount = $sprint->tasks->count();
            $doneCount = $sprint->tasks->where('status', 'done')->count();
            $progress = $tasksCount > 0 ? round(($doneCount / $tasksCount) * 100) : 0;
        @endphp

        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-soft-sm hover:shadow-soft-md transition-all p-5 flex flex-col justify-between group">
            <div>
                <!-- Sprint Title & ID -->
                <div class="flex items-start justify-between gap-3 mb-3">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-brand-50 text-brand-600 border border-brand-200/60">
                                Active Sprint
                            </span>
                            <span class="text-[11px] font-mono text-slate-400">#{{ $sprint->id }}</span>
                        </div>
                        <h2 class="font-bold text-base text-slate-800 group-hover:text-brand-600 transition-colors">
                            <a href="{{ route('dashboard.projects.sprints.show', [$project, $sprint]) }}">
                                {{ $sprint->name }}
                            </a>
                        </h2>
                    </div>
                </div>

                <!-- Date Range -->
                <div class="flex items-center gap-2 text-xs text-slate-500 mb-4 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                    <span class="material-symbols-outlined text-[16px] text-slate-400">calendar_month</span>
                    <span>
                        {{ $sprint->start_date ? \Carbon\Carbon::parse($sprint->start_date)->format('M d, Y') : 'No Start' }}
                        →
                        {{ $sprint->end_date ? \Carbon\Carbon::parse($sprint->end_date)->format('M d, Y') : 'No End' }}
                    </span>
                </div>
            </div>

            <div>
                <!-- Sprint Progress Bar -->
                <div class="mb-4">
                    <div class="flex items-center justify-between text-xs font-semibold text-slate-600 mb-1.5">
                        <span>Sprint Tasks</span>
                        <span class="text-emerald-600 font-bold">{{ $progress }}%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden mb-1.5">
                        <div class="h-full bg-gradient-to-r from-brand-500 to-emerald-500 rounded-full transition-all duration-500" style="width: {{ $progress }}%;"></div>
                    </div>
                    <div class="text-[11px] text-slate-400">
                        {{ $doneCount }} of {{ $tasksCount }} tasks completed
                    </div>
                </div>

                <!-- Open Sprint Button -->
                <a href="{{ route('dashboard.projects.sprints.show', [$project, $sprint]) }}"
                   class="w-full bg-slate-900 hover:bg-brand-600 text-white text-xs font-semibold py-2.5 rounded-xl text-center transition-all flex items-center justify-center gap-1.5 shadow-xs">
                    <span class="material-symbols-outlined text-[16px]">view_kanban</span>
                    Open Sprint Board
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-3">
                <span class="material-symbols-outlined text-2xl">bolt</span>
            </div>
            <h3 class="font-bold text-slate-800 text-base">No Sprints Yet</h3>
            <p class="text-xs text-slate-500 mt-1 mb-4">Create your first sprint to start dragging tasks from the backlog!</p>
            <a href="{{ route('dashboard.projects.sprints.create', $project) }}"
               class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-sm transition-all">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Create First Sprint
            </a>
        </div>
    @endforelse

</div>

</x-layouts.main-layout>

