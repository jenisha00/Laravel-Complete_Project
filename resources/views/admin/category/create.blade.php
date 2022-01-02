@extends('admin.master')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2 class="m-1 mb-3 text-dark"><i class="fas fa-plus-circle ml-2 mr-2"></i>Add Category</h2>
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
        <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
           @csrf 
            <div class="form-group">                
                <label for="cname" class="col-md-3">Category Name</label>
                <div class="col-md-6"><input type="text" name="category_name" placeholder="Category Name" required class="form-control"></div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary ml-3" value="Add Category">
            </div>
        </form> 
      </div>
  </section>

@endsection
