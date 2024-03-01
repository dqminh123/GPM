@extends('layouts.frontend')
@section('main')

    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Giỏ hàng</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{route('Home.index')}}">Trang chủ</a></li>
                        <li class="active">Giỏ hàng</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    @if ($giohang->soluong == 0)
        <div class="main_content">
            <div class="section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="text-center order_complete">
                                <img src="{{ url('public/master') }}/images/e.jpg" alt="" style="width: 100px">
                                <div class="heading_s1">
                                    <h3 class="text-danger">Giỏ hàng chưa có sản phẩm!</h3>
                                </div>
                                <p class="text-black">Giỏ hàng của bạn đang rỗng, xin hãy lấp đầy nó bằng việc duyệt
                                    qua các sản phẩm của cửa hàng
                                    và bỏ vào giỏ các sản phẩm mà bạn yêu thích và có ý định sẽ sở hữu nó.</p>
                                <a href="{{ route('Home.shop') }}" class="btn btn-success">TIẾP TỤC MUA SẮM</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <!-- SECTION -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Tổng tiền</th>

                    </tr>
                </thead>

                @foreach($giohang->items as $item)
                    <tr class="mb-3">
                       
                        <td><img src="{{ url('public/sanpham') }}/{{$item['anh']}}" alt="Berry Lace Dress"
                                style="width: 100px"></td>
                        <td>{{$item['tensp']}}</td>
                        <td>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <a href="{{ route('giohang.capnhatgiam', $item['id']) }}"
                                        class="btn btn-success">&minus;</a>
                                    <input type="text" value="{{$item['soluong']}}" style="width: 50px;text-align:center"
                                        name="qty" min="1">
                                    <a href="{{ route('giohang.capnhattang', $item['id']) }}"
                                        class="btn btn-success">&plus;</a>
                                </div>
                            </div>
                        </td>
                        <td> {{ number_format($item['gia'])}}<u>đ</u></td>
                        <td> {{ number_format($item['soluong'] * $item['gia']) }}<u>đ</u></td>
                        <td>
                            <a href="{{ route('giohang.xoa', $item['id']) }}" class="delete"><i
                                    class="fa fa-close"></i></a>
                        </td>
                        
                    </tr>
                    @endforeach
            </table>
            <form>
                @csrf
                <div class="mb-3">
                    <label for="tinh">Thành phố <span
                            class="text-danger font-weight-bold">*</span></label>
                    <select class="custom-select form-control chon thanhpho" id="thanhpho"
                        name="thanhpho">
                        <option value="">-- Chọn thành phố --</option>
                        @foreach ($thanhpho as $value)
                            <option value="{{ $value->mathanhpho }}">
                                {{ $value->tenthanhpho }}</option>
                        @endforeach
                    </select>
                    {{ $errors->first('tinh') }}
                </div>

                <div class="mb-3">
                    <label for="huyen">Huyện <span
                            class="text-danger font-weight-bold">*</span></label>
                    <select class="custom-select form-control huyen chon" id="huyen"
                        name="huyen">
                        <option value="">-- Chọn Huyện --</option>
                        {{-- @foreach ($huyen as $value)
              <option value="{{ $value->mahuyen }}">{{ $value->tenhuyen }}</option>
          @endforeach --}}
                    </select>
                    {{ $errors->first('huyen') }}
                </div>

                <div class="mb-3" style="margin-bottom: 10px">
                    <label for="xa">Xã <span
                            class="text-danger font-weight-bold">*</span></label>
                    <select class="custom-select form-control xa" id="xa" name="xa">
                        <option value="">-- Chọn Xã --</option>
                        {{-- @foreach ($xa as $value)
<option value="{{ $value->maxa }}">{{ $value->tenxa }}</option>
          @endforeach --}}
                    </select>
                    {{ $errors->first('xa') }}
                </div>



                <button type="button"
                    class="btn btn-danger themvanchuyen tinhvanchuyen">Thêm phí
                    vận chuyển</button>
            </form>

            <br>
             @if (Session::get('phi'))
                                    <a href="{{ route('xoachiphi.vanchuyen') }}" class="btn btn-warning "
                                        type="submit">Xóa phí vận chuyển</a>
                                                    @endif 
            <div class="col-md-6" style="margin-bottom: 30px">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <a href="{{ route('Home.shop') }}" class="btn btn-warning btn-sm btn-block"
                            style="width: 250px">Tiếp tục mua hàng</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('giohang.xoahet') }}" class="btn btn-warning btn-sm btn-block">Xoá tất cả</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                    <h2 class="text-danger h4 text-uppercase">Tổng giỏ hàng</h2>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-right">
                    <span style="color: black">Tổng tiền:</span>
                    <strong class="text-dark">{{ number_format($giohang->gia) }} ₫</strong>
                </div>
            </div>
            <br>
            
            <div class="row mb-3">
                <div class="col-md-6">

                </div>
                <div class="col-md-6 text-right">
                    <span style="color: black">Thuế VAT (0%):</span>
                    <strong class="text-dark">{{ Cart::tax() }} ₫</strong>
                </div>
            </div>
            <br>
            <div class="row mb-3">
                <div class="col-md-6">

                </div>
                @if (Session::get('phi'))
                <div class="col-md-6 text-right">
                    <span style="color: black">Phí vận chuyển:</span>
                    
                    <strong class="text-right" >
                        {{ number_format(Session::get('phi')) }}<u>đ</u>
                    </strong>
                    
                </div>
                @endif
            </div>
            <br>
            <div class="row mb-3">
            </div>
            <div class="row mb-5">
                <div class="col-md-6">

                </div>
                
                <div class="col-md-6 text-right">
                    <span style="color: black">Tổng thanh toán:</span>
                    <strong class="text-dark">{{number_format($giohang->gia+Session::get('phi'))}} ₫</strong>
                    <hr>
                    <button class="btn btn-danger" onclick="window.location='{{ route('dathang.index') }}'"
                        style="width: 300px">Chấp nhận thanh toán</button>
                </div>
               
            </div>
            <br>
    @endif
    </div>

@endsection
@section('js')
<script>
   $(document).ready(function() {
            $('.chon').change(function() {
                var action = $(this).attr('id');
                var mathanhpho = $(this).val();
                var _token = $('input[name="_token"]').val();
                var $result = '';
                //alert(action,mathanhpho,_token);
                 
                if (action == 'thanhpho') {
                    result = 'huyen';
                } else {
                    result = 'xa';
                }
                $.ajax({
                    url: "{{ route('chon.vanchuyenhome') }}",
                    method: 'POST',
                    data: {
                        action: action,
                        mathanhpho: mathanhpho,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        });
</script>
<script>
    $(document).ready(function() {
        $('.tinhvanchuyen').click(function() {
            var mathanhpho = $('.thanhpho').val();
            var mahuyen = $('.huyen').val();
            var maxa = $('.xa').val();
            var _token = $('input[name="_token"]').val();
            
            if (mathanhpho == '' && mahuyen == '' && maxa == '') {
                Swal.fire(
                    'Chú ý?',
                    'hãy chọn địa chỉ giao hàng',
                    'question'
                )
            } else {
                $.ajax({
                    url: "{{ route('tinh.vanchuyen') }}",
                    method: 'POST',
                    data: {
                        mathanhpho: mathanhpho,
                        mahuyen: mahuyen,
                        maxa: maxa,
                        _token: _token
                    },
                    success: function() {
                        location.reload();
                    }

                });
            }
        });
    });
</script>
@endsection
