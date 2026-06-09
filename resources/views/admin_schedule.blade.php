<x-layout 
    title="Panel Admin - Kelola Jadwal" 
    cssFile="schedule">

    <header class="page-header">
        <h1>Kelola Jadwal Latihan</h1>
        <p>Atur status jadwal latihan dari "Aktif" menjadi "Libur", atau tambah, edit, dan hapus jadwal.</p>
        
        @if(session('success'))
        <div style="margin-top: 16px; padding: 12px; background: #dcfce7; color: #16a34a; border-radius: 8px;">
            {{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div style="margin-top: 16px; padding: 12px; background: #fee2e2; color: #ef4444; border-radius: 8px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <button onclick="document.getElementById('modal-add').style.display='flex'" style="margin-top: 24px; padding: 12px 24px; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"></path></svg>
            Tambah Jadwal Baru
        </button>
    </header>

    <div class="schedule-container" style="padding-top: 40px;">
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
                
                <div style="display: flex; flex-direction: column; gap: 8px; align-items: flex-end;">
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

                    <div style="display: flex; gap: 8px; margin-top: 8px;">
                        @if($sched->status !== 'completed')
                        <form action="{{ route('admin.schedules.toggle', $sched->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="{{ $sched->status === 'active' ? 'btn-toggle-holiday' : 'btn-toggle-active' }}">
                                {{ $sched->status === 'active' ? 'Ubah ke Libur' : 'Ubah ke Aktif' }}
                            </button>
                        </form>
                        @endif
                        
                        <button onclick="editSchedule({{ $sched->toJson() }})" style="padding: 6px 12px; background: transparent; color: #3b82f6; border: 1px solid #3b82f6; border-radius: 100px; cursor: pointer; font-size: 12px; font-weight: 600;">
                            Edit
                        </button>
                        
                        <a href="{{ route('admin.attendance.show', $sched->id) }}" style="padding: 6px 12px; background: transparent; color: #10b981; border: 1px solid #10b981; border-radius: 100px; cursor: pointer; font-size: 12px; font-weight: 600; text-decoration:none;">
                            Absensi
                        </a>
                        
                        <form action="{{ route('admin.schedules.destroy', $sched->id) }}" method="POST" onsubmit="return confirm('Yakin hapus jadwal ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding: 6px 12px; background: transparent; color: #ef4444; border: 1px solid #ef4444; border-radius: 100px; cursor: pointer; font-size: 12px; font-weight: 600;">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="modal-add" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000;">
        <div style="background: #ffffff; width: 100%; max-width: 500px; padding: 32px; border-radius: 16px; position: relative; color: #111827;">
            <button onclick="document.getElementById('modal-add').style.display='none'" style="position: absolute; top: 16px; right: 16px; background: transparent; border: none; cursor: pointer;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <h2 style="margin-bottom: 24px;">Tambah Jadwal Baru</h2>
            <form action="{{ route('admin.schedules.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                @csrf
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Nama Latihan</label>
                    <input type="text" name="title" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Hari (misal: Setiap Senin)</label>
                    <input type="text" name="day_info" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tipe (misal: REGULAR)</label>
                    <input type="text" name="type" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Waktu (misal: 15:30 - 17:30 WIB)</label>
                    <input type="text" name="time" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Lokasi</label>
                    <input type="text" name="location" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <button type="submit" style="margin-top: 16px; padding: 12px; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    Simpan Jadwal
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modal-edit" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000;">
        <div style="background: #ffffff; width: 100%; max-width: 500px; padding: 32px; border-radius: 16px; position: relative; color: #111827;">
            <button onclick="document.getElementById('modal-edit').style.display='none'" style="position: absolute; top: 16px; right: 16px; background: transparent; border: none; cursor: pointer;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <h2 style="margin-bottom: 24px;">Edit Jadwal</h2>
            <form id="form-edit" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                @csrf
                @method('PUT')
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Nama Latihan</label>
                    <input type="text" name="title" id="edit-title" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Hari</label>
                    <input type="text" name="day_info" id="edit-day" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tipe</label>
                    <input type="text" name="type" id="edit-type" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Waktu</label>
                    <input type="text" name="time" id="edit-time" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Lokasi</label>
                    <input type="text" name="location" id="edit-loc" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <button type="submit" style="margin-top: 16px; padding: 12px; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    Update Jadwal
                </button>
            </form>
        </div>
    </div>

    <!-- SECTION: KELOLA EVENT MENDATANG -->
    <header class="page-header" style="padding-top: 80px; padding-bottom: 40px; border-top: 1px solid var(--color-border, #e5e7eb); margin-top: 40px;">
        <h1>Kelola Event Mendatang</h1>
        <p>Tambahkan, ubah, atau hapus event-event yang akan ditampilkan di beranda untuk *user*.</p>

        <button onclick="document.getElementById('modal-add-event').style.display='flex'" style="margin-top: 24px; padding: 12px 24px; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"></path></svg>
            Tambah Event Baru
        </button>
    </header>

    <div class="schedule-container" style="padding-top: 20px;">
        <div class="schedule-list">
            @forelse($events as $event)
            <div class="schedule-row">
                <div class="sched-date">
                    <div class="sched-month" style="font-size: 12px; opacity: 0.8;">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</div>
                    <div class="sched-day" style="font-size: 24px;">{{ strtoupper($event->type) }}</div>
                </div>
                <div class="sched-details">
                    <h3>{{ $event->name }}</h3>
                    <div class="sched-meta">
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            {{ $event->time_info }}
                        </span>
                        <span>
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            {{ $event->location }}
                        </span>
                    </div>
                </div>
                
                <div style="display: flex; gap: 8px;">
                    <button onclick="editEvent({{ $event->toJson() }})" style="padding: 8px 16px; background: transparent; color: #3b82f6; border: 1px solid #3b82f6; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: bold;">
                        Edit
                    </button>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="padding: 8px 16px; background: transparent; color: #ef4444; border: 1px solid #ef4444; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: bold;">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                Belum ada event mendatang yang didaftarkan.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Tambah Event -->
    <div id="modal-add-event" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000;">
        <div style="background: #ffffff; width: 100%; max-width: 500px; padding: 32px; border-radius: 16px; position: relative; color: #111827;">
            <button onclick="document.getElementById('modal-add-event').style.display='none'" style="position: absolute; top: 16px; right: 16px; background: transparent; border: none; cursor: pointer;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <h2 style="margin-bottom: 24px;">Tambah Event Baru</h2>
            <form action="{{ route('admin.events.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                @csrf
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Nama Event</label>
                    <input type="text" name="name" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tanggal Event</label>
                    <input type="date" name="event_date" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Waktu (misal: 15:30 - Selesai)</label>
                    <input type="text" name="time_info" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Lokasi</label>
                    <input type="text" name="location" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tipe (misal: Turnamen)</label>
                    <input type="text" name="type" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <button type="submit" style="margin-top: 16px; padding: 12px; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    Simpan Event
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Edit Event -->
    <div id="modal-edit-event" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000;">
        <div style="background: #ffffff; width: 100%; max-width: 500px; padding: 32px; border-radius: 16px; position: relative; color: #111827;">
            <button onclick="document.getElementById('modal-edit-event').style.display='none'" style="position: absolute; top: 16px; right: 16px; background: transparent; border: none; cursor: pointer;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <h2 style="margin-bottom: 24px;">Edit Event</h2>
            <form id="form-edit-event" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                @csrf
                @method('PUT')
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Nama Event</label>
                    <input type="text" name="name" id="edit-event-name" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tanggal Event</label>
                    <input type="date" name="event_date" id="edit-event-date" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Waktu</label>
                    <input type="text" name="time_info" id="edit-event-time" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Lokasi</label>
                    <input type="text" name="location" id="edit-event-loc" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tipe</label>
                    <input type="text" name="type" id="edit-event-type" required style="width: 100%; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f9fafb; color: #111827;">
                </div>
                <button type="submit" style="margin-top: 16px; padding: 12px; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    Update Event
                </button>
            </form>
        </div>
    </div>

    <script>
        function editSchedule(schedule) {
            document.getElementById('edit-title').value = schedule.title;
            document.getElementById('edit-day').value = schedule.day_info;
            document.getElementById('edit-type').value = schedule.type;
            document.getElementById('edit-time').value = schedule.time;
            document.getElementById('edit-loc').value = schedule.location;
            
            document.getElementById('form-edit').action = '/admin/schedules/' + schedule.id;
            document.getElementById('modal-edit').style.display = 'flex';
        }

        function editEvent(event) {
            document.getElementById('edit-event-name').value = event.name;
            const d = new Date(event.event_date);
            const dateString = d.toISOString().split('T')[0];
            document.getElementById('edit-event-date').value = dateString;
            document.getElementById('edit-event-time').value = event.time_info;
            document.getElementById('edit-event-loc').value = event.location;
            document.getElementById('edit-event-type').value = event.type;
            
            document.getElementById('form-edit-event').action = '/admin/events/' + event.id;
            document.getElementById('modal-edit-event').style.display = 'flex';
        }
    </script>

</x-layout>
