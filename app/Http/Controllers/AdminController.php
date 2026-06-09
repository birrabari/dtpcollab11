<?php

namespace App\Http\Controllers;

use App\Models\CashPayment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $pendingPayments = CashPayment::with('user')->where('status', 'pending')->latest('date')->get();
        $historyPayments = CashPayment::with('user')->where('status', '!=', 'pending')->latest('date')->limit(20)->get();

        return view('admin', compact('pendingPayments', 'historyPayments'));
    }

    public function approve(Request $request, CashPayment $payment)
    {
        if ($payment->status !== 'pending') {
            return back()->with('error', 'Pembayaran ini sudah diproses sebelumnya.');
        }

        $payment->update([
            'status' => 'approved',
            'admin_note' => $request->admin_note,
        ]);

        // Tambahkan ke kas (Transaction)
        Transaction::create([
            'type'        => 'in',
            'amount'      => $payment->amount,
            'description' => 'Pembayaran Kas dari ' . $payment->user->name . ' (' . $payment->description . ')',
            'date'        => now(),
        ]);

        return back()->with('success', 'Pembayaran berhasil disetujui. Saldo kas tim bertambah.');
    }

    public function reject(Request $request, CashPayment $payment)
    {
        if ($payment->status !== 'pending') {
            return back()->with('error', 'Pembayaran ini sudah diproses sebelumnya.');
        }

        $payment->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note,
        ]);

        return back()->with('success', 'Pembayaran ditolak.');
    }

    public function storeExpense(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Transaction::create([
            'type'        => 'out',
            'amount'      => $request->amount,
            'description' => 'Pengeluaran: ' . $request->description,
            'date'        => $request->date,
        ]);

        return back()->with('success', 'Pengeluaran berhasil dicatat. Saldo kas tim berkurang.');
    }

    public function schedules()
    {
        $schedules = \App\Models\Schedule::all();
        $events = \App\Models\Event::orderBy('event_date', 'asc')->get();
        return view('admin_schedule', compact('schedules', 'events'));
    }

    public function toggleSchedule(\App\Models\Schedule $schedule)
    {
        if ($schedule->status === 'active') {
            $schedule->update(['status' => 'holiday']);
        } elseif ($schedule->status === 'holiday') {
            $schedule->update(['status' => 'active']);
        }
        
        return back()->with('success', 'Status jadwal berhasil diubah.');
    }

    public function storeSchedule(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'day_info' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        \App\Models\Schedule::create($request->all());

        return back()->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function updateSchedule(Request $request, \App\Models\Schedule $schedule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'day_info' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $schedule->update($request->all());

        return back()->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroySchedule(\App\Models\Schedule $schedule)
    {
        $schedule->delete();

        return back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
