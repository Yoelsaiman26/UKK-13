<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = null;
        $isStudent = false;
        $isAdmin = false;

        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $isAdmin = true;
        } elseif (Auth::guard('siswas')->check()) {
            $user = Auth::guard('siswas')->user();
            $isStudent = true;
        }

        return view('profile.index', compact('user', 'isStudent', 'isAdmin'));
    }

    public function update(Request $request)
    {
        // Only allow admin to update profile
        if (!Auth::guard('web')->check()) {
            return redirect()->route('profile.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengubah profil.');
        }

        $user = Auth::guard('web')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
