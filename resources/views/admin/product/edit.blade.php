@extends('admin.master')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2 class="m-1 mb-3 text-dark"><i class="fas fa-edit ml-2 mr-2"></i>Edit Product</h1>
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
        <form action="{{route('admin.product.update', $product_id)}}" method="post" enctype="multipart/form-data">
           @csrf 
           @method('PUT')
            <div class="form-group">                
                <label for="pname" class="col-md-3">Product Name</label>
                <div class="col-md-6"><input type="text" name="product_name" class="form-control" value="{{$product_name}}" required></div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">                
                <label for="cname" class="col-md-3">Category Name</label>
                <div class="col-md-6">                    
                    <select name="category_id" class="form-control" required>
                        <option value="" disabled>Choose Category</option>
                            @foreach($categories as $c)                       
                              <option value="{{$c->id}}" 
                                  @if($c->id == $category_id) 
                                    selected
                                  @endif   
                              >{{$c->category_name}}</option>
                            @endforeach
                    </select>                    
                </div>             
            </div>
            <!-- <div class="form-group">                
                <label for="qty" class="col-md-3">Quantity</label>
                <div class="col-md-6"><input type="number" name="quantity" value="{{$quantity}}" required class="form-control"></div>
            </div>
            <div class="form-group">                
                <label for="qty" class="col-md-3">Additional Quantity</label>
                <div class="col-md-6"><input type="number" name="additional_quantity" class="form-control"></div>
            </div> -->
            <div class="form-group">                
                <label for="price" class="col-md-3">Unit Price</label>
                <div class="col-md-6"><input type="number" name="unit_price" step="0.01" value="{{$unit_price}}" required class="form-control"></div>
            </div>
            <div class="form-group">                
                <label for="photo" class="col-md-3">Photo</label>
                <div class="col-md-6">
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary ml-3" value="Update Product">
            </div>
        </form>
      </div>
  </section>

@endsection
