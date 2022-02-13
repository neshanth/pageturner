<!-- <div class="container">
    <div class="cart my-5">
        <div class="row bg-white rounded justify-content-between">
            <div class="col-md-7 cart-content">
                <div class="cart-title d-flex justify-content-between p-4 border-bottom border-primary">
                    <h4>Shopping Cart</h4>
                    @if(session("cart"))
                    <p>{{ count(session("cart"))  }} items</p>
                    @endif
                </div>
                <div class="cart-items">
                    @if(session("cart"))
                    @foreach($cartItems as $c)
                    <div class="row py-2">
                        <div class="col">
                            <img width="70px" src="{{ asset("storage/product/".$c['image']) }}" alt="{{ $c['title'] }}">
                        </div>
                        <div class="col">
                            <small>{{ $c['title'] }}</small>
                        </div>
                        <div class="col cart-qty d-flex align-items-start">
                            <form class="qty-form">
                                @csrf
                                <button data-qty="inc" class="mx-1 inc-btn qty-btn"><i class="fas fa-chevron-up"></i></button>
                                <p class="quantity-input text-center">{{ $c['quantity'] }}</p>
                                <button data-qty="dec" class="mx-1 dec-btn qty-btn"><i class="fas fa-chevron-down"></i></button>
                                <input type="hidden" name="cart-id" value={{ $c['product_id'] }}>
                            </form>
                        </div>
                        <div class="col">
                            <p>{{ $c['price'] }}</p>
                        </div>
                        <div class="col">
                            <form>
                                @csrf
                                <button data-id={{ $c['product_id'] }} class="btn btn-danger cart-delete"><i class="fas fa-times"></i></button>
                            </form>

                        </div>
                        <div class="spinner-border text-primary" data-id={{ $c['product_id'] }} role="status" style="visibility:hidden;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <hr class="my-1">
                    </div>
                    @endforeach
                    @else
                    <h6 class="text-center">Your Shopping Cart is Empty</h6>
                    <div class="continue-btn d-flex justify-content-center">
                        <a href="/" class="btn btn-custom-primary">Continue Shopping</a>
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
                        <h5 class="total">
                            <span>&#x20B9;</span>
                            <span class="total-amount"></span>
                        </h5>
                    </div>
                </div>
                @if(session("cart") != null)
                <div class="d-flex justify-content-center">
                    <a href="/checkout" class="btn btn-light btn-lg checkout-btn">Checkout</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div> -->

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
                            @if(session("cart"))
                            @foreach($cartItems as $c)
                            <tr>
                                <td class="product-thumbnail">
                                    <img src="{{ asset("storage/product/".$c['image']) }}" alt="Image" class="img-fluid">
                                </td>
                                <td class="product-name">
                                    <h2 class="h5 text-black">{{ $c['title'] }}</h2>
                                </td>
                                <td>${{ $c['price'] }}</td>
                                <td>
                                    <form action="">
                                        @csrf
                                        <div class="input-group mb-3" style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <button data-qty="dec" class="btn btn-outline-primary js-btn-minus qty-btn" type="button">&minus;</button>
                                            </div>
                                            <input type="text" class="form-control text-center" value="{{ $c['quantity'] }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button data-qty="inc" class="btn btn-outline-primary js-btn-plus qty-btn" type="button">&plus;</button>
                                            </div>
                                        </div>

                                    </form>

                                </td>
                                <td><a href="#" class="btn btn-primary height-auto btn-sm">X</a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button class="btn btn-primary btn-sm btn-block">Update Cart</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="text-black h4" for="coupon">Coupon</label>
                        <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                        <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-sm px-4">Apply Coupon</button>
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
                                <strong class="text-black">$230.00</strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">$230.00</strong>
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