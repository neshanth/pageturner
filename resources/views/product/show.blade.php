@extends("layout.app")

@section("content")
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="item-entry">
                    <a href="#" class="product-item md-height bg-gray d-block">
                        <img src="{{ asset("storage/product/".$product->image) }}" alt="{{ $product->title }}" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="text-black">{{ $product->title }}</h2>
                <p class="book-author text--custom-primary">{{ $product->author }}</p>
                <p>{!! $product->description !!}</p>
                <p><strong class="h4 text-dark"><span class="text--custom-primary">&#8377</span> {{ $product->price }}</strong></p>
                <div class="mb-5">
                    <form class="cart-form text-center">
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
            </div>
        </div>
    </div>
</div>

@endsection