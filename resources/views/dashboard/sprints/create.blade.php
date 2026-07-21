<x-layouts.main-layout>

<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-1">
            <a href="{{ route('dashboard.projects.sprints.index', $project) }}" class="hover:text-brand-600 transition-colors">Sprints</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-slate-700 font-semibold">New Sprint</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create Sprint</h1>
        <p class="text-xs text-slate-500 mt-1">Set up a new sprint cycle to manage team deliverables.</p>
    </div>

    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/90 shadow-soft-sm">
        <form method="POST" action="{{ route('dashboard.projects.sprints.store', $project) }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Sprint Name</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium"
                       placeholder="e.g. Sprint 1 - Launch MVP">
                @error('name')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Start Date</label>
                    <input type="date" name="start_date"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all">
                    @error('start_date')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">End Date</label>
                    <input type="date" name="end_date"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-xs font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all">
                    @error('end_date')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                <a href="{{ route('dashboard.projects.sprints.index', $project) }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-semibold text-white bg-brand-600 hover:bg-brand-700 shadow-sm shadow-brand-500/20 hover:shadow-md transition-all active:scale-[0.98]">
                    Create Sprint
                </button>
            </div>
        </form>
    </div>
</div>

</x-layouts.main-layout>

