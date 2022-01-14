@extends("layout.app")


@section('content')
<div class="container">
    <div class="cart my-5">
        <div class="row bg-white rounded justify-content-between">
            <div class="col-md-7 cart-content mx-4">
                <div class="cart-title d-flex justify-content-between p-4 border-bottom border-primary">
                    <h4>Shopping Cart</h4>
                    <p>{{ $cart->count()}} items</p>
                </div>
                <div class="cart-items">
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
                </div>
            </div>
            <div class="col-md-4 cart-summary bg-custom p-4">
              <div class="summary pb-4 text-center">
                  <h4 class="border-bottom border-white text-white py-3">Summary</h4>
              </div>
              <div class="amount border-bottom border-white pb-5">
                    <select class="form-select" id="shipping">
                        <option value="express" selected>Express   &#x20B9;  10.00  (1-3 days) </option>
                        <option value="free">Free (4-6 days)</option>
                    </select>
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
            </div>
        </div>
    </div>
</div>


@endsection
