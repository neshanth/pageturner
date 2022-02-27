@extends("dashboard.dashboard")

@section("content")

<div class="order-details">
    <div class="col-md-10">
        <h3 class="text-center text-generic">Order Details</h3>
        <div class="items">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="bg-custom text-white">
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($orderItems as $key=>$orderItem)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td scope="row"><img src="{{ asset('storage/product/'.$orderItem->product->image) }}" width="50px" /></td>
                            <td scope="row">{{ $orderItem->quantity }}</td>
                            <td scope="row">{{ $orderItem->product->price }}</td>
                            <td scope="row">
                                {{ $orderItem->getFullName($orderItem->order->address_id) }} <br />
                                {{ $orderItem->getFullAddress($orderItem->order->address_id) }} <br />
                                {{ $orderItem->getPostCode($orderItem->order->address_id) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection