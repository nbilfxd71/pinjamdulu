<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pinjamdulu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: #0066cc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-attachment: fixed;
        }
        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            margin: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .login-form-section {
            background: white;
            padding: 50px 40px;
            flex: 1;
            min-width: 0;
        }
        .login-info-section {
            background: #0066cc;
            padding: 50px 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
        }
        .login-brand {
            text-align: center;
            margin-bottom: 35px;
        }
        .login-brand h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #0066cc;
            margin: 0;
        }
        .login-brand .icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        .form-control {
            border: 2px solid #e2e8f0;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.1);
            outline: none;
        }
        .form-control::placeholder {
            color: #cbd5e0;
        }
        .btn-login {
            background: #0066cc;
            border: none;
            padding: 13px;
            border-radius: 6px;
            color: white;
            font-weight: 600;
            width: 100%;
            margin-top: 15px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0, 102, 204, 0.2);
            font-size: 1rem;
        }
        .btn-login:hover {
            background: #0052a3;
            box-shadow: 0 2px 6px rgba(0, 102, 204, 0.3);
            color: white;
        }
        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }
        .register-link p {
            margin: 0;
            color: #718096;
            font-size: 0.95rem;
        }
        .register-link a {
            color: #0066cc;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .register-link a:hover {
            color: #0052a3;
        }
        .alert {
            border: none;
            border-radius: 6px;
            margin-bottom: 25px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .alert-danger {
            background-color: #fed7d7;
            color: #742a2a;
        }
        .alert ul {
            margin: 0;
            padding-left: 20px;
        }
        .info-content h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .info-content p {
            font-size: 1rem;
            line-height: 1.6;
            opacity: 0.95;
            margin-bottom: 20px;
        }
        .info-features {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        .info-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }
        .info-features i {
            font-size: 1.2rem;
        }
        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                max-width: 100%;
                margin: 15px;
            }
            .login-form-section,
            .login-info-section {
                padding: 35px 25px;
            }
            .login-brand h2 {
                font-size: 1.5rem;
            }
            .login-info-section {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-form-section">
            <div class="login-brand">
                <div class="icon"><i class="bi bi-tools"></i></div>
                <h2>Pinjamdulu</h2>
            </div>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email"><i class="bi bi-envelope"></i> Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email anda" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="bi bi-lock"></i> Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password anda" required>
                </div>
                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </form>

            <div class="register-link">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>

        <div class="login-info-section">
            <div class="info-content">
                <h3><i class="bi bi-tools"></i> Pinjamdulu</h3>
                <p>Kelola peminjaman alat dengan mudah dan efisien</p>
                
                <ul class="info-features">
                    <li><i class="bi bi-check-circle-fill"></i> Sistem peminjaman yang terstruktur</li>
                    <li><i class="bi bi-check-circle-fill"></i> Tracking real-time untuk setiap peminjaman</li>
                    <li><i class="bi bi-check-circle-fill"></i> Manajemen inventori yang akurat</li>
                    <li><i class="bi bi-check-circle-fill"></i> Interface yang user-friendly</li>
                    <li><i class="bi bi-check-circle-fill"></i> Laporan lengkap dan detail</li>
                </ul>

                <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.2); font-size: 0.85rem; opacity: 0.8;">
                    Demo: admin@pinjamdulu.com / password
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
