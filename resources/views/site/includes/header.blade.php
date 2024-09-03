<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>{{config('app.name')}}</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- font -->
    <link rel="stylesheet" href="{{asset('/site/fonts/fonts.css')}}">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('/site/fonts/font-icons.css')}}">
    <link rel="stylesheet" href="{{asset('/site/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/site/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('/site/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('/site/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/site/css/apexcharts.css')}}">
    <link rel="stylesheet"type="text/css" href="{{asset('/site/css/jqueryui.min.css')}}"/>
    @yield('style')
    <link rel="stylesheet"type="text/css" href="{{asset('/site/css/styles.css')}}"/>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{asset('/site/images/logo/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('/site/images/logo/favicon.png')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .error {
            color: #ed2027 !important;
        }
        .form-control.style-1.error,
        input.error,
        textarea.error,
        select.error {
            border-color: #ed2027 !important;
        }
        .custom-error p {
            color: #ed2027;
            margin-top: 5px;
            font-size: 0.9rem;
        }
    </style>
<style>
    .fa-heart{
        color: #ed2027 !important;
    }
    .header-property-detail .content-bottom .icon-box .item:hover .fa-heart {
        color: #FFFFFF !important;
    }
    .homeya-box .images-group .box-icon:hover .fa-heart{
        color: #FFFFFF !important;
    }
</style>
</head>

<body class="body counter-scroll">

<div class="preload preload-container">
    <div class="boxes ">
        <div class="box">
            <div></div> <div></div> <div></div> <div></div>
        </div>
        <div class="box">
            <div></div> <div></div> <div></div> <div></div>
        </div>
        <div class="box">
            <div></div> <div></div> <div></div> <div></div>
        </div>
        <div class="box">
            <div></div> <div></div> <div></div> <div></div>
        </div>
    </div>
</div>

<!-- /preload -->

<div id="wrapper">
    <div id="pagee" class="clearfix">

        <!-- Main Header -->
        <header class="main-header fixed-header">
            <!-- Header Lower -->
            <div class="header-lower">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-container d-flex justify-content-between align-items-center">
                            <!-- Logo Box -->
                            <div class="logo-box">
                                <div class="logo"><a href="{{route('site.index')}}"><img src="{{asset('/site/images/logo/logo@2x.png')}}" alt="logo" width="174" height="44"></a></div>
                            </div>
                            <div class="nav-outer">
                                <!-- Main Menu -->
                                <nav class="main-menu show navbar-expand-md">
                                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li class=" home current"><a href="{{route('site.index')}}#">Home</a>
{{--                                                <ul>--}}
{{--                                                    <li class="current"><a href="{{route('site.index')}}">Home</a></li>--}}


{{--                                                </ul>--}}
                                            </li>
                                            <li class=" "><a href="{{route('site.properties')}}">Properties</a>

                                            </li>


                                            <li class=" "><a href="{{route('site.blogs')}}">Blogs</a>

                                            </li>

                                            <li class="dropdown2"><a href="#">More</a>
                                                <ul>
                                                    <li><a href="{{route('site.faqs')}}">FAQs</a></li>
                                                    <li><a href="{{route('site.about-us')}}">About Us</a></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                                <!-- Main Menu End-->
                            </div>
                            <div class="header-account">
                                <div class="register">
                                    <ul class="d-flex">
                                        <li><a href="#modalLogin" data-bs-toggle="modal">Login</a></li>
                                        <li>/</li>
                                        <li><a href="#modalRegister" data-bs-toggle="modal">Register</a></li>
                                    </ul>
                                </div>
                                <div class="flat-bt-top">
                                    <a class="tf-btn primary" href="{{route('user.properties.create')}}">Submit Property</a>
                                </div>
                            </div>

                            <div class="mobile-nav-toggler mobile-button"><span></span></div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header Lower -->

            <!-- Mobile Menu  -->
            <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>
                <nav class="menu-box">
                    <div class="nav-logo"><a href="{{route('site.index')}}"><img src="{{asset('/site/images/logo/logo@2x.png')}}" alt="nav-logo" width="174" height="44"></a></div>
                    <div class="bottom-canvas">
                        <div class="login-box flex align-items-center">
                            <a href="#modalLogin" data-bs-toggle="modal">Login</a>
                            <span>/</span>
                            <a href="#modalRegister" data-bs-toggle="modal">Register</a>
                        </div>
                        <div class="menu-outer"></div>
                        <div class="button-mobi-sell">
                            <a class="tf-btn primary" href="{{route('user.properties.create')}}">Submit Property</a>
                        </div>
                        <div class="mobi-icon-box">
                            <div class="box d-flex align-items-center">
                                <span class="icon icon-phone2"></span>
                                <div>1-333-345-6868</div>
                            </div>
                            <div class="box d-flex align-items-center">
                                <span class="icon icon-mail"></span>
                                <div>themesflat@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- End Mobile Menu -->

        </header>
        <!-- End Main Header -->
