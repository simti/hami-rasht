<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/images/favicon.png')}}">
    <title>حامی رشت | پنل ادمین</title>

    {{--  <link href="{{asset('admin/css/lib/chartist/chartist.min.css')}}" rel="stylesheet"> --}}
    {{--  <link href="{{asset('admin/css/lib/owl.carousel.min.css')}}" rel="stylesheet" /> --}}
    {{--  <link href="{{asset('admin/css/lib/owl.theme.default.min.css')}}" rel="stylesheet" /> --}}
    {{--  <link href="{{asset('admin/css/lib/toastr/toastr.min.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('admin/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/lib/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/lib/sweetalert/swal-forms.css')}}" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('admin/css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    {{-- <link href="{{url('admin/css/lib/calendar2/persian-datepicker.css')}}" rel="stylesheet"> --}}
    {{-- <link href="{{url('admin/css/lib/calendar2/pignose.calendar.min.css')}}" rel="stylesheet"> --}}

    <link href="{{asset('admin/css/helper.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css?v=31')}}" rel="stylesheet">

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,700' rel='stylesheet'
        type='text/css'>
    <link href="https://cdn.rawgit.com/rastikerdar/vazir-font/v18.0.0/dist/font-face.css" rel="stylesheet"
        type="text/css" />

    <!-- All Jquery -->
    <script src="{{asset('admin/js/lib/jquery/jquery.min.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:** -->
    <!--[if lt IE 9]>
  <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <!--[endif]-->
    <style>
        #toast-container {
            position: fixed;
            z-index: 999999;
            pointer-events: none;
            text-align: right;
        }

        .toast-bottom-left {
            bottom: 12px;
            left: 12px;
        }

        #toast-container>.toast-success,
        #toast-container>.toast-error {
            background-position: right 15px center;
        }



        #toast-container>div {
            position: relative;
            pointer-events: auto;
            overflow: hidden;
            margin: 0 6px 6px;
            padding: 15px 50px 15px 15px;
            min-width: 300px;
            width: auto !important;
            max-width: 600px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            background-position: 15px center;
            background-repeat: no-repeat;
            -moz-box-shadow: 0 0 12px #999;
            -webkit-box-shadow: 0 0 12px #999;
            box-shadow: 0 0 12px #999;
            color: #FFF;
            opacity: .8;
            -ms-filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=80);
            filter: alpha(opacity=80);
        }

        #toast-container * {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }



        .toast-title {
            font-weight: 700;
        }

        .toast-message {
            -ms-word-wrap: break-word;
            word-wrap: break-word;
            /* font-size: initial; */
        }

        ::-webkit-input-placeholder {
            /* Chrome */
            color: rgba(73, 80, 87, 0.4);
             !important;
        }

        :-ms-input-placeholder {
            /* IE 10+ */
            color: rgba(73, 80, 87, 0.4);
             !important;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            color: rgba(73, 80, 87, 0.4);
             !important;
            opacity: 1;
        }

        :-moz-placeholder {
            /* Firefox 4 - 18 */
            color: rgba(73, 80, 87, 0.4);
             !important;
            opacity: 1;
        }
    </style>


    @yield('custom_css')
</head>


