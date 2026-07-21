@auth('web')
@isset($project)
<a href="{{ route('dashboard.projects.tasks.create', $project) }}"
    class="ml-2 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-ui-button text-ui-button hover:opacity-90 active:scale-95 transition-all">
    Create tasks
</a>
@endisset
<div class="ml-2 flex items-center gap-2">
    <div class="w-8 h-8 rounded-full overflow-hidden border border-outline-variant cursor-pointer">
        <img alt="User Avatar" class="w-full h-full object-cover"
            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" />
    </div>
    <a href="{{ route('logout') }}" class="text-xs font-medium"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</div>
@else
<a href="{{ route('login') }}"
    class="ml-2 bg-primary-container text-on-primary px-6 py-2 rounded-lg font-ui-button text-ui-button hover:opacity-90 active:scale-95 transition-all">
    Login
</a>
@endauth
