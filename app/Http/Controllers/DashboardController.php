<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TeamTask;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Nombre de tâches personnelles
        $personalTasksCount = Task::where('user_id', $userId)->count();

        // Nombre de tâches d'équipe
        $teamTasksCount = TeamTask::whereHas('team', function ($query) use ($userId) {
            $query->whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            });
        })->count();

        // Nombre de tâches en attente personnelles
        $pendingPersonalTasksCount = Task::where('user_id', $userId)->where('status', 'en cours')->count();

        // Nombre de tâches en attente d'équipe
        $pendingTeamTasksCount = TeamTask::whereHas('team', function ($query) use ($userId) {
            $query->whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            });
        })->where('status', 'en cours')->count();

        return view('dashboard', compact(
            'personalTasksCount',
            'teamTasksCount',
            'pendingPersonalTasksCount',
            'pendingTeamTasksCount'
        ));
    }
}
