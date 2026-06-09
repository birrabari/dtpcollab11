<?php

namespace App\Http\Controllers;

use App\Models\User;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota      = User::where('is_admin', false)->orderBy('name')->get();
        $totalAnggota = $anggota->count();

        return view('anggota', compact('anggota', 'totalAnggota'));
    }
}
