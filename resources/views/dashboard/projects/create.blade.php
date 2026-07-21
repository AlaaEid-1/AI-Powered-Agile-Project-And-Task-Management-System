<x-layouts.main-layout>

<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-1">
            <a href="{{ route('dashboard.projects.index') }}" class="hover:text-brand-600 transition-colors">Projects</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-slate-700 font-semibold">New Project</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create Project</h1>
        <p class="text-xs text-slate-500 mt-1">Set up a new workspace project to group tasks and sprints.</p>
    </div>

    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/90 shadow-soft-sm">
        <form method="POST" action="{{ route('dashboard.projects.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Project Title <span class="text-rose-500">*</span></label>
                <input type="text" name="title" required
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-medium"
                       placeholder="e.g. Mobile App Redesign 2026">
                @error('title')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Description</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all resize-none"
                          placeholder="Briefly describe the goals and scope of this project..."></textarea>
                @error('description')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                <a href="{{ route('dashboard.projects.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 transition-all">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-semibold text-white bg-brand-600 hover:bg-brand-700 shadow-sm shadow-brand-500/20 hover:shadow-md transition-all active:scale-[0.98]">
                    Create Project
                </button>
            </div>
        </form>
    </div>
</div>

</x-layouts.main-layout>

