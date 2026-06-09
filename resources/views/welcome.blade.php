<x-layout title="Ekskul Basket — Beranda" cssFile="welcome">
<div class="home-wrapper">

    {{-- ===== HERO — PROFIL EKSKUL ===== --}}
    <section class="club-hero">
        <div class="club-hero-inner">
            <div class="club-hero-text">
                <span class="club-badge">Ekskul Resmi Sekolah</span>
                <h1 class="club-title">Basket<br><span class="text-accent">SMA Telkom</span></h1>
                <p class="club-desc">Ekskul basket yang membentuk atlet berprestasi, berkarakter, dan berjiwa sportivitas tinggi. Bergabunglah dan raih potensi terbaikmu bersama kami.</p>
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
                <img src="{{ asset('images/team1.png') }}" alt="Foto Tim Basket" class="hero-img">
            </div>
        </div>
    </section>

    {{-- ===== STATS CARDS ===== --}}
    <section class="home-stats">
        <div class="hstat-card">
            <div class="hstat-icon"><img src="{{ asset('images/icon-group.png') }}" alt="Anggota Aktif" style="width: 40px; height: auto;"></div>
            <div class="hstat-val">{{ $totalAnggota }}</div>
            <div class="hstat-label">Anggota Aktif</div>
        </div>
        <div class="hstat-card">
            <div class="hstat-icon"><img src="{{ asset('images/icon-money.png') }}" alt="Saldo Kas Tim" style="width: 40px; height: auto;"></div>
            <div class="hstat-val">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
            <div class="hstat-label">Saldo Kas Tim</div>
        </div>
        <div class="hstat-card">
            <div class="hstat-icon"><img src="{{ asset('images/icon-calendar.png') }}" alt="Latihan / Minggu" style="width: 40px; height: auto;"></div>
            <div class="hstat-val">3×</div>
            <div class="hstat-label">Latihan / Minggu</div>
        </div>
        <div class="hstat-card">
            <div class="hstat-icon"><img src="{{ asset('images/icon-trophy.png') }}" alt="Prestasi Diraih" style="width: 40px; height: auto;"></div>
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
                <p>Ekskul Basket SMA Hub berdiri sejak 2018 dengan misi mengembangkan bakat siswa di bidang olahraga basket. Program latihan kami dirancang secara sistematis oleh pelatih berpengalaman untuk memaksimalkan kemampuan teknik, fisik, dan mental setiap anggota.</p>
                <ul class="info-list">
                    <li>✅ Pelatih bersertifikat nasional</li>
                    <li>✅ Fasilitas lapangan lengkap</li>
                    <li>✅ Program latihan terstruktur</li>
                    <li>✅ Dukungan nutrisi & kesehatan atlet</li>
                </ul>
            </div>
            <div class="info-photo">
                <img src="{{ asset('images/team2.png') }}" alt="Latihan Tim Basket">
            </div>
        </div>
    </section>

    {{-- ===== JADWAL LATIHAN ===== --}}
    <section class="home-schedule">
        <div class="home-schedule-inner">
            <h2>Jadwal Latihan Rutin</h2>
            <div class="schedule-cards">
                <div class="sched-card">
                    <div class="sched-day-name">Senin</div>
                    <div class="sched-time">15:30 – 17:30 WIB</div>
                    <div class="sched-loc">📍 Lapangan Indoor Sekolah</div>
                    <span class="sched-type latihan">Latihan Fisik</span>
                </div>
                <div class="sched-card">
                    <div class="sched-day-name">Rabu</div>
                    <div class="sched-time">15:30 – 17:30 WIB</div>
                    <div class="sched-loc">📍 Lapangan Indoor Sekolah</div>
                    <span class="sched-type teknik">Latihan Teknik</span>
                </div>
                <div class="sched-card">
                    <div class="sched-day-name">Jumat</div>
                    <div class="sched-time">14:00 – 17:00 WIB</div>
                    <div class="sched-loc">📍 Lapangan Indoor Sekolah</div>
                    <span class="sched-type tanding">Sparing / Tanding</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PRESTASI ===== --}}
    <section class="home-prestasi">
        <div class="home-prestasi-inner">
            <h2>Prestasi Tim</h2>
            <div class="prestasi-grid">
                <div class="prestasi-card">
                    <div class="prestasi-year">2024</div>
                    <div class="prestasi-title">Juara 2 Turnamen Antar Sekolah Kota</div>
                    <div class="prestasi-org">Dinas Pendidikan Kota</div>
                </div>
                <div class="prestasi-card">
                    <div class="prestasi-year">2023</div>
                    <div class="prestasi-title">Juara 1 Kompetisi Basket SMA Se-Kabupaten</div>
                    <div class="prestasi-org">PERBASI Kabupaten</div>
                </div>
                <div class="prestasi-card">
                    <div class="prestasi-year">2023</div>
                    <div class="prestasi-title">Best Athlete — Turnamen Pelajar Provinsi</div>
                    <div class="prestasi-org">PERBASI Provinsi</div>
                </div>
                <div class="prestasi-card">
                    <div class="prestasi-year">2022</div>
                    <div class="prestasi-title">Juara 3 DBL Regional Jawa Barat</div>
                    <div class="prestasi-org">DBL Indonesia</div>
                </div>
                <div class="prestasi-card">
                    <div class="prestasi-year">2022</div>
                    <div class="prestasi-title">Juara 1 Turnamen Antar Ekskul Kota</div>
                    <div class="prestasi-org">OSIS Kota</div>
                </div>
            </div>
        </div>
    </section>

</div>
</x-layout>