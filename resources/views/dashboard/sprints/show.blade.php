<x-layouts.main-layout>
@php
    $todoCount = count($tasks['todo'] ?? []);
    $inProgressCount = count($tasks['in_progress'] ?? []);
    $doneCount = count($tasks['done'] ?? []);
    $totalSprintTasks = $todoCount + $inProgressCount + $doneCount;
    $progressPercent = $totalSprintTasks > 0 ? round(($doneCount / $totalSprintTasks) * 100) : 0;
@endphp

<!-- Sprint Dashboard Header & Progress Bar -->
<div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-soft-sm mb-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-brand-50 text-brand-600 border border-brand-200/60 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-600 animate-pulse"></span>
                    Active Sprint
                </span>
                <span class="text-xs font-mono font-medium text-slate-400">Sprint #{{ $sprint->id }}</span>
            </div>

            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                {{ $sprint->name }}
            </h1>
            <p class="text-xs text-slate-500 mt-0.5 flex items-center gap-2">
                <span class="font-medium text-slate-700">{{ $project->title }}</span>
                <span class="text-slate-300">•</span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                    {{ $sprint->start_date ? \Carbon\Carbon::parse($sprint->start_date)->format('M d') : 'No Start' }}
                    →
                    {{ $sprint->end_date ? \Carbon\Carbon::parse($sprint->end_date)->format('M d, Y') : 'No End' }}
                </span>
            </p>
        </div>

        <!-- Header Actions & Sprint Metrics -->
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.projects.tasks.create', $project) }}"
               class="bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-sm shadow-brand-500/20 hover:shadow-md transition-all flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">add</span>
                New Task
            </a>
        </div>
    </div>

    <!-- Sprint Progress Bar Section -->
    <div class="bg-slate-50 rounded-xl p-3.5 border border-slate-200/60">
        <div class="flex items-center justify-between text-xs font-semibold text-slate-700 mb-2">
            <span class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px] text-brand-600">trending_up</span>
                Sprint Progress
            </span>
            <div class="flex items-center gap-3 text-slate-500">
                <span><strong id="progress-done-count" class="text-slate-800">{{ $doneCount }}</strong> of <strong id="progress-total-count" class="text-slate-800">{{ $totalSprintTasks }}</strong> tasks completed</span>
                <span id="progress-percent-label" class="px-2 py-0.5 bg-emerald-50 text-emerald-700 font-bold rounded-md border border-emerald-200/60">{{ $progressPercent }}%</span>
            </div>
        </div>

        <!-- Progress Track -->
        <div class="w-full h-2.5 bg-slate-200/80 rounded-full overflow-hidden p-0.5">
            <div id="progress-bar-fill" class="h-full bg-gradient-to-r from-brand-500 to-emerald-500 rounded-full transition-all duration-500" style="width: {{ $progressPercent }}%;"></div>
        </div>
    </div>
</div>

<!-- Board Grid Layout: Backlog (Left 3 cols) + Sprint Board (Right 9 cols) -->
<div class="grid grid-cols-12 gap-6">

    <!-- ================= 📋 PRODUCT BACKLOG PANEL ================= -->
    <div class="col-span-12 lg:col-span-3">
        <div class="bg-slate-100/90 rounded-2xl p-4 border border-slate-200/80 min-h-[680px] flex flex-col transition-all"
             data-drop="backlog">

            <!-- Backlog Panel Header -->
            <div class="flex items-center justify-between mb-4 sticky top-0 bg-slate-100/90 py-1 z-10">
                <div class="flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">inventory_2</span>
                    </span>
                    <h2 class="font-bold text-sm text-slate-800 tracking-tight">Product Backlog</h2>
                </div>
                <span id="counter-backlog" class="px-2 py-0.5 text-xs font-bold bg-amber-200/70 text-amber-800 rounded-full">
                    {{ count($backlog) }}
                </span>
            </div>

            <!-- Backlog Dropzone Container -->
            <div class="task-container flex-grow space-y-2 custom-scrollbar overflow-y-auto max-h-[700px] pr-0.5" id="container-backlog">
                @forelse($backlog as $task)
                    @include('dashboard.tasks._card', ['task' => $task])
                @empty
                    <div id="empty-backlog" class="h-40 flex flex-col items-center justify-center text-center p-4 border-2 border-dashed border-slate-200 rounded-xl text-slate-400">
                        <span class="material-symbols-outlined text-3xl mb-1 text-slate-300">inbox</span>
                        <p class="text-xs font-medium">Backlog is empty</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Drag tasks here to unassign from sprint</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ================= 🚀 SPRINT KANBAN BOARD ================= -->
    <div class="col-span-12 lg:col-span-9">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- 🟡 TODO COLUMN -->
            <div class="bg-slate-100/90 rounded-2xl p-4 border border-slate-200/80 min-h-[680px] flex flex-col transition-all"
                 data-drop="sprint"
                 data-sprint-id="{{ $sprint->id }}"
                 data-status="todo">

                <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-200/80">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
                        <h2 class="font-bold text-xs uppercase tracking-wider text-slate-700">To Do</h2>
                    </div>
                    <span id="counter-todo" class="px-2 py-0.5 text-xs font-bold bg-white text-slate-600 rounded-full border border-slate-200 shadow-soft-xs">
                        {{ $todoCount }}
                    </span>
                </div>

                <div class="task-container flex-grow space-y-2 custom-scrollbar overflow-y-auto max-h-[700px] pr-0.5" id="container-todo">
                    @foreach($tasks['todo'] as $task)
                        @include('dashboard.tasks._card', ['task' => $task])
                    @endforeach
                </div>
            </div>

            <!-- 🔵 IN PROGRESS COLUMN -->
            <div class="bg-slate-100/90 rounded-2xl p-4 border border-slate-200/80 min-h-[680px] flex flex-col transition-all"
                 data-drop="sprint"
                 data-sprint-id="{{ $sprint->id }}"
                 data-status="in_progress">

                <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-200/80">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 animate-pulse"></span>
                        <h2 class="font-bold text-xs uppercase tracking-wider text-indigo-700">In Progress</h2>
                    </div>
                    <span id="counter-in_progress" class="px-2 py-0.5 text-xs font-bold bg-indigo-100 text-indigo-700 rounded-full border border-indigo-200/60">
                        {{ $inProgressCount }}
                    </span>
                </div>

                <div class="task-container flex-grow space-y-2 custom-scrollbar overflow-y-auto max-h-[700px] pr-0.5" id="container-in_progress">
                    @foreach($tasks['in_progress'] as $task)
                        @include('dashboard.tasks._card', ['task' => $task])
                    @endforeach
                </div>
            </div>

            <!-- 🟢 DONE COLUMN -->
            <div class="bg-slate-100/90 rounded-2xl p-4 border border-slate-200/80 min-h-[680px] flex flex-col transition-all"
                 data-drop="sprint"
                 data-sprint-id="{{ $sprint->id }}"
                 data-status="done">

                <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-200/80">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <h2 class="font-bold text-xs uppercase tracking-wider text-emerald-700">Done</h2>
                    </div>
                    <span id="counter-done" class="px-2 py-0.5 text-xs font-bold bg-emerald-100 text-emerald-700 rounded-full border border-emerald-200/60">
                        {{ $doneCount }}
                    </span>
                </div>

                <div class="task-container flex-grow space-y-2 custom-scrollbar overflow-y-auto max-h-[700px] pr-0.5" id="container-done">
                    @foreach($tasks['done'] as $task)
                        @include('dashboard.tasks._card', ['task' => $task])
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================= DRAG & DROP + REAL-TIME AJAX SCRIPT ================= -->
<script>
window.TaskFlowState = window.TaskFlowState || {
    isDragging: false,
    pendingEvents: []
};

