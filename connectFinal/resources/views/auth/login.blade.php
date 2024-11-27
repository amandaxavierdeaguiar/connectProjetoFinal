<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Corpo e fundo */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            background: url('images/imagemfundo.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        /* Área principal */
        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Estilo da navbar */
        .navbar {
            background-color: rgba(54, 35, 106, 0.8);
        }

        .navbar .nav-link, .navbar-brand {
            color: #fff !important;
        }

        .navbar .nav-link:hover {
            color: #d4d4d4 !important;
        }

        /* Animação da imagem */
        .logo-container {
            animation: slide-in 2s ease-out;
            opacity: 0;
            animation-fill-mode: forwards;
            position: absolute;
            bottom: 70%;
        }

        @keyframes slide-in {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(-50%);
                opacity: 1;
            }
        }

        .logo {
            max-width: 300px;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                </ul>
            </div>
        </div>
        @if (Route::has('login'))
        <div class="ms-auto">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-white font-bold no-underline me-3">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-white font-bold no-underline me-3">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-white font-bold no-underline">Register</a>
                @endif
            @endauth
        </div>
        @endif
    </nav>

    <!-- Content -->
    <div class="content">
        <div class="logo-container">
            <img src="images/cesaelogo.jpg" alt="Logo" class="logo">
        </div>
        <div class="card w-25 p-4 shadow mt-5">
            <h2 class="text-center mb-4">Login</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus autocomplete="username">
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                    <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-secondary">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

