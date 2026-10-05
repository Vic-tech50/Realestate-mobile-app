<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Victech') }} - Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('vendors/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('vendors/images/favicon-32x32.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- DeskApp CSS -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendors/styles/style.css') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
        }

        .login-page {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(25, 118, 210, .12), transparent 35%),
                radial-gradient(circle at bottom right, rgba(40, 167, 69, .08), transparent 35%),
                #f5f7fb;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .login-container {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            background: #fff;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .08);
            display: flex;
        }

        /* =========================
           LEFT SIDE
        ========================= */

        .login-brand-panel {
            width: 48%;
            background: linear-gradient(145deg, #0d6efd 0%, #084298 100%);
            padding: 55px;
            color: #fff;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .login-brand-panel::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
            top: -100px;
            right: -100px;
        }

        .login-brand-panel::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            bottom: -80px;
            left: -80px;
        }

        .brand-content,
        .brand-footer {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            width: 58px;
            height: 58px;
            border-radius: 15px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 35px;
        }

        .brand-title {
            font-size: 34px;
            line-height: 1.2;
            font-weight: 800;
            margin-bottom: 18px;
            color: #fff;
        }

        .brand-description {
            font-size: 15px;
            line-height: 1.8;
            color: rgba(255, 255, 255, .82);
            max-width: 400px;
            margin-bottom: 35px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            color: rgba(255, 255, 255, .92);
            font-size: 14px;
        }

        .feature-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .brand-footer {
            font-size: 12px;
            color: rgba(255, 255, 255, .65);
        }

        /* =========================
           RIGHT SIDE
        ========================= */

        .login-form-panel {
            width: 52%;
            padding: 65px 70px;
            display: flex;
            align-items: center;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 430px;
            margin: auto;
        }

        .welcome-text {
            margin-bottom: 35px;
        }

        .welcome-text h2 {
            font-size: 29px;
            font-weight: 800;
            color: #172033;
            margin-bottom: 8px;
        }

        .welcome-text p {
            color: #7b8495;
            font-size: 14px;
            margin: 0;
        }

        /* Alerts */

        .alert-message {
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .success-message {
            background: #eaf8ef;
            color: #198754;
            border: 1px solid #c9eed7;
        }

        /* Inputs */

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #343b4a;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9aa3b2;
            font-size: 18px;
            z-index: 2;
        }

        .modern-input {
            width: 100%;
            height: 52px;
            border: 1px solid #e2e6ed;
            border-radius: 11px;
            background: #fafbfc;
            padding: 0 48px;
            font-size: 14px;
            color: #1f2937;
            transition: all .2s ease;
        }

        .modern-input:focus {
            outline: none;
            background: #fff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, .08);
        }

        .modern-input.is-invalid {
            border-color: #dc3545;
        }

        .modern-input::placeholder {
            color: #a6adba;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #8d96a5;
            cursor: pointer;
            padding: 4px;
        }

        .password-toggle:hover {
            color: #0d6efd;
        }

        .invalid-message {
            display: block;
            font-size: 12px;
            color: #dc3545;
            margin-top: 7px;
        }

        /* Remember / Forgot */

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 5px 0 28px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #687386;
            font-size: 13px;
            cursor: pointer;
        }

        .remember-label input {
            width: 16px;
            height: 16px;
            accent-color: #0d6efd;
        }

        .forgot-link {
            color: #0d6efd;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* Button */

        .login-button {
            width: 100%;
            height: 52px;
            border: 0;
            border-radius: 11px;
            background: linear-gradient(135deg, #0d6efd, #0754b8);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: .2px;
            cursor: pointer;
            transition: all .2s ease;
            box-shadow: 0 8px 20px rgba(13, 110, 253, .20);
        }

        .login-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 25px rgba(13, 110, 253, .28);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 28px;
            font-size: 12px;
            color: #a0a7b4;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 991px) {

            .login-container {
                max-width: 600px;
            }

            .login-brand-panel {
                display: none;
            }

            .login-form-panel {
                width: 100%;
                padding: 55px 60px;
            }
        }

        @media (max-width: 575px) {

            .login-wrapper {
                padding: 15px;
            }

            .login-container {
                min-height: auto;
                border-radius: 16px;
            }

            .login-form-panel {
                padding: 40px 25px;
            }

            .welcome-text h2 {
                font-size: 25px;
            }

            .login-options {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body class="login-page">

    <div class="login-wrapper">

        <div class="login-container">

            <!-- =========================
                 LEFT BRANDING
            ========================== -->
            <div class="login-brand-panel">

                <div class="brand-content">

                    <div class="brand-logo">
                        V
                    </div>

                    <h1 class="brand-title">
                        Welcome to<br>
                        {{ config('app.name', 'Victech') }}
                    </h1>

                    <p class="brand-description">
                        Manage your properties, agents, notifications
                        and other platform activities from one secure
                        dashboard.
                    </p>

                    <div class="feature-list">

                        <div class="feature-item">
                            <span class="feature-icon">
                                <i class="icon-copy dw dw-building"></i>
                            </span>
                            <span>Manage properties easily</span>
                        </div>

                        <div class="feature-item">
                            <span class="feature-icon">
                                <i class="icon-copy dw dw-user1"></i>
                            </span>
                            <span>Manage agents and users</span>
                        </div>

                        <div class="feature-item">
                            <span class="feature-icon">
                                <i class="icon-copy dw dw-notification"></i>
                            </span>
                            <span>Stay updated with notifications</span>
                        </div>

                    </div>

                </div>

                <div class="brand-footer">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Victech') }}.
                    All rights reserved.
                </div>

            </div>


            <!-- =========================
                 LOGIN FORM
            ========================== -->
            <div class="login-form-panel">

                <div class="login-form-wrapper">

                    <div class="welcome-text">
                        <h2>Welcome back 👋</h2>

                        <p>
                            Sign in to your administrator account
                            to continue.
                        </p>
                    </div>


                    <!-- Success Message -->
                    @if (session('message'))
                        <div class="alert-message success-message">
                            <i class="icon-copy dw dw-check"></i>
                            {{ session('message') }}
                        </div>
                    @endif


                    <!-- Login Form -->
                    <form action="/authLogin" method="POST">

                        @csrf


                        <!-- Email -->
                        <div class="form-group">

                            <label class="form-label">
                                Email Address
                            </label>

                            <div class="input-wrapper">

                                <i class="input-icon icon-copy dw dw-user1"></i>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="modern-input @error('email') is-invalid @enderror"
                                    placeholder="Enter your email address"
                                    autocomplete="email"
                                >

                            </div>

                            @error('email')
                                <span class="invalid-message">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <!-- Password -->
                        <div class="form-group">

                            <label class="form-label">
                                Password
                            </label>

                            <div class="input-wrapper">

                                <i class="input-icon dw dw-padlock1"></i>

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="modern-input @error('password') is-invalid @enderror"
                                    placeholder="Enter your password"
                                    autocomplete="current-password"
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    onclick="togglePassword()"
                                    aria-label="Show password"
                                >
                                    <i class="dw dw-eye" id="passwordIcon"></i>
                                </button>

                            </div>

                            @error('password')
                                <span class="invalid-message">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <!-- Options -->
                        <div class="login-options">

                            <label class="remember-label">

                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    {{ old('remember') ? 'checked' : '' }}
                                >

                                <span>Remember me</span>

                            </label>

                            <a href="#" class="forgot-link">
                                Forgot password?
                            </a>

                        </div>


                        <!-- Submit -->
                        <button type="submit" class="login-button">
                            Sign In
                        </button>

                    </form>


                    <div class="login-footer">
                        Secure administrator access
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- DeskApp JS -->
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>


    <script>
        function togglePassword() {

            const password = document.getElementById('password');
            const icon = document.getElementById('passwordIcon');

            if (password.type === 'password') {

                password.type = 'text';

                icon.classList.remove('dw-eye');
                icon.classList.add('dw-invisible');

            } else {

                password.type = 'password';

                icon.classList.remove('dw-invisible');
                icon.classList.add('dw-eye');
            }
        }
    </script>

</body>

</html>