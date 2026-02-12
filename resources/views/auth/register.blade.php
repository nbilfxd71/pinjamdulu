<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pinjamdulu</title>
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
            padding: 20px;
        }
        .register-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 45px;
        }
        .register-brand {
            text-align: center;
            margin-bottom: 35px;
        }
        .register-brand .icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #0066cc;
        }
        .register-brand h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0066cc;
            margin: 0;
        }
        .register-brand p {
            color: #718096;
            font-size: 0.95rem;
            margin-top: 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        .form-control,
        .form-select {
            border: 2px solid #e2e8f0;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.1);
            outline: none;
        }
        .form-control::placeholder {
            color: #cbd5e0;
        }
        .btn-register {
            background: #0066cc;
            border: none;
            padding: 13px;
            border-radius: 6px;
            color: white;
            font-weight: 600;
            width: 100%;
            margin-top: 20px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0, 102, 204, 0.2);
            font-size: 1rem;
        }
        .btn-register:hover {
            background: #0052a3;
            box-shadow: 0 2px 6px rgba(0, 102, 204, 0.3);
            color: white;
        }
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }
        .login-link p {
            margin: 0;
            color: #718096;
            font-size: 0.95rem;
        }
        .login-link a {
            color: #0066cc;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .login-link a:hover {
            color: #0052a3;
        }
        .alert {
            border: none;
            border-radius: 8px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .alert-danger {
            background-color: #fed7d7;
            color: #742a2a;
        }
        .alert ul {
            margin: 0;
            padding-left: 20px;
        }
        @media (max-width: 576px) {
            .register-container {
                padding: 30px 20px;
            }
            .register-brand h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-brand">
            <div class="icon"><i class="bi bi-tools"></i></div>
            <h2>Pinjamdulu</h2>
            <p>Buat akun untuk memulai</p>
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

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="form-group">
                <label for="name"><i class="bi bi-person"></i> Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap anda" required>
            </div>
            <div class="form-group">
                <label for="email"><i class="bi bi-envelope"></i> Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email anda" required>
            </div>
            <div class="form-group">
                <label for="nomor_identitas"><i class="bi bi-credit-card"></i> Nomor Identitas (KTP/SIM)</label>
                <input type="text" class="form-control @error('nomor_identitas') is-invalid @enderror" id="nomor_identitas" name="nomor_identitas" value="{{ old('nomor_identitas') }}" placeholder="Nomor identitas anda">
            </div>
            <div class="form-group">
                <label for="alamat"><i class="bi bi-geo-alt"></i> Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukkan alamat anda" rows="3">{{ old('alamat') }}</textarea>
            </div>
            <div class="form-group">
                <label for="no_telepon"><i class="bi bi-telephone"></i> No. Telepon</label>
                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Nomor telepon anda">
            </div>
            <div class="form-group">
                <label for="password"><i class="bi bi-lock"></i> Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password anda" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation"><i class="bi bi-lock-check"></i> Konfirmasi Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password anda" required>
            </div>
            <button type="submit" class="btn btn-register">
                <i class="bi bi-person-plus"></i> Daftar Akun
            </button>
        </form>

        <div class="login-link">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
