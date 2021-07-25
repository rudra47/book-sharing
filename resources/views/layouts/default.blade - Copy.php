<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- Favicon -->
    <link href="{{ asset('web/img/fav.png') }}" rel="shortcut icon" type="image/x-icon"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ILC - Input Language Center') }}</title> 
    <!--<title> Edu-Course </title>-->

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('web/assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
    <!-- Custom icon Fonts -->
    <link href="{{ asset('web/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Konnect Slider -->
    <link href="{{ asset('web/css/konnect-slider.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('web/css/animate.css') }}" media="all" rel="stylesheet" type="text/css" />

    <!-- Main CSS -->
    <link href="{{ asset('web/css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('web/css/green.css')}}" rel="stylesheet" id="style_theme">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        .live-class {
            margin: 0 auto;
            width: 85%;
        }
        .live-class-data {
            overflow-x:auto; 
            height: 400px;
            margin-top: 50px;
        }
        .live-class-menu ul {
            width: 100%;
            list-style-type: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .live-class-menu ul li a {
            padding: 10px 30px;
            margin-right: 5px;
            display: inline-block;
            background: #2c387e;
            color: #ffffff;
            text-decoration: none;
        }
        .live-class-menu ul li a:hover {
            background: #ffc107;
        }
        .live-class-menu .liveMenuActive {
            background: #ffc107;
        }

        @media (min-width: 320px) and (max-width: 480px) {
            .live-class {
                margin: 0 auto;
                width: 100%;
            }
            .live-class-menu ul {
                flex-direction: column;
            }
            .live-class-menu ul li {
                width: 100%;
                text-align: center;
                margin: 5px;
            }
            .live-class-menu ul li a{
                display: block;
            }
        }
        /* Profile */
        .user-profile {
            border: 20px solid gray;
        }
        .user-profile img {
            width: 100%;
            padding: 0px;
        }
        .user-profile a {
            padding: 5px 10px; 
            background: lightgray; 
            position: absolute; 
            bottom: 10px; 
            right: 10px;
            border-radius: 4px;
        }
        .pro-act {
            color: #ffc80c!important;
        }
        
        /* Video Slider */
        .carousel-inner { margin: auto; width: 90%; }
        .carousel-control { width:  4%; }
        .carousel-control.left,
        .carousel-control.right {
          background-image:none;
        }
         
        .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right {
          margin-top:-10px;
          margin-left: -10px;
          color: #444;
        }
        
        /* @media (max-width: 767px) {
          .carousel-inner > .item.next,
          .carousel-inner > .item.active.right {
              left: 0;
              -webkit-transform: translate3d(100%, 0, 0);
              transform: translate3d(100%, 0, 0);
          }
          .carousel-inner > .item.prev,
          .carousel-inner > .item.active.left {
              left: 0;
              -webkit-transform: translate3d(-100%, 0, 0);
              transform: translate3d(-100%, 0, 0);
          }
        
        }
        @media (min-width: 767px) and (max-width: 992px ) {
          .carousel-inner > .item.next,
          .carousel-inner > .item.active.right {
              left: 0;
              -webkit-transform: translate3d(50%, 0, 0);
              transform: translate3d(50%, 0, 0);
          }
          .carousel-inner > .item.prev,
          .carousel-inner > .item.active.left {
              left: 0;
              -webkit-transform: translate3d(-50%, 0, 0);
              transform: translate3d(-50%, 0, 0);
          }
        }
        @media (min-width: 992px ) {
          
          .carousel-inner > .item.next,
          .carousel-inner > .item.active.right {
              left: 0;
              -webkit-transform: translate3d(16.7%, 0, 0);
              transform: translate3d(16.7%, 0, 0);
          }
          .carousel-inner > .item.prev,
          .carousel-inner > .item.active.left {
              left: 0;
              -webkit-transform: translate3d(-16.7%, 0, 0);
              transform: translate3d(-16.7%, 0, 0);
          }
          
        } */

    </style>
</head>
<body>
    <div id="app">
        <!-- Pre Loader -->
        <div class="loading">
            <div class="loader"></div>
        </div>
        <!-- Scroll to Top --> 
        <a id="scroll-up" ><i class="fa fa-angle-up"></i></a> 
        <!-- Color Changer -->
        <!-- Top Bar  -->
        <div class="konnect-info">
            <div class="container-fluid">
            <div class="row"> 
                <!-- Top bar Left -->
                <div class="col-md-6 col-sm-8 hidden-xs">
                <ul>
                    <li><i class="fa fa-paper-plane" aria-hidden="true"></i> support@ilc.com </li>
                    <li class="li-last"> <i class="fa fa-volume-control-phone" aria-hidden="true"></i> +8801718568987</li>
                </ul>
                </div>
                <!-- Top bar Right -->
                <div class="col-md-6 col-sm-4">
                <ul class="konnect-float-right">
                    @if (Route::has('login'))
                    @auth
                        {{-- <li><i class="fa fa-user-o" aria-hidden="true"></i> {{ Auth::user()->name }} </li> --}}
                        <li>
                            <a href="{{ route('logout', app()->getLocale()) }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-user-o" aria-hidden="true"></i> @lang('default.log-out') </a>
                            <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    @else
                        <li><a href="{{ route('login', app()->getLocale()) }}"><i class="fa fa-user-o" aria-hidden="true"></i> @lang('default.login') </a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register', app()->getLocale()) }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> @lang('default.register') </a></li>
                        @endif
                    @endif
                    @endif
                    
                    <li class="li-last hidden-xs hidden-sm">
                        <a target="_blank" href="https://www.facebook.com/inputlanguage/"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
                        <a target="_blank" href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a> 
                    </li>
                    {{-- @php
                        $link=explode('/',$_SERVER['REQUEST_URI']);
                        $page=$link[count($link)-1];
                        echo request()->path();
                        echo $page;
                    @endphp --}}
                    @if (App::isLocale('en'))
                        <?php
                            $genUrl = Request::url();
                        ?>
                        <li><a href="{{ URL::to('/bn') }}"> বাংলা </a></li>
                    @elseif(App::isLocale('bn')) 
                        <?php
                            $genUrl = URL::current();
                        ?>
                        <li><a href="{{ URL::to('/en') }}"> English </a></li>
                    @else 
                        <li><a href="{{ URL::to('/bn') }}"> বাংলা </a></li>
                    @endif
                </ul>
                </div>
            </div>
            </div>
        </div>
        
        <!-- Main Navigation + LOGO Area -->
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
            <div class="navbar-header"> 
                <!-- Responsive Menu -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <img src="{{ asset('web/img/icons/menu.png') }}" alt="menu" width="40"> </button>
                <!-- Logo --> 
                <a class="navbar-brand" href="{{URL::to('/')}}"><img class="logo-change" src="{{ asset('web/img/ilc-logo.png') }}" alt="logo"></a> </div>
            
            <!-- Menu Items -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{URL::to('/')}}">@lang('default.home')</a></li>
                <li class=""><a href="{{route('courses', app()->getLocale())}}">@lang('default.live-class')</a></li>
                <li class="{{ (request()->is('courses')) ? 'active' : '' }}"><a href="{{route('courses', app()->getLocale())}}">@lang('default.courses')</a></li>
                <li class="{{ (request()->is('about-us')) ? 'active' : '' }}"><a href="{{route('about-us', app()->getLocale())}}">@lang('default.about-us')</a></li>
                <li class="{{ (request()->is('contact-us')) ? 'active' : '' }}"><a href="{{route('contact-us', app()->getLocale())}}">@lang('default.contact')</a></li>
                <li class="{{ (request()->is('faq')) ? 'active' : '' }}"><a href="{{route('faq', app()->getLocale())}}">@lang('default.faq')</a></li>
                @auth
                <li class="dropdown"><a href="course.html" class="dropdown-toggle" data-toggle="dropdown">@lang('default.profile') <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('profile', app()->getLocale())}}">{{ Auth::user()->name }}</a></li>
                        <li><a href="#">My Courses</a></li>
                    </ul>
                </li>
                @endif
                <!--<li class="search-icon"><a href="javascript:void(0)"><i class="fa fa-search" aria-hidden="true"></i></a>-->
                <!--    <div class="search-form">-->
                <!--    <form class="navbar-form" role="search">-->
                <!--        <div class="input-group add-on">-->
                <!--        <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">-->
                <!--        <div class="input-group-btn">-->
                <!--            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>-->
                <!--        </div>-->
                <!--        </div>-->
                <!--    </form>-->
                <!--    </div>-->
                <!--</li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse --> 
            </div>
            <!-- /.container-fluid --> 
        </nav>
        
        <main class="py-4">
            @yield('content')
        </main>
        
        <!--Main footer-->
        <section class="main-footer">
            <div class="container">
            <div class="row"> 
                <!--footer widget one-->
                <div class="col-md-4 col-sm-6">
                <div class="footer-widget"> <img src="{{ asset('web/img/ilc-logo.png') }}" alt="" class="img-responsive logo-change" style="margin-left: -25px;">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa consectetur assumenda est unde animi. Repellat quibusdam et ad aut molestias, facere maxime expedita aperiam sint.</p>
                    <span><a href="#" class="read-more">@lang('default.read-more')</a></span> </div>
                </div>
                <!--/ footer widget one--> 
                
                <!--footer widget Two-->
                <div class="col-md-4 col-sm-6">
                <div class="footer-widget address">
                    <h3>@lang('default.contact')</h3>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span>Dhanmondi, Dhaka </span></p>
                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> <span>support@ilc.com</span></p>
                    <p><i class="fa fa-volume-control-phone" aria-hidden="true"></i> <span>+88 (0) 101 0000 000 <br>
                    +88 (0) 202 0000 001</span></p>
                </div>
                </div>
                <!--/ footer widget Two--> 
                
                <!--footer widget Three-->
                <div class="col-md-4 col-sm-6">
                <div class="footer-widget quicl-links">
                    <h3>@lang('default.quick-links')</h3>
                    <ul>
                    <li><i class="fa  fa-angle-right"></i> <a href="{{URL::to('/')}}">@lang('default.home')</a></li>
                    <li><i class="fa  fa-angle-right"></i> <a href="{{route('about-us', app()->getLocale())}}">@lang('default.about-us')</a></li>
                    <li><i class="fa  fa-angle-right"></i> <a href="#">@lang('default.live-class')</a></li>
                    <li><i class="fa  fa-angle-right"></i> <a href="{{route('contact-us', app()->getLocale())}}">@lang('default.contact')</a></li>
                    <li><i class="fa  fa-angle-right"></i> <a href="{{route('courses', app()->getLocale())}}">@lang('default.courses')</a></li>
                    <li><i class="fa  fa-angle-right"></i> <a href="#">@lang('default.privacy-policy')</a></li>
                    <li><i class="fa  fa-angle-right"></i> <a href="{{ route('login', app()->getLocale()) }}">@lang('default.login')</a></li>
                    <li><i class="fa  fa-angle-right"></i> <a href="{{ route('register', app()->getLocale()) }}">@lang('default.register')</a></li>
                    </ul>
                </div>
                </div>
                <!--/ footer widget thre--> 
            </div>
            </div>
        </section>
        <!--/Main Footer--> 
        
        <!--copyright Footer-->
        <footer>
            <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center"> 
                    <p> &copy;  All right reserved by ILC, {{date('Y')}}</p>
                </div>
            </div>
            </div>
        </footer>
    </div>
    
    <script src="{{ asset('web/assets/jquery/jquery.min.js') }}"></script> 

    <!-- Bootstrap Core JavaScript --> 
    <script src="{{ asset('web/assets/bootstrap/js/bootstrap.min.js') }}"></script> 

    <!-- Konnect Slider JavaScript --> 
    <script src="{{ asset('web/js/jquery.flexslider.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('web/js/konnect-slider.js') }}" type="text/javascript"></script> 

    <!-- Theme JavaScript --> 
    <script src="{{ asset('web/js/default.js') }}"></script>
    {{-- <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-77800499-1', 'auto');
        ga('send', 'pageview');

    </script> --}}

    @stack('javascript')

</body>
</html>
