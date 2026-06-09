<x-layout 
    title="Ekskul Portal - Jadwal Latihan" 
    cssFile="schedule">

    <header class="page-header">
        <h1>Jadwal Latihan</h1>
        <p>Disiplin adalah fondasi kemenangan. Pantau jadwal latihan rutin dan bersiap untuk turun ke lapangan.</p>
    </header>

    <div class="schedule-container">
        <div class="schedule-list">
            @foreach($schedules as $sched)
            <div class="schedule-row" style="{{ $sched->status === 'completed' ? 'opacity: 0.5;' : '' }}">
                <div class="sched-date">
                    <div class="sched-month">{{ $sched->day_info }}</div>
                    <div class="sched-day">{{ strtoupper($sched->type) }}</div>
                </div>
                <div class="sched-details">
                    <h3>{{ $sched->title }}</h3>
                    <div class="sched-meta">
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            {{ $sched->time }}
                        </span>
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            {{ $sched->location }}
                        </span>
                    </div>
                </div>
                
                @if($sched->status === 'active')
                <div class="sched-status active">
                    Aktif
                </div>
                @elseif($sched->status === 'holiday')
                <div class="sched-status" style="border-color: #ef4444; color: #ef4444;">
                    Libur
                </div>
                @else
                <div class="sched-status" style="border-color: var(--color-border); color: var(--color-text-muted);">
                    Selesai
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>

</x-layout>
