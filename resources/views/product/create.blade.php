@extends("dashboard.dashboard")

@section('content')
   <div class="col-md-6">
       @if(session('success'))
           <h4 class="text-success">{{ session('success') }}</h4>
       @endif
       <h2 class="text-generic my-2 text-center">New Product</h2>
       <form action="{{ route("products.store") }}" method="post">
           @csrf
           <div class="mb-3">
               <label for="title" class="form-label">Product Title</label>
               <input type="text" class="form-control" id="title" placeholder="Title">
               @if($errors->has('title'))
                   <p class="text-danger mb-3">{{ $errors->first('title') }}</p>
               @endif
           </div>
           <div class="mb-3">
               <label for="price" class="form-label">Price</label>
               <input type="number" class="form-control" id="price" min="0" placeholder="Price">
               @if($errors->has('price'))
                   <p class="text-danger mb-3">{{ $errors->first('price') }}</p>
               @endif
           </div>
           <div class="mb-3">
               <label for="category" class="form-label">Category</label>
               <select name="category" class="form-select" id="category">
                   @foreach($categories as $category)
                       <option value="{{ $category->name }}">{{ $category->name }}</option>
                   @endforeach
               </select>
               @if($errors->has('category'))
                   <p class="text-danger mb-3">{{ $errors->first('category') }}</p>
               @endif
           </div>
           <div class="mb-3">
               <label for="stock" class="form-label">Stock</label>
               <input type="number" class="form-control" name="stock" id="stock" min="10">
               @if($errors->has('stock'))
                   <p class="text-danger mb-3">{{ $errors->first('stock') }}</p>
               @endif
           </div>
           <div class="mb-3">
               <label for="editor" class="form-label">Description</label>
               <textarea name="description" id="editor"></textarea>
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
               <button type="submit" class="btn btn-custom-primary">Submit</button>
           </div>
       </form>
   </div>
@endsection
