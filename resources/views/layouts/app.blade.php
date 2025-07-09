<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sumber Lancar Motor')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand bg-white text-primary font-weight-bold px-3 py-1 rounded" href="{{ route('home') }}">
                Sumber Lancar Motor
            </a>
    
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
    
                    {{-- Keranjang dengan badge --}}
                    <a class="nav-link text-white position-relative" href="{{ route('cart.index') }}">
                        Keranjang
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
    
                    <a class="nav-link text-white" href="{{ route('orders.index') }}">Pesanan</a>
                </div>
    
                <div class="ml-auto d-flex gap-2">
                    <div class="ml-auto d-flex gap-2">
                        @if(Auth::check())
                            <form action="{{ route('user.logout') }}" method="POST" style="display: inline;">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-light btn-sm mr-2">Profil</a>
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success btn-sm mr-2">Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
    

    <div class="container">
        @yield('content')
    </div>

    {{-- footer --}}
    <footer class="bg-primary text-white text-center py-4">
        <div class="container">
            <p class="mb-1 fw-bold">&copy; 2025 Sumber Lancar Motor. All rights reserved.</p>
            <p class="mb-1">Alamat: HFWF+2F2, Jl. Raya Jetis, Jetis, Kec. Jetis, Kabupaten Mojokerto, Jawa Timur 61352</p>
            <p class="mb-0">
                <img src="{{ asset('images/waLogo.png') }}" alt="WA Logo" style="width: 20px; vertical-align: middle;">
                <span class="ms-1">083854263778</span>
            </p>
        </div>
    </footer>
    

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>