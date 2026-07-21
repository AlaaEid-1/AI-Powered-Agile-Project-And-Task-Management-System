<div class="bg-white p-4 rounded-xl shadow border">

    <h2 class="font-bold text-lg">
        {{ $sprint->name }}
    </h2>

    <p class="text-sm text-gray-500 mt-1">
        Tasks: {{ $sprint->tasks_count }}
    </p>

    <p class="text-xs text-gray-400 mt-2">
        {{ $sprint->start_date }} → {{ $sprint->end_date }}
    </p>

    <a href="{{ route('dashboard.projects.sprints.show', [$project, $sprint]) }}"
       class="text-blue-600 text-sm mt-3 inline-block">
        Open Sprint →
    </a>

</div>
