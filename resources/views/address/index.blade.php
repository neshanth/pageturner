@extends("dashboard.dashboard")


@section('content')
    <div class="col-md-10">
        <h2 class="text-generic my-1 text-center">All Address</h2>
        @if(session('success'))
            <h4 class="text-danger">{{ session('success') }}</h4>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="bg-custom text-white">
                    <th scope="col">#</th>
                    <th scope="col">FirstName</th>
                    <th scope="col">LastName</th>
                    <th scope="col">Address</th>
                    <th scope="col">State</th>
                    <th scope="col">City</th>
                    <th scope="col">Postcode</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($address as $key=>$a)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $a->firstname }}</td>
                        <td>{{ $a->lastname }}</td>
                        <td>{{ $a->full_address }}</td>
                        <td>{{ $a->state }}</td>
                        <td>{{ $a->city }}</td>
                        <td>{{ $a->postcode }}</td>
                        <td>
                            <div class="buttons d-flex">
                                <a class="btn btn-warning mx-1" href="{{ route("address.edit",[$a->id]) }}">Edit</a>
                                <form action="{{ route("address.destroy", $a->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mx-1">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
