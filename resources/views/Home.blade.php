@extends('layouts.frontend')
@section('main')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                @foreach($dm as $cat)
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="{{url('public/danhmuc')}}/{{$cat->anh}}" alt="" style="width: 250px;height:250px">
                        </div>
                        <div class="shop-body">
                            <h3>{{$cat->tendanhmuc}}</h3>
                            <a href="{{route('Home.view',['slug'=>$cat->slug , 'id'=>$cat->id])}}" class="cta-btn">Mua ngay <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- /shop -->

                <!-- shop -->
                
                <!-- /shop -->

                <!-- shop -->
                
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Sản phẩm mới</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1"></a></li>
                                <li><a data-toggle="tab" href="#tab1"></a></li>
                                <li><a data-toggle="tab" href="#tab1"></a></li>
                                <li><a data-toggle="tab" href="#tab1"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <!-- product -->
                                    @foreach ($sanpham as $item)
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="{{ url('public/sanpham') }}/{{ $item->anh }}" alt="">
                                            </div>
                                            <div class="product-body">

                                                <p class="product-category" style="color: black">
                                                    {{ $item->danhmuc->tendanhmuc }}
                                                </p>
                                                <h3 class="product-name"><a href="{{ route('Home.view', ['slug' => $item->slug , 'id' => $item->id]) }}">{{ $item->tensp }}</a></h3>
                                                @if ($item->giamgia > 0)
                                                    <h4 class="product-price">
                                                        {{ number_format($item->giamgia) }}<u>đ</u><del
                                                            class="product-old-price">    {{ number_format($item->giaxuat) }}<u>đ</u></del>
                                                    </h4>
                                                @else
                                                    <h4 class="product-price">
                                                        {{ number_format($item->giaxuat) }}<u>đ</u>

                                                    </h4>
                                                @endif
                                                <div class="product-rating">
                                                   
                                                </div>
                                                <div class="product-btns">
                                                    <a href="{{ route('Home.view', ['slug' => $item->slug, 'id' => $item->id ]) }}"
                                                        class="quick-view"><i class="fa fa-eye"></i><span
                                                            class="tooltipp"></span></a>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <a href="{{route('Home.themvaogio',['slug'=>$item->slug])}}" class="add-to-cart-btn fa fa-shopping-cart">   Thêm vào giỏ</a>
                                            </div>
                                        </div>
                                        <!-- /product -->

                                        <!-- product -->

                                        <!-- /product -->

                                        <!-- product -->

                                        <!-- /product -->

                                        <!-- product -->

                                        <!-- /product -->

                                        <!-- product -->
                                    @endforeach
                                    <!-- /product -->
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">Sản phẩm nổi bật tuần này</h2>
                        <p>Giảm giá lên đến 50% </p>
                        <a class="primary-btn cta-btn" href="{{route('Home.shop')}}">Mua ngay</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Bán chạy nhất</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab2"></a></li>
                                <li><a data-toggle="tab" href="#tab2"></a></li>
                                <li><a data-toggle="tab" href="#tab2"></a></li>
                                <li><a data-toggle="tab" href="#tab2"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    <!-- product -->
                                    @foreach ($sp as $pro)
                                        <div class="product">

                                            <div class="product-img">
                                                <img src="{{ url('public/sanpham') }}/{{ $pro->anh }}" alt="">
                                            </div>
                                            <div class="product-body">

                                                <p class="product-category" style="color: black">
                                                    {{ $pro->danhmuc->tendanhmuc }}
                                                </p>
                                                <h3 class="product-name"><a href="{{ route('Home.view', ['slug' => $pro->slug , 'id' => $item->id]) }}">{{ $pro->tensp }}</a></h3>
                                                @if ($pro->giamgia > 0)
                                                    <h4 class="product-price">
                                                        {{ number_format($pro->giamgia) }}<u>đ</u><del
                                                            class="product-old-price">   {{ number_format($pro->giaxuat) }}<u>đ</u></del>
                                                    </h4>
                                                @else
                                                    <h4 class="product-price">{{ number_format($pro->giaxuat) }}<u>đ</u>

                                                    </h4>
                                                @endif
                                                <div class="product-btns">
                                                    <a href="{{ route('Home.view', ['slug' => $pro->slug, 'id' => $item->id]) }}"
                                                        class="quick-view"><i class="fa fa-eye"></i><span
                                                            class="tooltipp"></span></a>
                                                </div>

                                            </div>
                                            <div class="add-to-cart">
                                                <a href="{{route('Home.themvaogio',['slug'=>$pro->slug])}}" class="add-to-cart-btn fa fa-shopping-cart">   Thêm vào giỏ</a>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                    <!-- product -->

                                    <!-- /product -->

                                    <!-- product -->

                                    <!-- /product -->

                                    <!-- product -->

                                    <!-- /product -->

                                    <!-- product -->

                                    <!-- /product -->
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Bán chạy nhất</h4>
                        <div class="section-nav">
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        <div>
                            @foreach ($sp as $item)
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ url('public/sanpham') }}/{{ $item->anh }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $item->danhmuc->tendanhmuc }}</p>
                                        <h3 class="product-name"><a href="{{ route('Home.view', ['slug' => $item->slug , 'id' => $item->id]) }}">{{ $item->tensp }}</a></h3>
                                        @if ($item->giamgia > 0)
                                            <h4 class="product-price">
                                                {{ number_format($item->giamgia) }}<u>đ</u>    <del
                                                    class="product-old-price">   {{ number_format($item->giaxuat) }}<u>đ</u></del>
                                            </h4>
                                        @else
                                            <h4 class="product-price">{{ number_format($item->giaxuat) }}<u>đ</u>

                                            </h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div>
                            <!-- product widget -->

                            <!-- /product widget -->

                            <!-- product widget -->

                            <!-- /product widget -->

                            <!-- product widget -->

                            <!-- product widget -->
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Bán chạy nhất</h4>
                        <div class="section-nav">
                            <div id="slick-nav-4" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-4">
                        <div>
                            <!-- product widget -->
                            @foreach ($sp as $item)
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ url('public/sanpham') }}/{{ $item->anh }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $item->danhmuc->tendanhmuc }}</p>
                                        <h3 class="product-name"><a href="{{ route('Home.view', ['slug' => $item->slug , 'id' => $item->id]) }}">{{ $item->tensp }}</a></h3>
                                        @if ($item->giamgia > 0)
                                            <h4 class="product-price">
                                                {{ number_format($item->giamgia) }}<u>đ</u>    <del
                                                    class="product-old-price">   {{ number_format($item->giaxuat) }}<u>đ</u></del>
                                            </h4>
                                        @else
                                            <h4 class="product-price">{{ number_format($item->giaxuat) }}<u>đ</u>

                                            </h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div>
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm visible-xs"></div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Bán chạy nhất</h4>
                        <div class="section-nav">
                            <div id="slick-nav-5" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-5">
                        <div>
                            <!-- product widget -->
                            @foreach ($sp as $item)
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ url('public/sanpham') }}/{{ $item->anh }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $item->danhmuc->tendanhmuc }}</p>
                                        <h3 class="product-name"><a href="{{ route('Home.view', ['slug' => $item->slug , 'id' => $item->id]) }}">{{ $item->tensp }}</a></h3>
                                        @if ($item->giamgia > 0)
                                            <h4 class="product-price">
                                                {{ number_format($item->giamgia) }}<u>đ</u>    <del
                                                    class="product-old-price">   {{ number_format($item->giaxuat) }}<u>đ</u></del>
                                            </h4>
                                        @else
                                            <h4 class="product-price">{{ number_format($item->giaxuat) }}<u>đ</u>

                                            </h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
