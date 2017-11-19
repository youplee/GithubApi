<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>NEXTMEDIA GITHUB</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/app.css')}}"/> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.min.css"/>
    <!-- end of global css -->
    <!--page level css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/swiper/css/swiper.min.css')}}">
    <link href="{{asset('assets/vendors/nvd3/css/nv.d3.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendors/lcswitch/css/lc_switch.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">

    <link href="{{asset('assets/css/custom_css/dashboard1.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/custom_css/dashboard1_timeline.css')}}" rel="stylesheet"/>

    <link href="{{asset('assets/vendors/ihover/css/ihover.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/animate/animate.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/widgets.css')}}">

    <!-- add new user-->
    <link href="{{asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('assets/vendors/select2/css/select2.min.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('assets/vendors/select2/css/select2-bootstrap.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/iCheck/css/all.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">


  <link href="{{ asset('assets/vuetify/css/styles.css') }}" rel="stylesheet" type="text/css">
  <link rel="icon" type="{{ asset('assets/vuetify/images/image/png') }}" href="favicon-32x32.png" sizes="32x32">
  <script src="{{ asset('assets/vuetify/js/vuetify.min.js') }}"></script>

    <!-- end add new user-->
    <!--end of page level css-->
    @yield('style')
</head>
<body class="skin-default">
<div class="preloader">
    <div class="loader_img"><img src="{{asset('assets/img/loader.gif')}}" alt="loading..." height="64" width="64"></div>
</div>
<!-- header logo: style can be found in header-->
<header class="header">
   @include('layouts.partials.header')
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">

        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            @include('layouts.partials.leftSidebar')
        </section>
        <!-- /.sidebar --> 
    </aside>

    <aside class="right-side">
        <section class="content-header">
            @include('layouts.partials.searchbar')
        </section>
        <section class="content">
           
                @yield('content')
                
                @include('layouts.partials.rightSidebar')
        </section>
    </aside>
    
    <!-- /.right-side --> 
</div>
<!-- ./wrapper -->
<!-- global js -->
<div id="qn"></div>


@yield('modals')
        

<script src="{{asset('assets/js/app.js')}}" type="text/javascript"></script>
<!-- end of global js -->

<!-- begining of page level js -->
<!--Sparkline Chart-->
<script type="text/javascript" src="{{asset('assets/js/custom_js/sparkline/jquery.flot.spline.js')}}"></script>
<!-- flip -->
<script type="text/javascript" src="{{asset('assets/vendors/flip/js/jquery.flip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/lcswitch/js/lc_switch.min.js')}}"></script>
<!--flot chart-->
<!-- <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.resize.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.stack.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flotspline/js/jquery.flot.spline.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/flot.tooltip/js/jquery.flot.tooltip.js')}}"></script> -->
<!--swiper-->
<script type="text/javascript" src="{{asset('assets/vendors/swiper/js/swiper.min.js')}}"></script>
<!--chartjs-->
<script src="{{asset('assets/vendors/chartjs/js/Chart.js')}}"></script>
<!--nvd3 chart-->
<script type="text/javascript" src="{{asset('assets/js/nvd3/d3.v3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/nvd3/js/nv.d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/moment/js/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/advanced_newsTicker/js/newsTicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/dashboard1.js')}}"></script>
<!-- end of page level js -->

<!-- wow plugin -->
<script type="text/javascript" src="{{asset('assets/vendors/countUp.js/js/countUp.js')}}"></script>
<!--Sparkline Chart-->
<script type="text/javascript" src="{{asset('assets/vendors/jquery-knob/js/jquery.knob.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/wow/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom_js/widgets.js')}}"></script>
<!-- end of page level js -->


@yield('javascripts')
</body>

</html>