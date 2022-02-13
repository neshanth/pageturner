@extends("layout.app")


@section('content')


@guest

<x-guestcart :cartItems="$cartItems" />

@endguest


@auth
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($cart->count() > 0)
                            @foreach($cart as $c)
                            <tr>
                                <td class="product-thumbnail">
                                    <img src="{{ asset("storage/product/".$c->product->image) }}" alt="Image" class="img-fluid">
                                </td>
                                <td class="product-name">
                                    <h2 class="h5 text-black">{{ $c->product->title }}</h2>
                                </td>
                                <td>Rs. {{ $c->product->price }}</td>
                                <td>
                                    <form>
                                        @csrf
                                        <div class="input-group mb-3" style="max-width: 120px;">
                                            <input type="hidden" name="cart-id" value={{ $c->id }}>
                                            <div class="input-group-prepend">
                                                <button data-qty="dec" class="btn btn-outline-primary dec-btn  qty-btn" type="button">&minus;</button>
                                            </div>
                                            <input type="text" class="form-control text-center quantity-input" value={{ $c->quantity  }} placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button data-qty="inc" class="btn btn-outline-primary inc-btn qty-btn" type="button">&plus;</button>
                                            </div>
                                        </div>

                                    </form>

                                </td>
                                <td>
                                    <form>
                                        @csrf
                                        <button data-id={{ $c->id }} class="btn btn-danger cart-delete"><i class="fas fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <p class="cart-update-success .cart-update text-success text-center"></p>
                    <p class="cart-update-delete .cart-update text-warning text-center"></p>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button class="btn btn-primary btn-sm btn-block" onclick="location.reload()">Update Cart</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="total-amount"></strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="total-amount"></strong>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg btn-block" onclick="window.location='checkout.html'">Proceed To Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endauth


@auth
<!-- <div class="container">
    <div class="cart my-5">
        <div class="row bg-white rounded justify-content-between">
            <div class="col-md-7 cart-content">
                <div class="cart-title d-flex justify-content-between p-4 border-bottom border-primary">
                    <h4>Shopping Cart</h4>
                    <p>{{ $cart->count()}} items</p>
                </div>
                <div class="cart-items">
                    @if($cart->count() > 0)
                    @foreach($cart as $c)
                    <div class="row py-2">
                        <div class="col">
                            <img width="70px" src="{{ asset("storage/product/".$c->product->image) }}" alt="{{ $c->product->name }}">
                        </div>
                        <div class="col">
                            <small>{{ $c->product->title }}</small>
                        </div>
                        <div class="col cart-qty d-flex align-items-start">
                            <form class="qty-form">
                                @csrf
                                <button data-qty="inc" class="mx-1 inc-btn qty-btn"><i class="fas fa-chevron-up"></i></button>
                                <p class="quantity-input text-center">{{ $c->quantity }}</p>
                                <button data-qty="dec" class="mx-1 dec-btn qty-btn"><i class="fas fa-chevron-down"></i></button>
                                <input type="hidden" name="cart-id" value={{ $c->id }}>
                            </form>
                        </div>
                        <div class="col">
                            <p>{{ $c->product->price }}</p>
                        </div>
                        <div class="col">
                            <form>
                                @csrf
                                <button data-id={{ $c->id }} class="btn btn-danger cart-delete"><i class="fas fa-times"></i></button>
                            </form>

                        </div>
                        <div class="spinner-border text-primary" data-id={{ $c->id }} role="status" style="visibility:hidden;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <hr class="my-1">
                    </div>
                    @endforeach
                    @else
                    <p class="text-center">Your Shopping Cart Is Empty</p>
                    <div class="continue-btn d-flex justify-content-center">
                        <button class="btn btn-custom-primary">Continue Shopping</button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4 cart-summary bg-custom p-4">
                <div class="summary pb-4 text-center">
                    <h4 class="border-bottom border-white text-white py-3">Summary</h4>
                </div>
                <div class="total my-3 d-flex justify-content-between text-white">
                    <h5 class="text-white">TOTAL</h5>
                    <div class="total-container">
                        <div class="total">
                            <span>&#x20B9;</span>
                            <span class="total-amount"></span>
                        </div>
                    </div>
                </div>

                @if($cart->count() > 0)
                <div class="d-flex justify-content-center">
                    <a href="/checkout" class="btn btn-light btn-lg checkout-btn">CHECKOUT</a>
                </div>
                @endif
            </div>
        </div>
        <p class="cart-update-success text-success text-center"></p>
    </div>
</div> -->
@endauth

@endsection