<x-layout title="Laporan Keuangan — Ekskul Basket" cssFile="keuangan">
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
                <h2>Riwayat Transaksi Kas</h2>
                <span class="section-badge">{{ $transactions->count() }} transaksi</span>
            </div>

            @if($transactions->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <p>Belum ada data transaksi.</p>
                </div>
            @else
            <div class="trx-table-wrap">
                <table class="trx-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                            <th style="text-align:right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $trx)
                        <tr>
                            <td class="trx-date">{{ $trx->date->format('d M Y') }}</td>
                            <td class="trx-desc">{{ $trx->description }}</td>
                            <td>
                                <span class="trx-badge {{ $trx->type === 'in' ? 'badge-in' : 'badge-out' }}">
                                    {{ $trx->type === 'in' ? '▲ Masuk' : '▼ Keluar' }}
                                </span>
                            </td>
                            <td class="trx-amount {{ $trx->type === 'in' ? 'amount-in' : 'amount-out' }}">
                                {{ $trx->type === 'in' ? '+' : '-' }} Rp {{ number_format($trx->amount, 0, ',', '.') }}
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