document.addEventListener('DOMContentLoaded', () => {
    let draggedTask = null;

    // Attach listeners to draggable cards
    function bindDraggableCards() {
        document.querySelectorAll('.task-card').forEach(card => {
            card.removeEventListener('dragstart', handleDragStart);
            card.removeEventListener('dragend', handleDragEnd);

            card.addEventListener('dragstart', handleDragStart);
            card.addEventListener('dragend', handleDragEnd);
        });
    }

    function handleDragStart(e) {
        if (e.dataTransfer) {
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', this.dataset.taskId || '');
        }
        window.TaskFlowState.isDragging = true;
        draggedTask = this;
        this.classList.add('dragging');
        document.querySelectorAll('[data-drop]').forEach(zone => {
            zone.classList.add('drop-target-active');
        });
    }

    function handleDragEnd(e) {
        window.TaskFlowState.isDragging = false;
        if (draggedTask) {
            draggedTask.classList.remove('dragging');
        }
        document.querySelectorAll('[data-drop]').forEach(zone => {
            zone.classList.remove('drop-target-active', 'drop-target-over');
        });
        draggedTask = null;

        // Process any events that arrived while dragging
        processPendingTaskFlowEvents();
    }

    // Configure Drop Zones
    document.querySelectorAll('[data-drop]').forEach(zone => {
        zone.addEventListener('dragover', e => {
            e.preventDefault();
            zone.classList.add('drop-target-over');
        });

        zone.addEventListener('dragleave', e => {
            zone.classList.remove('drop-target-over');
        });

        zone.addEventListener('drop', function (e) {
            e.preventDefault();
            zone.classList.remove('drop-target-over', 'drop-target-active');

            if (!draggedTask) return;
            
            window.TaskFlowState.isDragging = false;

            const taskId = draggedTask.dataset.taskId;
            let sprintId = null;
            let status = null;

            if (this.dataset.drop === 'backlog') {
                sprintId = null;
                status = 'todo';
            } else if (this.dataset.drop === 'sprint') {
                sprintId = this.dataset.sprintId;
                status = this.dataset.status;
            }

            // Target container inside the drop zone
            const container = this.querySelector('.task-container') || this;

            // Remove empty state if present
            const emptyState = container.querySelector('#empty-backlog');
            if (emptyState) emptyState.remove();

            // Append Card physically
            container.appendChild(draggedTask);

            // Update Counters & Progress Bar
            updateColumnCountersAndProgress();

            // Process any pending events now that drag is over
            processPendingTaskFlowEvents();

            // Send AJAX Request
            fetch(`/dashboard/tasks/${taskId}/status`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    sprint_id: sprintId,
                    status: status
                })
            })
            .then(res => res.json())
            .then(data => {
                const statusLabel = status === 'in_progress' ? 'In Progress' : (status === 'done' ? 'Done' : 'Backlog/Todo');
                if (typeof showToast === 'function') {
                    showToast(`Task #${taskId} moved to ${statusLabel}`);
                }
            })
            .catch(err => {
                console.error('Failed to update status:', err);
                if (typeof showToast === 'function') {
                    showToast('Failed to update task status', 'error');
                }
            });
        });
    });

    // Helper to calculate column counters & sprint progress bar dynamically
    function updateColumnCountersAndProgress() {
        const backlogCount = document.querySelectorAll('#container-backlog .task-card').length;
        const todoCount = document.querySelectorAll('#container-todo .task-card').length;
        const inProgressCount = document.querySelectorAll('#container-in_progress .task-card').length;
        const doneCount = document.querySelectorAll('#container-done .task-card').length;

        const counterBacklog = document.getElementById('counter-backlog');
        const counterTodo = document.getElementById('counter-todo');
        const counterInProgress = document.getElementById('counter-in_progress');
        const counterDone = document.getElementById('counter-done');

        if (counterBacklog) counterBacklog.textContent = backlogCount;
        if (counterTodo) counterTodo.textContent = todoCount;
        if (counterInProgress) counterInProgress.textContent = inProgressCount;
        if (counterDone) counterDone.textContent = doneCount;

        // Sprint Total & Progress
        const sprintTotal = todoCount + inProgressCount + doneCount;
        const percent = sprintTotal > 0 ? Math.round((doneCount / sprintTotal) * 100) : 0;

        const elDone = document.getElementById('progress-done-count');
        const elTotal = document.getElementById('progress-total-count');
        const elLabel = document.getElementById('progress-percent-label');
        const elFill = document.getElementById('progress-bar-fill');

        if (elDone) elDone.textContent = doneCount;
        if (elTotal) elTotal.textContent = sprintTotal;
        if (elLabel) elLabel.textContent = `${percent}%`;
        if (elFill) elFill.style.width = `${percent}%`;
    }

    // Initial Bind
    bindDraggableCards();

    // Listen for Real-Time Pusher Events dispatched from main-layout
    window.addEventListener('task:created', function (e) {
        // Increment the Backlog counter visually
        const cBacklog = document.getElementById('counter-backlog');
        if (cBacklog) {
            cBacklog.textContent = parseInt(cBacklog.textContent) + 1;
        }
        updateColumnCountersAndProgress();
    });

    window.addEventListener('task:updated', function (e) {
        const data = e.detail;
        if (!data || !data.task_id) return;
        
        if (window.TaskFlowState.isDragging) {
            window.TaskFlowState.pendingEvents.push(data);
        } else {
            safeSyncSprintTaskDOM(data);
        }
    });

    function processPendingTaskFlowEvents() {
        while (window.TaskFlowState.pendingEvents.length > 0) {
            const data = window.TaskFlowState.pendingEvents.shift();
            safeSyncSprintTaskDOM(data);
        }
    }

    function safeSyncSprintTaskDOM(data) {
        const taskCard = document.querySelector(`.task-card[data-task-id="${data.task_id}"]`);
        if (!taskCard) return; // Task card not on this board

        if (data.action_type === 'status_changed' || data.action_type === 'sprint_moved') {
            let targetContainer = null;
            const msg = data.message || '';
            
            if (data.action_type === 'sprint_moved') {
                if (msg.includes('Product Backlog')) {
                    targetContainer = document.getElementById('container-backlog');
                } else if (msg.includes('added task to sprint') || msg.includes('moved task to sprint')) {
                    const currentSprintName = document.querySelector('h1').textContent.trim();
                    if (msg.includes(currentSprintName)) {
                        targetContainer = document.getElementById('container-todo');
                    } else {
                        taskCard.remove();
                        updateColumnCountersAndProgress();
                        return;
                    }
                }
            } else if (data.action_type === 'status_changed') {
                if (taskCard.closest('#container-backlog')) return; // Ignore if in backlog

                let newStatus = null;
                if (msg.includes('changed status to Todo')) newStatus = 'todo';
                else if (msg.includes('changed status to In Progress') || msg.includes('changed status to In progress')) newStatus = 'in_progress';
                else if (msg.includes('changed status to Done')) newStatus = 'done';

                if (newStatus) {
                    targetContainer = document.getElementById(`container-${newStatus}`);
                }
            }

            if (targetContainer && !targetContainer.contains(taskCard)) {
                // Remove empty state from backlog if present
                const emptyState = targetContainer.querySelector('#empty-backlog');
                if (emptyState) emptyState.remove();

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
                updateColumnCountersAndProgress();
            }
        }
    }
});
</script>
</x-layouts.main-layout>
