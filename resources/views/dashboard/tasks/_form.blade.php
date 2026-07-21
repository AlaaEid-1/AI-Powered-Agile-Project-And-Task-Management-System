<form action="{{ $action ?? route('dashboard.projects.tasks.store', $project) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method ?? 'POST')

    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-1">
            <a class="hover:text-brand-600 transition-colors" href="{{ route('dashboard.projects.tasks.index', $project) }}">Tasks</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-slate-700 font-semibold">{{ isset($task) && $task->id ? 'Edit Task' : 'Create Task' }}</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
            {{ isset($task) && $task->id ? 'Edit Task #' . $task->id : 'Create New Task' }}
        </h1>
        <p class="text-xs text-slate-500 mt-1">
            Fill in the objective details, attach cover images, and set priorities.
        </p>
    </div>

    <!-- Error Validation Summary -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200/80 text-rose-800 text-xs flex flex-col gap-1">
            <div class="font-bold flex items-center gap-1.5 text-rose-900">
                <span class="material-symbols-outlined text-[18px]">error</span>
                <span>Please fix the following errors:</span>
            </div>
            <ul class="list-disc list-inside pl-2 space-y-0.5">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Main Card -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-soft-sm overflow-hidden p-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left Column: Title, Description, Attachments -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Title Input -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Task Title <span class="text-rose-500">*</span>
                    </label>
                    <input name="title"
                           value="{{ old('title', $task->title ?? '') }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium"
                           placeholder="e.g. Redesign Landing Page Dashboard"
                           type="text" required>
                    @error('title')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Textarea -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Description
                    </label>
                    <textarea name="description"
                              rows="5"
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all resize-none"
                              placeholder="Add detailed description, acceptance criteria, or links...">{{ old('description', $task->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover / Attachment Dropzone -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Cover Image / Attachment
                    </label>

                    @if (isset($task) && $task->cover_image)
                        <div class="mb-3 relative group inline-block">
                            <img src="{{ asset('storage/' . $task->cover_image) }}" class="w-48 h-32 object-cover rounded-xl border border-slate-200 shadow-soft-xs" />
                            <span class="absolute top-2 left-2 bg-slate-900/70 text-white text-[10px] px-2 py-0.5 rounded-full backdrop-blur-xs">Current Image</span>
                        </div>
                    @endif

                    <label class="border-2 border-dashed border-slate-200 hover:border-brand-500 rounded-2xl p-6 flex flex-col items-center justify-center gap-2 bg-slate-50/50 hover:bg-brand-50/30 transition-all cursor-pointer group text-center">
                        <input type="file" name="cover" class="hidden" onchange="previewFileName(this)">
                        <div class="w-12 h-12 rounded-xl bg-white text-slate-400 group-hover:text-brand-600 flex items-center justify-center shadow-soft-xs border border-slate-200 transition-colors">
                            <span class="material-symbols-outlined text-[26px]">cloud_upload</span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-700 group-hover:text-brand-600 transition-colors" id="file-label-text">
                                Click to upload cover image or drag file here
                            </p>
                            <p class="text-[11px] text-slate-400 mt-0.5">
                                JPG, PNG, WEBP or GIF (Max 10MB)
                            </p>
                        </div>
                    </label>
                    @error('cover')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column: Priority, Status, Due Date -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Priority Segmented Radio Controls -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Priority
                    </label>
                    <div class="grid grid-cols-3 gap-1.5 p-1.5 bg-slate-100/80 rounded-xl border border-slate-200/80">
                        <label class="cursor-pointer">
                            <input class="sr-only peer" name="priority" type="radio" value="low"
                                @checked(old('priority', $task->priority ?? 'low') == 'low')>
                            <div class="text-center py-2 rounded-lg text-xs font-semibold text-slate-600 peer-checked:bg-white peer-checked:text-brand-600 peer-checked:shadow-soft-xs transition-all">
                                Low
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input class="sr-only peer" name="priority" type="radio" value="medium"
                                @checked(old('priority', $task->priority ?? 'medium') == 'medium')>
                            <div class="text-center py-2 rounded-lg text-xs font-semibold text-slate-600 peer-checked:bg-white peer-checked:text-amber-600 peer-checked:shadow-soft-xs transition-all">
                                Medium
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input class="sr-only peer" name="priority" type="radio" value="high"
                                @checked(old('priority', $task->priority ?? '') == 'high')>
                            <div class="text-center py-2 rounded-lg text-xs font-semibold text-slate-600 peer-checked:bg-white peer-checked:text-rose-600 peer-checked:shadow-soft-xs transition-all">
                                High
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Status Segmented Radio Controls -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Status
                    </label>
                    <div class="grid grid-cols-3 gap-1.5 p-1.5 bg-slate-100/80 rounded-xl border border-slate-200/80">
                        <label class="cursor-pointer">
                            <input class="sr-only peer" name="status" type="radio" value="todo"
                                @checked(old('status', $task->status ?? 'todo') == 'todo')>
                            <div class="text-center py-2 rounded-lg text-xs font-semibold text-slate-600 peer-checked:bg-white peer-checked:text-slate-800 peer-checked:shadow-soft-xs transition-all">
                                Todo
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input class="sr-only peer" name="status" type="radio" value="in_progress"
                                @checked(old('status', $task->status ?? '') == 'in_progress')>
                            <div class="text-center py-2 rounded-lg text-xs font-semibold text-slate-600 peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-soft-xs transition-all">
                                In Prog
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input class="sr-only peer" name="status" type="radio" value="done"
                                @checked(old('status', $task->status ?? '') == 'done')>
                            <div class="text-center py-2 rounded-lg text-xs font-semibold text-slate-600 peer-checked:bg-white peer-checked:text-emerald-600 peer-checked:shadow-soft-xs transition-all">
                                Done
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Sprint Assignment Dropdown -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Assign to Sprint
                    </label>
                    <select name="sprint_id"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all">
                        <option value="">Product Backlog (Unassigned)</option>
                        @if(isset($project) && $project->sprints)
                            @foreach($project->sprints as $sprintOption)
                                <option value="{{ $sprintOption->id }}" @selected(old('sprint_id', $task->sprint_id ?? '') == $sprintOption->id)>
                                    {{ $sprintOption->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('sprint_id')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Due Date Picker -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Due Date
                    </label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">calendar_today</span>
                        <input name="due_date" type="date"
                               value="{{ old('due_date', isset($task->due_date) ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all">
                    </div>
                </div>

                <!-- Info Box -->
                <div class="p-4 bg-indigo-50/60 rounded-xl border border-indigo-100 text-xs text-indigo-900 flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-brand-600 text-[18px] shrink-0 mt-0.5">info</span>
                    <p class="leading-relaxed">
                        This task will belong to <strong>{{ $project->title }}</strong>. You can move it between Sprints and Backlog on the Sprint board.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Actions Footer -->
        <div class="mt-8 pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('dashboard.projects.tasks.index', $project) }}"
               class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition-all">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2.5 rounded-xl text-xs font-semibold text-white bg-brand-600 hover:bg-brand-700 shadow-sm shadow-brand-500/20 hover:shadow-md transition-all active:scale-[0.98]">
                {{ isset($task) && $task->id ? 'Update Task' : 'Create Task' }}
            </button>
        </div>
    </div>
</form>

<script>
function previewFileName(input) {
    if (input.files && input.files[0]) {
        const text = document.getElementById('file-label-text');
        if (text) {
            text.textContent = 'Selected: ' + input.files[0].name;
        }
    }
}
</script>

