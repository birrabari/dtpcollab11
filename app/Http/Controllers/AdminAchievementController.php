<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AdminAchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('year', 'desc')->get();
        return view('admin_achievements', compact('achievements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:4',
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
        ]);

        Achievement::create($request->all());

        return back()->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'year' => 'required|string|max:4',
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
        ]);

        $achievement->update($request->all());

        return back()->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return back()->with('success', 'Prestasi berhasil dihapus.');
    }
}
