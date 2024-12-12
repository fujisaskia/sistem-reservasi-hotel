<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'nationality' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'identification_type' => 'nullable|string|max:50',
            'identification_number' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        $user->update($request->all());

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
