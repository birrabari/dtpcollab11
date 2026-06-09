<x-layout 
    title="Ekskul Portal - Jadwal Latihan" 
    cssFile="schedule">

    <header class="page-header">
        <h1>Jadwal Latihan</h1>
        <p>Disiplin adalah fondasi kemenangan. Pantau jadwal latihan rutin dan bersiap untuk turun ke lapangan.</p>
        
        @if(auth()->check() && (auth()->user()->is_admin ?? true))
            <div style="margin-top: 32px;">
                <button class="btn-outline">
                    Edit Jadwal (Admin)
                </button>
            </div>
        @endif
    </header>

    <div class="schedule-container">
        <div class="schedule-list">
            
            <div class="schedule-row">
                <div class="sched-date">
                    <div class="sched-month">Setiap Senin</div>
                    <div class="sched-day">REGULAR</div>
                </div>
                <div class="sched-details">
                    <h3>Latihan Reguler Basket</h3>
                    <div class="sched-meta">
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            15:30 - 17:30 WIB
                        </span>
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            Lapangan Sekolah Utama
                        </span>
                    </div>
                </div>
                <div class="sched-status active">
                    Aktif
                </div>
            </div>

            <div class="schedule-row">
                <div class="sched-date">
                    <div class="sched-month">Setiap Rabu</div>
                    <div class="sched-day">INTENSIF</div>
                </div>
                <div class="sched-details">
                    <h3>Latihan Fisik & Taktik</h3>
                    <div class="sched-meta">
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            15:30 - 17:00 WIB
                        </span>
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            Lapangan Sekolah Utama
                        </span>
                    </div>
                </div>
                <div class="sched-status active">
                    Aktif
                </div>
            </div>

            <div class="schedule-row" style="opacity: 0.5;">
                <div class="sched-date">
                    <div class="sched-month">24 Maret 2024</div>
                    <div class="sched-day">SPARRING</div>
                </div>
                <div class="sched-details">
                    <h3>Sparing vs SMA 1</h3>
                    <div class="sched-meta">
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            08:00 - Selesai
                        </span>
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            GOR Kota
                        </span>
                    </div>
                </div>
                <div class="sched-status" style="border-color: var(--color-border); color: var(--color-text-muted);">
                    Selesai
                </div>
            </div>

        </div>
    </div>

</x-layout>
