@extends('dashboard.dashboard')

@section('content')
    <div class="col-md-6">
        @if(session('success'))
            <h4 class="text-success">{{ session('success') }}</h4>
        @endif
        <form action="{{ route('roles.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="name" class="form-control" id="role" required>
                @if($errors->has('name'))
                   <p class="text-danger mb-3">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-custom-primary">Submit</button>
        </form>
    </div>
@endsection
