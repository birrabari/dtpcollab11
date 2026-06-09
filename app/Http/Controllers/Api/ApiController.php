<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Get all events
     */
    public function getEvents()
    {
        $events = Event::orderBy('date', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Daftar jadwal kegiatan berhasil diambil',
            'data' => $events
        ]);
    }

    /**
     * Get all achievements
     */
    public function getAchievements()
    {
        $achievements = Achievement::orderBy('date', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Daftar prestasi berhasil diambil',
            'data' => $achievements
        ]);
    }

    /**
     * Get all members
     */
    public function getMembers()
    {
        $members = User::where('is_admin', false)
            ->select('id', 'name', 'kelas', 'posisi', 'no_punggung', 'created_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar anggota tim berhasil diambil',
            'data' => $members
        ]);
    }
}
