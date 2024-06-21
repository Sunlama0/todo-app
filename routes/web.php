<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamTaskController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/team-tasks', [TeamController::class, 'index'])->name('team.index');
    Route::get('/team-tasks/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('/team-tasks', [TeamController::class, 'store'])->name('team.store');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/teams', [AdminController::class, 'createTeam'])->name('admin.createTeam');
    Route::post('/admin/teams/{teamId}/add-user', [AdminController::class, 'addUserToTeam'])->name('admin.addUserToTeam');
    
    // Routes pour le profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::resource('team-tasks', TeamTaskController::class);
});

Route::prefix('team_tasks')->middleware(['auth'])->group(function () {
    Route::get('/', [TeamTaskController::class, 'index'])->name('team_tasks.index');
    Route::get('/create', [TeamTaskController::class, 'create'])->name('team_tasks.create');
    Route::post('/', [TeamTaskController::class, 'store'])->name('team_tasks.store');
    Route::get('/{teamTask}/edit', [TeamTaskController::class, 'edit'])->name('team_tasks.edit');
    Route::put('/{teamTask}', [TeamTaskController::class, 'update'])->name('team_tasks.update');
    Route::put('team-tasks/{id}/complete', [TeamTaskController::class, 'markAsComplete'])->name('team-tasks.complete');
    Route::delete('/{teamTask}', [TeamTaskController::class, 'destroy'])->name('team_tasks.destroy');
});
