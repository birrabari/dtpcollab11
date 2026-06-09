<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ekskul kuu</title>
    
    <!-- Cinematic Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/global.css', 'resources/css/pages/auth.css'])
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-cover" style="background-image: url('{{ asset('images/team-photo.jpg') }}');">
            <div class="auth-cover-overlay"></div>
            <div class="auth-cover-content">
                <h2>J.A.B.F.G</h2>
                <p>Bersama Meraih Prestasi.</p>
            </div>
        </div>

        <div class="auth-form-section">
            <div class="auth-container">
                <h1 class="auth-brand">ekskul kuu.</h1>
                <p class="auth-subtitle">Masuk untuk mengelola tim basket Anda.</p>

                <form action="{{ route('login') }}" method="POST" class="auth-form">
                    @csrf
                    
                    @if($errors->any())
                        <div class="alert-error">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    
                    <div class="aform-group">
                        <label class="aform-label">Email Address</label>
                        <input type="email" name="email" class="aform-input" placeholder="contoh@ekskul.id" required value="{{ old('email') }}">
                    </div>
                    
                    <div class="aform-group">
                        <label class="aform-label">Password</label>
                        <input type="password" name="password" class="aform-input" placeholder="Masukkan password" required>
                    </div>
                    
                    <div class="auth-btn-container">
                        <button type="submit" class="btn-auth">Akses Lapangan</button>
                    </div>
                </form>

                <div class="auth-footer">
                    Belum masuk daftar? <a href="/register" class="auth-link">Gabung Sekarang</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
