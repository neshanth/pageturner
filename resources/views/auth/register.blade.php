@extends("layout.app")

@section('content')
    <div class="container">
        <h2 class="text-center">Register</h2>
        @if(session('success'))
             <h4 class="text-success">{{ session('success') }}</h4>
        @endif
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control-lg form-control" id="name" placeholder="Name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control-lg form-control" id="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control-lg form-control" id="password" placeholder="Passwords">
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button class="btn btn-lg btn-custom-primary">Register</button>
            </div>
        </form>
    </div>
@endsection
