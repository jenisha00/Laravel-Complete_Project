@extends('admin.master')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2 class="m-1 mb-3 text-dark"><i class="fas fa-plus-circle ml-2 mr-2"></i>Add Sale</h2>
          @if(session('message'))
          <div class="alert alert-danger mt-2 mb-2">
              {{ session('message') }}
          </div>
          @endif
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- <form action="#" method="post" enctype="multipart/form-data">
           @csrf 
           <div class="form-group row">                
                <div class="col-sm-5 m-1">
                  <input type="text" name="product_name" placeholder="Search Product Name" required class="form-control">
                </div>            
                <div class="col-sm-5 m-1">
                    <input type="submit" class="btn btn-primary" value="Search">
                </div>
            </div>
        </form>  -->

        <form action="{{route('admin.sales.store')}}" method="post" enctype="multipart/form-data">
           @csrf                
           <div class="form-group">                
                <label for="pname" class="col-md-3">Product Name</label>
                <div class="col-md-6">                    
                    <select name="product_id" class="form-control" required>
                        <option value="" hidden>Choose Product</option>
                        @if(count($products))
                            @foreach($products as $product)                       
                            <option value="{{$product->id}}">{{$product->product_name}}</option>
                            @endforeach
                        @else
                            <option disabled>No product records. Please add product</option>
                        @endif
                    </select>                    
                </div>             
            </div>           
            <div class="form-group">                
              <label for="qty" class="col-md-3">Quantity Sold</label>
              <div class="col-md-6"><input type="number" name="quantity_sold" placeholder="Quantity Sold" required class="form-control"></div>
            </div>
            <div class="form-group">                
                <label for="price" class="col-md-3">Unit Price</label>
                <div class="col-md-6 input-group">
                  <input type="number" name="unit_price" step="0.01" placeholder="Unit Price" required class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>                
            </div>
            <div class="form-group">                
              <label for="date" class="col-md-3">Date</label>
              <div class="col-md-6"><input type="date" name="date" required class="form-control"></div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary ml-3" value="Add Sale">
            </div>
        </form>
      </div>
  </section>

@endsection
