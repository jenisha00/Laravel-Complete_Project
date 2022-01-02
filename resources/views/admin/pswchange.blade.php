@extends('admin.master')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2 class="m-2"><i class="fas fa-lock ml-2 mr-2"></i>Change Password</h2>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        @if ($errors->any() || session('error'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    @if(session('error'))
                    <li>{{session('error')}}</li>
                    @endif
                </ul>
            </div>
        @endif
        @if(session('message'))
          <div class="alert alert-success" id="message_id"><strong>{{session('message')}}</strong></div>
        @endif
        
        <form action="{{route('updatePassword')}}" method="post">
           @csrf 
           @method('PUT')
            <div class="form-group">                
                <label for="old_password" class="col-md-3">Current Password</label>
                <div class="col-md-6"><input type="password" name="old_password" class="form-control" placeholder="Enter current password" required></div>
                <div class="clearfix"></div>
            </div>

            <div class="form-group">                
                <label for="new_password" class="col-md-3">New Password</label>
                <div class="col-md-6"><input type="password" name="password" class="form-control" placeholder="Enter new password" required></div>
                <div class="clearfix"></div>
            </div>
            
            <div class="form-group">                
                <label for="old_password" class="col-md-3">Confirm New Password</label>
                <div class="col-md-6"><input type="password" name="password_confirmation" class="form-control" placeholder="Enter new password again" required></div>
                <div class="clearfix"></div>
            </div>
           
            <div class="form-group">
                <input type="submit" class="btn btn-primary ml-3" value="Update">
            </div>
        </form>
      </div>
  </section>

  @endsection