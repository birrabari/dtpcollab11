<x-layout title="Laporan Keuangan — Basketin" cssFile="keuangan">
<div class="finance-wrapper">

    {{-- HEADER --}}
    <div class="finance-hero">
        <div class="fhero-content">
            <span class="fhero-subtitle">Laporan Keuangan Tim</span>
            <h1 class="fhero-title">Kas Basket</h1>
            <div class="finance-stats">
                <div class="fstat-box">
                    <div class="fstat-label">💰 Saldo Kas Saat Ini</div>
                    <div class="fstat-value {{ $saldo >= 0 ? '' : 'negative' }}">
                        Rp {{ number_format($saldo, 0, ',', '.') }}
                    </div>
                </div>
                <div class="fstat-box">
                    <div class="fstat-label">📈 Total Pemasukan</div>
                    <div class="fstat-value positive">Rp {{ number_format($totalIn, 0, ',', '.') }}</div>
                </div>
                <div class="fstat-box">
                    <div class="fstat-label">📉 Total Pengeluaran</div>
                    <div class="fstat-value outval">Rp {{ number_format($totalOut, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="finance-content-full">

        {{-- TRANSAKSI TABLE --}}
        <div class="finance-section">
            <div class="section-header">
                <h2>Riwayat Transaksi QRIS</h2>
                <span class="section-badge">{{ $qrisPayments->count() }} transaksi</span>
            </div>

            @if($qrisPayments->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <p>Belum ada data transaksi QRIS.</p>
                </div>
            @else
            <div class="trx-table-wrap">
                <table class="trx-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Anggota</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th style="text-align:right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($qrisPayments as $trx)
                        <tr>
                            <td class="trx-date">{{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</td>
                            <td><strong>{{ $trx->user->name }}</strong></td>
                            <td class="trx-desc">{{ $trx->description }}</td>
                            <td>
                                @if($trx->status === 'approved')
                                    <span class="trx-badge badge-in">Disetujui</span>
                                @elseif($trx->status === 'pending')
                                    <span class="trx-badge" style="background:#fef08a; color:#854d0e;">Menunggu</span>
                                @else
                                    <span class="trx-badge badge-out">Ditolak</span>
                                @endif
                            </td>
                            <td class="trx-amount amount-in">
                                Rp {{ number_format($trx->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

        {{-- QUICK LINKS --}}
        <div class="finance-action-bar">
            <a href="/bayar-kas" class="btn-primary-home">
                💳 Kirim Pembayaran Kas
            </a>
            <p style="font-size:14px;color:var(--color-text-muted);margin-top:12px;">
                Ingin membayar iuran? Klik tombol di atas untuk mengirim bukti pembayaran ke admin.
            </p>
        </div>

    </div>
</div>
</x-layout>
