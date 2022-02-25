@extends("layout.app")

@section('content')
<div class="container">
    <div class="title-section text-center mb-5 mt-5 col-12">
        <h2 class="text-uppercase">Register</h2>
    </div>
    @if(session('success'))
    <h4 class="text-success text-center">{{ session('success') }}</h4>
    @endif
    <form class="w-75 mx-auto" action="{{ route('register') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label text--custom-primary">Name</label>
            <input type="text" name="name" class="form-control-lg form-control" id="name" placeholder="Name">
            @if($errors->has('name'))
            <p class="text-danger my-3">{{ $errors->first('name') }}</p>
            @endif
        </div>
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
        <div class="mb-3">
            <label for="password_confirmation" class="form-label text--custom-primary">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control-lg form-control" id="password" placeholder="Password">
            @if($errors->has('password_confirmation'))
            <p class="text-danger my-3">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <button class="btn btn-lg btn--custom-primary">Register</button>
        </div>
    </form>
</div>
@endsection