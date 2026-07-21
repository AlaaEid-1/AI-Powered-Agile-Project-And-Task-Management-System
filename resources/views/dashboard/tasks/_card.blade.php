<div class="task-card bg-white p-3.5 rounded-xl border border-slate-200/90 shadow-soft-xs hover:shadow-soft-md hover:border-slate-300/80 cursor-grab active:cursor-grabbing transition-all duration-200 hover:-translate-y-0.5 group relative mb-2.5 select-none"
     draggable="true"
     data-task-id="{{ $task->id }}">

    <!-- Priority Badge, Sprint Label & Task ID Row -->
    <div class="flex items-center justify-between mb-2 gap-1.5 flex-wrap">
        @php
            $priority = strtolower($task->priority ?? 'medium');
            $priorityStyles = [
                'low' => 'bg-slate-100 text-slate-600 border-slate-200',
                'medium' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                'high' => 'bg-orange-50 text-orange-700 border-orange-200/60',
                'urgent' => 'bg-rose-50 text-rose-700 border-rose-200/60',
            ];
            $style = $priorityStyles[$priority] ?? $priorityStyles['medium'];

            $lastActivity = $task->latestActivity;
            $lastActor = $lastActivity && $lastActivity->user ? $lastActivity->user : $task->user;
            $lastUpdatedTime = $lastActivity ? $lastActivity->created_at->diffForHumans() : $task->updated_at->diffForHumans();
        @endphp

        <div class="flex items-center gap-1.5">
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-semibold tracking-wide uppercase border {{ $style }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $priority === 'high' || $priority === 'urgent' ? 'bg-rose-500 animate-pulse' : ($priority === 'medium' ? 'bg-amber-500' : 'bg-slate-400') }}"></span>
                {{ ucfirst($priority) }}
            </span>

            @if($task->sprint)
                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-medium bg-brand-50 text-brand-700 border border-brand-200/50 truncate max-w-[110px]" title="Sprint: {{ $task->sprint->name }}">
                    <span class="material-symbols-outlined text-[12px] text-brand-600">bolt</span>
                    <span class="truncate">{{ $task->sprint->name }}</span>
                </span>
            @else
                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-medium bg-slate-50 text-slate-500 border border-slate-200/60" title="Product Backlog">
                    <span class="material-symbols-outlined text-[12px] text-slate-400">inventory_2</span>
                    <span>Backlog</span>
                </span>
            @endif
        </div>

        <!-- Task ID Pill -->
        <span class="text-[10px] font-mono font-medium text-slate-400 bg-slate-50 px-1.5 py-0.5 rounded border border-slate-100">
            #{{ $task->id }}
        </span>
    </div>

    <!-- Optional Cover Image Preview -->
    @if(!empty($task->cover_image))
        <div class="mb-2.5 overflow-hidden rounded-lg border border-slate-100 max-h-32 bg-slate-50">
            <img src="{{ asset('storage/' . $task->cover_image) }}" alt="Task Cover" class="w-full h-24 object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
    @endif

    <!-- Task Title -->
    <h3 class="font-semibold text-xs sm:text-sm text-slate-800 group-hover:text-brand-600 transition-colors line-clamp-2 leading-snug mb-1">
        {{ $task->title }}
    </h3>

    <!-- Task Description Preview (if present) -->
    @if(!empty($task->description))
        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-2 font-normal">
            {{ $task->description }}
        </p>
    @endif

    <!-- Card Footer: Collaboration & Last Actor Activity Info -->
    <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-[11px] text-slate-400 mt-2">
        <div class="flex items-center gap-1.5 min-w-0" title="Last modified by {{ $lastActor ? $lastActor->name : 'System' }} ({{ $lastUpdatedTime }})">
            <div class="w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-[9px] shrink-0 border border-indigo-200">
                {{ strtoupper(substr($lastActor->name ?? 'U', 0, 2)) }}
            </div>
            <span class="text-[11px] font-medium text-slate-600 truncate max-w-[90px]">
                {{ $lastActor->name ?? 'User' }}
            </span>
            <span class="text-[10px] text-slate-400 shrink-0">• {{ $lastUpdatedTime }}</span>
        </div>

        <!-- Quick Action Buttons (Show on Hover) -->
        <div class="opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1 shrink-0">
            @isset($project)
                <a href="{{ route('dashboard.projects.tasks.show', [$project, $task]) }}"
                   class="p-1 hover:bg-slate-100 text-slate-500 hover:text-brand-600 rounded transition-colors"
                   title="View Details"
                   onclick="event.stopPropagation();">
                    <span class="material-symbols-outlined text-[16px]">visibility</span>
                </a>
                <a href="{{ route('dashboard.projects.tasks.edit', [$project, $task]) }}"
                   class="p-1 hover:bg-slate-100 text-slate-500 hover:text-brand-600 rounded transition-colors"
                   title="Edit Task"
                   onclick="event.stopPropagation();">
                    <span class="material-symbols-outlined text-[16px]">edit</span>
                </a>
                <button type="button"
                        class="p-1 hover:bg-rose-50 text-slate-500 hover:text-rose-600 rounded transition-colors"
                        title="Delete Task"
                        onclick="event.stopPropagation(); if(confirm('Delete this task?')) document.getElementById('quick-delete-task-{{ $task->id }}').submit();">
                    <span class="material-symbols-outlined text-[16px]">delete</span>
                </button>
                <form id="quick-delete-task-{{ $task->id }}" action="{{ route('dashboard.projects.tasks.destroy', [$project, $task]) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endisset
        </div>
    </div>
</div>
