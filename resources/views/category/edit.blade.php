@extends("dashboard.dashboard")

@section("content")
<div class="col-md-6">
    @if(session('success'))
    <h4 class="text-success">{{ session('success') }}</h4>
    @endif
    <h2 class="text-generic my-5 text-center">Edit {{ $category->name }}</h2>
    <form action="{{ route("categories.update",[$category->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="role" required value="{{ $category->name }}">
            @if($errors->has('name'))
            <p class="text-danger mb-3">{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
            @if($errors->has('image'))
            <p class="text-danger mb-3">{{ $errors->first('image') }}</p>
            @endif
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-custom-primary">Submit</button>
        </div>
    </form>
</div>

@endsection