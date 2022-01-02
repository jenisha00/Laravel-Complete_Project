<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Dashboard</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
</head>
<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-dark" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-3 fs-4 fw-bold text-uppercase border-bottom">
                <a href="{{ route('dashboard') }}" style="text-decoration: none">
                    <h1>IMS</h1>                
                </a>
            </div>
        
            <div class="list-group list-group-flush">
                <a href="{{route('dashboard')}}" class="list-group-item {{(request()->segment(2) == '') ? 'active' : ''}}">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
                <a href="{{route('admin.category.index')}}" class="list-group-item {{(request()->segment(2) == 'category') ? 'active' : ''}}">
                    <i class="fas fa-stream mr-2"></i>Categories</a>
                <a href="{{route('admin.product.index')}}" class="list-group-item {{(request()->segment(2) == 'product') ? 'active' : ''}}">
                    <i class="fas fa-th-large mr-2"></i>Products</a>
                <a href="{{route('admin.stock.index')}}" class="list-group-item {{(request()->segment(2) == 'stock') ? 'active' : ''}}">
                    <i class="fas fa-chart-bar mr-2"></i>Stock</a>
                <a href="{{route('admin.sales.index')}}" class="list-group-item {{(request()->segment(2) == 'sales') ? 'active' : ''}}">
                    <i class="fas fa-chart-line mr-2"></i>Sales</a>
                <a href="{{route('showForm')}}" class="list-group-item {{(request()->segment(2) == 'search') ? 'active' : ''}}">
                    <i class="fas fa-search mr-2"></i>Search Inventory</a>
                <form method="POST" action="{{ route('logout') }}">           
                    @csrf
                    <a href="{{ route('logout') }}" class="list-group-item"
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt mr-1"></i>
                    Log Out
                    </a>
                </form>
            </div>
        </div>
    
        <div id="content-wrapper" class="container">
            <nav class="navbar navbar-expand navbar-light bg-transparent px-4">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <i class="fas fa-bars" id="menu-toggle"></i>
                  </li>
                </ul>  

                <ul class="navbar-nav ml-auto">
                  <li class="nav-item dropleft">
                      <a class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown" href="#">
                        <i class="fas fa-user" style="border:2px solid; border-radius:50%; padding:5px; "></i>
                        {{Auth::user()->name}}
                        <span class="caret"></span>
                      </a>
                      <div class="dropdown-menu" >
                          <a href="{{route('showProfile')}}" class="dropdown-item">
                            <span class="mr-1">
                              <i class="fas fa-user"></i>
                            </span>
                            My Profile
                          </a>  
                          <div class="dropdown-divider"></div>
                          <a href="{{route('pswChange')}}" class="dropdown-item">
                            <span class="mr-1">
                              <i class="fas fa-cog"></i>
                            </span>  
                            Change Password
                          </a>
                          <div class="dropdown-divider"></div>
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf

                              <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault();
                                              this.closest('form').submit();">
                                <span class="mr-1">
                                  <i class="fas fa-sign-out-alt "></i>
                                </span> 
                                Log Out
                              </a>
                            </form>
                      </div>
                  </li>
                </ul>  
              </nav>
            </nav>

            <div class="container-fluid px-4">
                @yield('content')
            </div>
                
            
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        $("document").ready(function(){
            $("#mydatatable").DataTable();
        });

        //for hiding alert measssge
        $("document").ready(function(){
            setTimeout(function(){
                $("#message_id").remove();
            }, 1000 );
        });
    </script>
</body>
</html>