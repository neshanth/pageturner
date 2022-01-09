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
            <h2 class="text-center my-5">Recently Added Products</h2>
              <div class="row">
                  @foreach($products as $product)
                      <div class="col-md-3">
                          <div class="card mb-3" style="max-width: 14rem">
                              <img src="{{ asset("storage/product/".$product->image) }}" class="card-img-top" alt="{{ $product->image }}">
                              <div class="card-body product-description">
                                  <h5 class="card-title text-bolder text-generic product-title">{{ $product->title }}</h5>
                                  <p class="card-text">{!! substr(strip_tags($product->description),0,100) !!}...</p>
                                  <p class="card-text fs-5"><span class="text-generic">&#x20B9</span> {{ $product->price }}</p>
                                  <button class="btn btn-custom-primary">Add to Cart</button>
                              </div>

                          </div>
                      </div>

                  @endforeach
              </div>
            </div>
        </div>
    </div>
@endsection
