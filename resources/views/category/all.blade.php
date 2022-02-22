@extends("layout.app")

@section("content")
<div class="row">
    <div class="title-section text-center mb-5 mt-5 col-12">
        <h2 class="text-uppercase">All Categories</h2>

        <div class="row justify-content-between mt-5">
            @foreach ($categories as $category)
            <div class="col-md-2 col-sm-3 col-4 mx-2 my-2">
                <a href="{{ '/category/'.$category->id }}">
                    <img src="{{ asset("storage/category/".$category->image) }}" alt={{ $category->name }} width="62px">
                </a>
                <div class="cat-name-container mt-3">
                    <p class="cat-name text--custom-primary"><a class="cat-link" href="{{ '/category/'.$category->id }}">{{ $category->name }}</a></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection