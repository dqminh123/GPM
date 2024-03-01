<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>GPM Việt Nam</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/frontend') }}/img/favicon.webp" />
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ url('public/frontend') }}/css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ url('public/frontend') }}/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="{{ url('public/frontend') }}/css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ url('public/frontend') }}/css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ url('public/frontend') }}/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ url('public/frontend') }}/css/style.css" />

    @yield('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +0902-777-186</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> lienhe@gpm.vn</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 6 Lê Quát, Đông Xuyên, Long Xuyên, An Giang</a></li>
                </ul>
                <ul class="header-links pull-right">
                    @if (!Auth::guard('khachhang')->user())
                        <li><a href="#"><i class="fa fa-dollar"></i> VNĐ</a></li>
                        <li><a href="{{ route('Home.dangnhap') }}">
                                <i class="fa fa-user"></i> Đăng nhập
                            </a></li>
                        <li style="color: antiquewhite">/</li>
                        <li><a href="{{ route('Home.dangky') }}">
                                <i class="fa fa-user"></i> Đăng ký
                            </a></li>
                    @endif
                </ul>
                <ul class="header-links pull-right">
                    @if (Auth::guard('khachhang')->user())
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                                {{ Auth::guard('khachhang')->user()->hovaten }}
                                <img src="{{ url('public/khachhang') }}/{{ Auth::guard('khachhang')->user()->anh }}"
                                    style="width: 50px; border-radius:30px;" alt="">
                            </a>

                            <!-- BEGIN DROPDOWN MENU -->
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a href="{{ route('khachhang.account') }}" style="color: red">Thông tin</a>
                                </li>
                                <li><a href="{{ route('dathang.myorder') }}" style="color: red">Đơn hàng
                                    của tôi</a></li>
                                <li><a href="{{ route('khachhang.changepassword') }}" style="color: red">Đổi mật
                                        khẩu</a></li>
                                <li><a href="{{ route('khachhang.dangxuat') }}" style="color: red">Đăng xuất</a></li>
                            </ul>
                            <!-- END DROPDOWN MENU -->
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{ route('Home.index') }}" class="logo">
                                <img src="{{ url('public/frontend') }}/img/logo.webp" alt="" style="width: 200px">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form>

                                <input class="input" placeholder="Search here" id="input-search-result">
                                <div class="timkiem-sanpham" style="width: 100px">

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->

                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown" style="margin-left: 80%">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ Hàng</span>

                                    <div class="qty">{{ $giohang->soluong }}</div>

                                </a>

                                <div class="cart-dropdown">
                                    @if ($giohang->soluong == 0)
                                        <h6 class="text-danger" style="text-align: center">Chưa có sản phẩm nào trong
                                            giỏ
                                            hàng</h5>
                                        @else
                                            <div class="cart-list">
                                                @foreach ($giohang->items as $item)
                                                    <div class="product-widget">
                                                        <div class="product-img">
                                                            <img src="{{ url('public/sanpham') }}/{{ $item['anh'] }}"
                                                                alt="">
                                                        </div>
                                                        <div class="product-body">
                                                            <h3 class="product-name"><a
                                                                    href="#">{{ $item['tensp'] }}</a>
                                                            </h3>
                                                            <h4 class="product-price"><span
                                                                    class="qty">{{ $item['soluong'] }}x</span>{{ number_format($item['gia']) }}<u>đ</u>
                                                            </h4>
                                                        </div>
                                                        <a href="{{ route('giohang.xoa', $item['id']) }}"
                                                            class="delete"><i class="fa fa-close"></i></a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="cart-summary">
                                                <small>{{ $giohang->soluong }} sản phẩm được chọn</small>
                                                <h5>Tổng tiền: {{ number_format($giohang->gia) }}<u>đ</u></h5>
                                            </div>
                                            <div class="cart-btns">
                                                <a href="{{ route('giohang.view') }}">View Cart</a><a
                                                    href="{{ route('dathang.index') }}">Checkout <i
                                                        class="fa fa-arrow-circle-right"></i></a>

                                            </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="{{ route('Home.index') }}">Trang chủ</a></li>
                    <li class="dropdown">
                        <a href="#" a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false"
                            style="color: black;font-size:15.5px">Giới thiệu
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <ul><a class="dropdown-item" href="{{ route('Home.about') }}">Về Chúng Tôi</a></ul>
                                <hr>
                                <ul><a class="dropdown-item" href="{{ route('Home.spdv') }}">Sản phẩm và dịch vụ</a>
                                </ul>
                            </div>
                        </a>
                    </li>
                    <li><a href="{{ route('Home.shop') }}">Sản phẩm</a></li>
                    <li><a href="https://gpm.vn/du-an-thuc-hien">Dự án thực hiện</a></li>
                    <li><a href="https://gpm.vn/tin-tuc">Tin tức</a></li>
                    <li><a href="{{ route('Home.lienhe') }}">Liên hệ</a></li>

                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <div class="container">
        @if (Session::has('yes'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('yes') }}

            </div>
        @endif
        @if (Session::has('no'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {!! Session::get('no') !!}
            </div>
        @endif
    </div>
    <!-- NAVIGATION -->
    @yield('main')

    <!-- /NAVIGATION -->

    <!-- SECTION -->

    <!-- /SECTION -->

    <!-- SECTION -->

    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->

    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->

    <!-- /NEWSLETTER -->

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Giới thiệu</h3>
                            <p>Công ty GPM Việt Nam, chuyên cung cấp các giải pháp về CNTT, hệ thống giám sát, wifi
                                chuyên dụng, các giải pháp phần mềm, thiết bị công nghệ chuyên dùng cho nhà máy, khu sản
                                xuất,...</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Địa chỉ liên hệ</h3>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>6 Lê Quát, Đông Xuyên, Long Xuyên, An
                                        Giang</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>0902-777-186</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>lienhe@gpm.vn</a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Tin mới</h3>
                            <ul class="footer-links">
                                <li>
                                    <img src="{{ url('public/frontend') }}/img/123.webp" alt="" style="width: 50px">
                                    <h5><a
                                            href="https://gpm.vn/huong-dan-cai-dat-co-ban-va-day-du-cac-tinh-nang-cua-camera-imou-ranger-2-model-a22ep">Hướng
                                            dẫn cài đặt cơ bản và đầy đủ các tính năng của camera Imou Ranger 2 model
                                            A22EP</a></h5>
                                </li>
                                <span>
                                    11/09/2020
                                </span>
                                <br>
                                <li>
                                    <img src="{{ url('public/frontend') }}/img/4.webp" alt="" style="width: 70px">
                                    <h5><a
                                            href="https://gpm.vn/quy-trinh-khoi-phuc-mat-khau-cho-san-pham-hikvision-moi">QUY
                                            TRÌNH KHÔI PHỤC MẬT KHẨU CHO SẢN PHẨM HIKVISION – MỚI</a></h5>
                                </li>
                                <span>21/08/2020</span>
                                <li>
                                    <img src="{{ url('public/frontend') }}/img/5.webp" alt="" style="width: 70px">
                                    <h5><a href="https://gpm.vn/huong-dan-chinh-nguoc-sang-camera-global">Hướng dẫn
                                            chỉnh ngược sáng camera Global</a></h5>
                                </li>
                                <span>06/06/2020</span>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Kết nối với chúng tôi</h3>
                            <div class="facebook_page">
                                <div id="fb-root"></div>
                                <script>
                                    var timer = undefined;
                                    timer = setTimeout(() => {
                                        (function(d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (d.getElementById(id)) return;
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));
                                        timer = undefined;
                                    }, 6000)
                                </script>
                                <div class="footerText">
                                    <div class="fb-page" data-href="			https://www.facebook.com/gpm.vn			"
                                        data-tabs="timeline" data-height="150" data-small-header="true"
                                        data-adapt-container-width="true" data-hide-cover="false"
                                        data-show-facepile="false">
                                        <div class="fb-xfbml-parse-ignore">
                                            <blockquote cite="			https://www.facebook.com/gpm.vn			">
                                                <a href="			https://www.facebook.com/gpm.vn			">Facebook</a>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- /row -->
        </div>
        <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Bản quyền &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> Công ty TNHH Một thành viên Thiết bị và Phần mềm GPM Việt Nam.
                            Đăng ký doanh nghiệp số: 1602037520, do Sở Kế hoạch và Đầu tư tỉnh An Giang cấp lần đầu ngày
                            06/04/2017, thay đổi lần 2 ngày 10/08/2021. Địa chỉ: 06 Lê Quát, phường Đông Xuyên, Thành
                            phố Long Xuyên, tỉnh An Giang. Chịu trách nhiệm nội dung: <i class="fa fa-heart-o"
                                aria-hidden="true"></i> bởi <a href="#" target="_blank">Đặng Quang Minh</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->
    <!-- Đăng ký -->

    <!-- jQuery Plugins -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('public/frontend') }}/js/jquery.min.js"></script>
    <script src="{{ url('public/frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('public/frontend') }}/js/slick.min.js"></script>
    <script src="{{ url('public/frontend') }}/js/nouislider.min.js"></script>
    <script src="{{ url('public/frontend') }}/js/jquery.zoom.min.js"></script>
    <script src="{{ url('public/frontend') }}/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    @yield('js')
    
    <script>
        $('#input-search-result').keyup(function(e) {
            var _text = $(this).val();
            if (_text != '') {
                $.ajax({
                    type: "GET",
                    url: "http://localhost/GPM/api/search-sanpham?tukhoa=" + _text,
                    success: function(response) {
                        for (var sp of response) {
                            var _html = '';
                            _html +=
                                '<li><img style="width: 130px" src="http://localhost/GPM/public/sanpham/' +
                                sp.anh + '"><a class="text-black" href="http://localhost/GPM/danh-muc/' +
                                sp.slug + '/'+sp.id+ '">' + sp.tensp + '</li>';

                        }
                        $('.timkiem-sanpham').html(_html);
                    }
                });
            } else {
                $('.timkiem-sanpham').html('');
            }



        });
    </script>
</body>

</html>
