@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-1 mb-3"><i class="fas fa-user ml-2 mr-2"></i>Profile</h2>
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
        @if(session('message'))
          <div class="alert alert-success" id="message_id">
              {{ session('message') }}
          </div>
        @endif
        <form action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
           @csrf 
           @method('PUT')
            <div class="form-group">                
                <label for="name" class="col-md-3">Name</label>
                <div class="col-md-6"><input type="text" name="name" value="{{Auth::user()->name}}" required class="form-control"></div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">                
                <label for="uname" class="col-md-3">Username</label>
                <div class="col-md-6"><input type="text" name="username" value="{{Auth::user()->username}}" required class="form-control"></div>
                <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary ml-3" value="Update Profile">
            </div>
        </form> 
      </div>
  </section>
@endsection