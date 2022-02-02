@extends("layout.app")

@section("content")
<h2 class="text-center text-custom-primary">Search</h2>
@if($products->count() < 1) <h4>No Results Found</h4>

    @else
    <div class="container">
        <div class="row">
            <p class="text-center result-text text-custom-secondary">Found <span class="result-count">{{ $products->count() }}</span> {{ $products->count() > 1 ? 'Results' : 'Result'  }} for {{ $bookName }} </p>
            @foreach ($products as $product )
            <div class="col-md-4">
                <div class="card mb-3 h-100" style="width: 18rem;">
                    <a href="{{ '/product/' .$product->id }}">
                        <img src="{{ asset("storage/product/".$product->image) }}" class="card-img-top" alt="{{ $product->image }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ '/product/' .$product->id }}">{{ $product->title }}</a>
                        </h5>
                        <p class="card-text">{!! substr(strip_tags($product->description),0,100) !!}...</p>
                        <p class="card-text fs-5"><span class="text-generic">&#x20B9</span> {{ $product->price }}</p>
                        <form class="cart-form">
                            @csrf
                            <input type="hidden" class="product-id" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" class="price" name="price" value="{{ $product->price }}">
                            @auth
                            <input type="hidden" class="customer-id" name="customer_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                            @endauth
                            <button class="btn btn-custom-primary" id="cart-submit">Add to Cart</button>
                            <p class="cart-success text-success"></p>
                            <p class="cart-fail text-danger"></p>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @endsection