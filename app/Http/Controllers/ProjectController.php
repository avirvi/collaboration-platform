<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Project::class)) {
            abort(403, 'You are not authorized to create a project.');
        }

        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Project::class)) {
            abort(403, 'You are not authorized to create a project.');
        }

        $rules = array(
            'title' => 'required|min:3|max:60',
            'description',
        );

        $request->validate($rules);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        Participation::create([
            'user_id' => Auth::id(),
            'project_id' => $project->id,
            'user_project_role' => 'moderator',
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $project = Project::find($id);
        
        if ($request->user()->cannot('view', $project)) {
            abort(403, 'You are not authorized to view this project.');
        }
        
        $tasks = Task::where('project_id', $id);
        return view('projects.show', compact ('project', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Project $project)
    {
        if ($request->user()->cannot('update', $project)) {
            abort(403, 'You are not authorized to edit this project.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        if ($request->user()->cannot('update', $project)) {
            abort(403, 'You are not authorized to edit this project.');
        }

        $rules = array(
            'title' => 'required|min:3|max:60',
            'description' => '',
        );

        $request->validate($rules);

        $project->title = $request->title;
        $project->description = $request->description;
        $project->save();

        return redirect()->route('projects.show', $project->id)->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Project $project)
    {
        if ($request->user()->cannot('delete', $project)) {
            abort(403, 'You are not authorized to delete this project.');
        }
        $project->delete();
        return redirect()->route('dashboard.index')->with('success', 'Project deleted successfully.');
    }
}
