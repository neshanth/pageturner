@extends("dashboard.dashboard")


@section('content')
    <div class="col-md-10">
        <h2 class="text-generic my-5 text-center">All Categories</h2>
        @if(session('success'))
            <h4 class="text-danger">{{ session('success') }}</h4>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="bg-custom text-white">
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($categories as $key=>$category)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $category->name }}</td>
                        <td><img src="{{ asset('storage/category/'.$category->image) }}" width="50px" /></td>
                        <td>
                            <div class="buttons d-flex">
                                <a class="btn btn-warning mx-1" href="{{ route("categories.edit",$category->id) }}">Edit</a>
                                <form action="{{ route("categories.destroy", $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mx-1">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
