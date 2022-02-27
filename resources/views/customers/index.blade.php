@extends("dashboard.dashboard")


@section('content')
<div class="col-md-10 mx-auto">
    <h2 class="text-generic my-2 text-center">All Customers</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="bg-custom text-white">
                    <th scope="col">#</th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($customers as $key=>$customer)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection