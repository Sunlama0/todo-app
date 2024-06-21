<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $personalTasks = Task::where('user_id', $user->id)->get(); // Récupérer les tâches personnelles
        return view('tasks.index', compact('personalTasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $task = new Task($request->all());
        $task->created_by = Auth::id();
        $task->user_id = Auth::id();
        $task->save();

        if ($request->has('users')) {
            $task->users()->sync($request->input('users'));
        }

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());

        if ($request->has('users')) {
            $task->users()->sync($request->input('users'));
        }

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}