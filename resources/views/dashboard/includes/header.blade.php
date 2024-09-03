<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{asset('')}}/assets/"
    data-template="vertical-menu-template-starter"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{config('app.name')}} | </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('/')}}assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('/assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/vendor/fonts/tabler-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('/assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('/assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/vendor/libs/toastr/toastr.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/vendor/libs/animate-css/animate.css')}}" />
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css
" rel="stylesheet"></link>
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('/assets/vendor/js/helpers.js')}}"></script>
@yield('style')
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
{{--    <script src="{{asset('/assets/vendor/js/template-customizer.js')}}"></script>--}}
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('/assets/js/config.js')}}"></script>
    <style>

        #ul_notifications {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .notification-drop {
            font-family: 'Ubuntu', sans-serif;
            color: #444;
        }

        .notification-drop .item {
            padding-right: 15px;
            font-size: 18px;
            position: relative;
            border-bottom: 1px solid #ddd;
        }

        .notification-drop .item:hover {
            cursor: pointer;
        }

        .notification-drop .item i {
            margin-left: 10px;
        }

        .notification-drop .item ul li {
            font-size: 16px;
            padding: 10px 10px 10px 10px;
        }

        .notification-drop .item ul li:hover {
            background: #ddd;
            color: rgba(0, 0, 0, 0.8);
        }

        @media screen and (min-width: 500px) {
            .notification-drop {
                display: flex;
                justify-content: flex-end;
            }

            .notification-drop .item {
                border: none;
            }
        }



        .notification-bell {
            font-size: 20px;
        }

        .btn__badge {
            background: #ff0000;
            color: white;
            font-size: 10px;
            position: absolute;
            top: -3px;
            right: 0px;
            padding: 0px 4px 0px 4px;
            border-radius: 50%;
            height: 10px;
            padding-bottom: 23px;
            font-weight: bolder;
        }

        .pulse-button {
            box-shadow: 0 0 0 0 rgba(0, 0, 255, 0.5);
            -webkit-animation: pulse 1.5s infinite;
        }

        .pulse-button:hover {
            -webkit-animation: none;
        }

        @-webkit-keyframes pulse {
            0% {
                -moz-transform: scale(0.9);
                -ms-transform: scale(0.9);
                -webkit-transform: scale(0.9);
                transform: scale(0.9);
            }

            70% {
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -webkit-transform: scale(1);
                transform: scale(1);
                box-shadow: 0 0 0 50px rgba(255, 0, 0, 0);
            }

            100% {
                -moz-transform: scale(0.9);
                -ms-transform: scale(0.9);
                -webkit-transform: scale(0.9);
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
            }
        }

        .notification-text {
            font-size: 14px;
            font-weight: bold;
        }

        .notification-text span {
            float: right;
        }
    </style>
    <script>
        const userId = "{{Auth::id()}}";
    </script>
    <script src="{{ asset('js/app.js')}}"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
