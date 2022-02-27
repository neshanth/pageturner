<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @auth
        <li class="nav-item">
            <form action={{ route("logout") }} method="post">
                @csrf
                <button class="btn btn-link p-0  text-danger mx-3">Logout</button>
            </form>
        </li>
        @endauth
    </ul>
</nav>
<!-- /.navbar -->