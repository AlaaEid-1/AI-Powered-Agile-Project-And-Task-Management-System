@props(['project'])

<div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-0.5 rounded-2xl mb-6 shadow-soft-sm">
    <div class="bg-white rounded-2xl p-5 h-full">
        <div class="flex items-center gap-2 mb-3">
            <span class="text-xl">✨</span>
            <h2 class="text-lg font-bold text-slate-800">AI Sprint Planner</h2>
        </div>
        
        @if($errors->has('ai_error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl mb-4 text-sm font-medium">
                {{ $errors->first('ai_error') }}
            </div>
        @endif

        <form action="{{ route('dashboard.projects.ai.generate', $project) }}" method="POST" class="space-y-3">
            @csrf
            <textarea name="prompt" rows="3" required
                      class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 resize-none transition-all"
                      placeholder="Describe your Feature / Use Case / Idea..."></textarea>
            
            <div class="flex justify-end">
                <button type="submit" 
                        onclick="if(this.form.checkValidity()) { this.innerHTML = '<span class=\'material-symbols-outlined text-[18px] animate-spin\'>progress_activity</span> Generating...'; this.classList.add('opacity-75', 'pointer-events-none'); }"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-sm transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">auto_awesome</span>
                    Generate with AI
                </button>
            </div>
        </form>
    </div>
</div>
