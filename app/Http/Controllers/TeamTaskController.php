<?php

namespace App\Http\Controllers;

use App\Models\TeamTask;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamTaskController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $teams = $user->teams;
        $selectedTeamId = $request->input('team_id', $teams->first()->id ?? null);

        if ($teams->isEmpty()) {
            return view('team_tasks.index', [
                'teams' => $teams,
                'selectedTeamId' => $selectedTeamId,
                'teamTasks' => collect()
            ]);
        }

        $teamTasks = TeamTask::where('team_id', $selectedTeamId)
            ->where(function ($query) {
                $query->where('due_date', '>=', now())
                    ->orWhere('status', '!=', 'terminée');
            })
            ->orderBy('due_date', 'asc')
            ->get();

        return view('team_tasks.index', [
            'teams' => $teams,
            'selectedTeamId' => $selectedTeamId,
            'teamTasks' => $teamTasks
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $teams = $user->teams;

        return view('team_tasks.create', ['teams' => $teams]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'status' => 'required|string|in:en cours,terminée,expirée',
            'team_id' => 'required|exists:teams,id',
        ]);

        $validated['created_by'] = Auth::id();
        TeamTask::create($validated);

        return redirect()->route('team-tasks.index')->with('success', 'La tâche a été créée avec succès.');
    }

    public function edit($id)
    {
        $task = TeamTask::findOrFail($id);
        $user = Auth::user();
        $teams = $user->teams;

        return view('team_tasks.edit', [
            'task' => $task,
            'teams' => $teams
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'status' => 'required|string|in:en cours,terminée,expirée',
            'team_id' => 'required|exists:teams,id',
        ]);

        $task = TeamTask::findOrFail($id);
        $task->update($validated);

        return redirect()->route('team-tasks.index')->with('success', 'La tâche a été mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $task = TeamTask::findOrFail($id);
        $task->delete();

        return redirect()->route('team-tasks.index')->with('success', 'La tâche a été supprimée avec succès.');
    }

    public function markAsComplete($id)
    {
        $task = TeamTask::findOrFail($id);
        $task->update(['status' => 'terminée']);

        return redirect()->route('team-tasks.index')->with('success', 'La tâche a été marquée comme terminée.');
    }
}
