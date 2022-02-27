@extends("dashboard.dashboard")

@section('content')

<div class="col-md-12">
    <h2 class="text-custom-primary my-2 text-center">All Products</h2>
    @if(session('success'))
    <h4 class="text-success text-center">{{ session('success') }}</h4>
    @endif
    <div class="add-category d-flex justify-content-end my-2">
        <a class="btn btn--custom-primary" href="{{ route('products.create') }}">Add Product <i class="fa fa-plus"></i></a>
    </div>
    <div class="table-responsive">
        <table class="table" id="myTable">
            <thead>
                <tr class="bg-custom text-white">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($products as $key=>$product)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td><img width="100" src="{{ asset("storage/product/".$product->image) }}" alt="{{ $product->image }}"></td>
                    <td>{{ $product->stock }}</td>
                    <td>{!! substr(strip_tags($product->description),0,100) !!}</td>
                    <td class="text-danger">
                        <a href="{{ route("products.edit",[$product->id]) }}">
                            <button class="btn btn-warning">Edit</button>
                        </a>
                        <form action="{{ route("products.destroy", $product->id) }}" method="post" class="my-1">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection