<x-layout title="Absensi Kehadiran — Admin" cssFile="admin">

<div class="admin-wrapper">
    <div class="admin-header">
        <a href="/admin/schedules" class="btn-secondary" style="display:inline-block; margin-bottom:12px;">← Kembali ke Jadwal</a>
        <h1 class="admin-title">📋 Absensi: {{ $schedule->title }}</h1>
        <p class="admin-subtitle">
            Hari: <strong>{{ $schedule->day_info }}</strong> &bull; Jam: <strong>{{ $schedule->time }}</strong> &bull; Lokasi: <strong>{{ $schedule->location }}</strong>
        </p>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">Terjadi kesalahan saat menyimpan data.</div>
    @endif

    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">Daftar Kehadiran Anggota</h2>
        </div>

        <form action="{{ route('admin.attendance.store', $schedule->id) }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        @php
                            $status = isset($attendances[$user->id]) ? $attendances[$user->id]->status : 'alpha';
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>
                                <select name="attendance[{{ $user->id }}]" style="padding:8px; border-radius:6px; border:1px solid var(--color-border); min-width:120px;">
                                    <option value="hadir" {{ $status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="sakit" {{ $status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="izin" {{ $status == 'izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="alpha" {{ $status == 'alpha' ? 'selected' : '' }}>Alpha (Tanpa Keterangan)</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="padding: 24px; background: #f9fafb; border-top: 1px solid var(--color-border); text-align: right;">
                <button type="submit" class="btn-primary" style="margin:0;">Simpan Data Absensi</button>
            </div>
        </form>
    </div>
</div>

</x-layout>
