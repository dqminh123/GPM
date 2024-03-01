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

                                        <a href="{{ route('Home.view', ['slug' => $item->slug ,'id' => $item->id]) }}" class="d-flex">
                                            <span>

                                            </span>
                                            {{ $item->tendanhmuc }} ({{$item->sanpham->count()}})
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
                                    <a href="{{ route('Home.views', ['slug' => $item->slug ,'id' => $item->id]) }}" class="d-flex">
                                    <span></span>
                                    {{ $item->nhacungcap }} ({{$item->sanpham->count()}})
                                    <small></small>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <br>
                    <br>
                    <div class="aside">
                        <h3 class="aside-title">Bán chạy nhất</h3>
                        @foreach ($model->sanpham as $item)
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
                    {{-- <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Sort By:
                                <select class="input-select">
                                    <option value="0">Popular</option>
                                    <option value="1">Position</option>
                                </select>
                            </label>

                            <label>
                                Show:
                                <select class="input-select">
                                    <option value="0">20</option>
                                    <option value="1">50</option>
                                </select>
                            </label>
                        </div>
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div> --}}
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row">
                        <!-- product -->

                        @foreach ($model->sanpham as $item)
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                
                                    @if ($item->soluong >= 1)
                                        <div class="product-img">
                                            <img src="{{ url('public/sanpham') }}/{{ $item->anh }}" alt="">
                                        </div>
                                        <div class="product-body">

                                            <p class="product-category" style="color: black">{{ $item->danhmuc->tendanhmuc }}
                                            </p>
                                            <h3 class="product-name"><a href="{{ route('Home.view', ['slug' => $item->slug , 'id' => $item->id]) }}">{{ $item->tensp }}</a></h3>
                                            @if ($item->giamgia > 0)
                                                <h4 class="product-price">{{ number_format($item->giamgia) }}<u>đ</u><del
                                                        class="product-old-price">{{ number_format($item->giaxuat) }}<u>đ</u></del>
                                                </h4>
                                            @else
                                                <h4 class="product-price">{{ number_format($item->giaxuat) }}<u>đ</u>
    
                                                </h4>
                                            @endif
                                            
                                            <div class="product-btns">
                                                <a href="{{ route('Home.view', ['slug' => $item->slug , 'id' => $item->id]) }}"
                                                    class="quick-view"><i class="fa fa-eye"></i><span
                                                        class="tooltipp"></span></a>
                                            </div>
    
                                        </div>
                                        <div class="add-to-cart">
                                            <a href="{{route('Home.themvaogio',['slug'=>$item->slug])}}" class="add-to-cart-btn fa fa-shopping-cart">   Thêm vào giỏ</a>
                                        </div>
                                    @endif
                            </div> 
                        </div>
                        @endforeach
                    </div>
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
