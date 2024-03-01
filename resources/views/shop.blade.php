@extends('layouts.frontend')
@section('main')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Danh mục</h3>
                        <div class="checkbox-filter">
                            @foreach ($dm as $item)
                                <div class="input-checkbox">
                                    <input type="checkbox" id="category-1">
                                    <label for="category-1">

                                        <a href="{{ route('Home.view', ['slug' => $item->slug, 'id' => $item->id]) }}"
                                            class="d-flex">
                                            <span>

                                            </span>
                                            {{ $item->tendanhmuc }} ({{ $item->sanpham->count() }})
                                            <small></small>
                                        </a>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="aside">
                        <h3 class="aside-title">Nhà cung cấp</h3>
                        @foreach ($ncc as $item)
                            <div class="checkbox-filter">
                                <div class="input-checkbox">
                                    <input type="checkbox" id="brand-1">
                                    <label for="brand-1">
                                        <a href="{{ route('Home.views', ['slug' => $item->slug, 'id' => $item->id]) }}"
                                            class="d-flex">
                                            <span></span>
                                            {{ $item->nhacungcap }} ({{ $item->sanpham->count() }})
                                            <small></small>
                                        </a>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /aside Widget -->
                    <br>
                    <br>
                    <div class="aside">
                        <h3 class="aside-title">Bán chạy nhất</h3>
                        @foreach ($sp as $item)
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{ url('public/sanpham') }}/{{ $item->anh }}" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{ $item->danhmuc->tendanhmuc }}</p>
                                    <h3 class="product-name"><a
                                            href="{{ route('Home.view', ['slug' => $item->slug, 'id' => $item->id]) }}">{{ $item->tensp }}</a>
                                    </h3>
                                    @if ($item->giamgia > 0)
                                        <h4 class="product-price">
                                            {{ number_format($item->giamgia) }}<u>đ</u> <del
                                                class="product-old-price">{{ number_format($item->giaxuat) }}<u>đ</u></del>
                                        </h4>
                                    @else
                                        <h4 class="product-price">{{ number_format($item->giaxuat) }}<u>đ</u>

                                        </h4>
                                    @endif
                                </div>
                            </div>
                        @endforeach



                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="custom_select mb-4">
                        <form action="{{ route('Home.shop') }}" method="post">
                            @csrf
                            <select class="form-control-sm" id="sapxep" name="sapxep"
                                onchange="if(this.value != 0) { this.form.submit(); }">
                                <option value="default" {{ session('sapxep') == 'default' ? 'selected' : '' }}>Sắp xếp mặc
                                    định</option>
                                <option value="popularity" {{ session('sapxep') == 'popularity' ? 'selected' : '' }}>Mua nhiều
                                    nhất</option>
                                <option value="date" {{ session('sapxep') == 'date' ? 'selected' : '' }}>Hàng mới nhất
                                </option>
                                <option value="price" {{ session('sapxep') == 'price' ? 'selected' : '' }}>Xếp theo giá: thấp
                                    đến cao</option>
                                <option value="price-desc" {{ session('sapxep') == 'price-desc' ? 'selected' : '' }}>Xếp theo
                                    giá: cao xuống thấp</option>
                            </select>
                        </form>
                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row">
                        <!-- product -->
                        @foreach ($sanpham as $pro)
                            <div class="col-md-4 col-xs-6">

                                <div class="product">

                                    <div class="product-img">
                                        <img src="{{ url('public/sanpham') }}/{{ $pro->anh }}" alt="">
                                    </div>
                                    <div class="product-body">

                                        <p class="product-category" style="color: black">{{ $pro->danhmuc->tendanhmuc }}
                                        </p>
                                        <h3 class="product-name"><a
                                                href="{{ route('Home.view', ['slug' => $pro->slug, 'id' => $pro->id]) }}">{{ $pro->tensp }}</a>
                                        </h3>
                                        @if ($pro->giamgia > 0)
                                            <h4 class="product-price">{{ number_format($pro->giamgia) }}<u>đ</u><del
                                                    class="product-old-price">     {{ number_format($pro->giaxuat) }}<u>đ</u></del>
                                            </h4>
                                        @else
                                            <h4 class="product-price">{{ number_format($pro->giaxuat) }}<u>đ</u>

                                            </h4>
                                        @endif

                                        <div class="product-btns">
                                            <a href="{{ route('Home.view', ['slug' => $pro->slug, 'id' => $pro->id]) }}"
                                                class="quick-view"><i class="fa fa-eye"></i><span
                                                    class="tooltipp"></span></a>
                                        </div>

                                    </div>
                                    <div class="add-to-cart">
                                        <a href="{{ route('Home.themvaogio', ['slug' => $pro->slug]) }}"
                                            class="add-to-cart-btn fa fa-shopping-cart"> Thêm vào giỏ</a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <li class="pagination justify-content-center">{{$sanpham->appends(request()->all())->links()}}</li>
                    <!-- /store products -->

                    <!-- store bottom filter -->

                    <!-- /store bottom filter -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- NEWSLETTER -->

    <!-- /NEWSLETTER -->

    <!-- FOOTER -->

    <!-- /FOOTER -->

    <!-- jQuery Plugins -->
@endsection
