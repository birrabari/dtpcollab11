<x-layout title="Basketin — Beranda" cssFile="welcome">
<div class="home-wrapper">

    {{-- ===== HERO — PROFIL EKSKUL ===== --}}
    <section class="club-hero">
        <div class="club-hero-inner">
            <div class="club-hero-text">
                <span class="club-badge">Ekskul Resmi Sekolah</span>
                <h1 class="club-title">Selamat Datang di<br><span class="text-accent">Basketin.</span></h1>
                <p class="club-desc">Basketin yang membentuk atlet berprestasi, berkarakter, dan berjiwa sportivitas tinggi. Bergabunglah dan raih potensi terbaikmu bersama kami.</p>
                <div class="club-hero-actions">
                    <a href="/jadwal" class="btn-primary-home">Lihat Jadwal Latihan</a>
                    @guest
                    <a href="/register" class="btn-outline-home">Gabung Tim</a>
                    @endguest
                    @auth
                    <a href="/keuangan" class="btn-outline-home">Laporan Kas</a>
                    @endauth
                </div>
            </div>
            <div class="club-hero-photo">
                <img src="{{ asset('images/team1.jpeg') }}" alt="Foto Tim Basket" class="hero-img">
            </div>
        </div>
    </section>

    {{-- ===== STATS CARDS ===== --}}
    <section class="home-stats">
        <div class="hstat-card">
            <div class="hstat-icon" style="background: linear-gradient(135deg, #FF6B6B, #D90429);">
                <img src="{{ asset('images/anggota aktif.jfif') }}" alt="Anggota Aktif" style="width: 100%; height: 100%; object-fit: cover; border-radius: 18px;">
            </div>
            <div class="hstat-val">{{ $totalAnggota }}</div>
            <div class="hstat-label">Anggota Aktif</div>
        </div>
        <div class="hstat-card">
            <div class="hstat-icon" style="background: linear-gradient(135deg, #4ADE80, #16A34A);">
                <img src="{{ asset('images/saldo kas ekstra.jfif') }}" alt="Saldo Kas Tim" style="width: 100%; height: 100%; object-fit: cover; border-radius: 18px;">
            </div>
            <div class="hstat-val">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
            <div class="hstat-label">Saldo Kas Tim</div>
        </div>
        <div class="hstat-card">
            <div class="hstat-icon" style="background: linear-gradient(135deg, #60A5FA, #2563EB);">
                <img src="{{ asset('images/jadwal latihan.jfif') }}" alt="Latihan / Minggu" style="width: 100%; height: 100%; object-fit: cover; border-radius: 18px;">
            </div>
            <div class="hstat-val">3×</div>
            <div class="hstat-label">Latihan / Minggu</div>
        </div>
        <div class="hstat-card">
            <div class="hstat-icon" style="background: linear-gradient(135deg, #FBBF24, #D97706);">
                <img src="{{ asset('images/prestasi diraih (2).jfif') }}" alt="Prestasi Diraih" style="width: 100%; height: 100%; object-fit: cover; border-radius: 18px;">
            </div>
            <div class="hstat-val">5</div>
            <div class="hstat-label">Prestasi Diraih</div>
        </div>
    </section>

    {{-- ===== INFO EKSKUL ===== --}}
    <section class="home-info">
        <div class="info-block">
            <div class="info-text">
                <span class="info-label">Tentang Kami</span>
                <h2>Membentuk Atlet,<br>Bukan Sekadar Pemain.</h2>
                <p><strong>Basketin</strong> berdiri sejak 2018 dengan misi mengembangkan bakat siswa di bidang olahraga basket. Program latihan kami dirancang secara sistematis oleh pelatih berpengalaman untuk memaksimalkan kemampuan teknik, fisik, dan mental setiap anggota.</p>
                <ul class="info-list">
                    <li>✅ Fasilitas lapangan lengkap</li>
                    <li>✅ Program latihan terstruktur</li>
                </ul>
            </div>
            <div class="info-photo">
                <img src="{{ asset('images/team2.jpeg') }}" alt="Latihan Tim Basket">
            </div>
        </div>
    </section>

    {{-- ===== JADWAL LATIHAN ===== --}}
    <section class="home-schedule">
        <div class="home-schedule-inner">
            <h2>Event Mendatang</h2>
            <div class="schedule-cards">
                @forelse($events as $event)
                <div class="sched-card">
                    <div class="sched-day-name">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</div>
                    <div class="sched-time" style="font-weight: bold; margin-bottom: 4px; color: var(--color-text-main);">{{ $event->name }}</div>
                    <div class="sched-time">{{ $event->time_info }}</div>
                    <div class="sched-loc">📍 {{ $event->location }}</div>
                    @php
                        // Tentukan class warna berdasarkan tipe event (bisa disesuaikan)
                        $typeClass = 'latihan';
                        if (stripos($event->type, 'teknik') !== false) $typeClass = 'teknik';
                        elseif (stripos($event->type, 'tanding') !== false || stripos($event->type, 'sparing') !== false || stripos($event->type, 'turnamen') !== false) $typeClass = 'tanding';
                    @endphp
                    <span class="sched-type {{ $typeClass }}">{{ strtoupper($event->type) }}</span>
                </div>
                @empty
                <div class="sched-card" style="grid-column: 1 / -1; text-align: center;">
                    <p style="color: var(--color-text-muted);">Belum ada event mendatang.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== PRESTASI ===== --}}
    <section class="home-prestasi">
        <div class="home-prestasi-inner">
            <h2>Prestasi Tim</h2>
            <div class="prestasi-grid">
                @forelse($achievements as $ach)
                <div class="prestasi-card">
                    <div class="prestasi-year">{{ $ach->year }}</div>
                    <div class="prestasi-title">{{ $ach->title }}</div>
                    <div class="prestasi-org">{{ $ach->organizer }}</div>
                </div>
                @empty
                <p style="color:var(--color-text-muted); grid-column:1/-1; text-align:center;">Belum ada data prestasi.</p>
                @endforelse
            </div>
        </div>
    </section>

</div>
</x-layout>
