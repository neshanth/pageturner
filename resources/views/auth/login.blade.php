@extends("layout.app")

@section("content")
<div class="container">
    <div class="title-section text-center mb-5 mt-5 col-12">
        <h2 class="text-uppercase">Login</h2>
    </div>
    @if(session('error'))
    <h4 class="text-danger">{{ session('error') }}</h4>
    @endif
    <form class="w-75 mx-auto" action="{{ route('login') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label text--custom-primary">Email</label>
            <input type="email" name="email" class="form-control-lg form-control" id="email" placeholder="Email">
            @if($errors->has('email'))
            <p class="text-danger my-3">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="password" class="form-label text--custom-primary">Password</label>
            <input type="password" name="password" class="form-control-lg form-control" id="password" placeholder="Password">
            @if($errors->has('password'))
            <p class="text-danger my-3">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <button class="btn btn-lg btn--custom-primary">Login</button>
            <p class="text-dark mx-4 my-1"><a href="{{ route('register') }}">Create Account</a></p>
        </div>
    </form>
</div>
@endsection