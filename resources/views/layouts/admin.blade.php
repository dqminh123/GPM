<?php
$menu = config('menu');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- site metas -->
    <title>GPM - Trang chủ quản trị</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/adminlte') }}/images/favicon.webp" />
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="{{ url('public/adminlte') }}/images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ url('public/adminlte') }}/css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="{{ url('public/adminlte') }}/style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ url('public/adminlte') }}/css/responsive.css" />
    <!-- color css -->
    {{-- <link rel="stylesheet" href="{{ url('public/adminlte') }}/css/colors.css" /> --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{ url('public/adminlte') }}/css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{ url('public/adminlte') }}/css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ url('public/adminlte') }}/css/custom.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!--[if lt IE 9]>
        @yield('css')
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">
                            <a href="index.html"><img class="logo_icon img-responsive"
                                    src="{{ url('public/adminlte') }}/images/logo/logo_icon.png" alt="#" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img"><img class="img-responsive"
                                    src="{{ url('public/nhanvien') }}/{{ Auth::user()->anh }}" alt="#"
                                    width="60px" />
                            </div>
                            <div class="user_info">
                                <h6>{{ Auth::user()->hovaten }}</h6>
                                <p><span class="online_animation"></span> Online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4>Hệ thống</h4>
                    <ul class="list-unstyled components">
                        @foreach ($menu as $i)
                            <li><a href={{ route($i['route']) }}><i class="fa {{ $i['icon'] }} orange_color"></i>
                                    <span>{{ $i['name'] }}</span></a></li>

                            @if (isset($i['items']))
                                <li>

                                    <a href="#element" data-toggle="collapse" aria-expanded="false"
                                        class="dropdown-toggle"><i class="fa {{ $i['icon'] }} purple_color"></i>
                                        <span>Danh mục con</span></a>

                                    <ul class="collapse list-unstyled" id="element">
                                        @foreach ($i['items'] as $mit)
                                            <li><a href={{ route($mit['route']) }}>>
                                                    <span>{{ $mit['name'] }}</span></a></li>
                                        @endforeach
                                    </ul>

                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                    class="fa fa-bars"></i></button>
                            <div class="logo_section">
                                <a href="index.html"><img class="img-responsive"
                                        src="{{ url('public/adminlte') }}/images/logo/logo.png" alt="#" /></a>
                            </div>
                            <div class="right_topbar">
                                <div class="icon_info">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-bell-o"></i><span
                                                    class="badge">2</span></a></li>
                                        <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i><span
                                                    class="badge">3</span></a></li>
                                    </ul>
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a class="dropdown-toggle" data-toggle="dropdown"><img
                                                    class="img-responsive rounded-circle"
                                                    src="{{ url('public/nhanvien') }}/{{ Auth::user()->anh }}"
                                                    alt="#" width="5px" /><span
                                                    class="name_user">{{ Auth::user()->hovaten }}</span></a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="profile.html">My Profile</a>
                                                <a class="dropdown-item" href="settings.html">Settings</a>
                                                <a class="dropdown-item" href="help.html">Help</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.dangxuat') }}"><span>Log Out</span> <i
                                                        class="fa fa-sign-out"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="container">
                    @if (Session::has('yes'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                            {{ Session::get('yes') }}

                        </div>
                    @endif
                    @if (Session::has('no'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                            {{ Session::get('no') }}
                        </div>
                    @endif
                </div>
                <!-- end topbar -->
                <!-- dashboard inner -->
                <div class="card-body">
                    @yield('main')
                </div>
                <!-- end dashboard inner -->
            </div>
        </div>
    </div>
    <!-- jQuery -->
    {{-- <script src="{{ url('public/adminlte') }}/js/jquery.min.js"></script> --}}
    <script src="{{ url('public/adminlte') }}/js/popper.min.js"></script>
    <script src="{{ url('public/adminlte') }}/js/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="{{ url('public/adminlte') }}/js/animate.js"></script>
    <!-- select country -->
    {{-- <script src="{{ url('public/adminlte') }}/js/bootstrap-select.js"></script> --}}
    <!-- owl carousel -->


    {{-- <script src="{{ url('public/adminlte') }}/js/owl.carousel.js"></script> --}}
    <!-- chart js -->
    <script src="{{ url('public/adminlte') }}/js/Chart.min.js"></script>
    <script src="{{ url('public/adminlte') }}/js/Chart.bundle.min.js"></script>
    {{-- <script src="{{ url('public/adminlte') }}/js/utils.js"></script> --}}
    <script src="{{ url('public/adminlte') }}/js/analyser.js"></script>
    <!-- nice scrollbar -->
    <script src="{{ url('public/adminlte') }}/js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- custom js -->
    {{-- <script src="{{ url('public/adminlte') }}/js/custom.js"></script> --}}

    {{-- <script src="{{ url('public/adminlte') }}/js/chart_custom_style1.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    {{-- <script>
        $(document).ready( function () {
        $("table").DataTable();
    } );
    </script> --}}
    @yield('js')

</body>

</html>
