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
                                <th class="product-total">Total</th>
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
                                <td><span class="text--custom-primary">&#8377</span> {{ $c['price'] }}</td>
                                <td>
                                    <form>
                                        @csrf
                                        <div class="input-group mb-3 cart-buttons" style="max-width: 120px;">
                                            <input type="hidden" name="cart-id" value={{ $c['product_id'] }}>
                                            <div class="input-group-prepend">
                                                <button data-qty="dec" data-price="{{ $c['price'] }}" class="btn btn-outline-primary dec-btn  qty-btn" type="button">&minus;</button>
                                            </div>
                                            <input type="text" class="form-control text-center quantity-input w-50" value={{ $c['quantity']  }} placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button data-qty="inc" data-price="{{ $c['price'] }}" class="btn btn-outline-primary inc-btn qty-btn" type="button">&plus;</button>
                                            </div>
                                        </div>

                                    </form>

                                </td>
                                <td class="product-subtotal">Rs. {{ intval($c['quantity']) * floatval($c['price']) }}</td>
                                <td>
                                    <form>
                                        @csrf
                                        <button data-id={{ $c['product_id'] }} class="btn btn-danger cart-delete"><i class="fas fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
            @if (session('cart') == null)
            <h3 class="text-center text--custom-primary">Your shopping cart is empty</h3>
            <div class="go-back text-center">
                <a href="/" class="btn btn--custom-primary">Go Back</a>
            </div>
            @endif
            <p class="cart-update-success .cart-update text-success text-center"></p>
            <p class="cart-update-delete .cart-update text-warning text-center"></p>
            <div class="row mb-5">
                @if (session('cart') != null)
                <div class="col-md-12 mb-3 mb-md-0 text-center">
                    <a class="btn btn--custom-primary" href="/cart/show">
                        Update Cart
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pl-5">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right mb-5">
                                <h3 class="text-black h4 text-uppercase cart-totals-text text-center">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="total-amount text--custom-primary"></strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="total-amount text--custom-primary"></strong>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                @if(session("cart") != null)
                                <a href="/checkout" class="btn btn-primary btn-lg btn-block">Proceed To Checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>