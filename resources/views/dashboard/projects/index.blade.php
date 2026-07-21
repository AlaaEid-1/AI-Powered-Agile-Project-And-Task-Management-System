<x-layouts.main-layout>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Projects Workspace</h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">Manage and organize all your active product development projects.</p>
    </div>

    <a href="{{ route('dashboard.projects.create') }}"
       class="bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs sm:text-sm px-4 py-2.5 rounded-xl shadow-sm shadow-brand-500/20 hover:shadow-md transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
        <span class="material-symbols-outlined text-[20px]">add</span>
        <span>New Project</span>
    </a>
</div>

<!-- Projects Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@forelse($projects as $project)
    @php
        $tasksCount = $project->tasks()->count();
        $doneCount = $project->tasks()->where('status', 'done')->count();
        $progress = $tasksCount > 0 ? round(($doneCount / $tasksCount) * 100) : 0;
        $sprintsCount = $project->sprints()->count();
    @endphp

    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-soft-sm hover:shadow-soft-md hover:border-slate-300/80 transition-all p-5 flex flex-col justify-between group">
        <div>
            <!-- Project Badge & Title -->
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-brand-600 text-white font-bold flex items-center justify-center shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform text-sm">
                        {{ strtoupper(substr($project->title, 0, 2)) }}
                    </div>
                    <div>
                        <h2 class="font-bold text-base text-slate-800 group-hover:text-brand-600 transition-colors leading-snug">
                            <a href="{{ route('dashboard.projects.show', $project) }}">
                                {{ $project->title }}
                            </a>
                        </h2>
                        <span class="text-[11px] font-medium text-slate-400">Created {{ $project->created_at ? $project->created_at->diffForHumans() : 'Recently' }}</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                {{ $project->description ?? 'No description provided for this project.' }}
            </p>
        </div>

        <div>
            <!-- Stats & Progress -->
            <div class="bg-slate-50 rounded-xl p-3 border border-slate-100 mb-4">
                <div class="flex items-center justify-between text-xs font-semibold text-slate-600 mb-1.5">
                    <span>Task Progress</span>
                    <span class="text-brand-600 font-bold">{{ $progress }}%</span>
                </div>
                <div class="w-full h-1.5 bg-slate-200 rounded-full overflow-hidden mb-2">
                    <div class="h-full bg-brand-600 rounded-full transition-all duration-500" style="width: {{ $progress }}%;"></div>
                </div>
                <div class="flex items-center justify-between text-[11px] text-slate-400">
                    <span>{{ $doneCount }}/{{ $tasksCount }} Completed</span>
                    <span>{{ $sprintsCount }} Sprints</span>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex items-center gap-2 pt-2 border-t border-slate-100">
                <a href="{{ route('dashboard.projects.show', $project) }}"
                   class="flex-1 bg-slate-100 hover:bg-brand-50 text-slate-700 hover:text-brand-600 text-xs font-semibold py-2 rounded-xl text-center transition-all flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">view_kanban</span>
                    Open Board
                </a>
                <a href="{{ route('dashboard.projects.sprints.index', $project) }}"
                   class="p-2 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-xl transition-colors" title="Manage Sprints">
                    <span class="material-symbols-outlined text-[18px]">bolt</span>
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full bg-white rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-brand-600 flex items-center justify-center mx-auto mb-3">
            <span class="material-symbols-outlined text-2xl">folder_off</span>
        </div>
        <h3 class="font-bold text-slate-800 text-base">No Projects Found</h3>
        <p class="text-xs text-slate-500 mt-1 mb-4">Create your first project to start organizing tasks and sprints.</p>
        <a href="{{ route('dashboard.projects.create') }}"
           class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-sm transition-all">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Create First Project
        </a>
    </div>
@endforelse

</div>

</x-layouts.main-layout>

