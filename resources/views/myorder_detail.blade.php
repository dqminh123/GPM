@extends('layouts.frontend')
@section('main')
</div>
<div class="main_content">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table style="150px" class="table table-bordered">
                        <tbody class="text-black">
                          <tr>
                            <td width=150px>Mã đơn hàng:</td>
                            <td>{{$dathang->id}}</td>
                          </tr>
                          <tr>
                            <td>Tên khách hàng:</td>
                            <td>{{$dathang->khachhang->hovaten}}</td>
                          </tr> 
                          <tr>
                            <td>Địa chỉ:</td>
                            <td>{{$dathang->khachhang->diachi}}</td>
                          </tr>
                          <tr>
                            <td>SĐT:</td>
                            <td>{{$dathang->khachhang->dienthoai}}</td>
                          </tr>
                          <tr>
                            <td>Email:</td>
                            <td>{{$dathang->khachhang->email}}</td>
                          </tr>
                        </tbody>
                        
                    </table>
                    
                    @if (isset($dathang->nhanvien_id))
                    <table style="150px" class="table table-bordered">
                        <tbody class="text-black">
                          <tr>
                            <td width=150px>Tên nhân viên giao hàng:</td>
                            <td>{{$dathang->nhanvien->hovaten}}</td>
                          </tr> 
                          <tr>
                            <td>SĐT:</td>
                            <td>{{$dathang->nhanvien->dienthoai}}</td>
                          </tr>
                          <tr>
                            <td>Email:</td>
                            <td>{{$dathang->nhanvien->email}}</td>
                          </tr>
                          <tr>
                              <td>Tình trạng đơn hàng</td>
                            <td style="color:red;">{{$dathang->tinhtrang->tinhtrang}}</td>
                        </tr>
                        </tbody>
                        
                    </table>
                    @endif
                    <hr>
                    <div class="table-responsive shop_cart_table">
                        
                        <table class="table table-bordered border-primary">
                            <thead>
                                <tr class="text-black">
                                    <th class="product-main-image">Ảnh</th>
                                    <th class="product-thumbnail">Sản phẩm</th>
                                    <th class="product-name">Đơn giá</th>
                                    <th class="product-price">Số lượng</th>
                                    <th class="product-name">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($od as $value)
                                <tr class="text-black">
                                    <td  ><img width="70px" src="{{url('public/sanpham')}}/{{$value->sanpham->anh}}"></td>
                                    <td  >{{$value->sanpham->tensp}}</td>
                                    
                                    <td  >{{number_format($value->sanpham->giaxuat)}} ₫</td>
                                    <td  >{{$value->soluong}}</td>
                                    <td  >{{number_format($value->soluong*$value->sanpham->giaxuat)}} ₫</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection