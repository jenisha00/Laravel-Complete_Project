@extends('admin.master')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2 class="m-1 mb-3 text-dark"><i class="fas fa-plus-circle ml-2 mr-2"></i>Add Product</h2>
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
        <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
           @csrf 
            <div class="form-group">                
                <label for="pname" class="col-md-3">Product Name</label>
                <div class="col-md-6"><input type="text" name="product_name" placeholder="Product Name" required class="form-control"></div>
            </div>
            <div class="form-group">                
                <label for="photo" class="col-md-3">Photo</label>
                <div class="col-md-6"><input type="file" name="image" class="form-control" required></div>
            </div>
            <div class="form-group">                
                <label for="cname" class="col-md-3">Category Name</label>
                <div class="col-md-6">                    
                    <select name="category_id" class="form-control" required>
                        <option value="" hidden>Choose Category</option>
                        @if(count($categories))
                            @foreach($categories as $category)                       
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        @else
                            <option disabled>No category records. Please add category</option>
                        @endif
                    </select>                    
                </div>             
            </div>

            <!-- <div class="form-group">                
                <label for="qty" class="col-md-3">Quantity</label>
                <div class="col-md-6"><input type="number" name="quantity" placeholder="Quantity" required class="form-control"></div>
            </div> -->
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
                <input type="submit" class="btn btn-primary ml-3" value="Add Product">
            </div>
        </form> 
      </div>
  </section>

@endsection
