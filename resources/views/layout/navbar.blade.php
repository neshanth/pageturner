<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="#">PageTurner</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
        </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                <li class="nav-item mx-4 mt-1">
                   <a class="custom-link text-dark fw-bold fs-5" aria-current="page" href="{{ route('login') }}">Log In</a>
                </li>
                 <li class="nav-item mx-4 mt-1">
                   <a class="btn btn-custom-primary fw-bold" aria-current="page" href="{{ route("register") }}">Register Now</a>
                </li>
                @else
                    <li class="nav-item mx-4 mt-1">
                        Welcome
                        <a class="custom-link fw-bold text-uppercase" href="{{ route('dashboard') }}" aria-current="page">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                    </li>
                    <form action="logout" method="post">
                        @csrf
                         <button class="btn btn-link p-0  text-danger mx-3">Logout</button>
                    </form>
                @endguest
                <li class="nav-item mx-4 mt-1 fs-4">
                    <a href="#" class="custom-link">
                        <i class="fa fa-shopping-cart text-generic"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

