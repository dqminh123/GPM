@extends('layouts.admin')
@section('main')

<div class="card" >
    <div class="card-body">
        <table class="table table-bordered border-primary">
            <h1 style="text-align: center; color: red;">Đơn hàng : {{$od->id}}</h1>
            <hr>
            <tbody>
                <tr>
                    <td width=200px>Họ và tên</td>
                    <td>{{$od->khachhang->hovaten}}</td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>{{$od->khachhang->diachi}}</td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>{{$od->khachhang->dienthoai}}</td>
                   
                </tr>

                <tr>
                    <td>Email</td>
                    <td>{{$od->khachhang->email}}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        @if (isset($od->nhanvien_id))
            
            <table class="table table-bordered border-primary">
                <tbody>
                    <tr>
                        <td width=200px>Nhân viên giao hàng</td>
                    <td>{{$od->nhanvien->hovaten}}</td>
                    </tr>

                    <tr>
                        <td>Địa chỉ</td>
                        <td>{{$od->nhanvien->diachi}}</td>
                    </tr>

                    <tr>
                        <td>Số điện thoại</td>
                        <td>{{$od->nhanvien->dienthoai}}</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>{{$od->nhanvien->email}}</td>
                    </tr>

                    <tr>
                        <td>Tình trạng đơn hàng:</td>
                        <td style="color: red;">{{$od->tinhtrang->tinhtrang}}</td>
                    </tr>
                </tbody>
            </table>
            @endif
            <hr>
        <table class="table">
            <thead>
                <tr>
                    <th class="product-thumbnail"></th>
                    <th class="product-thumbnail">Sản phẩm</th>
                    <th class="product-name">Đơn giá</th>
                    <th class="product-price">Số lượng</th>
                    <th class="product-quantity">Thành tiền</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($od->dathang_chitiet as $value)
                <tr>
                    <td  ><img width="200px" src="{{url('public/sanpham')}}/{{$value->sanpham->anh}}"></td>
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

@endsection
