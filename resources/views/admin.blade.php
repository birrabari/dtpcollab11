<x-layout title="Panel Admin — basketin" cssFile="admin">
<div class="admin-wrapper">
    <div class="admin-header">
        <span class="page-eyebrow">🛡️ Panel Admin</span>
        <h1 class="admin-title">Kelola Pembayaran</h1>
        <p class="admin-subtitle">Konfirmasi pembayaran kas dari anggota sebelum dimasukkan ke saldo kas tim.</p>
    </div>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert-error">
        {{ session('error') }}
    </div>
    @endif

    <div class="admin-content">
        {{-- SECTION: PENDING --}}
        <div class="admin-card">
            <h2 class="admin-card-title">⏳ Menunggu Konfirmasi</h2>
            
            @if($pendingPayments->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">✅</div>
                    <p>Tidak ada pembayaran yang menunggu konfirmasi.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Anggota</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                                <th>Metode</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingPayments as $p)
                            <tr>
                                <td>{{ $p->date->format('d M Y') }}</td>
                                <td><strong>{{ $p->user->name }}</strong></td>
                                <td>{{ $p->description }}</td>
                                <td>Rp {{ number_format($p->amount, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-method">{{ strtoupper($p->payment_method) }}</span>
                                </td>
                                <td>
                                    @if($p->proof_image)
                                        <a href="{{ asset($p->proof_image) }}" target="_blank" style="color:var(--color-accent); font-weight:bold; text-decoration:underline;">Lihat Bukti</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <form action="{{ route('admin.approve', $p->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-approve" onclick="return confirm('Terima pembayaran ini?')">Terima</button>
                                        </form>
                                        <form action="{{ route('admin.reject', $p->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-reject" onclick="return confirm('Tolak pembayaran ini?')">Tolak</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- SECTION: HISTORY --}}
        <div class="admin-card mt-24">
            <h2 class="admin-card-title">📜 Riwayat Terakhir</h2>
            
            @if($historyPayments->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <p>Belum ada riwayat diproses.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Anggota</th>
                                <th>Nominal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historyPayments as $p)
                            <tr>
                                <td>{{ $p->date->format('d M Y') }}</td>
                                <td>{{ $p->user->name }}</td>
                                <td>Rp {{ number_format($p->amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($p->status === 'approved')
                                        <span class="badge badge-success">DITERIMA</span>
                                    @else
                                        <span class="badge badge-danger">DITOLAK</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- SECTION: PENGELUARAN --}}
        <div class="admin-card mt-24" style="margin-bottom: 24px;">
            <h2 class="admin-card-title">💸 Catat Pengeluaran Kas</h2>
            <p style="color:var(--text-secondary); margin-bottom:16px; font-weight:600;">Gunakan form ini jika ada pemakaian dana kas, otomatis akan memotong Total Kas.</p>
            <form action="{{ route('admin.expenses.store') }}" method="POST" style="display:flex; gap:16px; align-items:flex-end; flex-wrap:wrap;">
                @csrf
                <div class="form-group" style="flex:1; min-width:150px; margin-bottom:0;">
                    <label>Tanggal</label>
                    <input type="date" name="date" required value="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group" style="flex:2; min-width:200px; margin-bottom:0;">
                    <label>Keterangan (Untuk apa?)</label>
                    <input type="text" name="description" placeholder="Contoh: Beli Bola Basket" required>
                </div>
                <div class="form-group" style="flex:1; min-width:150px; margin-bottom:0;">
                    <label>Nominal (Rp)</label>
                    <input type="number" name="amount" placeholder="150000" required min="1000">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <button type="submit" class="btn-primary" style="background:#ef4444; margin:0;">Catat Pengeluaran</button>
                </div>
            </form>
        </div>

    </div>
</div>
</x-layout>
