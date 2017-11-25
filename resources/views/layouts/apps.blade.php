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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">

    <link href="{{asset('assets/css/custom_css/dashboard1.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/custom_css/dashboard1_timeline.css')}}" rel="stylesheet"/>



    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/widgets.css')}}">

    <!-- add new user-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">

<script src="https://use.fontawesome.com/e8c765c6d1.js"></script>


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

<!--flot chart-->

<!--swiper-->

<!--nvd3 chart-->
<script type="text/javascript" src="{{asset('assets/js/nvd3/d3.v3.min.js')}}"></script>

<!-- end of page level js -->

<!-- wow plugin -->
<!--Sparkline Chart-->

<!-- end of page level js -->


@yield('javascripts')
</body>

</html>