<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $users = User::all();
        return view('admin.index', compact('teams', 'users'));
    }

    public function createTeam(Request $request)
    {
        $team = new Team();
        $team->name = $request->input('name');
        $team->save();
        return redirect()->route('admin.index')->with('success', 'Équipe créée avec succès');
    }

    public function addUserToTeam(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
        ]);
    
        $team = Team::find($request->team_id);
        $user = User::find($request->user_id);
    
        // Vérifiez si l'utilisateur est déjà dans l'équipe
        if (!$team->users->contains($user)) {
            $team->users()->attach($user);
            return redirect()->back()->with('success', 'Utilisateur ajouté à l\'équipe avec succès.');
        } else {
            return redirect()->back()->with('error', 'L\'utilisateur est déjà dans cette équipe.');
        }
    }
}