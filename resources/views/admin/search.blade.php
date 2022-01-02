@extends('admin.master')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2 class="m-1 mb-3 text-dark"><i class="fas fa-search ml-2 mr-2"></i>Search</h2>
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
        <form action="{{route('submitForm')}}" method="post" enctype="multipart/form-data">
           @csrf 
           <div class="form-group row">                
                <div class="col-sm-5 m-1">
                  <input type="text" name="product_name" placeholder="Search Product Name" required class="form-control">
                </div>            
                <div class="col-sm-5 m-1">
                    <input type="submit" class="btn btn-primary" name="submit" value="Search">
                </div>
            </div>
        </form> 
       
        <div class="container-fluid bg-white p-4" style="border: 1px solid #d3d3d3;">
            <table class="table table-bordered table-responsive-sm table-responsive-md bg-white">
            <thead style="background-color: #d3d3d3;">
                <tr>
                  <th>S.N.</th>
                  <th>Product Name</th>
                  <th>Category Name</th>
                  <th>Total Quantity Sold</th>
                  <th>Quantity Available</th>
                  <th>Sales Unit Price</th>
                  <th>Total Sales Price</th>     
                  <th>Status</th>          
                </tr>
            </thead>
            <tbody>
                @if(isset($_POST['submit']))
                    @if(isset($search))
                        @foreach($search as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->product_name}}</td>
                                <td>{{ $s->category->category_name}}</td>
                                <td>{{ $s->quantity_sold}}</td>
                                <td>{{ $s->quantity}}</td>
                                <td>{{ $s->unit_price}}.00</td>
                                <td>{{ $s->total_price}}.00</td>
                                @if( $s->status == 1)
                                  <td class="text-success"><strong>Available</strong></td>
                                @else
                                  <td class="text-danger"><strong> Not Available</strong></td>
                                @endif
                            </tr>   
                        @endforeach 
                          
                    @else
                        <tr>
                            <td>1</td>
                            <td>{{$product_name}}</td>
                            <td>{{$category_name}}</td>
                            <td>0</td>
                            <td>{{$quantity}}</td>
                            <td>{{$unit_price}}.00</td>
                            <td>0.00</td>
                            @if( $status == 1)
                              <td class="text-success"><strong>Available</strong></td>
                            @else
                              <td class="text-danger"><strong>Not Available</strong></td>
                            @endif
                        </tr>
                    @endif
                @endif    
            </tbody>
            </table>
        </div>
      </div>
  </section>

@endsection
