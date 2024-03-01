@extends('layouts.frontend')
@section('main')
    <div class="container">
        <table class="table">
            @if ($od->count('id') == 0)
                <div class="alert alert-primary" role="alert">
                    Đơn hàng trống
                </div>
            @else
                <thead>
                    <tr class="text-black">
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Ngày đặt hàng</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Tình trạng</th>
                    </tr>
                </thead>
                <tbody>



                    @foreach ($od as $value)
                        <tr class="text-black">
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->khachhang->hovaten }}</td>
                            <td>{{ $value->ngaydathang }}</td>
                            <td>{{ number_format($value->tongtien) }} ₫</td>
                            <td>{{ $value->tinhtrang->tinhtrang }}</td>
                            <td><a href="{{ route('dathang.myorder_detail', $value->id) }}" class="btn btn-success">Xem chi
                                    tiết</a></td>
                        </tr>
                    @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
