<!-- <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="/">PageTurner</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                <li class="nav-item me-3  mt-1">
                    <a class="custom-link text-dark fw-bold fs-5" aria-current="page" href="{{ route('login') }}">Log In</a>
                </li>
                <li class="nav-item me-3 mt-1">
                    <a class="btn btn-custom-primary fw-bold" aria-current="page" href="{{ route("register") }}">Register Now</a>
                </li>
                @else
                <li class="nav-item me-3 mt-1">
                    Welcome
                    <a class="custom-link fw-bold text-uppercase" href="{{ route('dashboard') }}" aria-current="page">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                </li>
                <form action="{{ route("logout") }}" method="post">
                    @csrf
                    <button class="btn btn-link p-0  text-danger mx-3">Logout</button>
                </form>
                @endguest
                <li class="nav-item mt-1 fs-4">

                </li>
            </ul>
            <a href="/cart/show" class="custom-link">
                <i class="fa fa-shopping-cart text-generic"></i>
                <p class="d-inline-block">
                    <span class="cart-count"></span>
                </p>
            </a>
        </div>
    </div>
</nav> -->
<header class="header container align-items-center">
    <div class="logo">
        <a href="/">
            <img src="{{ asset("images/logo.png")}}" class="logo-image" width="30px" alt="Logo" />
        </a>
    </div>
    <div class="right-menu d-flex">
        <button class="custom-btn text-custom-primary hamburger">
            <i class="fa fa-bars"></i>
        </button>
        <div class="desktop-menu">
            <nav class="desktop-navigation">
                <ul class="navigation-items align-items-center">
                    @guest
                    <li><a href="{{ route("login") }}">Login</a></li>
                    <li><a href="{{ route("register") }}" class="btn btn-custom-primary">Sign Up</a></li>
                    @endguest
                </ul>
            </nav>
        </div>
        <a href="/cart/show" class="text-custom-primary cart-link">
            <i class="fa fa-shopping-cart"></i>
            <span class="cart-count">0</span>
        </a>
    </div>
</header>
<div class="mobile-menu hide-menu">
    <nav class="mobile-navigation container">
        <ul>
            @guest
            <li><a href="{{ route("login") }}">Login</a></li>
            <li><a href="{{ route("register") }}">Sign Up</a></li>
            @endguest
        </ul>
    </nav>
</div>