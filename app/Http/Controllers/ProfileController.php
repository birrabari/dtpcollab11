<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'posisi' => 'nullable|string|max:50',
            'no_punggung' => 'nullable|integer|min:0|max:99',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'kelas' => $request->kelas,
            'posisi' => $request->posisi,
            'no_punggung' => $request->no_punggung,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
