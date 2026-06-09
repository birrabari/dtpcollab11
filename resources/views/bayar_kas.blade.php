<x-layout title="Bayar Kas — Ekskul Basket" cssFile="bayar_kas">
<div class="bayar-wrapper">

    {{-- HEADER --}}
    <div class="bayar-hero">
        <div class="bayar-hero-inner">
            <span class="page-eyebrow">💳 Pembayaran Kas</span>
            <h1 class="bayar-title">Kirim Pembayaran</h1>
            <p class="bayar-subtitle">Upload bukti pembayaran Anda dan admin akan memverifikasi dalam 1×24 jam.</p>
        </div>
    </div>

    <div class="bayar-content">

        {{-- LEFT: FORM --}}
        <div class="bayar-form-col">
            <div class="form-card">
                <h2 class="form-card-title">Form Pembayaran Kas</h2>

                @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert-error-box">
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin-top:8px;padding-left:20px;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('bayar-kas.store') }}" method="POST" enctype="multipart/form-data" class="bayar-form">
                    @csrf

                    <div class="field-group">
                        <label class="field-label">Nominal Pembayaran (Rp)</label>
                        <input type="number" name="amount" class="field-input" placeholder="Contoh: 25000"
                               value="{{ old('amount') }}" required min="1000">
                    </div>

                    <div class="field-group">
                        <label class="field-label">Keterangan</label>
                        <input type="text" name="description" class="field-input"
                               placeholder="Contoh: Iuran Kas Bulan Juni 2025"
                               value="{{ old('description') }}" required>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Metode Pembayaran</label>
                        <div class="method-toggle">
                            <label class="method-opt">
                                <input type="radio" name="payment_method" value="qris" checked>
                                <span class="method-btn">📱 QRIS</span>
                            </label>
                            <label class="method-opt">
                                <input type="radio" name="payment_method" value="cash">
                                <span class="method-btn">💵 Tunai (Cash)</span>
                            </label>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Tanggal Pembayaran</label>
                        <input type="date" name="date" class="field-input"
                               value="{{ old('date', date('Y-m-d')) }}" required>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Upload Bukti Transfer / Foto</label>
                        <div class="upload-area" id="uploadArea">
                            <input type="file" name="proof_image" id="proofFile"
                                   accept="image/jpg,image/jpeg,image/png,image/webp" required
                                   class="upload-input" onchange="previewImage(this)">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <div class="upload-icon">📎</div>
                                <div class="upload-text">Klik atau seret foto bukti transfer di sini</div>
                                <div class="upload-hint">JPG, PNG, WEBP — Maks 3MB</div>
                            </div>
                            <img id="previewImg" src="" alt="" style="display:none;width:100%;border-radius:8px;max-height:200px;object-fit:contain;">
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        📤 Kirim Pembayaran ke Admin
                    </button>
                </form>
            </div>

            {{-- QRIS INFO --}}
            <div class="qris-card">
                <h3>Bayar via QRIS</h3>
                <div class="qris-box">
                    <p class="qris-name">EKSKUL BASKET SMA HUB</p>
                    <img src="{{ asset('images/qris.png') }}" alt="QRIS Ekskul Basket">
                </div>
                <p class="qris-hint">Scan dengan GoPay, OVO, Dana, ShopeePay, atau Mobile Banking apapun.</p>
            </div>
        </div>

        {{-- RIGHT: RIWAYAT --}}
        <div class="bayar-history-col">
            <div class="history-card">
                <h2 class="form-card-title">Riwayat Pembayaran Saya</h2>

                @if($payments->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <p>Belum ada riwayat pembayaran.</p>
                    </div>
                @else
                    @foreach($payments as $p)
                    <div class="history-item">
                        <div class="history-main">
                            <div class="history-desc">{{ $p->description }}</div>
                            <div class="history-meta">
                                {{ $p->date->format('d M Y') }} &bull; via {{ ucfirst($p->payment_method ?? 'transfer') }}
                            </div>
                            @if($p->admin_note)
                            <div class="history-note">💬 Admin: {{ $p->admin_note }}</div>
                            @endif
                        </div>
                        <div class="history-right">
                            <div class="history-amount">Rp {{ number_format($p->amount, 0, ',', '.') }}</div>
                            <span class="history-status status-{{ $p->status }}">
                                @if($p->status === 'pending')   ⏳ Menunggu
                                @elseif($p->status === 'approved') ✅ Diterima
                                @else ❌ Ditolak
                                @endif
                            </span>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('previewImg');
    const placeholder = document.getElementById('uploadPlaceholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</x-layout>
