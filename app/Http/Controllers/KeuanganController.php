<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class KeuanganController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest('date')->get();
        $totalIn      = Transaction::where('type', 'in')->sum('amount');
        $totalOut     = Transaction::where('type', 'out')->sum('amount');
        $saldo        = $totalIn - $totalOut;

        return view('keuangan', compact('transactions', 'totalIn', 'totalOut', 'saldo'));
    }
}
