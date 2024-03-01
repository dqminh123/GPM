@extends('layouts.frontend')
@section('main')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('Home.index') }}">Home</a></li>
                        <li><a href="{{ route('Home.shop') }}">Sản phẩm</a></li>
                        <li>{{ $model->danhmuc->tendanhmuc }}</li>
                        <li class="active">{{ $model->tensp }}</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="{{ url('public/sanpham') }}/{{ $model->anh }}" alt="">
                        </div>
                        <?php
                        $images = json_decode($model->list_anh);
                        ?>
                        @if (is_array($images))
                            @foreach ($images as $item)
                                <div class="product-preview">
                                    <img src="{{ $item }}" alt="">
                                </div>
                            @endforeach
                        @endif


                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{ url('public/sanpham') }}/{{ $model->anh }}" alt="">
                        </div>
                        <?php
                        $images = json_decode($model->list_anh);
                        ?>
                        @if (is_array($images))
                            @foreach ($images as $item)
                                <div class="product-preview">
                                    <img src="{{ $item }}" alt="">
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{ $model->tensp }}</h2>
                        
                        <div>
                            @if ($model->giamgia > 0)
                                <h3 class="product-price">{{ number_format($model->giamgia) }}<u>đ</u>
                                    <del class="product-old-price">{{ number_format($model->giaxuat) }}<u>đ</u>
                                    </del>
                                </h3>
                            @else
                                <h3 class="product-price">{{ number_format($model->giaxuat) }}<u>đ</u>

                                </h3>
                            @endif
                           
                        </div>
                        <p>{!! $model->chitiet !!}</p>

                        <br>

                        <div class="add-to-cart">

                            <a href="{{ route('Home.themvaogio', ['slug' => $model->slug]) }}"
                                class="add-to-cart-btn fa fa-shopping-cart"> Thêm vào giỏ</a>
                        </div>



                        <ul class="product-links">
                            <li>Danh mục:</li>
                            <li><a href="#">{{ $model->danhmuc->tendanhmuc }}</a></li>

                        </ul>

                        <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>

                    </div>
                    <hr>
                    @if (auth()->guard('khachhang')->check())
                        <div id="rateYo"></div>
                        <form action="{{ route('Home.rating') }}" method="POST" class="form-inline" id="formRating">
                            @csrf
                            <input type="hidden" class="form-control" name="rating_start" id="rating_start">
                            <input type="hidden" class="form-control" name="sanpham_id" value="{{ $model->id }}">
                            <input type="hidden" class="form-control" name="khachhang_id"
                                value="{{ auth()->guard('khachhang')->user()->id }}">
                        </form>
                    @else
                        <div id="rateYo1"></div>
                    @endif

                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Mô tả</a></li>
                            <li><a data-toggle="tab" href="#tab2">Chi tiết</a></li>
                            <li><a data-toggle="tab" href="#tab3">Bình luận</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{!! $model->chitiet !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->

                            <!-- tab2  -->
                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{!! $model->chitiet !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab2  -->

                            <!-- tab3  -->

                            <div id="tab3" class="tab-pane fade in">
                                @if (Auth::guard('khachhang')->check())
                                    <form action="" method="POST">
                                        <legend>Xin chào bạn: {{ Auth::guard('khachhang')->user()->hovaten }}</legend>

                                        <div class="form-group">
                                            <label for="">Nội dung bình luận</label>
                                            <input type="hidden" value="{{ $model->id }}" name="sanpham_id">
                                            <textarea id="comment-content" class="form-control" rows="3" placeholder="Nhập nội dung (*)"></textarea>
                                            <small id="comment-error" class="help-sanpham"></small>
                                        </div>

                                        <button type="button" class="btn btn-primary" id="btn-comment">Gửi bình
                                            luận</button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Vui lòng đăng nhập để bình luận
                                    </button>
                                    <hr>
                                @endif
                                <br>
                                <h3>Các bình luận</h3>
                                <br>
                                <div id="comment">
                                    @include('list_comment', ['comments' => $model->comments])

                                </div>
                            </div>


                            <!-- /tab3  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Sản phẩm khác</h3>
                    </div>
                </div>

                <!-- product -->
                @foreach ($sanpham as $pro)
                    <div class="col-md-3 col-xs-6">

                        <div class="product">

                            <div class="product-img">
                                <img src="{{ url('public/sanpham') }}/{{ $pro->anh }}" alt="">
                            </div>
                            <div class="product-body">

                                <p class="product-category" style="color: black">
                                    {{ $pro->danhmuc->tendanhmuc }}
                                </p>
                                <h3 class="product-name"><a
                                        href="{{ route('Home.view', ['slug' => $pro->slug, 'id' => $pro->id]) }}">{{ $pro->tensp }}</a>
                                </h3>
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
                <!-- /product -->

                <!-- product -->

                <!-- /product -->

                <div class="clearfix visible-sm visible-xs"></div>

                <!-- product -->

                <!-- /product -->

                <!-- product -->

                <!-- /product -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đăng nhập ngay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="error"></div>
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password">
                        </div>
                        <button type="button" class="btn btn-primary btn-block" id="btn-login">Đăng nhập</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        $(function() {
            let ratingAvg = '{{ $ratingAvg }}';
            $("#rateYo").rateYo({
                rating: ratingAvg,
                ratedFill: "#E74C3C",

            }).on("rateyo.set", function(e, data) {
                $('#rating_start').val(data.rating);
                $('#formRating').submit();
            });

            $("#rateYo1").rateYo({
                rating: ratingAvg,
                ratedFill: "#E74C3C",

            }).on("rateyo.set", function(e, data) {
                location.replace("{{ route('Home.dangnhap') }}");
            });
        });
    </script>

    <script>
        var _csrf = '{{ csrf_token() }}';
        var _commentUrl = '{{ route('ajax.comment', $model->id) }}';
        $('#btn-login').click(function(e) {
            e.preventDefault();

            var _loginUrl = '{{ route('ajax.dangnhap') }}';
            var email = $('#email').val();
            var password = $('#password').val();
            $.ajax({
                type: "POST",
                url: _loginUrl,
                data: {
                    email: email,
                    password: password,
                    _token: _csrf,
                },

                success: function(response) {
                    if (response.error) {
                        let _html_error =
                            '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        for (let error of response.error) {
                            _html_error += `<li>${error}</li>`
                        }
                        _html_error += '</div>';
                        $('#error').html(_html_error);
                    } else {
                        const Msg = Swal.mixin({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Đăng nhập thành công',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        //end
                        Msg.fire({

                            type: 'success',
                            title: 'Đăng nhập thành công',

                        });
                        location.reload();
                    }

                    // console.log(response);
                }
            });

        });

        $('#btn-comment').click(function(e) {
            e.preventDefault();
            let content = $('#comment-content').val();

            // console.log(content,_commentUrl);
            $.ajax({
                type: "POST",
                url: _commentUrl,
                data: {
                    content: content,
                    _token: _csrf,
                },

                success: function(response) {
                    if (response.error) {
                        $('#comment-error').html(response.error);
                    } else {
                        $('#comment-error').html('');
                        $('#comment-content').val('');
                        $('#comment').html(response);
                        // console.log(response);
                    }

                }
            });
        });

        $(document).on('click', '.btn-show-reply-form', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var comment_reply_id = '#content-reply-' + id;
            let contentReply = $(comment_reply_id).val();
            var form_reply = '.form-reply-' + id;
            // alert(form_reply);
            $('.formReply').slideUp();
            $(form_reply).slideDown();
        });

        $(document).on('click', '.btn-send-comment-reply', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var comment_reply_id = '#content-reply-' + id;
            let contentReply = $(comment_reply_id).val();
            var form_reply = '.form-reply-' + id;
            //  alert(contentReply);
            $.ajax({
                type: "POST",
                url: _commentUrl,
                data: {
                    content: contentReply,
                    reply_id: id,
                    _token: _csrf,
                },

                success: function(response) {
                    if (response.error) {
                        $('#comment-error').html(response.error);
                    } else {
                        $('#comment-error').html('');
                        $('#comment-content').val('');
                        $('#comment').html(response);
                        // console.log(response);
                    }

                }
            });

        });
    </script>
@endsection