<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <!-- Logo icon -->
                        <b><img src="{{asset('admin/images/logo.png')}}" alt="homepage" class="dark-logo"
                                style="width:40px;height:40px;" /></b>
                        <!-- Logo text -->
                        <span style="    color: #d8602a;">اداره بهزیستی رشت</span>
                        <!--End Logo icon -->
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  "
                                href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  "
                                href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- End Messages -->
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- End Messages -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" style="font-size:13px">
                                {{Auth::user()->full_name}}
                                <span><i class="fa fa-chevron-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated pulse">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-text">
                                                <h4>{{Auth::user()->fullname}}</h4>
                                                ادمین سیستم
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i> خروج </a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->

        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-label" style="text-align: center;">
                            <a href="">
                                <i class="fa fa-desktop"></i>
                                مشاهده وبسایت
                            </a>
                        </li>
                        <li class="nav-devider"></li>


                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span class="hide-menu">مددجویان
                                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('donees.index')}}">مشاهده همه </a></li>
                                <li><a href="{{route('donees.create')}}">افزودن مددجو جدید </a></li>
                            </ul>
                        </li>

                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <i class="fa fa-gratipay" aria-hidden="true"></i>
                                <span class="hide-menu">حامی ها
                                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('donors.index')}}">مشاهده همه </a></li>
                                <li><a href="{{route('donors.create')}}">افزودن حامی جدید </a></li>
                            </ul>
                        </li>

                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">تراکنش ها
                                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('transactions.index')}}">مشاهده همه </a></li>
                                <li><a href="{{route('transactions.create')}}">افزودن تراکنش جدید </a></li>
                                <li><a onclick="return confirm('آیا مطمئن هستید؟')"
                                        href="{{route('transactions.bank_bulk_store')}}">افزودن دسته ای بانکی </a></li>
                                <li><a onclick="return confirm('آیا مطمئن هستید؟')"
                                        href="{{route('transactions.non_bank_bulk_store')}}">افزودن دسته ای غیر بانکی
                                    </a></li>
                            </ul>
                        </li>

                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <span class="hide-menu">دوره مالی
                                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('periods.index')}}">مشاهده همه </a></li>
                                <li><a href="{{route('periods.store')}}"
                                        onclick="return confirm('آیا مطمئن هستید؟')">افزودن دوره جدید </a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{route('users.deactivated')}}">
                                <i class="fa  fa-user-times" aria-hidden="true"></i>
                                <span class="hide-menu">کاربران غیرفعال
                                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('settings.show')}}">
                                <i class="fa  fa-gear" aria-hidden="true"></i>
                                <span class="hide-menu">تنظیمات
                                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                                </span>
                            </a>
                        </li>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                @yield('page_title')
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->

            <div class="container-fluid">
                <!-- Start Page Content -->
                @yield('content')
                <!-- End PAge Content -->
            </div>

            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer">۱۳۹۷ © تمامی حقوق محفوظ است. اجرا توسط <a href="https://shayankhaleghparast.ir">
                    شایان خالق پرست</a></footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('admin/js/lib/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('admin/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('admin/js/lib/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>

    <script src="{{asset('admin/js/lib/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin/js/lib/sweetalert/swal-forms.js')}}"></script>

    <!--Custom JavaScript -->
    <script src="{{asset('admin/js/custom.min.js')}}"></script>

    @yield('custom_js')

    {{--  convert numbers  --}}
    <script>
        var
    persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
    englishNumbers  = [/0/g, /1/g, /2/g, /3/g, /4/g, /5/g, /6/g, /7/g, /8/g, /9/g],
    fixNumbers = function (str)
    {
      if(typeof str === 'string')
      {
        for(var i=0; i<10; i++)
        {
          str = str.replace(persianNumbers[i], i).replace(englishNumbers[i], i);
        }
      }
      return str;
    };

    $(":input").bind('keyup mouseup', function () {
       $(this).val(fixNumbers($(this).val()))
    });
    </script>

    {{-- call alert toaster --}}
    <script>
        function toast_alert(msg,type){
        if(type=="true"){
          $(".err_msg").html(msg)
          $('.err_alert').show();
              setTimeout(function () {
                $('.err_alert').hide();
              }, 2000);
        }else{
          $(".suc_msg").html(msg)
          $('.suc_alert').show();
            setTimeout(function () {
              $('.suc_alert').hide();
            }, 5000);
        }
      }

      function onlyNumber(el){
        let inp = fixNumbers($("#"+el.id).val())
        if(!(/^\d*$/.test(inp))){
          $("#"+el.id).val(inp.replace(/\D/g,''))
        }
      }
    </script>

    <div id="toast-container" class="toast-bottom-left suc_alert" style="display:none;">
        <div class="toast toast-success" aria-live="polite" style="">
            {{-- <div class="toast-title">عنوان پیغام </div> --}}
            <div class="toast-message suc_msg"></div>
        </div>
    </div>

    <div id="toast-container" class="toast-bottom-left err_alert" style="display:none;">
        <div class="toast toast-error" aria-live="polite">
            {{-- <div class="toast-title">عنوان پیغام </div> --}}
            <div class="toast-message err_msg"></div>
        </div>
    </div>
    @yield('custom_modal')
    @if($errors->any())
    <script>
        toast_alert("{{$errors}}","true")
    </script>
    @endif
</body>

</html>
