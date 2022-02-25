@extends("layout.app")

@section("content")
<div class="title-section text-center mb-5 mt-5 col-12">
    <h2 class="text-uppercase">Search</h2>
</div>
@if($products->count() < 1) <h4 class="text-center text-dark">No Results Found</h4>

    @else
    <p class="text-center text--custom-primary">Found {{ count($products) }} {{ count($products) > 1 ?  "Results" : "Result" }} For {{ $query }}</p>
    <div class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-9 order-1">
                    <div class="row mb-5">
                        @foreach ($products as $product)
                        <div class="col-lg-4 text-center col-md-4 item-entry category-item mb-4">
                            <a href="{{ "/product/" . $product->id }}" class="product-item md-height bg-gray d-block">
                                <img src="{{ asset("storage/product/".$product->image) }}" alt="Image" class="img-fluid">
                            </a>
                            <h2 class="item-title"><a href="{{ "/product/" . $product->id }}">{{ $product->title }}</a></h2>
                            <strong class="item-price d-block">${{ $product->price }}</strong>
                            <form class="cart-form">
                                @csrf
                                <input type="hidden" class="product-id" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" class="price" name="price" value="{{ $product->price }}">
                                @auth
                                <input type="hidden" class="customer-id" name="customer_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                                @endauth
                                <button class="btn btn--custom-primary" id="cart-submit">Add to Cart</button>
                                <p class="cart-success text-success"></p>
                                <p class="cart-fail text-danger"></p>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

    @endsection