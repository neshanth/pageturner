@extends('layout.app')

@section('content')
    <div class="container">
        <div class="intro my-5">
            <h1 class="text-center my-3">Your Career in <span class="text-generic">Tech</span> Begins Here</h1>
            <div class="row">
                <form class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="job_title" placeholder="Job Title"  class="form-control bg-white" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="form-select bg-white" aria-label="City">
                            <option selected>Choose City</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-custom-primary mb-3">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="categories">
            <h2 class="text-center my-3">Choose From Many</h2>
            <div class="row">
                <div class="col-4">
                    <p>FRONT END</p>
                </div>
                <div class="col-4">
                    <p>FRONT END</p>
                </div>
                <div class="col-4">
                    <p>FRONT END</p>
                </div>
                <div class="col-4">
                    <p>FRONT END</p>
                </div>
            </div>
        </div>
        <div class="recently-posted">
            <h2 class="text-center my-3">Recently Posted Jobs</h2>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
@endsection
