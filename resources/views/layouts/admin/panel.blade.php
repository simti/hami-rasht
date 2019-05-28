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

  {{--  <link href="{{asset('admin/css/lib/chartist/chartist.min.css')}}" rel="stylesheet">  --}}
  {{--  <link href="{{asset('admin/css/lib/owl.carousel.min.css')}}" rel="stylesheet" />  --}}
  {{--  <link href="{{asset('admin/css/lib/owl.theme.default.min.css')}}" rel="stylesheet" />  --}}
  {{--  <link href="{{asset('admin/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">  --}}
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
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,700' rel='stylesheet' type='text/css'>
  <link href="https://cdn.rawgit.com/rastikerdar/vazir-font/v18.0.0/dist/font-face.css" rel="stylesheet" type="text/css" />
  
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
    
    #toast-container>.toast-success,#toast-container>.toast-error {
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

    ::-webkit-input-placeholder { /* Chrome */
      color: rgba(73, 80, 87, 0.4); !important;
    }
    :-ms-input-placeholder { /* IE 10+ */
      color: rgba(73, 80, 87, 0.4); !important;
    }
    ::-moz-placeholder { /* Firefox 19+ */
      color: rgba(73, 80, 87, 0.4); !important;
      opacity: 1;
    }
    :-moz-placeholder { /* Firefox 4 - 18 */
      color: rgba(73, 80, 87, 0.4); !important;
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
            <b><img src="{{asset('admin/images/logo.png')}}" alt="homepage" class="dark-logo" style="width:40px;height:40px;" /></b>
            <!-- Logo text -->
            <span>پنل مدیریت</span>
            <!--End Logo icon -->
          </a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse">
          <!-- toggle and nav items -->
          <ul class="navbar-nav mr-auto mt-md-0">
            <!-- This is  -->
            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
            <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
            <!-- End Messages -->
          </ul>
          <!-- User profile and search -->
          <ul class="navbar-nav my-lg-0">
              <!-- End Messages -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="font-size:13px">
                    {{-- {{Auth::user()->fullname}} --}}
                    test
                    <span><i class="fa fa-chevron-down"></i></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right animated pulse">
                <ul class="dropdown-user">
                  <li>
                    <div class="dw-user-box">
                      <div class="u-text">
                        {{-- <h4>{{Auth::user()->fullname}}</h4> --}}
                        test
                        {{-- <p class="text-muted">{{Auth::user()->group_str}} </p>
                         --}}
                      </div>
                    </div>
                  </li>
                  <li role="separator" class="divider"></li>
                  <li><a href=""><i class="fa fa-power-off"></i> خروج از حساب</a></li>
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
                <a class="has-arrow"  href="#" aria-expanded="false">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <span class="hide-menu">مددجویان 
                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                  </span>
                </a>
                <ul aria-expanded="false" class="collapse">
                  <li><a href="{{route('donees.index')}}">مشاهده همه  </a></li>
                  <li><a href="{{route('donees.create')}}">افزودن مددجو جدید </a></li>
                </ul>
              </li>

              <li> 
                <a class="has-arrow"  href="#" aria-expanded="false">
                    <i class="fa fa-gratipay" aria-hidden="true"></i>
                  <span class="hide-menu">حامی ها
                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                  </span>
                </a>
                <ul aria-expanded="false" class="collapse">
                  <li><a href="{{route('donors.index')}}">مشاهده همه  </a></li>
                  <li><a href="{{route('donors.create')}}">افزودن حامی جدید </a></li>
                </ul>
              </li>

              <li> 
                <a class="has-arrow"  href="#" aria-expanded="false">
                    <i class="fa fa-users" aria-hidden="true"></i>
                  <span class="hide-menu">تراکنش ها
                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                  </span>
                </a>
                <ul aria-expanded="false" class="collapse">
                  <li><a href="#">مشاهده همه  </a></li>
                  <li><a href="{{route('transactions.create')}}">افزودن تراکنش جدید </a></li>
                </ul>
              </li>

              <li> 
                <a class="has-arrow"  href="#" aria-expanded="false">
                    <i class="fa fa-gift" aria-hidden="true"></i>
                  <span class="hide-menu">دوره مالی
                    {{--  <span class="label label-rouded label-primary pull-right">۲</span>  --}}
                  </span>
                </a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{route('periods.index')}}">مشاهده همه  </a></li>
                    <li><a href="{{route('periods.store')}}" onclick="return confirm('آیا مطمئن هستید؟')">افزودن دوره جدید </a></li>
                </ul>
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
      <footer class="footer">۱۳۹۷ © تمامی حقوق محفوظ است.   اجرا توسط <a href="https://shayankhaleghparast.ir"> شایان خالق پرست</a></footer>
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

  {{--  <script src="{{asset('admin/js/lib/datamap/d3.min.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/datamap/topojson.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/datamap/datamaps.world.min.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/datamap/datamap-init.js')}}"></script>  --}}

  {{--  <script src="{{asset('admin/js/lib/weather/jquery.simpleWeather.min.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/weather/weather-init.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/owl-carousel/owl.carousel.min.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/owl-carousel/owl.carousel-init.js')}}"></script>  --}}

  <!-- Amchart -->
  {{--  <script src="{{asset('admin/js/lib/morris-chart/raphael-min.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/morris-chart/morris.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/morris-chart/dashboard1-init.js')}}"></script>  --}}


  {{--  <script src="{{asset('admin/js/lib/calendar-2/moment.latest.min.js')}}"></script>  --}}
  <!-- scripit init-->
  {{--  <script src="{{asset('admin/js/lib/calendar-2/semantic.ui.min.js')}}"></script>  --}}
  <!-- scripit init-->
  {{--  <script src="{{asset('admin/js/lib/calendar-2/prism.min.js')}}"></script>  --}}
  <!-- scripit init-->
  {{--  <script src="{{asset('admin/js/lib/calendar-2/pignose.calendar.min.js')}}"></script>  --}}
  <!-- scripit init-->
  {{--  <script src="{{asset('admin/js/lib/calendar-2/pignose.init.js')}}"></script>  --}}

  {{--  <script src="{{asset('admin/js/lib/chartist/chartist.min.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/chartist/chartist-plugin-tooltip.min.js')}}"></script>  --}}
  {{--  <script src="{{asset('admin/js/lib/chartist/chartist-init.js')}}"></script>  --}}
  <!--Custom JavaScript -->
  <script src="{{asset('admin/js/custom.min.js')}}"></script>
  
  @yield('custom_js')

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-23581568-13');
  </script>

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
    {{-- custom modal --}}
    {{-- <div class="sweet-overlay" tabindex="-1" style="opacity: 1.04; display: block;"></div>
    <div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="true" data-has-confirm-button="true" data-allow-outside-click="true" data-has-done-function="true" data-animation="pop" data-timer="null" style="display: block; margin-top: -148px;"><div class="sa-icon sa-error" style="display: none;">
        <span class="sa-x-mark">
          <span class="sa-line sa-left"></span>
          <span class="sa-line sa-right"></span>
        </span>
      </div><div class="sa-icon sa-warning" style="display: none;">
        <span class="sa-body"></span>
        <span class="sa-dot"></span>
      </div><div class="sa-icon sa-info" style="display: none;"></div><div class="sa-icon sa-success" style="display: none;">
        <span class="sa-line sa-tip"></span>
        <span class="sa-line sa-long"></span>
  
        <div class="sa-placeholder"></div>
        <div class="sa-fix"></div>
      </div><div class="sa-icon sa-custom" style="display: none;"></div><h2>غذای جدید</h2>
      <p style="display: block;"><div class="swal-form"><input id="title" class=" nice-input swal-form-field" type="text" name="" value="" title="نام غذا" placeholder="نام غذا" data-swal-forms-required=""><label for="title"></label></div></p>
      <fieldset>
        <input type="text" tabindex="3" placeholder="">
        <div class="sa-input-error"></div>
      </fieldset><div class="sa-error-container">
        <div class="icon">!</div>
        <p>Not valid!</p>
      </div><div class="sa-button-container">
        <button class="cancel" tabindex="2" style="display: inline-block;">بستن</button>
        <div class="sa-confirm-button-container">
          <button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(92, 74, 199); box-shadow: rgba(92, 74, 199, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">ثبت</button><div class="la-ball-fall">
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
      </div></div> --}}

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
</body>

</html>