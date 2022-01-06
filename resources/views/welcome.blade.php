@extends('layout.app')

@section('content')
    <div class="intro">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('images/banner.jpg') }}" alt="First slide">
                </div>
            </div>
        </div>
    </div>
    <div class="container">

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
