@extends("dashboard.dashboard")


@section('content')
    <div class="col-md-6">
        @if(session('success'))
            <h4 class="text-danger">{{ session('success') }}</h4>
        @endif
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr class="bg-custom text-white">
                    <th scope="col">#</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($roles as $key=>$role)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $role->name }}</td>
                        <td class="text-danger">
                            <form action="{{ route("roles.destroy", $role->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link">
                                    <i class="fa fa-times text-danger" />
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
