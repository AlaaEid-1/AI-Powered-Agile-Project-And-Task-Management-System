<x-layouts.main-layout>
@php
    $todoTasks = $tasks['todo'] ?? collect();
    $inProgressTasks = $tasks['in_progress'] ?? collect();
    $doneTasks = $tasks['done'] ?? collect();
    $totalTasks = count($todoTasks) + count($inProgressTasks) + count($doneTasks);
    $donePercent = $totalTasks > 0 ? round((count($doneTasks) / $totalTasks) * 100) : 0;
@endphp

<!-- Project Header Section -->
<div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-soft-sm mb-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200/60">
                    Project Board
                </span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                {{ $project->title }}
            </h1>
            @if($project->description)
                <p class="text-xs text-slate-500 mt-1 max-w-2xl leading-relaxed">
                    {{ $project->description }}
                </p>
            @endif
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.projects.sprints.index', $project) }}"
               class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 border border-slate-200">
                <span class="material-symbols-outlined text-[18px]">bolt</span>
                View Sprints
            </a>
            <a href="{{ route('dashboard.projects.tasks.create', $project) }}"
               class="bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-sm shadow-brand-500/20 transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">add</span>
                New Task
            </a>
        </div>
    </div>

    <!-- Quick Stats Bar -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-4 pt-4 border-t border-slate-100">
        <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-200/60 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-slate-200/70 text-slate-700 flex items-center justify-center">
                <span class="material-symbols-outlined text-[18px]">format_list_bulleted</span>
            </div>
            <div>
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Total Tasks</p>
                <p class="text-sm font-bold text-slate-800" id="stat-total">{{ $totalTasks }}</p>
            </div>
        </div>

        <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-200/60 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center">
                <span class="material-symbols-outlined text-[18px]">pending</span>
            </div>
            <div>
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">To Do</p>
                <p class="text-sm font-bold text-slate-800" id="stat-todo">{{ count($todoTasks) }}</p>
            </div>
        </div>

        <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-200/60 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center">
                <span class="material-symbols-outlined text-[18px]">sync</span>
            </div>
            <div>
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">In Progress</p>
                <p class="text-sm font-bold text-slate-800" id="stat-in_progress">{{ count($inProgressTasks) }}</p>
            </div>
        </div>

        <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-200/60 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                <span class="material-symbols-outlined text-[18px]">task_alt</span>
            </div>
            <div>
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Done</p>
                <p class="text-sm font-bold text-slate-800" id="stat-done">{{ count($doneTasks) }}</p>
            </div>
        </div>
    </div>

    <!-- Project Members Management Card -->
    <div class="mt-5 pt-4 border-t border-slate-100">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-indigo-600 text-[20px]">group</span>
                <h3 class="font-bold text-xs uppercase tracking-wider text-slate-700">Project Team Members</h3>
                <span class="px-2 py-0.5 text-[11px] font-bold bg-slate-100 text-slate-600 rounded-full border border-slate-200">
                    {{ $project->allMembers()->count() }}
                </span>
            </div>

            @if($project->isOwner(auth()->user()))
                <form action="{{ route('dashboard.projects.members.add', $project) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    <input type="email" name="email" placeholder="Add member by email..." required
                           class="px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 w-56 sm:w-64">
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-3 py-1.5 rounded-xl shadow-xs transition-all flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">person_add</span>
                        Add
                    </button>
                </form>
            @endif
        </div>

        @if($errors->has('email') || $errors->has('member'))
            <p class="text-xs text-rose-600 mb-2 font-medium">
                {{ $errors->first('email') ?: $errors->first('member') }}
            </p>
        @endif

        @if(session('info'))
            <p class="text-xs text-amber-600 mb-2 font-medium">{{ session('info') }}</p>
        @endif

        <!-- Members Pill List -->
        <div class="flex flex-wrap gap-2">
            @foreach($project->allMembers() as $member)
                @php $isProjectOwner = $project->isOwner($member); @endphp
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-xs text-slate-800 font-medium">
                    <div class="w-6 h-6 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center font-bold text-[10px]">
                        {{ strtoupper(substr($member->name, 0, 2)) }}
                    </div>
                    <span>{{ $member->name }}</span>
                    @if($isProjectOwner)
                        <span class="px-1.5 py-0.2 text-[9px] font-bold uppercase bg-amber-100 text-amber-800 rounded">Owner</span>
                    @else
                        <span class="px-1.5 py-0.2 text-[9px] font-bold uppercase bg-slate-200 text-slate-700 rounded">Member</span>
                        @if($project->isOwner(auth()->user()))
                            <form action="{{ route('dashboard.projects.members.remove', [$project, $member]) }}" method="POST" class="inline" onsubmit="return confirm('Remove member from project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-rose-600 ml-1" title="Remove Member">
                                    <span class="material-symbols-outlined text-[14px]">close</span>
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- AI Sprint Planner Component -->
<x-ai-sprint-planner :project="$project" />

