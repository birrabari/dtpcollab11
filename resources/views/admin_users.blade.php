<x-layout title="Kelola Users — Admin" cssFile="admin">

<div class="admin-wrapper">
    <div class="admin-header">
        <h1 class="admin-title">👥 Kelola Anggota</h1>
        <p class="admin-subtitle">Manajemen data seluruh anggota ekskul basket dan hak akses admin.</p>
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

    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">Daftar Anggota ({{ $users->count() }})</h2>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Bergabung</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge badge-admin">Admin</span>
                            @else
                                <span class="badge badge-member">Anggota</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td style="text-align: right;">
                            <button onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', {{ $user->is_admin ? 'true' : 'false' }})" class="btn-icon btn-edit" title="Edit User">
                                ✏️ Edit
                            </button>
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn-icon btn-delete" title="Hapus User">🗑️ Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL EDIT USER --}}
<div id="modal-edit-user" class="modal-overlay" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Anggota</h3>
            <button class="modal-close" onclick="document.getElementById('modal-edit-user').style.display='none'">×</button>
        </div>
        <div class="modal-body">
            <form id="editUserForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" id="edit_name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="edit_email" required>
                </div>
                <div class="form-group">
                    <label>Peran (Role)</label>
                    <select name="is_admin" id="edit_is_admin" required style="width:100%; padding:10px; border-radius:6px; border:1px solid var(--color-border);">
                        <option value="0">Anggota Biasa</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                
                <div style="margin-top:24px; display:flex; gap:12px; justify-content:flex-end;">
                    <button type="button" class="btn-secondary" onclick="document.getElementById('modal-edit-user').style.display='none'">Batal</button>
                    <button type="submit" class="btn-primary" style="background:#ef4444;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(id, name, email, isAdmin) {
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_is_admin').value = isAdmin ? '1' : '0';
    document.getElementById('editUserForm').action = '/admin/users/' + id;
    document.getElementById('modal-edit-user').style.display = 'flex';
}
</script>

<style>
.badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
.badge-admin { background: #fee2e2; color: #ef4444; }
.badge-member { background: #e0e7ff; color: #4f46e5; }
.btn-icon { background: none; border: none; cursor: pointer; padding: 4px 8px; font-size: 14px; border-radius: 4px; }
.btn-icon:hover { background: #f3f4f6; }
.btn-edit { color: #f59e0b; }
.btn-delete { color: #ef4444; }
</style>

</x-layout>
