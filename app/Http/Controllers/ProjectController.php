<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::query()
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('status', 'Project created.');
    }

    public function complete(Project $project): RedirectResponse
    {
        $project->update(['is_completed' => true]);

        return redirect()
            ->route('projects.index')
            ->with('status', 'Project marked as completed.');
    }
}
