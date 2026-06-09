<?php

namespace App\Http\Controllers;

use App\Models\CashPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashPaymentController extends Controller
{
    public function index()
    {
        $payments = Auth::user()->cashPayments()->latest()->get();
        return view('bayar_kas', compact('payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount'      => ['required', 'numeric', 'min:1000'],
            'description' => ['required', 'string', 'max:255'],
            'date'        => ['required', 'date'],
            'proof_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ], [
            'amount.min'          => 'Nominal minimal Rp 1.000.',
            'proof_image.image'   => 'File harus berupa gambar.',
            'proof_image.max'     => 'Ukuran gambar maksimal 3MB.',
        ]);

        $proofPath = null;
        if ($request->hasFile('proof_image')) {
            $file     = $request->file('proof_image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/proofs'), $filename);
            $proofPath = 'uploads/proofs/' . $filename;
        }

        CashPayment::create([
            'user_id'        => Auth::id(),
            'amount'         => $request->amount,
            'description'    => $request->description,
            'payment_method' => $request->payment_method ?? 'qris',
            'date'           => $request->date,
            'proof_image'    => $proofPath,
            'status'         => 'pending',
        ]);

        return redirect()->route('bayar-kas.index')
            ->with('success', '✅ Konfirmasi berhasil! Admin akan mengecek mutasi rekening dalam 1×24 jam.');
    }
}
