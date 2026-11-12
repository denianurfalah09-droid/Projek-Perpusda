<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas Admin - Perpusda Purwakarta</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>
<body>

    <div class="login-wrapper">
        <div class="login-card">

            <!-- Header / Logo -->
            <div class="login-brand-header">
                <a href="{{ route('beranda') }}" class="login-logo-link" title="Kembali ke Beranda">
                    <div class="login-icon-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <div class="brand-text">
                        <h2>PERPUSDA</h2>
                        <span>PURWAKARTA</span>
                    </div>
                </a>
                <div class="login-badge">Portal Petugas</div>
            </div>

            <div class="login-intro">
                <h1>Masuk ke Dashboard</h1>
                <p>Silakan masukkan kredensial akun Anda untuk mengelola sistem informasi perpustakaan.</p>
            </div>

            <!-- Flash Error Notification -->
            @if ($errors->has('login_error'))
                <div class="login-alert-danger">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <span>{{ $errors->first('login_error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="login-alert-success">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="login-form">
                @csrf

                <!-- Username / Email Field -->
                <div class="form-group">
                    <label for="username">Email atau Username</label>
                    <div class="input-with-icon">
                        <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username', 'admin@perpusda.purwakarta.go.id') }}"
                            placeholder="admin@perpusda.purwakarta.go.id"
                            required
                            autofocus
                        >
                    </div>
                    @error('username')
                        <span class="field-error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <div class="label-row">
                        <label for="password">Password</label>
                    </div>
                    <div class="input-with-icon">
                        <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            value="admin123"
                            placeholder="Masukkan password admin"
                            required
                        >
                        <button type="button" class="btn-toggle-pwd" id="togglePwdBtn" aria-label="Lihat password">
                            <svg id="eyeOpen" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            <svg id="eyeClosed" style="display:none;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="field-error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember" id="remember" checked>
                        <span class="checkmark"></span>
                        <span class="label-text">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <button type="submit" class="btn-login-submit">
                    <span>Masuk ke Dashboard</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </form>

            <div class="login-hint-box">
                <div class="hint-title">💡 Akun Akses Awal:</div>
                <div class="hint-details">
                    <div>Email: <code>admin@perpusda.purwakarta.go.id</code></div>
                    <div>Password: <code>admin123</code></div>
                </div>
            </div>

            <div class="login-card-footer">
                <a href="{{ route('beranda') }}" class="back-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    <span>Kembali ke Website Utama</span>
                </a>
            </div>

        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('togglePwdBtn');
        const pwdInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        if (toggleBtn && pwdInput) {
            toggleBtn.addEventListener('click', function() {
                if (pwdInput.type === 'password') {
                    pwdInput.type = 'text';
                    eyeOpen.style.display = 'none';
                    eyeClosed.style.display = 'block';
                } else {
                    pwdInput.type = 'password';
                    eyeOpen.style.display = 'block';
                    eyeClosed.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>