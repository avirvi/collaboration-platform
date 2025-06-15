<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participation;
use App\Models\User;
use App\Models\Project;

class ParticipationController extends Controller
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
        if ($request->user()->cannot('create', Project::class)) {
            abort(403, 'You are not authorized to create a project.');
        }

        return view('projects.participation.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $rules = array(
            'username' => 'required|exists:users,username',
            'role' => '',
        );

        $request->validate($rules);

        $user_id = User::where('username', $request->username)->value('id');

        if (Participation::where('user_id', '=', $user_id, 'and', 'project_id', '=', $project->id)->exists()) {
            return back()->withErrors(['username' => 'User is already a participant.'])->withInput();
        }

        Participation::create([
            'user_id' => $user_id,
            'project_id' => $project->id,
            'user_project_role' => $request->role,
        ]);

        return redirect()->route('projects.show', $project->id)->with('susccess', 'User added successfully.');
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
    public function edit(Request $request, Project $project, Participation $participation)
    {
        if ($request->user()->cannot('update', $participation)) {
            abort(403, 'You are not authorized to edit this participant.');
        }

        return view('projects.participation.edit', compact('project', 'participation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Participation $participation)
    {
        if ($request->user()->cannot('update', $participation)) {
            abort(403, 'You are not authorized to edit this participant.');
        }

        $rules = array(
            'role' => 'required|string|in:participant,moderator'
        );

        $request->validate($rules);

        $participation->user_project_role = $request->role;
        $participation->save();

        return redirect()->route('projects.show', $project->id)->with('success', 'Participant updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Project $project, Participation $participation)
    {
        if ($request->user()->cannot('delete', $participation)) {
            abort(403, 'You are not authorized to delete this participant.');
        }
        $participation->delete();
        return redirect()->route('projects.show', $project)->with('success', 'Participant deleted successfully.');
    }
}
