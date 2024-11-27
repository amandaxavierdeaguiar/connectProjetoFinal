<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            background: url('images/imagemfundo.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        footer {
            flex-shrink: 0;
            background-color: rgba(54, 35, 106, 0.8);
            color: #fff;
        }
        .navbar {
            background-color: rgba(54, 35, 106, 0.8);
        }
        .navbar .nav-link, .navbar-brand {
            color: #fff !important;
        }
        .navbar .nav-link:hover {
            color: #d4d4d4 !important;
        }


        .logo-container {
            animation: slide-in 2s ease-out;
            opacity: 0;
            animation-fill-mode: forwards;
        }


        @keyframes slide-in {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
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
    <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <a
                href="{{ url('/dashboard') }}"
                class="rounded-md px-3 py-2 text-white font-bold no-underline ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20]"
            >
                Dashboard
            </a>
        @else
            <a
                href="{{ route('login') }}"
                class="px-3 py-2 text-white font-bold no-underline"
            >
                Log in
            </a>

            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="rounded-md px-3 py-2 text-white font-bold no-underline ring-1 ring-transparent transition hover:text-white focus:outline-none focus-visible:ring-[#FF2D20]"
                >
                    Register
                </a>
            @endif
        @endauth
    </nav>
@endif


     
    </nav>


    <div class="container content mt-4">
        <div class="logo-container">

            <img src="{{ asset('images/cesaeconnect.jpg') }}" alt="Connect" style="width: 800px; height: auto;" class="logo">

            {{-- <img src="{{ asset('images/caixadialog.jpg') }}" alt="Connect" class="logo"> --}}

        </div>
    </div>

    <!-- Rodapé -->
    <footer class="text-center py-1">
    <p class="mb-0">&copy; {{ date('Y') }}</p>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>






