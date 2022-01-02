<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
</head>
<body style="background-image: url('../img/theme.jpg'); background-repeat:no-repeat; background-attachment:fixed;background-size:cover;">
    <div class="container" style="margin-top: 120px;"  >
        <div class="row">
            <div class="mx-auto col-lg-6 col-md-8" style="width: 450px">
            
                <div class="card" >                                                
                   <div class="card-header text-center py-3" style="font-size:25px">{{ __('IMS | Login') }}</div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{route('login')}}">
                            @csrf
                            <div class="form-group">
                                <i class="fas fa-user"></i>
                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                <input id="username" type="username" class="form-control " name="username" placeholder="Username" autocomplete="username">                                
                            </div>
                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <label for="password" class="form-label">{{ __('Password') }}</label>                              
                                <input id="password" type="password" class="form-control " name="password" placeholder="Password" autocomplete="current-password">                               
                            </div>                        
                            <div class="form-group text-right">
                                <div>                                    
                                    <button type="submit" class="btn btn-primary ">{{ __('Login') }}</button>                                    
                                </div>
                            </div>    
                            <div class="form-group text-right">
                                <a class="btn btn-link pr-0" style="text-decoration:underline" href="{{ route('register') }}">
                                            {{ __("Don't have an account? Register") }}
                                        </a>
                            </div>                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
    

