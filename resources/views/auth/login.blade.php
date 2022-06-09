<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{asset('backend/images/favicon.ico ') }}">

        <title>Admin Login</title>
      
        <!-- Vendors Style-->
        <link rel="stylesheet" href="{{ asset('backEnd/css/vendors_css.css ')}}">
          
        <!-- Style-->  
        <link rel="stylesheet" href="{{ asset('backEnd/css/style.css ')}}">
        <link rel="stylesheet" href="{{ asset('backEnd/css/skin_color.css ')}}">
        <!-- toastr css -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    </head>
    <body class="hold-transition theme-primary bg-gradient-primary">
    
        <div class="container h-p100">
            <div class="row align-items-center justify-content-md-center h-p100">        
                <div class="col-12">
                    <div class="row justify-content-center no-gutters">
                        <div class="col-lg-4 col-md-5 col-12">
                            <div class="content-top-agile p-10">
                                <h2 class="text-white">Get started with Us</h2>
                                <p class="text-white-50">Sign in to start your session</p>                          
                            </div>
                            <!-- start login aleart message show -->
                            <!-- @if(Session::has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong>{{ session::get('error') }}</strong>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            @endif -->
                            <!-- end login aleart message show -->
                            <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                                <form action="{{ route('login') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        @error('email')
                                                <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                        @enderror()
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="email" class="form-control pl-15 bg-transparent text-white plc-white" name="email" id="email" :value="old('email')"  placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @error('password')
                                                <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                                        @enderror()
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text  bg-transparent text-white"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" id="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Password" name="password">
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-6">
                                          <div class="checkbox text-white">
                                            <input type="checkbox" id="basic_checkbox_1" >
                                            <label for="basic_checkbox_1">Remember Me</label>
                                          </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                         <div class="fog-pwd text-right">
                                            <a href="{{ route('password.request') }}" class="text-white hover-info"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
                                          </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12 text-center">
                                          <button type="submit" class="btn btn-info btn-rounded mt-10">SIGN IN</button>
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                </form>                                                     

                                <div class="text-center text-white">
                                  <p class="mt-20">- Sign With -</p>
                                  <p class="gap-items-2 mb-20">
                                      <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-facebook"></i></a>
                                      <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-twitter"></i></a>
                                      <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-google-plus"></i></a>
                                      <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-instagram"></i></a>
                                    </p>    
                                </div>
                                
                                <div class="text-center">
                                    <p class="mt-15 mb-0 text-white">Don't have an account? <a href="{{ route('register') }}" class="text-info ml-5">Sign Up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor JS -->
        <script src="{{ asset('backEnd/js/vendors.min.js ') }}"></script>
        <script src="{{ asset('assets/icons/feather-icons/feather.min.js ') }}"></script>    

        <!-- toastr js -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script type="text/javascript">
            @if(Session::has('success'))
                toastr.warning("{{Session::get('success') }}");
            @endif
            @if(Session::has('info'))
                toastr.info("{{Session::get('info') }}");
            @endif
        </script>

    </body>
</html>