<x-layout 
    title="Panel Admin - Kelola Event" 
    cssFile="schedule">

    <header class="page-header">
        <h1>Kelola Event Mendatang</h1>
        <p>Tambahkan, ubah, atau hapus event-event yang akan ditampilkan di beranda.</p>
        
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

        <button onclick="document.getElementById('modal-add').style.display='flex'" style="margin-top: 24px; padding: 12px 24px; background: var(--color-primary); color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"></path></svg>
            Tambah Event Baru
        </button>
    </header>

    <div class="schedule-container" style="padding-top: 40px;">
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
                Belum ada event yang didaftarkan.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="modal-add" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000;">
        <div style="background: var(--color-bg-main); width: 100%; max-width: 500px; padding: 32px; border-radius: 16px; position: relative;">
            <button onclick="document.getElementById('modal-add').style.display='none'" style="position: absolute; top: 16px; right: 16px; background: transparent; border: none; cursor: pointer;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <h2 style="margin-bottom: 24px;">Tambah Event Baru</h2>
            <form action="{{ route('admin.events.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                @csrf
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Nama Event</label>
                    <input type="text" name="name" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tanggal Event</label>
                    <input type="date" name="event_date" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Waktu (misal: 15:30 - Selesai)</label>
                    <input type="text" name="time_info" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Lokasi</label>
                    <input type="text" name="location" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tipe (misal: Latihan Fisik, Turnamen)</label>
                    <input type="text" name="type" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <button type="submit" style="margin-top: 16px; padding: 12px; background: var(--color-primary); color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    Simpan Event
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modal-edit" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 1000;">
        <div style="background: var(--color-bg-main); width: 100%; max-width: 500px; padding: 32px; border-radius: 16px; position: relative;">
            <button onclick="document.getElementById('modal-edit').style.display='none'" style="position: absolute; top: 16px; right: 16px; background: transparent; border: none; cursor: pointer;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <h2 style="margin-bottom: 24px;">Edit Event</h2>
            <form id="form-edit" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                @csrf
                @method('PUT')
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Nama Event</label>
                    <input type="text" name="name" id="edit-name" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tanggal Event</label>
                    <input type="date" name="event_date" id="edit-date" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Waktu</label>
                    <input type="text" name="time_info" id="edit-time" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Lokasi</label>
                    <input type="text" name="location" id="edit-loc" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: bold; font-size: 14px;">Tipe</label>
                    <input type="text" name="type" id="edit-type" required style="width: 100%; padding: 12px; border: 1px solid var(--color-border); border-radius: 8px; background: var(--color-bg-elevated); color: var(--color-text-main);">
                </div>
                <button type="submit" style="margin-top: 16px; padding: 12px; background: var(--color-primary); color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                    Update Event
                </button>
            </form>
        </div>
    </div>

    <script>
        function editEvent(event) {
            document.getElementById('edit-name').value = event.name;
            // potong waktu untuk input date, Laravel date cast mereturn object date dengan format ISO
            const d = new Date(event.event_date);
            const dateString = d.toISOString().split('T')[0];
            document.getElementById('edit-date').value = dateString;
            document.getElementById('edit-time').value = event.time_info;
            document.getElementById('edit-loc').value = event.location;
            document.getElementById('edit-type').value = event.type;
            
            document.getElementById('form-edit').action = '/admin/events/' + event.id;
            document.getElementById('modal-edit').style.display = 'flex';
        }
    </script>

</x-layout>
