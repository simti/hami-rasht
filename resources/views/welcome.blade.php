<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('admin/images/favicon.png')}}">
    <title>حامی رشت | پنل ادمین</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('admin/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url('admin/css/helper.css')}}" rel="stylesheet">
    <link href="{{url('admin/css/style.css')}}" rel="stylesheet">
    
    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,700' rel='stylesheet' type='text/css'>
    <link href="https://cdn.rawgit.com/rastikerdar/vazir-font/v18.0.0/dist/font-face.css" rel="stylesheet" type="text/css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!--[endif]-->

    <style>
        span.help-block.form-error{
            color: #b7403d;
            font-size: small;
        }
    </style>
</head>
<body>
        <div class="preloader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
            </div>
            <!-- Main wrapper  -->
            <div id="main-wrapper">
                <div class="unix-login">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <div class="row">
                                  <div class="col-md-12" style="text-align: center;padding-top: 100px;">
                                    <img src="{{url('admin/images/logo.png')}}" alt="" style="width:30%;padding: 20px;">
                                  </div>
                                  <div class="col-md-12 ">
                                    <h4 class="text-center " style="color: #d8602a;font-size: x-large;padding: 20px;">اداره بهزیستی رشت</h4>
                                  </div>
                                </div>
                                <div class="login-content card" style="margin:0">
                                    <div class="login-form">
                                        <h4>ورود به سیستم</h4>
                                        <form id="myForm" action="{{route('login')}}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>کلمه عبور</label>
                                                <input hidden name="group" value="admin" />
                                                <input id="password" type="password" name="password" class="form-control {{$errors->has('password')?'is-invalid':''}}" autocomplete="off" focus>
                                                @if(session('wrong_number', false))
                                                    <span class="help-block form-error">شماره تلفن اشتباه بود!</span>
                                                @endif
                                                @if($errors->has('password'))
                                                  <span class="help-block form-error">{{$errors->first('phone')}}</span>
                                                @endif
                                            </div>
                                            <button type="button" onclick="doSubmit()" class="btn btn-primary btn-flat m-b-30 m-t-30">ورود</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
            </div>



    <!-- All Jquery -->
    <script src="{{url('admin/js/lib/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{url('admin/js/lib/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{url('admin/js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{url('admin/js/jquery.slimscroll.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{url('admin/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{url('admin/js/lib/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
  
    <!--Custom JavaScript -->
    <script src="{{url('admin/js/custom.min.js')}}"></script>
  
    <script>  
        const toEnglishDigits = value => { 
          const charCodeZeroFa = '۰'.charCodeAt(0) 
          const charCodeZeroAr = '٠'.charCodeAt(0) 
          return value.replace(/[۰-۹]/g, w => w.charCodeAt(0) - charCodeZeroFa).replace(/[٠-٩]/g, w => w.charCodeAt(0) - charCodeZeroAr) 
        }
        function doSubmit(){
          $("#password").val(toEnglishDigits($("#password").val()))
          $("#myForm").submit();
        }
    </script>
</body>
</html>