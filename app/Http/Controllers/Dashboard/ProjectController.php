<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', auth()->id())
            ->orWhereHas('users', fn($q) => $q->where('users.id', auth()->id()))
            ->latest()
            ->get();

        return view('dashboard.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('dashboard.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Attach owner to pivot table as well
        $project->users()->attach(auth()->id());

        return redirect()->route('dashboard.projects.index');
    }

    public function show(Project $project)
    {
        Gate::authorize('view', $project);

        $project->load(['users', 'user']);

        $tasks = $project->tasks()
            ->with(['user', 'sprint', 'latestActivity.user'])
            ->get()
            ->groupBy('status');

        return view('dashboard.projects.show', compact('project', 'tasks'));
    }

    public function addMember(Request $request, Project $project)
    {
        Gate::authorize('manageMembers', $project);

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User with this email was not found.']);
        }

        if ($project->hasMember($user)) {
            return back()->with('info', 'User is already a member of this project.');
        }

        $project->users()->syncWithoutDetaching([$user->id]);

        return back()->with('status', "User {$user->name} ({$user->email}) added to project members!");
    }

    public function removeMember(Project $project, User $user)
    {
        Gate::authorize('manageMembers', $project);

        if ($project->isOwner($user)) {
            return back()->withErrors(['member' => 'Cannot remove the project owner.']);
        }

        $project->users()->detach($user->id);

        return back()->with('status', "Member removed from project.");
    }
}
