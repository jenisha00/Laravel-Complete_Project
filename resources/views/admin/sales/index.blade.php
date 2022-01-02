@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-1 mb-3"><i class="fas fa-chart-line mr-2"></i>Sales</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid table-responsive">
        <p>
            <a href="{{route('admin.sales.create')}}" class="btn btn-primary">Add New Sale</a>
        </p>
        @if(session('message'))
          <div class="alert alert-success" id="message_id">
              {{ session('message') }}
          </div>
        @endif
        <div class="container-fluid bg-white  p-4" style="border: 1px solid #d3d3d3;">
            <table id="mydatatable" class="table table-bordered table-responsive-sm table-responsive-md bg-white">
            <thead style="background-color: #d3d3d3;">
                <tr>
                  <th>S.N.</th>                  
                  <th>Product Name</th>
                  <th>Quantity Sold</th>
                  <th>Unit Price</th>
                  <th>Total Price</th>    
                  <th>Date</th>         
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @if(count($sales))
                @foreach($sales as $sale)
                <tr>
                  <td>{{$loop->iteration}}</td>                    
                  <td>{{ $sale->product->product_name}}</td>
                  <td>{{ $sale->quantity_sold}}</td>
                  <td>{{ $sale->unit_price}}.00</td>
                  <td>{{ $sale->total_price}}.00</td>
                  <td>{{ $sale->date }}</td>
                  <td>
                    <a href="{{route('admin.sales.edit', $sale->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    <a href="#" role="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal_{{$sale->id}}" data-action="{{ route('admin.sales.destroy', $sale->id) }} "><i class="fas fa-trash"></i></a>         
                  </td>
                    <div class="modal fade" id="deleteModal_{{$sale->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.sales.destroy', $sale->id) }}" method="post">
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
                </tr>
                @endforeach
                @else
                <tr>
                <td colspan="6">No Records Found</td>
                </tr>
                @endif
            </tbody>
            </table>
        </div>
      </div>
  </section>

@endsection