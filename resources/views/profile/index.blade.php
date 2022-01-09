@extends("dashboard.dashboard")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2 class="text-uppercase text-center">Profile</h2>
            @foreach($details as $detail)
                <div class="mb-3 text-center">
                    @if($detail->avatar)
                        <img src="{{ asset('storage/avatar/'. $detail->avatar) }}" class="rounded img-rounded text-center" alt="avatar">
                    @else
                        <img src="{{ asset("images/avatar.png") }}" class="rounded img-rounded text-center" alt="avatar" width="150px" />
                    @endif
                </div>
                <form action="{{ route('profile',[$detail->id]) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $detail->name }}">
                        @if($errors->has('name'))
                          <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $detail->email }}">
                        @if($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" name="avatar" type="file" id="formFile">
                        @if($errors->has('avatar'))
                            <p class="text-danger">{{ $errors->first('avatar') }}</p>
                        @endif
                    </div>
                    <input type="hidden" name="user_id" value="{{ $detail->id }}">
                    <div class="mb-3">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>

            @endforeach
        </div>
    </div>

</div>

@endsection
