<x-layout title="Kelola Prestasi — Admin" cssFile="admin">

<div class="admin-wrapper">
    <div class="admin-header">
        <h1 class="admin-title">🏆 Kelola Prestasi</h1>
        <p class="admin-subtitle">Tambah, ubah, atau hapus daftar prestasi yang akan tampil di halaman utama.</p>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TAMBAH PRESTASI --}}
    <div class="admin-card" style="margin-bottom: 24px;">
        <div class="card-header">
            <h2 class="card-title">Tambah Prestasi Baru</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.achievements.store') }}" method="POST" style="display:flex; gap:16px; align-items:flex-end; flex-wrap:wrap;">
                @csrf
                <div class="form-group" style="flex:1; min-width:80px;">
                    <label>Tahun</label>
                    <input type="text" name="year" placeholder="Contoh: 2024" required>
                </div>
                <div class="form-group" style="flex:3; min-width:200px;">
                    <label>Nama/Judul Prestasi</label>
                    <input type="text" name="title" placeholder="Contoh: Juara 1 DBL Jabar" required>
                </div>
                <div class="form-group" style="flex:2; min-width:150px;">
                    <label>Penyelenggara</label>
                    <input type="text" name="organizer" placeholder="Contoh: DBL Indonesia" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary" style="margin:0;">Tambah Prestasi</button>
                </div>
            </form>
        </div>
    </div>

    {{-- DAFTAR PRESTASI --}}
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">Daftar Prestasi ({{ $achievements->count() }})</h2>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Judul Prestasi</th>
                        <th>Penyelenggara</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($achievements->isEmpty())
                    <tr>
                        <td colspan="4" style="text-align:center; padding:24px; color:var(--color-text-muted);">Belum ada data prestasi.</td>
                    </tr>
                    @else
                        @foreach($achievements as $ach)
                        <tr>
                            <td><strong>{{ $ach->year }}</strong></td>
                            <td>{{ $ach->title }}</td>
                            <td>{{ $ach->organizer }}</td>
                            <td style="text-align: right;">
                                <button onclick="openEditModal({{ $ach->id }}, '{{ addslashes($ach->year) }}', '{{ addslashes($ach->title) }}', '{{ addslashes($ach->organizer) }}')" class="btn-icon btn-edit" title="Edit">
                                    ✏️
                                </button>
                                <form action="{{ route('admin.achievements.destroy', $ach->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus prestasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-icon btn-delete" title="Hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="modal-edit-ach" class="modal-overlay" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Prestasi</h3>
            <button class="modal-close" onclick="document.getElementById('modal-edit-ach').style.display='none'">×</button>
        </div>
        <div class="modal-body">
            <form id="editAchForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="text" name="year" id="edit_year" required>
                </div>
                <div class="form-group">
                    <label>Nama/Judul Prestasi</label>
                    <input type="text" name="title" id="edit_title" required>
                </div>
                <div class="form-group">
                    <label>Penyelenggara</label>
                    <input type="text" name="organizer" id="edit_organizer" required>
                </div>
                
                <div style="margin-top:24px; display:flex; gap:12px; justify-content:flex-end;">
                    <button type="button" class="btn-secondary" onclick="document.getElementById('modal-edit-ach').style.display='none'">Batal</button>
                    <button type="submit" class="btn-primary" style="background:#f59e0b; color:#fff;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(id, year, title, organizer) {
    document.getElementById('edit_year').value = year;
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_organizer').value = organizer;
    document.getElementById('editAchForm').action = '/admin/achievements/' + id;
    document.getElementById('modal-edit-ach').style.display = 'flex';
}
</script>

<style>
.btn-icon { background: none; border: none; cursor: pointer; padding: 4px 8px; font-size: 14px; border-radius: 4px; }
.btn-icon:hover { background: #f3f4f6; }
.btn-edit { color: #f59e0b; }
.btn-delete { color: #ef4444; }
</style>

</x-layout>
