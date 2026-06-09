<x-layout 
    title="Ekskul Portal - Profil" 
    cssFile="profile">

    <div class="profile-wrapper">
        <div class="profile-hero">
            <div class="athlete-avatar-container">
                <div class="athlete-avatar">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="athlete-number">11</div>
            </div>
            
            <div class="athlete-info">
                <h1>{{ auth()->user()->name ?? 'Admin Utama' }}</h1>
                <p>POINT GUARD</p>
                
                <div class="athlete-stats-bar">
                    <div class="astat-item">
                        <div class="astat-value">24</div>
                        <div class="astat-label">Matches</div>
                    </div>
                    <div class="astat-item">
                        <div class="astat-value">156</div>
                        <div class="astat-label">Points</div>
                    </div>
                    <div class="astat-item">
                        <div class="astat-value">89</div>
                        <div class="astat-label">Assists</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-content">
            <h2 class="profile-form-header">Player Settings</h2>
            
            <form>
                <div class="pform-group">
                    <label class="pform-label">Nama Lengkap</label>
                    <input type="text" class="pform-input" value="{{ auth()->user()->name ?? 'Admin Utama' }}">
                </div>
                
                <div class="pform-row">
                    <div class="pform-group">
                        <label class="pform-label">Posisi</label>
                        <input type="text" class="pform-input" value="Point Guard">
                    </div>
                    <div class="pform-group">
                        <label class="pform-label">Nomor Punggung</label>
                        <input type="number" class="pform-input" value="11">
                    </div>
                </div>
                
                <div class="pform-group">
                    <label class="pform-label">Email</label>
                    <input type="email" class="pform-input" value="{{ auth()->user()->email ?? 'admin@ekskul.id' }}">
                </div>
                
                <div style="margin-top: 48px;">
                    <button type="button" class="btn-cinematic btn-cinematic-accent">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
