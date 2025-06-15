<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;

class TaskController extends Controller
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
    public function create(Request $request, Project $project)
    {
        if ($request->user()->cannot('create', [Task::class, $project])) {
            abort(403, 'You are not authorized to create a project.');
        }

        $statuses = TaskStatus::all();
        $participants = DB::table('participations')->leftJoin('users', function ($join) {
            $join->on('participations.user_id', '=', 'users.id');
        })->where('participations.project_id', '=', $project->id)->get();

        return view('projects.tasks.create', compact('statuses', 'participants', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        if ($request->user()->cannot('create', [Task::class, $project])) {
            abort(403, 'You are not authorized to create a task in this project.');
        }

        $rules = array(
            'title' => 'required|min:3|max:60',
            'deadline' => 'required|date',
            'status' => 'required',
            'responsible_person' => 'nullable',
        );

        $request->validate($rules);

        $task = Task::create([
            'title' => $request->title,
            'deadline' => $request->deadline,
            'status_id' => $request->status,
            'responsible_person' => $request->responsible_person,
            'project_id' => $project->id,
        ]);

        return redirect()->route('projects.show', $project->id)->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Project $project, Task $task)
    {
        if ($request->user()->cannot('update', $project)) {
            abort(403, 'You are not authorized to edit this task.');
        }

        $statuses = TaskStatus::all();
        $participants = DB::table('participations')->leftJoin('users', function ($join) {
            $join->on('participations.user_id', '=', 'users.id');
        })->where('participations.project_id', '=', $project->id)->get();

        return view('projects.tasks.edit', compact('project', 'task', 'statuses', 'participants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        if ($request->user()->cannot('update', $project)) {
            abort(403, 'You are not authorized to edit this task.');
        }

        $rules = array(
            'title' => 'required|min:3|max:60',
            'deadline' => 'required|date',
            'status_id' => 'required',
            'responsible_person' => 'nullable',
        );

        $request->validate($rules);

        $task->title = $request->title;
        $task->deadline = $request->deadline;
        $task->status_id = $request->status_id;
        $task->responsible_person = $request->responsible_person;
        $task->save();

        return redirect()->route('projects.show', $project->id)->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Project $project, Task $task)
    {
        if ($request->user()->cannot('delete', $project)) {
            abort(403, 'You are not authorized to delete this project.');
        }
        $task->delete();
        return redirect()->route('projects.show', $project)->with('success', 'Project deleted successfully.');
    }
}
