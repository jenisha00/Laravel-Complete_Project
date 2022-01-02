@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-1 mb-3"><i class="fas fa-stream mr-2"></i>Categories</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid table-responsive">
        <p>
            <a href="{{route('admin.category.create')}}" class="btn btn-primary">Add New Category</a>
        </p>
        @if(session('message'))
          <div class="alert alert-success" id="message_id">
              {{ session('message') }}
          </div>
        @endif
        <div class="container-fluid p-4 bg-white" style="border: 1px solid #d3d3d3;">
            <table id="mydatatable" class="table table-bordered table-responsive-sm table-responsive-md bg-white">
            <thead style="background-color: #d3d3d3;">
                <tr>
                <th>S.N.</th>                
                <th>Category Name</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if(count($categories))
                @foreach($categories as $category)
                <tr>
                    <td>{{$loop->iteration}}</td>                     
                    <td>{{ $category->category_name }}</td>
                    <td>
                      <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                      <a href="#" role="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal_{{$category->id}}" data-action="{{ route('admin.category.destroy', $category->id) }} "><i class="fas fa-trash"></i></a>         
                    </td>
                    <div class="modal fade" id="deleteModal_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="post">
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
                <td colspan="3">No Records Found</td>
                </tr>
                @endif
            </tbody>
            </table>
        </div>
      </div>
  </section>

  
@endsection