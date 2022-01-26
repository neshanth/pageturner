@extends("layout.app")

@section("content")

<div class="container">
    <h2 class="text-center my-5 text-generic">{{ $title }}</h2>
    <div class="row">
         @foreach($products as $product)
                      <div class="col-md-3">
                          <div class="card mb-3" style="max-width: 14rem">
                              <img src="{{ asset("storage/product/".$product->image) }}" class="card-img-top" alt="{{ $product->image }}">
                              <div class="card-body product-description">
                                    <h5 class="card-title text-bolder text-generic product-title">{{ $product->title }}</h5>
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
                                    </form>
                              </div>
                          </div>
                      </div>
        @endforeach
        </div>
</div>

@endsection