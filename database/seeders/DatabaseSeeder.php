<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Transaction;
use App\Models\CashPayment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin ──
        $admin = User::create([
            'name'     => 'Admin Ekskul',
            'email'    => 'admin@ekskul.id',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // ── Anggota / User ──
        $user1 = User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'user@ekskul.id',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        $user2 = User::create([
            'name'     => 'Siti Aminah',
            'email'    => 'siti@ekskul.id',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        $user3 = User::create([
            'name'     => 'Andi Pratama',
            'email'    => 'andi@ekskul.id',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // ── Riwayat Transaksi Kas ──
        $transactions = [
            ['type' => 'in',  'amount' => 25000,  'description' => 'Iuran Kas Bulanan — Budi Santoso',  'date' => '2026-05-05'],
            ['type' => 'in',  'amount' => 25000,  'description' => 'Iuran Kas Bulanan — Siti Aminah',   'date' => '2026-05-06'],
            ['type' => 'in',  'amount' => 25000,  'description' => 'Iuran Kas Bulanan — Andi Pratama',  'date' => '2026-05-07'],
            ['type' => 'out', 'amount' => 150000, 'description' => 'Pembelian Bola Basket Baru',         'date' => '2026-05-10'],
            ['type' => 'in',  'amount' => 350000, 'description' => 'Donasi Alumni Ekskul',              'date' => '2026-05-15'],
            ['type' => 'out', 'amount' => 50000,  'description' => 'Biaya Sewa Lapangan Tambahan',      'date' => '2026-05-20'],
            ['type' => 'in',  'amount' => 25000,  'description' => 'Iuran Kas Bulanan — Budi Santoso',  'date' => '2026-06-01'],
            ['type' => 'in',  'amount' => 25000,  'description' => 'Iuran Kas Bulanan — Siti Aminah',   'date' => '2026-06-02'],
            ['type' => 'out', 'amount' => 75000,  'description' => 'Pembelian Seragam Latihan',         'date' => '2026-06-05'],
        ];

        foreach ($transactions as $t) {
            Transaction::create($t);
        }

        // ── Sample Cash Payment Requests ──
        CashPayment::create([
            'user_id'     => $user1->id,
            'amount'      => 25000,
            'description' => 'Iuran Kas Bulan Juni 2026',
            'proof_image' => null,
            'status'      => 'pending',
            'date'        => '2026-06-08',
        ]);

        CashPayment::create([
            'user_id'     => $user2->id,
            'amount'      => 25000,
            'description' => 'Iuran Kas Bulan Juni 2026',
            'proof_image' => null,
            'status'      => 'approved',
            'date'        => '2026-06-07',
        ]);
    }
}
