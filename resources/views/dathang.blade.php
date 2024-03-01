@extends('layouts.frontend')
@section('main')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Thanh toán</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('Home.index') }}">Trang chủ</a></li>
                        <li class="active">Thanh toán</li>
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
                @if($giohang->soluong == 0)
                <div class="main_content">
                    <div class="section">
                      <div class="container">
                        <div class="row justify-content-center">
                          <div class="col-md-8">
                            <div class="text-center order_complete">
                                <img src="{{url('public/master')}}/images/e.jpg" alt="" style="width: 100px">
                                <div class="heading_s1">
                                    <h3 class="text-danger">Đơn hàng chưa có sản phẩm!</h3>
                                </div><p class="text-black">Đơn hàng của bạn đang rỗng, xin hãy lấp đầy nó bằng việc duyệt qua các sản phẩm của cửa hàng
                                        và bỏ vào giỏ các sản phẩm mà bạn yêu thích và có ý định sẽ sở hữu nó.</p>
                                    <a href="{{ route('Home.shop') }}" class="btn btn-primary">TIẾP TỤC MUA SẮM</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                <div class="col-md-7">
                    <!-- Billing Details -->
                    <form method="POST">
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Địa chỉ thanh toán</h3>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="hovaten" placeholder="Họ và tên"
                                    value="{{ Auth::guard('khachhang')->user()->hovaten }}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" placeholder="Email"
                                    value="{{ Auth::guard('khachhang')->user()->email }}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="diachi" placeholder="Địa chỉ"
                                    value="{{ Auth::guard('khachhang')->user()->diachi }}">
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="dienthoai" placeholder="Điện thoại"
                                    value="{{ Auth::guard('khachhang')->user()->dienthoai }}">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Order Details -->

                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Đơn hàng chi tiết</h3>
                    </div>
                    <form id="form" action="{{route('dathang.add')}}" method="post">
                        @csrf
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>Sản phẩm</strong></div>
                                <div><strong>Đơn giá</strong></div>
                            </div>
                            @if (Session::get('phi'))
                                <input type="hidden" name="chiphi" class="chiphi"
                                    value="{{ Session::get('phi') }}">
                            @else
                                <input type="hidden" name="chiphi" class="chiphi" value="20000">
                            @endif
                            @foreach ($giohang->items as $stt => $item)
                                <div class="order-products">
                                    <div class="order-col">
                                        <div>{{ $item['soluong'] }}x {{ $item['tensp'] }}</div>
                                        <div>{{ number_format($item['soluong'] * $item['gia']) }}<u>đ</u></div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="order-col">
                                <div>Phí vận chuyển</div>
                                <div>{{ number_format(Session::get('phi')) }}<u>đ</u></div>
                            </div>

                            <div class="order-col">
                                <div><strong>Tổng thanh toán</strong></div>

                                <div><strong
                                        class="order-total">{{ number_format($giohang->gia + Session::get('phi')) }}
                                        <u>đ</u></strong></div>

                            </div>



                        </div>
                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1">
                                <label for="payment-1">
                                    <span></span>
                                    Direct Bank Transfer
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2">
                                <label for="payment-2">
                                    <span></span>
                                    Cheque Payment
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-3">
                                <label for="payment-3">
                                    <span></span>
                                    Paypal System
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                Tôi đã đọc và chấp nhận <a href="#"> các điều khoản & điều kiện</a>
                            </label>
                        </div>
                        <br>
                        @if(Session::get('phi'))
                        <button type="submit" value="Đặt Hàng"  class="btn btn-danger btn-block send_order">Thanh toán</button>
                        @else
                        <a href="{{route('giohang.view') }}" style="text-align: center;color:red">Vui lòng hãy chọn phí vận chuyển</a>
                        @endif
                    </form>
                </div>

                <!-- /Order Details -->
                @endif
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
   
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#form').submit(function(e) {
                e.preventDefault();
                var chiphi = $('.chiphi').val();
                // var order_coupon = $('.order_coupon').val();
                var token = " {{ csrf_token() }}";
                $.ajax({
                    url: "{{ route('dathang.add') }}",
                    method: 'POST',
                    data: {
                        chiphi: chiphi,
                        // order_coupon: order_coupon,
                        _token: token
                    },
                    success: function() {
                        const Msg = Swal.mixin({
                                position: 'center',
                                icon: 'success',
                                title: 'Đặt hàng thành công',
                                showConfirmButton: false,
                                timer: 4000
                            })
                            //end
                            Msg.fire({

                                type: 'success',
                                title: 'Đặt hàng thành công',

                            });
                            location.replace("{{route('dathang.thanhcong')}}");

                    }

                });
            });
        });
    </script> 
@endsection
