<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AdminAttendanceController extends Controller
{
    public function show(Schedule $schedule)
    {
        $users = User::where('is_admin', false)->orderBy('name')->get();
        // Get existing attendance
        $attendances = Attendance::where('schedule_id', $schedule->id)->get()->keyBy('user_id');

        return view('admin_attendance', compact('schedule', 'users', 'attendances'));
    }

    public function store(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:hadir,sakit,izin,alpha',
        ]);

        foreach ($data['attendance'] as $userId => $status) {
            Attendance::updateOrCreate(
                ['schedule_id' => $schedule->id, 'user_id' => $userId],
                ['status' => $status]
            );
        }

        return back()->with('success', 'Data absensi berhasil disimpan!');
    }
}
