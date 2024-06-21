<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Task;

class TeamController extends Controller
{
    public function index()
    {
        // Récupérer uniquement les tâches d'équipe
        $teamTasks = Task::where('team_id', auth()->user()->team_id)->get();
        return view('team.index', compact('teamTasks'));
    }

    public function create()
    {
        return view('team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'user_id' => auth()->user()->id,
            'team_id' => auth()->user()->team_id,
            'created_by' => auth()->user()->id,
        ]);

        return redirect()->route('team.index')->with('success', 'Tâche créée avec succès.');
    }

    public function addUser(Request $request)
    {
        // Logique pour ajouter un utilisateur à une équipe
    }
}