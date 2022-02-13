@extends('layout.app')



@section('content')
<div class="site-blocks-cover" data-aos="fade">
    <div class="container">
        <div class="row">
            <div class="col-md-6 ml-auto order-md-2 align-self-start">
                <div class="site-block-cover-content">
                    <h1 class="text--custom-primary">Welcome To BookStore</h1>
                </div>
            </div>
            <div class="col-md-6 order-1 align-self-end">
                <img src="{{ asset('images/banner2.jpg') }}" alt="Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>


<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section text-center mb-5 col-12">
                <h2 class="text-uppercase">Recently Added</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 block-3">
                <div class="nonloop-block-3 owl-carousel">
                    @foreach ($products as $product)
                    <div class="item">
                        <div class="item-entry">
                            <a href="{{ '/product/' .$product->id }}" class="product-item md-height bg-gray d-block">
                                <img src="{{ asset("storage/product/".$product->image) }}" alt="Image" class="img-fluid" />
                            </a>
                            <h2 class="item-title text-center"><a href="{{ '/product/' .$product->id }}">{{ $product->title }}</a></h2>
                            <strong class="item-price text-center d-block"><span class="text--custom-primary">&#8377</span> {{ $product->price }}</strong>
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@endsection