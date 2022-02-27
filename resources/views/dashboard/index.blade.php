@extends('dashboard.dashboard')

@section('content')

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $customer['orders'] }}</h3>

            <p>Orders</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3>&#8377 {{ $customer['sales'] }}<sup style="font-size: 20px"></sup></h3>

            <p>Sales</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $customer['products'] }}</h3>

            <p>Products</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3>{{ $customer['customers'] }}</h3>

            <p>Customers</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
    </div>
</div>
<!-- ./col -->
@endsection