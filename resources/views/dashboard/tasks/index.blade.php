<x-layouts.main-layout>
    <div class="max-w-container-max mx-auto">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-md mb-lg">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-1">My Tasks</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Manage and track your active productivity
                    pipeline.</p>
            </div>
            <a href="{{ route('dashboard.tasks.create') }}"
                class="flex items-center justify-center gap-sm px-md h-11 bg-primary-container text-on-primary font-label-md rounded-xl shadow-ambient hover:opacity-90 active:scale-95 transition-all">
                <span class="material-symbols-outlined">add</span>
                <span class="">Create Task</span>
            </a>
        </div>
        <!-- Filter Bar -->
        <div
            class="bg-surface-container-lowest rounded-xl p-sm shadow-ambient mb-md border border-outline-variant/30 flex items-center gap-sm">
            <!-- Tabs Container -->
            <div class="flex items-center justify-between w-full overflow-x-auto scrollbar-hide">
                <div class="flex items-center gap-xs flex-nowrap">
                    @foreach ($status_options as $option)
                        <a href="{{ route('dashboard.tasks.index', ['status' => $option['value']]) }}"
                            class="flex items-center justify-center px-4 py-2 rounded-full whitespace-nowrap transition-all
       {{ $status === $option['value'] ? 'bg-primary/10 text-primary font-bold' : 'text-on-surface-variant hover:bg-surface-container-high' }}">

                            {{ $option['label'] }} ({{ $option['count'] }})
                        </a>
                    @endforeach

                </div>
                <div class="flex items-center gap-sm ml-4">
                    <div class="w-[1px] h-6 bg-outline-variant/30 mx-2 hidden sm:block"></div>
                    <button
                        class="p-2 rounded-lg text-on-surface-variant hover:bg-surface-container-high transition-colors">
                        <span class="material-symbols-outlined text-body-md">search</span>
                    </button>
                    <button
                        class="p-2 rounded-lg text-on-surface-variant hover:bg-surface-container-high transition-colors">
                        <span class="material-symbols-outlined text-body-md">sort</span>
                    </button>
                    <button
                        class="p-2 rounded-lg text-on-surface-variant hover:bg-surface-container-high transition-colors">
                        <span class="material-symbols-outlined text-body-md">view_column</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Task List Container -->
        <div class="bg-white rounded-xl shadow-ambient overflow-hidden border border-outline-variant/30">
            <div class="overflow-x-auto scrollbar-hide">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low">
                        <tr>
                            <th class="px-md py-sm w-12">
                                <div class="flex items-center justify-center">
                                    <input
                                        class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary"
                                        type="checkbox" />
                                </div>
                            </th>
                            <th
                                class="px-md py-sm font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                                Task Name</th>
                            <th
                                class="px-md py-sm font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-md py-sm font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                                Priority</th>
                            <th
                                class="px-md py-sm font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">
                                Due Date</th>
                            <th class="px-md py-sm w-16"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @foreach ($tasks as $task)
                            <!-- Task Item 1 -->
                            <tr class="hover:bg-surface-container-lowest group transition-colors cursor-pointer">
                                <td class="px-md py-md">
                                    <div class="flex items-center justify-center">
                                        <input
                                            class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary cursor-pointer"
                                            type="checkbox" />
                                    </div>
                                </td>
                                <td class="px-md py-md">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-md text-label-md text-on-surface group-hover:text-primary transition-colors">
                                            {{ $task->title }}
                                        </span>

                                    </div>
                                </td>
                                <td class="px-md py-md">
                                    @if ($task->status == 'completed')
                                        <span
                                            class="inline-flex items-center px-sm py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-[11px] uppercase tracking-wide">
                                            Completed</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-sm py-1 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-[11px] uppercase tracking-wide">
                                            Not Completed</span>
                                    @endif
                                </td>
                                <td class="px-md py-md">
                                    <span
                                        class="inline-flex items-center gap-1 font-label-sm text-label-sm text-primary">
                                        <span class="material-symbols-outlined text-[14px]"
                                            data-weight="fill">flag</span>
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </td>
                                <td class="px-md py-md font-body-sm text-body-sm text-on-surface-variant">
                                    {{ $task->due_date }}
                                </td>
                                <td class="px-md py-md text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('dashboard.tasks.edit', $task->id) }}"
                                            class="p-2 rounded-lg text-outline hover:text-primary hover:bg-surface-container-high transition-all"
                                            title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                        <form action="{{ route('dashboard.tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="p-2 rounded-lg text-outline hover:text-error hover:bg-error-container/30 transition-all">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</x-layouts.main-layout>
