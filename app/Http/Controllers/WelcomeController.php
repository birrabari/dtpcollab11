<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;

class WelcomeController extends Controller
{
    public function index()
    {
        $totalAnggota = User::where('is_admin', false)->count();
        $totalIn      = Transaction::where('type', 'in')->sum('amount');
        $totalOut     = Transaction::where('type', 'out')->sum('amount');
        $saldo        = $totalIn - $totalOut;

        return view('welcome', compact('totalAnggota', 'saldo'));
    }
}
