<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Basketin</title>
    
    <!-- Cinematic Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/global.css', 'resources/css/pages/auth.css'])
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-container">
            <h1 class="auth-brand">Bergabung.</h1>
            <p class="auth-subtitle">Daftarkan diri Anda ke dalam roster tim basket elite kami.</p>

            <form action="{{ route('register') }}" method="POST" class="auth-form">
                @csrf
                
                @if($errors->any())
                    <div class="alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <div class="aform-group">
                    <label class="aform-label">Nama Lengkap</label>
                    <input type="text" name="name" class="aform-input" placeholder="Masukkan nama" required value="{{ old('name') }}">
                </div>

                <div class="aform-group">
                    <label class="aform-label">Email Address</label>
                    <input type="email" name="email" class="aform-input" placeholder="contoh@ekskul.id" required value="{{ old('email') }}">
                </div>
                
                <div style="display: flex; gap: 16px;">
                    <div class="aform-group" style="flex: 1;">
                        <label class="aform-label">Password</label>
                        <input type="password" name="password" class="aform-input" placeholder="Buat sandi" required>
                    </div>
                    <div class="aform-group" style="flex: 1;">
                        <label class="aform-label">Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="aform-input" placeholder="Ulangi" required>
                    </div>
                </div>
                
                <div class="auth-btn-container">
                    <button type="submit" class="btn-auth">Draft Sekarang</button>
                </div>
            </form>

            <div class="auth-footer">
                Sudah ada di roster? <a href="/login" class="auth-link">Login di sini</a>
            </div>
        </div>
    </div>

</body>
</html>
