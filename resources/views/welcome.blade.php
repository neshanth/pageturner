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

        <div class="categories my-5">
            <h2 class="text-center my-5">Choose From Many</h2>
            <div class="row">
                <div class="owl-carousel owl-theme">
                    @foreach($categories as $category)
                        <div class="item cat-item">
                            <img src="{{ asset("storage/category/".$category->image) }}"  alt="{{ $category->name }}">
                            <p class="text-center my-2 text-bold">{{ $category->name }}</p>
                        </div>
                    @endforeach
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
