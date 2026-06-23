<x-guest-layout>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
            background: linear-gradient(135deg, #eaf2f7, #f8fafc);
        }

        .login-wrapper {
            width: 100%;
            max-width: 1100px;
            min-height: 620px;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            background: #ffffff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.14);
        }

        .login-left {
            position: relative;
            padding: 36px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #ffffff;
            background:
                linear-gradient(135deg, rgba(153, 27, 27, 0.78), rgba(239, 68, 68, 0.72), rgba(127, 29, 29, 0.65)),
                url('{{ asset('images/Bapenda-Kota-Semarang.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .login-left::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(127, 29, 29, 0.18) 0%,
                rgba(153, 27, 27, 0.35) 45%,
                rgba(69, 10, 10, 0.55) 100%
            );
            pointer-events: none;
        }

        .login-left-content,
        .login-left-footer {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .brand-logo img {
            height: 58px;
            width: auto;
            display: block;
            object-fit: contain;
            background: rgba(255, 255, 255, 0.1);
            padding: 6px 10px;
            border-radius: 14px;
            backdrop-filter: blur(8px);
        }

        .brand-text {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.95;
        }

        .left-title {
            font-size: 46px;
            line-height: 1.12;
            font-weight: 900;
            margin: 0 0 18px;
            max-width: 500px;
        }

        .left-subtitle {
            font-size: 18px;
            line-height: 1.75;
            max-width: 520px;
            margin: 0;
            color: rgba(255, 255, 255, 0.92);
        }

        .left-info-box {
            max-width: 520px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 22px;
            padding: 18px 18px;
            backdrop-filter: blur(10px);
        }

        .left-info-box h4 {
            margin: 0 0 8px;
            font-size: 18px;
            font-weight: 800;
            color: #ffffff;
        }

        .left-info-box p {
            margin: 0;
            font-size: 14px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.92);
        }

        .login-right {
            padding: 52px 48px;
            display: flex;
            align-items: center;
            background: #ffffff;
        }

        .login-form-wrap {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }

        .avatar-circle {
            width: 62px;
            height: 62px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fee2e2;
            color: #dc2626;
            font-size: 24px;
            font-weight: 900;
            margin-bottom: 24px;
        }

        .login-heading {
            margin: 0;
            font-size: 42px;
            font-weight: 900;
            line-height: 1.1;
            color: #0f172a;
        }

        .login-description {
            margin: 14px 0 30px;
            font-size: 16px;
            line-height: 1.8;
            color: #64748b;
        }

        .field-group {
            margin-bottom: 20px;
        }

        .field-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 800;
            color: #0f172a;
        }

        .field-input {
            width: 100%;
            height: 54px;
            border: 1px solid #cbd5e1;
            border-radius: 16px;
            padding: 0 16px;
            font-size: 14px;
            color: #0f172a;
            background: #ffffff;
            outline: none;
            transition: 0.2s ease;
        }

        .field-input:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12);
        }

        .field-input::placeholder {
            color: #94a3b8;
        }

        .error-text {
            margin-top: 8px;
            font-size: 13px;
            color: #dc2626;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-top: 6px;
            margin-bottom: 26px;
            flex-wrap: wrap;
        }

        .remember-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
        }

        .remember-label input {
            width: 16px;
            height: 16px;
            accent-color: #dc2626;
        }

        .forgot-link {
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            color: #b91c1c;
        }

        .forgot-link:hover {
            color: #7f1d1d;
        }

        .login-button {
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: #ffffff;
            font-size: 15px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(239, 68, 68, 0.28);
            transition: 0.2s ease;
        }

        .login-button:hover {
            transform: translateY(-1px);
            background: linear-gradient(135deg, #b91c1c, #dc2626);
        }

        .session-status {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 14px;
            background: #dcfce7;
            color: #166534;
            font-size: 14px;
            font-weight: 700;
        }

        .footer-note {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #e5e7eb;
            font-size: 13px;
            line-height: 1.7;
            color: #94a3b8;
        }

        @media (max-width: 960px) {
            .login-wrapper {
                grid-template-columns: 1fr;
            }

            .login-left {
                min-height: 360px;
            }

            .left-title {
                font-size: 34px;
            }

            .login-right {
                padding: 36px 24px;
            }
        }

        @media (max-width: 640px) {
            .login-page {
                padding: 16px;
            }

            .login-wrapper {
                border-radius: 22px;
            }

            .login-left,
            .login-right {
                padding: 24px;
            }

            .left-title {
                font-size: 28px;
            }

            .login-heading {
                font-size: 32px;
            }
        }
    </style>

    <div class="login-page">
        <div class="login-wrapper">
            <div class="login-left">
                <div class="login-left-content">
                    <div class="brand-logo">
                        <img src="{{ asset('images/1.png') }}" alt="Logo Bapenda">
                        <div class="brand-text">Badan Pendapatan Daerah</div>
                    </div>

                    <h1 class="left-title">
                        Monitoring Sistem dan Aset Bapenda
                    </h1>

                    <p class="left-subtitle">
                        Kelola laporan gangguan sistem, bug aplikasi, dan kerusakan aset
                        secara lebih cepat, rapi, terkontrol, dan terintegrasi.
                    </p>
                </div>

                <div class="login-left-footer">
                    <div class="left-info-box">
                        <h4>📋 Sistem Pelaporan Internal</h4>
                        <p>
                            Staff dapat membuat laporan, sedangkan admin dapat memantau,
                            menanggapi, dan memperbarui status laporan secara real-time.
                        </p>
                    </div>
                </div>
            </div>

            <div class="login-right">
                <div class="login-form-wrap">
                    <div class="avatar-circle">S</div>

                    <h2 class="login-heading">Masuk Akun</h2>
                    <p class="login-description">
                        Silakan login menggunakan email dan password yang sudah terdaftar.
                    </p>

                    @if (session('status'))
                        <div class="session-status">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="field-group">
                            <label for="email" class="field-label">Email</label>
                            <input
                                id="email"
                                class="field-input"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Masukkan email"
                            >
                            @error('email')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="password" class="field-label">Password</label>
                            <input
                                id="password"
                                class="field-input"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                            >
                            @error('password')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="remember-row">
                            <label for="remember_me" class="remember-label">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>Ingat saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="login-button">
                            Masuk
                        </button>
                    </form>

                    <div class="footer-note">
                        © {{ date('Y') }} BAPENDA. Sistem Monitoring dan Pelaporan Aset.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>