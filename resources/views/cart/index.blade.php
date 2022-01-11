@extends("layout.app")


@section('content')
<div class="container">
    <div class="cart my-5">
        <div class="row bg-white rounded justify-content-between">
            <div class="col-md-7 cart-content mx-4">
                <div class="cart-title d-flex justify-content-between p-4 border-bottom border-primary">
                    <h4>Shopping Cart</h4>
                    <p>3 items</p>
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
                                    <button class="mx-1 dec-btn"><i class="fas fa-minus"></i></button>
                                    <input type="text" class="quantity-input text-center" value={{ $c->quantity }}>
                                    <button class="mx-1 inc-btn"><i class="fas fa-plus"></i></button>
                                    <input type="hidden" name="cart-id" value={{ $c->id }}>
                                </form>  
                            </div>
                            <div class="col">
                                <p>{{ $c->product->price }}</p>
                            </div>
                            <div class="col">
                                <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                            </div>
                            <hr class="my-1">
                        </div>
                        @endforeach
                </div>
            </div>
            <div class="col-md-4 cart-summary bg-custom p-4 text-white border-bottom border-white">
                <h4>Summary</h4>
            </div>
        </div>
    </div>
</div>


@endsection
