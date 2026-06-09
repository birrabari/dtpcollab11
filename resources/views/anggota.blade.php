<x-layout title="Daftar Anggota — Ekskul Basket" cssFile="anggota">
<div class="anggota-wrapper">

    {{-- HEADER --}}
    <div class="anggota-hero">
        <div class="anggota-hero-inner">
            <span class="page-eyebrow">👥 Komunitas Tim</span>
            <h1 class="anggota-title">Daftar Anggota</h1>
            <p class="anggota-subtitle">
                {{ $totalAnggota }} anggota aktif terdaftar dalam sistem Ekskul Basket SMA Hub.
            </p>
        </div>
        <div class="anggota-hero-stat">
            <div class="hero-stat-val">{{ $totalAnggota }}</div>
            <div class="hero-stat-label">Total Anggota</div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="anggota-content">

        @if($anggota->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">👤</div>
                <h3>Belum Ada Anggota</h3>
                <p>Ajak teman-teman untuk bergabung ke ekskul basket!</p>
                @guest
                    <a href="/register" class="btn-primary-home" style="margin-top:20px;display:inline-flex;">Daftar Sekarang</a>
                @endguest
            </div>
        @else
            {{-- Search bar (UI only, no JS needed for small lists) --}}
            <div class="anggota-toolbar">
                <div class="anggota-count">Menampilkan {{ $totalAnggota }} anggota</div>
            </div>

            <div class="anggota-grid">
                @foreach($anggota as $index => $member)
                <div class="member-card">
                    <div class="member-avatar">
                        {{ strtoupper(substr($member->name, 0, 1)) }}
                    </div>
                    <div class="member-number">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="member-info">
                        <div class="member-name">{{ $member->name }}</div>
                        <div class="member-email">{{ $member->email }}</div>
                        <div class="member-joined">
                            Bergabung {{ $member->created_at->translatedFormat('d M Y') ?? $member->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <div class="member-status">
                        <span class="status-active">● Aktif</span>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
</x-layout>
