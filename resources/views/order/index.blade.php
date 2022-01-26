@extends("dashboard.dashboard")


@section('content')
    <div class="col-md-10 mx-auto">
        <h2 class="text-generic my-2 text-center">All Orders</h2>
        @if(session('success'))
            <h4 class="text-danger">{{ session('success') }}</h4>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="bg-custom text-white">
                    <th scope="col">#</th>
                    <th scope="col">Order Id</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($orders as $key=>$order)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->total }}</td>
                        <td>
                            <div class="buttons d-flex">
                                <a class="btn btn-warning mx-1" href="/orders/{{ $order->id }}">View Items</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