<!-- PROJECT KANBAN BOARD -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5">

    <!-- 🟡 TODO COLUMN -->
    <div class="bg-slate-100/90 rounded-2xl p-4 border border-slate-200/80 min-h-[650px] flex flex-col transition-all"
         data-status="todo"
         data-drop="project">

        <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-200/80">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
                <h2 class="font-bold text-xs uppercase tracking-wider text-slate-700">To Do</h2>
            </div>
            <span id="proj-counter-todo" class="px-2 py-0.5 text-xs font-bold bg-white text-slate-600 rounded-full border border-slate-200 shadow-soft-xs">
                {{ count($todoTasks) }}
            </span>
        </div>

        <div class="task-container flex-grow space-y-2.5 custom-scrollbar overflow-y-auto max-h-[700px] pr-0.5" id="proj-container-todo">
            @forelse($todoTasks as $task)
                @include('dashboard.tasks._card', ['task' => $task, 'project' => $project])
            @empty
                <div class="h-32 flex flex-col items-center justify-center text-center p-3 border-2 border-dashed border-slate-200 rounded-xl text-slate-400">
                    <p class="text-xs font-medium">No tasks in Todo</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- 🔵 IN PROGRESS COLUMN -->
    <div class="bg-slate-100/90 rounded-2xl p-4 border border-slate-200/80 min-h-[650px] flex flex-col transition-all"
         data-status="in_progress"
         data-drop="project">

        <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-200/80">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 animate-pulse"></span>
                <h2 class="font-bold text-xs uppercase tracking-wider text-indigo-700">In Progress</h2>
            </div>
            <span id="proj-counter-in_progress" class="px-2 py-0.5 text-xs font-bold bg-indigo-100 text-indigo-700 rounded-full border border-indigo-200/60">
                {{ count($inProgressTasks) }}
            </span>
        </div>

        <div class="task-container flex-grow space-y-2.5 custom-scrollbar overflow-y-auto max-h-[700px] pr-0.5" id="proj-container-in_progress">
            @forelse($inProgressTasks as $task)
                @include('dashboard.tasks._card', ['task' => $task, 'project' => $project])
            @empty
                <div class="h-32 flex flex-col items-center justify-center text-center p-3 border-2 border-dashed border-slate-200 rounded-xl text-slate-400">
                    <p class="text-xs font-medium">No tasks in progress</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- 🟢 DONE COLUMN -->
    <div class="bg-slate-100/90 rounded-2xl p-4 border border-slate-200/80 min-h-[650px] flex flex-col transition-all"
         data-status="done"
         data-drop="project">

        <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-200/80">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <h2 class="font-bold text-xs uppercase tracking-wider text-emerald-700">Done</h2>
            </div>
            <span id="proj-counter-done" class="px-2 py-0.5 text-xs font-bold bg-emerald-100 text-emerald-700 rounded-full border border-emerald-200/60">
                {{ count($doneTasks) }}
            </span>
        </div>

        <div class="task-container flex-grow space-y-2.5 custom-scrollbar overflow-y-auto max-h-[700px] pr-0.5" id="proj-container-done">
            @forelse($doneTasks as $task)
                @include('dashboard.tasks._card', ['task' => $task, 'project' => $project])
            @empty
                <div class="h-32 flex flex-col items-center justify-center text-center p-3 border-2 border-dashed border-slate-200 rounded-xl text-slate-400">
                    <p class="text-xs font-medium">No completed tasks yet</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

<!-- DRAG SCRIPT FOR PROJECT BOARD -->
<script>
window.TaskFlowState = window.TaskFlowState || {
    isDragging: false,
    pendingEvents: []
};

document.addEventListener('DOMContentLoaded', () => {
    let draggedTask = null;

    function bindDraggables() {
        document.querySelectorAll('.task-card').forEach(task => {
            task.removeEventListener('dragstart', onDragStart);
            task.removeEventListener('dragend', onDragEnd);

            task.addEventListener('dragstart', onDragStart);
            task.addEventListener('dragend', onDragEnd);
        });
    }

    function onDragStart(e) {
        if (e.dataTransfer) {
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', this.dataset.taskId || '');
        }
        window.TaskFlowState.isDragging = true;
        draggedTask = this;
        this.classList.add('dragging');
        document.querySelectorAll('[data-status]').forEach(col => col.classList.add('drop-target-active'));
    }

    function onDragEnd(e) {
        window.TaskFlowState.isDragging = false;
        if (draggedTask) draggedTask.classList.remove('dragging');
        document.querySelectorAll('[data-status]').forEach(col => col.classList.remove('drop-target-active', 'drop-target-over'));
        draggedTask = null;
        
        // Process any events that arrived while dragging
        processPendingTaskFlowEvents();
    }

    document.querySelectorAll('[data-status]').forEach(column => {
        column.addEventListener('dragover', function (e) {
            e.preventDefault();
            column.classList.add('drop-target-over');
        });

        column.addEventListener('dragleave', function () {
            column.classList.remove('drop-target-over');
        });

        column.addEventListener('drop', function (e) {
            e.preventDefault();
            column.classList.remove('drop-target-over', 'drop-target-active');

            if (!draggedTask) return;
            
            window.TaskFlowState.isDragging = false;

            const taskId = draggedTask.dataset.taskId;
            const newStatus = this.dataset.status;
            const container = this.querySelector('.task-container') || this;

            // Append task visually
            container.appendChild(draggedTask);

            // Update Counters & Stats
            updateProjectStats();

            // Process any pending events now that drag is over
            processPendingTaskFlowEvents();

            // AJAX request to backend
            fetch(`/dashboard/tasks/${taskId}/status`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(res => res.json())
            .then(data => {
                const statusName = newStatus === 'in_progress' ? 'In Progress' : (newStatus === 'done' ? 'Done' : 'Todo');
                if (typeof showToast === 'function') {
                    showToast(`Task status updated to ${statusName}`);
                }
            })
            .catch(err => {
                console.error('Status update failed:', err);
                if (typeof showToast === 'function') {
                    showToast('Failed to update task status', 'error');
                }
            });
        });
    });

    function updateProjectStats() {
        const todoCount = document.querySelectorAll('#proj-container-todo .task-card').length;
        const inProgressCount = document.querySelectorAll('#proj-container-in_progress .task-card').length;
        const doneCount = document.querySelectorAll('#proj-container-done .task-card').length;

        const cTodo = document.getElementById('proj-counter-todo');
        const cInProg = document.getElementById('proj-counter-in_progress');
        const cDone = document.getElementById('proj-counter-done');

        if (cTodo) cTodo.textContent = todoCount;
        if (cInProg) cInProg.textContent = inProgressCount;
        if (cDone) cDone.textContent = doneCount;

        const sTodo = document.getElementById('stat-todo');
        const sInProg = document.getElementById('stat-in_progress');
        const sDone = document.getElementById('stat-done');
        const sTotal = document.getElementById('stat-total');

        if (sTodo) sTodo.textContent = todoCount;
        if (sInProg) sInProg.textContent = inProgressCount;
        if (sDone) sDone.textContent = doneCount;
        if (sTotal) sTotal.textContent = todoCount + inProgressCount + doneCount;
    }

    bindDraggables();

    // Listen for Real-Time Pusher Events dispatched from main-layout
    window.addEventListener('task:created', function (e) {
        // Since we don't have the task HTML in the payload and can't fetch the backend,
        // we display a toast (already handled) but we can't instantly render the full card.
        // However, we can increment the Todo counter as a visual cue.
        const cTodo = document.getElementById('proj-counter-todo');
        if (cTodo) {
            cTodo.textContent = parseInt(cTodo.textContent) + 1;
        }
        updateProjectStats();
    });

    window.addEventListener('task:updated', function (e) {
        const data = e.detail;
        if (!data || !data.task_id) return;
        
        if (window.TaskFlowState.isDragging) {
            window.TaskFlowState.pendingEvents.push(data);
        } else {
            safeSyncTaskDOM(data);
        }
    });

    function processPendingTaskFlowEvents() {
        while (window.TaskFlowState.pendingEvents.length > 0) {
            const data = window.TaskFlowState.pendingEvents.shift();
            safeSyncTaskDOM(data);
        }
    }

    function safeSyncTaskDOM(data) {
        const taskCard = document.querySelector(`.task-card[data-task-id="${data.task_id}"]`);
        if (!taskCard) return; // Task card not on this board

        if (data.action_type === 'status_changed') {
            let newStatus = null;
            const msg = data.message || '';
            if (msg.includes('changed status to Todo')) newStatus = 'todo';
            else if (msg.includes('changed status to In Progress') || msg.includes('changed status to In progress')) newStatus = 'in_progress';
            else if (msg.includes('changed status to Done')) newStatus = 'done';

            if (newStatus) {
                const targetContainer = document.getElementById(`proj-container-${newStatus}`);
                if (targetContainer && !targetContainer.contains(taskCard)) {
                    // Safe DOM Move (managed by D&D system logic)
                    targetContainer.appendChild(taskCard);
                    
                    // Add a brief highlight effect
                    taskCard.style.transition = 'box-shadow 0.3s ease, transform 0.3s ease';
                    taskCard.style.boxShadow = '0 0 15px rgba(99, 102, 241, 0.4)';
                    taskCard.style.transform = 'scale(1.02)';
                    
                    setTimeout(() => {
                        taskCard.style.boxShadow = '';
                        taskCard.style.transform = '';
                    }, 1000);

                    // Update stats safely
                    updateProjectStats();
                }
            }
        }
    }
});
</script>
</x-layouts.main-layout>

