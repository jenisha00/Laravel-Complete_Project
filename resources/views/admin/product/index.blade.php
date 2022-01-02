@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-1 mb-3"><i class="fas fa-th-large mr-2"></i>Products</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid table-responsive">
        <p>
            <a href="{{route('admin.product.create')}}" class="btn btn-primary">Add New Product</a>
        </p>
        @if(session('message'))
          <div class="alert alert-success" id="message_id">
              {{ session('message') }}
          </div>
        @endif
        <div class="container-fluid p-4 bg-white" style="border: 1px solid #d3d3d3;">
            <table id="mydatatable" class="table table-bordered table-responsive-sm table-responsive-md bg-white ">
            <thead style="background-color: #d3d3d3;">
                <tr>
                  <th>S.N.</th>  
                  <th>Photo</th>                 
                  <th>Product Name</th>
                  <th>Category Name</th>
                  <th>Quantity Available</th>
                  <th>Unit Price</th> 
                  <th>Status</th>                                
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @if(count($products))
                @foreach($products as $product)
                <tr>
                  <td>{{$loop->iteration}}</td>  
                  <td><img src="{{asset('images/'.$product->image) }}" width="100px"></td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->category->category_name}}</td>
                  <td>{{ $product->quantity}}</td>
                  <td>{{ $product->unit_price}}.00</td>
                  @if($product->status == 1)
                      <td class="text-success"><strong>Available</strong></td>
                  @else
                    <td class="text-danger"><strong>Not Available</strong></td>
                  @endif
                  <td><a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                  <a href="#" role="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal_{{$product->id}}" data-action="{{ route('admin.product.destroy', $product->id) }} "><i class="fas fa-trash"></i></a>         
                  </td>
                    <div class="modal fade" id="deleteModal_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="post">
                              <div class="modal-body">                              
                                  @csrf
                                  @method('DELETE')
                                <div class="mb-3"><h5>Are you sure you want to delete?</h5></div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-danger">Delete</button>
                              </div>
                            </form>
                          </div>                          
                      </div>
                    </div>
                            
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                <td colspan="7">No Records Found</td>
                </tr>
                @endif
            </tbody>
            </table>
        </div>
      </div>
  </section>

@endsection