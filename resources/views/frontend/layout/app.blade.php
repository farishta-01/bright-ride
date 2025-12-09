<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BrightRide - Premium Car Dealership">
    <meta name="keywords" content="cars, dealership, automotive, vehicles">

    <title>BrightRide - @yield('title', 'Premium Car Dealership')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    @include('frontend.layout.partials.css')
    @yield('css')
</head>

<body>
    <div class="top-area">
        <div class="header-area">
            <!-- Start Navigation -->
            <nav class="navbar navbar-default bootsnav navbar-sticky navbar-scrollspy"
                 data-minus-value-desktop="70"
                 data-minus-value-mobile="55"
                 data-speed="1000">

                <div class="container">
                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="{{ route('frontend.home') }}">
                            Bright<span>Ride</span>
                        </a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}">
                                <a href="{{ route('frontend.home') }}">Home</a>
                            </li>
                            <li class="{{ request()->routeIs('frontend.service') ? 'active' : '' }}">
                                <a href="{{ route('frontend.service') }}">Services</a>
                            </li>
                            <li class="{{ request()->routeIs('frontend.featured_cars*') ? 'active' : '' }}">
                                <a href="{{ route('frontend.featured_cars') }}">Featured Cars</a>
                            </li>
                            <li class="{{ request()->routeIs('frontend.brands') ? 'active' : '' }}">
                                <a href="{{ route('frontend.brands') }}">Brands</a>
                            </li>
                            <li class="{{ request()->routeIs('frontend.contact') ? 'active' : '' }}">
                                <a href="{{ route('frontend.contact') }}">Contact</a>
                            </li>
                            @if (auth()->check())
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-user-circle"></i>
                                        {{ auth()->user()->username }}
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login.page') }}" class="nav-btn">
                                        <i class="fa fa-sign-in"></i> Login
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!--/.container-->
            </nav>
            <!--/nav-->
            <!-- End Navigation -->
        </div>
        <!--/.header-area-->
        <div class="clearfix"></div>
    </div>

    @yield('content')

    @include('frontend.layout.partials.js')
    @yield('javascript')
</body>

</html>
