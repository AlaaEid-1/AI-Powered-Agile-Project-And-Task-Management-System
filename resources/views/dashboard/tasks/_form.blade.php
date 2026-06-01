    <form action="{{ $action ?? route('dashboard.tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($method ?? 'POST')
        <div class="mb-lg">
            <nav class="flex gap-sm items-center text-body-sm font-body-sm text-outline mb-base">
                <a class="hover:text-primary transition-colors" href="#">My Tasks</a>
                <span class="material-symbols-outlined text-[16px]" data-icon="chevron_right">chevron_right</span>
                <span class="text-on-surface">Add Task</span>
            </nav>
            <h2 class="font-headline-xl text-headline-xl text-on-surface">Create New Task</h2>
            <p class="text-body-md font-body-md text-on-surface-variant">Organize your workflow by adding a new
                objective to your list.</p>
        </div>
        <!-- Form Card -->
        <div
            class="bg-surface-container-lowest rounded-xl custom-shadow-low border border-outline-variant/30 overflow-hidden">
            <div class="p-md lg:p-lg grid grid-cols-1 lg:grid-cols-12 gap-lg">
                <!-- Left Column: Primary Details -->

                <div class="lg:col-span-8 flex flex-col gap-md">
                    <div class="flex flex-col gap-xs">
                        @if ($errors->any())
                    <div class="text-red-800 mb-4 border border-red-900 bg-red-300">
                        @foreach ($errors->all() as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                @endif
                        <label class="font-label-md text-label-md text-on-surface">Task Title</label>
                        <input name="title" value="{{ old('title', $task->title ?? '') }}"
                            class="w-full px-md py-sm rounded-xl border border-outline bg-white text-body-md font-body-md transition-all"
                            placeholder="e.g. Q4 Marketing Strategy Review" type="text">
                        @error('title')
                            <p class="text-red-800">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-xs">
                        <label class="font-label-md text-label-md text-on-surface">Description</label>
                        <textarea name="description"
                            class="w-full px-md py-sm rounded-xl border border-outline bg-white text-body-md font-body-md transition-all resize-none"
                            placeholder="Provide details about this task..." rows="6">{{ old('description', $task->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-red-800">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-xs">
                        <label class="font-label-md text-label-md text-on-surface">Attachments</label>
                        @error('cover')
                    @foreach ($errors->get('cover') as $error)
                    <p class="text-red-800">{{ $error }}</p>
                    @endforeach
                    @enderror
                        {{-- عرض الصورة الحالية (في حالة edit) --}}
                        @if (isset($task) && $task->cover_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $task->cover_image) }}"
                                    class="w-40 h-40 object-cover rounded-lg border" />
                            </div>
                        @endif

                        {{-- Upload box --}}
                        <label
                            class="border-2 border-dashed border-outline-variant rounded-xl p-lg flex flex-col items-center justify-center gap-base bg-surface hover:bg-surface-container transition-colors cursor-pointer group">

                            <input type="file" name="cover" class="hidden">

                            <span
                                class="material-symbols-outlined text-outline group-hover:text-primary transition-colors text-4xl">
                                cloud_upload
                            </span>

                            <div class="text-center">
                                <p class="font-label-md text-label-md text-on-surface">
                                    Click to upload or drag and drop
                                </p>
                                <p class="font-label-sm text-label-sm text-outline">
                                    PDF, JPG, PNG or DOCX (max. 10MB)
                                </p>
                            </div>
                        </label>
                    </div>
                </div>
                <!-- Right Column: Metadata & Controls -->
                <div class="lg:col-span-4 flex flex-col gap-md">
                    <div class="flex flex-col gap-xs">
                        <label class="font-label-md text-label-md text-on-surface">Due Date</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline"
                                data-icon="calendar_today">calendar_today</span>
                            <input name="due_date" type="date"
                                value="{{ old('due_date', isset($task->due_date) ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}">
                        </div>
                    </div>
                    <div class="flex flex-col gap-xs">
                        <label class="font-label-md text-label-md text-on-surface">Priority</label>
                        <div class="flex gap-xs p-xs bg-surface-container rounded-xl border border-outline-variant">
                            <label class="flex-1 cursor-pointer">
                                <input class="sr-only peer" name="priority" type="radio" value="low"
                                    @checked(old('priority', $task->priority ?? '') == 'low')>
                                <div
                                    class="text-center py-2 rounded-lg font-label-md text-label-md transition-all text-on-surface-variant peer-checked:bg-white peer-checked:text-primary peer-checked:shadow-sm">
                                    Low</div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input class="sr-only peer" name="priority" type="radio" value="medium"
                                    @checked(old('priority', $task->priority ?? '') == 'medium')>
                                <div
                                    class="text-center py-2 rounded-lg font-label-md text-label-md transition-all text-on-surface-variant peer-checked:bg-white peer-checked:text-primary peer-checked:shadow-sm">
                                    Medium</div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input class="sr-only peer" name="priority" type="radio" value="high"
                                    @checked(old('priority', $task->priority ?? '') == 'high')>
                                <div
                                    class="text-center py-2 rounded-lg font-label-md text-label-md transition-all text-on-surface-variant peer-checked:bg-white peer-checked:text-primary peer-checked:shadow-sm">
                                    High</div>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-xs">
                        <label class="font-label-md text-label-md text-on-surface">Status</label>
                        <div class="flex gap-xs p-xs bg-surface-container rounded-xl border border-outline-variant">
                            <label class="flex-1 cursor-pointer">
                                <input class="sr-only peer" name="status" type="radio" value="not_completed"
                                    @checked(old('status', $task->status ?? '') == 'not_completed')>
                                <div
                                    class="text-center py-2 rounded-lg font-label-md text-label-md transition-all text-on-surface-variant peer-checked:bg-white peer-checked:text-primary peer-checked:shadow-sm">
                                    Not Completed</div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input class="sr-only peer" name="status" type="radio" value="completed"
                                    @checked(old('status', $task->status ?? '') == 'completed')>
                                <div
                                    class="text-center py-2 rounded-lg font-label-md text-label-md transition-all text-on-surface-variant peer-checked:bg-white peer-checked:text-primary peer-checked:shadow-sm">
                                    Completed</div>
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-xs">
                        <label class="font-label-md text-label-md text-on-surface">Tags</label>
                        <div class="flex flex-wrap gap-xs mb-base">
                            <span
                                class="px-sm py-1 bg-secondary-container text-primary rounded-full font-label-sm text-label-sm flex items-center gap-xs">
                                Work <span class="material-symbols-outlined text-[14px] cursor-pointer"
                                    data-icon="close">close</span>
                            </span>
                            <span
                                class="px-sm py-1 bg-surface-variant text-on-surface-variant rounded-full font-label-sm text-label-sm flex items-center gap-xs">
                                Personal <span class="material-symbols-outlined text-[14px] cursor-pointer"
                                    data-icon="add">add</span>
                            </span>
                            <span
                                class="px-sm py-1 bg-surface-variant text-on-surface-variant rounded-full font-label-sm text-label-sm flex items-center gap-xs">
                                Shopping <span class="material-symbols-outlined text-[14px] cursor-pointer"
                                    data-icon="add">add</span>
                            </span>
                        </div>
                        <input
                            class="w-full px-md py-sm rounded-xl border border-outline bg-white text-body-sm font-body-sm"
                            placeholder="Add custom tag..." type="text">
                    </div>
                    <div class="mt-base p-md bg-surface-container-low rounded-xl border border-outline-variant/50">
                        <div class="flex items-start gap-sm">
                            <span class="material-symbols-outlined text-primary" data-icon="info">info</span>
                            <p class="text-body-sm font-body-sm text-on-surface-variant">
                                This task will be visible to your team members in the <span
                                    class="text-primary font-bold">Marketing</span> workspace.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Actions -->
            <div
                class="px-md py-base lg:px-lg lg:py-md bg-surface-container flex items-center justify-end gap-md border-t border-outline-variant">
                <button
                    class="px-lg h-11 rounded-xl font-label-md text-label-md text-primary bg-secondary-container hover:bg-secondary-container/80 active:scale-95 transition-all">
                    Cancel
                </button>
                <button
                    class="px-xl h-11 rounded-xl font-label-md text-label-md text-on-primary bg-primary hover:opacity-90 active:scale-95 transition-all shadow-md px-12">
                    Create Task
                </button>
            </div>
        </div>
    </form>
