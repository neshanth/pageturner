@extends('dashboard.dashboard')

@section('content')
@foreach ($address as $a )
    <div class="col-md-6">
     <h2 class="text-generic my-1 text-center">Edit Address</h2>
     <form action="{{ route("address.update",[$a->id]) }}" method="post">
         @csrf
         @method('PUT')
        <div class="mb-3">
            <label for="firstname" class="form-label">FirstName</label>
            <input type="text" name="firstname" class="form-control" required value="{{ $a->firstname }}">
            @if($errors->has('firstname'))
                <p class="text-danger mb-3">{{ $errors->first('firstname') }}</p>
            @endif
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">LastName</label>
          <input type="text" name="lastname" class="form-control" value={{ $a->lastname }}>
        </div>
        <div class="mb-3">
            <label for="full_address" class="form-label">Address</label>
            <textarea class="form-control" name="full_address" id="full_address" rows="3" required>
                {{ $a->full_address }}
            </textarea>
            @if($errors->has('full_address'))
                <p class="text-danger mb-3">{{ $errors->first('full_address') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <select class="form-select" name="state" id="state" required>
               <option value="1">One</option>
            </select>
            @if($errors->has('state'))
                <p class="text-danger mb-3">{{ $errors->first('state') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <select class="form-select" name="city" id="city" required>
               <option value="1">One</option>
            </select>
            @if($errors->has('city'))
                <p class="text-danger mb-3">{{ $errors->first('city') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="postcode" class="form-label">Postcode</label>
            <input type="text" name="postcode" class="form-control" required value="{{ $a->postcode }}">
            @if($errors->has('postcode'))
                <p class="text-danger mb-3">{{ $errors->first('postcode') }}Please provide an Indian Postcode</p>
            @endif
        </div>
        <div class="mb-3">
            <button class="btn btn-custom-primary">Update</button>
        </div>
        @if(session('success'))
            <h4 class="text-success">{{ session('success') }}</h4>
        @endif
        @auth
          <input type="hidden" name="user_id" value={{  \Illuminate\Support\Facades\Auth::user()->id }}>
        @endauth
     </form>
</div>
@endforeach


@endsection