@extends("layout.app")

@section('content')
<div class="container mt-4">

    <div class="row">
        <div class="col-md-8">
            <h2>Shipping Address</h2>
            @if(session('error'))
            <p class="text-danger text-center">{{ session("error") }}</p>
            @endif
            @if ($count > 0)
            <div class="row">
                @foreach($address as $a)
                <div class="card p-3 mx-1" style="width:25%">
                    <address>
                        <p>
                            <strong>Name : </strong>
                            <span>{{ $a->firstname}}</span>
                            <span>{{ $a->lastname }}</span>
                        </p>
                        <p><strong>Address : </strong>{{ $a->full_address }}</p>
                        <p>
                            <strong>State : </strong> <span>{{ $a->state }}</span>
                            <strong>City: </strong><span>{{ $a->city }}</span>
                        </p>
                        <p><strong>Postcode :</strong>{{ $a->postcode }}</p>
                    </address>
                    @if ($a->is_billing)
                    <p class="text-generic">This address will be used for billing</p>
                    @else
                    <form action="/address/billing" method="post">
                        @csrf
                        <input type="hidden" name="address_id" value={{ $a->id }}>
                        <button class="btn btn-custom-primary">Set As Shipping</button>
                    </form>
                    @endif

                </div>
                @endforeach
            </div>
            @else
            <form action="{{ route('address.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstname" class="form-label">FirstName</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="form-label">LastName</label>
                        <input type="text" class="form-control" name="lastname" id="lastname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="full_address" id="address" cols="30" class="form-control" rows="5" required></textarea>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" name="state" aria-label="Default select example">
                            <option value="1">TamilNadu</option>
                            <option value="2">Kerala</option>
                            <option value="3">Karnataka</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <select name="city" class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="postcode" class="form-label">Postcode</label>
                        <input type="text" name="postcode" class="form-control" required>
                    </div>
                </div>
            </form>
            @endif
        </div>
        <div class="col-md-4">
            <div class="items d-flex justify-content-between">
                <h5>Your Cart</h5>
                <h5 class="item-count">
                    <span class="badge rounded-pill bg-primary">{{ $cartItems->count()}}</span>
                </h5>
            </div>
            <div class="cart-items">
                <ul class="list-group">
                    @foreach ($cartItems as $cartItem)
                    <li class="list-group-item">
                        <p class="d-flex justify-content-between">
                            <span class="fw-bold">{{ $cartItem->product->title }}</span>
                            <span> <span> &#x20B9;</span> {{ $cartItem->product->price }}</span>
                        </p>
                        <p class="text-generic fw-bold">( x {{ $cartItem->quantity }})</p>
                    </li>
                    @endforeach
                </ul>
                <ul class="total list-group my-2">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-bold">TOTAL</span>
                        <span class="total-amount text-generic fw-bolder fs-4">{{ $total }}</span>
                    </li>
                </ul>
                <div class="order-btn">
                    <form action="/checkout" method="post">
                        @csrf
                        <div class="card p-2 mt-2">
                            <select class="form-select" id="shipping" name="delivery_cost">
                                <option value="express" selected>Express &#x20B9; 10.00 (1-3 days) </option>
                                <option value="free">Free (4-6 days)</option>
                            </select>
                        </div>
                        <button class="btn btn-custom-primary mt-2">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection