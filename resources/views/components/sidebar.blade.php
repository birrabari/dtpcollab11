<aside class="sidebar">
    <div class="brand">
        <div class="brand-icon"></div>
        <span class="brand-text">ekskul kuu</span>
    </div>

    <ul class="nav-menu">
        <li>
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                <span>Beranda</span>
            </a>
        </li>
        <li>
            <a href="/jadwal" class="nav-link {{ request()->is('jadwal') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <span>Jadwal</span>
            </a>
        </li>
        <li>
            <a href="{{ auth()->check() ? '/keuangan' : '/login' }}" class="nav-link {{ request()->is('keuangan') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                <span>Keuangan</span>
            </a>
        </li>
        <li>
            <a href="{{ auth()->check() ? '/bayar-kas' : '/login' }}" class="nav-link {{ request()->is('bayar-kas') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                <span>Bayar Kas</span>
            </a>
        </li>
        <li>
            <a href="{{ auth()->check() ? '/anggota' : '/login' }}" class="nav-link {{ request()->is('anggota') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span>Anggota</span>
            </a>
        </li>
        <li>
            <a href="{{ auth()->check() ? '/profile' : '/login' }}" class="nav-link {{ request()->is('profile') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <span>Profil</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        @guest
            <a href="/login" class="nav-link" style="color:#fff;justify-content:center;background:var(--color-accent);border-radius:100px;">
                <span>Masuk</span>
            </a>
        @endguest
        @auth
            <a href="/logout" class="nav-link" style="color:var(--color-accent);">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                <span>Keluar</span>
            </a>
        @endauth
    </div>
</aside>
