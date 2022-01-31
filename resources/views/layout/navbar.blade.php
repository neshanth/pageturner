<header class="header container align-items-center">
    <div class="logo">
        <a href="/">
            <img src="{{ asset("images/logo.png")}}" class="logo-image" width="30px" alt="Logo" />
        </a>
    </div>
    <div class="right-menu">
        <a href="#" class="search-icon"><i class="fa fa-search"> </i></a></li>
        <div class="desktop-menu">
            <nav class="desktop-navigation">
                <ul class="navigation-items align-items-center">
                    @guest
                    <li><a href="{{ route("login") }}">Login</a></li>
                    <li><a href="{{ route("register") }}" class="btn btn-custom-primary">Sign Up</a></li>
                    @endguest
                    @auth
                    <li><a href="{{ route("dashboard") }}"> <i class="fas fa-user"></i> Profile</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
        <a href="/cart/show" class="text-custom-primary cart-link">
            <i class="fa fa-shopping-cart"></i>
            <span class="cart-count">0</span>
        </a>
        <button class="custom-btn text-custom-primary hamburger">
            <i class="fa fa-bars"></i>
        </button>
    </div>
</header>
<div class="container search-container hide-items">
    <h3 class="text-center">Search</h3>
    <div class="close-container">
        <button class="close-btn btn btn-custom-secondary">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <form action="" class="search-form" method="post">
        <input type="text" name="" class="search-input" id="" placeholder="Enter Book Name...">
        <button class="btn btn-custom-primary"> <i class="fa fa-search"></i> </button>
    </form>
</div>
<div class="mobile-menu hide-menu">
    <nav class="mobile-navigation container">
        <ul>
            @guest
            <li><a href="{{ route("login") }}">Login</a></li>
            <li><a href="{{ route("register") }}">Sign Up</a></li>
            @endguest
            @auth
            <li><a href="{{ route("dashboard") }}">Profile</a></li>
            @endauth
        </ul>
    </nav>
</div>