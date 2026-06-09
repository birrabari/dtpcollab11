<x-layout 
    title="Ekskul Portal - Profil" 
    cssFile="profile">

    <div class="profile-wrapper">
        <div class="profile-hero">
            <div class="athlete-avatar-container">
                <div class="athlete-avatar">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="athlete-number">{{ auth()->user()->no_punggung ?? 'XX' }}</div>
            </div>
            
            <div class="athlete-info">
                <h1>{{ auth()->user()->name }}</h1>
                <p>{{ strtoupper(auth()->user()->posisi ?? 'BELUM DIATUR') }} {{ auth()->user()->kelas ? ' • ' . strtoupper(auth()->user()->kelas) : '' }}</p>
            </div>
        </div>

        <div class="profile-content">
            <h2 class="profile-form-header">Player Settings</h2>

            @if(session('success'))
            <div class="alert-success" style="margin-bottom: 24px; color: green; font-weight:bold;">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert-error" style="margin-bottom: 24px; color: red; font-weight:bold;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="pform-group">
                    <label class="pform-label">Nama Lengkap</label>
                    <input type="text" name="name" class="pform-input" value="{{ auth()->user()->name }}" required>
                </div>
                
                <div class="pform-row">
                    <div class="pform-group">
                        <label class="pform-label">Posisi</label>
                        <select name="posisi" class="pform-input" style="appearance: auto; padding-right: 32px;">
                            <option value="">-- Pilih Posisi --</option>
                            <option value="Point Guard" {{ auth()->user()->posisi === 'Point Guard' ? 'selected' : '' }}>Point Guard</option>
                            <option value="Shooting Guard" {{ auth()->user()->posisi === 'Shooting Guard' ? 'selected' : '' }}>Shooting Guard</option>
                            <option value="Small Forward" {{ auth()->user()->posisi === 'Small Forward' ? 'selected' : '' }}>Small Forward</option>
                            <option value="Power Forward" {{ auth()->user()->posisi === 'Power Forward' ? 'selected' : '' }}>Power Forward</option>
                            <option value="Center" {{ auth()->user()->posisi === 'Center' ? 'selected' : '' }}>Center</option>
                        </select>
                    </div>
                    <div class="pform-group">
                        <label class="pform-label">Nomor Punggung</label>
                        <input type="number" name="no_punggung" class="pform-input" value="{{ auth()->user()->no_punggung }}" placeholder="Contoh: 11" min="0" max="99">
                    </div>
                </div>

                <div class="pform-group">
                    <label class="pform-label">Kelas</label>
                    <input type="text" name="kelas" class="pform-input" value="{{ auth()->user()->kelas }}" placeholder="Contoh: XI IPA 1">
                </div>
                
                <div class="pform-group">
                    <label class="pform-label">Email</label>
                    <input type="email" name="email" class="pform-input" value="{{ auth()->user()->email }}" required>
                </div>
                
                <div style="margin-top: 48px;">
                    <button type="submit" class="btn-cinematic btn-cinematic-accent">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
