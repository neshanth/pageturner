@extends("dashboard.dashboard")

@section('content')
    <div class="col-md-6">
        @if(session('success'))
            <h4 class="text-success">{{ session('success') }}</h4>
        @endif
        @foreach($product as $p)
        <h2 class="text-generic my-2 text-center">Edit Product</h2>
        <form action="{{ route("products.update",[$p->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Product Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ $p->title }}">
                @if($errors->has('title'))
                    <p class="text-danger mb-3">{{ $errors->first('title') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" min="0" placeholder="Price" value="{{ $p->price }}">
                @if($errors->has('price'))
                    <p class="text-danger mb-3">{{ $errors->first('price') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="cat_id" class="form-label">Category</label>
                <select name="cat_id" class="form-select" id="cat_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id === $p->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('cat_id'))
                    <p class="text-danger mb-3">{{ $errors->first('category') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" name="stock" id="stock" min="10" value="{{ $p->stock }}">
                @if($errors->has('stock'))
                    <p class="text-danger mb-3">{{ $errors->first('stock') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="editor" class="form-label">Description</label>
                <textarea name="description" id="editor">{{ $p->description }}</textarea>
                @if($errors->has('description'))
                    <p class="text-danger mb-3">{{ $errors->first('description') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" name="image" type="file" id="formFile">
                @if($errors->has('image'))
                    <p class="text-danger mb-3">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-custom-primary">Update</button>
            </div>
        </form>
        @endforeach
    </div>
@endsection
