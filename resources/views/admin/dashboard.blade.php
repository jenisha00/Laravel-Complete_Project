@extends('admin.master')

@section('content')
<h2 class="mb-2">Dashboard</h2>
<div class="row my-3">
    <div class="col-lg-3 col-md-6 col-6 mb-2">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">Rs. {{ $todaysale}}</h3>
                <p class="fs-5"> Today's Sales</p>
            </div>
            <i class="fas fa-chart-line bg-dark text-white fs-1  rounded-full  p-3"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-2">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{ $categories }}</h3>
                <p class="fs-5">Total Categories</p>
            </div>
            <i
                class="fas fa-stream bg-dark text-white fs-1  rounded-full  p-3"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-2">
        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{ $products }}</h3>
                <p class="fs-5">Total Products</p>
            </div>
            <i class="fas fa-th-large bg-dark text-white fs-1 rounded-full  p-3"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6 mb-2">
        <div class="p-3 bg-white shadow-sm d-flex  justify-content-around align-items-center rounded">
            <div>
                <h3 class="fs-2">{{ $stock }}</h3>
                <p class="fs-5">Total Stock</p>
            </div>
            <i class="fas fa-chart-bar bg-dark text-white fs-1 rounded-full  p-3"></i>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 bg-white my-2 mx-3 px-4" style="box-shadow: 2px 2px 20px 1px rgba(0,0,0,0.2);">
        <h5 class="text-center py-2">Total Sales Revenue</h5>
        <div class="table-wrapper">
        <table class="table table-bordered" style="box-shadow: 2px 2px 20px 1px rgba(0,0,0,0.2);">                  
            <tr>
              <th>Product Name</th>
              <th>Sales Revenue</th>
            </tr>
            @foreach($allsales as $sale)
            <tr>
                <td>{{$sale->product->product_name}}</td>
                <td>{{$sale->total_price}}.00</td>
            </tr>
            @endforeach
            <tr class="text-right" style="background-color:#60ceb6">
              <td colspan="2"><strong>Total Sales Revenue = Rs. {{$total}}.00</strong></td>
            </tr>
        </table>
        </div>
          
    </div>

    <div class="col-lg-3 col-md-5 col-sm-3 bg-white my-2 ml-2 mr-2 px-4" style="box-shadow: 2px 2px 20px 1px rgba(0,0,0,0.2);">
        <h5 class="text-center py-2">Not Available Products</h5>
        <div class="table-wrapper">
        <table class="table table-bordered" style="box-shadow: 2px 2px 20px 1px rgba(0,0,0,0.2);">
            
            <tr>
             <th>Product Name</th>
            </tr>
            @if(count($NAproducts))
            @foreach($NAproducts as $product)
                <tr>
                <td class="text-danger">{{$product->product_name}}</td>
                </tr>
            @endforeach
            @else
            <tr>
            <td>No Records</td>
            </tr>
            @endif
        </table>
        </div>
    </div>


    <div class="col-lg-4 col-md-6 col-sm-3 bg-white my-2 mx-3 px-4" style="box-shadow: 2px 2px 20px 1px rgba(0,0,0,0.2);">
        <h5 class="text-center py-2">Product Stocks</h5>
        <div class="table-wrapper">
        <table class="table table-bordered" style="box-shadow: 2px 2px 20px 1px rgba(0,0,0,0.2);">
            
            <tr>
              <th>Product Name</th>
              <th>Quantity</th>
            </tr>
            @foreach($allproducts as $product)
            <tr>
                <td>{{$product->product_name}}</td>
                <td>{{$product->quantity}}</td>
            </tr>
            @endforeach
            <tr class="text-right" style="background-color:#60ceb6">
              <td colspan="2"><strong>Total Stocks = {{$stock}}</strong></td>
            </tr>
        </table>
    </div>
</div>
@endsection