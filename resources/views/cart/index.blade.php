@extends("layout.app")


@section('content')
<div class="container">
    <div class="cart my-5">
        <div class="row bg-white rounded">
            <div class="col-md-8 cart-content">
                <div class="cart-title d-flex justify-content-between p-4 border-bottom border-primary">
                    <h4>Shopping Cart</h4>
                    <p>3 items</p>
                </div>
                <div class="cart-items">
                    <div class="row">
                        @foreach($cart as $c)
                            <div class="col">
                                <img src="{{ asset("storage/product/".$c->product->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 cart-summary bg-custom p-4 text-white border-bottom border-white">
                <h4>Summary</h4>
            </div>
        </div>
    </div>
</div>


@endsection
