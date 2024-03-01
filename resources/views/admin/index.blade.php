@extends('layouts.admin')
@section('main')
<div class="row column_title">
  <div class="col-md-12">
     <div class="page_title">
        <h2>Trang chủ quản trị</h2>
     </div>
  </div>
</div>
   

        
                
                        <br>
                        <div class="midde_cont">
                            <div class="container-fluid">

                                <div class="row column1">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="full counter_section margin_bottom_30">
                                            <div class="couter_icon">
                                                <div>
                                                    <i class="fa fa-camera yellow_color"></i>
                                                </div>
                                            </div>
                                            <div class="counter_no">
                                                <div>
                                                    <p class="total_no">{{$sanpham_count}}</p>
                                                    <a href="{{route('sanpham.index')}}" class="head_couter" style="color: red">Sản phẩm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="full counter_section margin_bottom_30">
                                            <div class="couter_icon">
                                                <div>
                                                    <i class="fa fa-users blue1_color"></i>
                                                </div>
                                            </div>
                                            <div class="counter_no">
                                                <div>
                                                    <p class="total_no">{{$khachhang_count}}</p>
                                                    <a href="{{route('khachhang.index')}}" class="head_couter" style="color: red">Khách hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="full counter_section margin_bottom_30">
                                            <div class="couter_icon">
                                                <div>
                                                    <i class="fa fa-user green_color"></i>
                                                </div>
                                            </div>
                                            <div class="counter_no">
                                                <div>
                                                    <p class="total_no">{{$nhanvien_count}}</p>
                                                    <a href="{{route('nhanvien.index')}}" class="head_couter" style="color: red">Nhân viên</a>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="full counter_section margin_bottom_30">
                                            <div class="couter_icon">
                                                <div>
                                                    <i class="fa fa-shopping-cart red_color"></i>
                                                </div>
                                            </div>
                                            <div class="counter_no">
                                                <div>
                                                    <p class="total_no">{{$donhang_count}}</p>
                                                    <a href="{{route('order.index')}}" class="head_couter" style="color: red">Đơn hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="full graph_head" style="margin-bottom: 15px">
                                     <div class="heading1 margin_0" >
                                        <h2>Thống kê danh thu</h2>
                                     </div>
                                  </div>
                                  <br>
                                  <div class="container">
                                <form id="form_danhthu" action="" method="GET">
                                  <div class="row g-3 align-items-center">
                                      <div class="col-auto">
                                          <label for="inputPassword6" class="col-form-label">Từ ngày</label>
                                      </div>
                                      <div class="col-auto">
                                          <input type="date" name="ngaybatdau" class="form-control"
                                              aria-describedby="passwordHelpInline">
                                      </div>
                                      <div class="col-auto">
                                          <label for="inputPassword6" class="col-form-label">-- Đến ngày</label>
                                      </div>
                                      <div class="col-auto">
                                          <input type="date" name="ngayketthuc" class="form-control"
                                              aria-describedby="passwordHelpInline">
                                      </div>
                                      <button type="submit" class="btn btn-primary">Tìm</button>
                                  </div>
                                  <form>
                                  </div>
                                      <br>
                                    <div id="chart" class="container"></div>
                                    <br>
                                    <div class="card">
                                      <div class="card-body">
                                        <div class="row">
                                          <table class="table">
                                              <thead>
                                                <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Khách hàng</th>
                                                  <th scope="col">Mã đơn hàng</th>
                                                  <th scope="col">Ngày đặt</th>
                                                  <th scope="col">Nhân viên giao hàng</th>
                                                  <th scope="col">Tổng tiền</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                               
                                                <?php $stt=1; ?>
                                                @foreach ($dh as $d)
                                                <tr>
                                                  <th >{{$stt}}</th>
                                                  <td>{{$d->khachhang->hovaten}}</td>
                                                  <td>{{$d->id}}</td>
                                                  <td>{{$d->ngaydathang}}</td>
                                                  @if(isset($d->nhanvien->hovaten))
                                                  <td>{{$d->nhanvien->hovaten}}</td>   
                                                  @else
                                                  <td>Chưa nhận đơn</td>
                                                  @endif
                                                  <td>{{number_format($d->tongtien)}}</td>
                                                </tr>
                                                <?php $stt++; ?>
                                                @endforeach
                                                
                                              </tbody>
                                            </table>
                                           
                                            
                                      </div>
                                    </div>
                                  </div>
                                @endsection
                                @section('js')
                                    <script>
                                        var chart = Morris.Bar({
                                            element: 'chart',
                                            parseTime: false,
                                            data: [
                                                0, 0
                                            ],
                                            xkey: 'ngaydathang',
                                            ykeys: ['sum', 'tongtien', 'id'],
                                            labels: ['Danh thu', 'Tổng tiền', 'id']
                                        });



                                        $('#form_danhthu').on('submit', function(e) {
                                            e.preventDefault();
                                            var ngay = $(this).serialize();
                                            $.get("{{ route('admin.index') }}?" + ngay, function(res) {
                                                chart.setData(res.dh);


                                            });
                                        })
                                    </script>
                                @endsection
