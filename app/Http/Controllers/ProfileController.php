<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        Log::info('Update profile request received.');

        $request->validate([
            'username' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'organization_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone_number' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $user->username = $request->input('username');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->organization_name = $request->input('organization_name');
        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->birthday = $request->input('birthday');

        if ($request->hasFile('logo')) {
            Log::info('Logo uploaded.');

            if ($user->logo) {
                Log::info('Deleting old logo: ' . $user->logo);
                Storage::disk('public')->delete($user->logo);
            }

            $path = $request->file('logo')->store('profile_logos', 'public');
            Log::info('New logo path: ' . $path);
            $user->logo = $path;
        } else {
            Log::info('No logo uploaded.');
        }

        $user->save();
        Log::info('User profile updated: ' . $user->toJson());

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }
}
