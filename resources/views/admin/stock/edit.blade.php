@extends('admin.master')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2 class="m-1 mb-3 text-dark"><i class="fas fa-edit ml-2 mr-2"></i>Edit Stock</h2>
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
        <form action="{{route('admin.stock.update', $id)}}" method="post" enctype="multipart/form-data">
           @csrf 
           @method('PUT')
           <div class="form-group">                
                <label for="pname" class="col-md-3">Product Name</label>
                <div class="col-md-6">                    
                    <select name="product_id" class="form-control" required>
                        <option value="" disabled>Choose Product</option>
                            @foreach($products as $product)                       
                            <option value="{{$product->id}}"
                              @if($product->id == $product_id)
                                selected
                              @endif>{{$product->product_name}}</option>
                            @endforeach
                    </select>                    
                </div>             
            </div>    
            <div class="form-group">                
                <label for="qty" class="col-md-3">Quantity</label>
                <div class="col-md-6"><input type="number" name="quantity" placeholder="Quantity" value="{{$quantity}}" required class="form-control"></div>
            </div>
            <!-- -->
            <div class="form-group">                
              <label for="date" class="col-md-3">Date</label>
              <div class="col-md-6"><input type="date" name="date" value="{{$date}}" required class="form-control"></div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary ml-3" value="Update Stock">
            </div>
        </form>
      </div>
  </section>

@endsection
