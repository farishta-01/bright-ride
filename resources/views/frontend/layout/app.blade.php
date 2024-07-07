<!doctype html>
<html class="no-js" lang="en">

<head>

    <title>BrightRide- @yield('title', 'Default')</title>
    @include('frontend.layout.partials.css')
    @yield('css')
</head>

<body>
    <div class="top-area">
        <div class="header-area">
            <!-- Start Navigation -->
            <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy" data-minus-value-desktop="70"
                data-minus-value-mobile="55" data-speed="1000">

                <div class="container">

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="{{ route('frontend.home') }}">Best Ride<span></span></a>

                    </div><!--/.navbar-header-->
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class=" "><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class=""><a href="{{ route('frontend.service') }}">Services</a></li>
                            <li class=""><a href="{{ route('frontend.featured_cars') }}">Featured cars</a>
                            </li>
                            <li class=""><a href="{{ route('frontend.brands') }}">Brands</a></li>
                            <li class=""><a href="{{ route('frontend.contact') }}">contact</a></li>
                            @if (auth()->check())
                                <li class="nav-item px-1 dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ auth()->user()->username }}
                                    </a>
                                    <div class="dropdown-menu text-center text-lg-start shadow-sm"
                                        aria-labelledby="navbarDropdownMenuLink">

                                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item px-1">
                                    <a class="nav-link" href="{{ route('login.page') }}">Login</a>
                                </li>
                            @endif
                        </ul><!--/.nav -->
                    </div><!-- /.navbar-collapse -->
                </div><!--/.container-->
            </nav><!--/nav-->
            <!-- End Navigation -->
        </div><!--/.header-area-->
        <div class="clearfix"></div>

    </div>
    @yield('content')
    @include('frontend.layout.partials.js')
    @yield('javascript')
</body>

</html>
