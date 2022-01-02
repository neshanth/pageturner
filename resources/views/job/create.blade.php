@extends("dashboard.dashboard")

@section('content')
    <div class="col-md-6">
        @if(session('success'))
            <h4 class="text-success">{{ session('success') }}</h4>
        @endif
        <form action="{{ route('jobs.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="job_title" class="form-label">Job Title</label>
                <input type="text" name="job_title" class="form-control" id="job_title" required>
            </div>
            <div class="mb-3">
                <label for="job_category" class="form-label">Job Category</label>
                <input type="text" name="job_category" class="form-control" id="job_category" required>
            </div>
            <div class="mb-3">
                <label for="job_type" class="form-label">Job Type</label>
                <input type="text" name="job_type" class="form-control" id="job_type" required>
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control" name="salary" id="salary">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="description" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control" id="location" required>
            </div>
            <button type="submit" class="btn btn-custom-primary">Submit</button>
        </form>
    </div>

@endsection
