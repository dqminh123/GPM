@extends('layouts.frontend')
@section('main')
<div class="container">
    <div class="card">
        <br>
        <div class="card-header">
            <h3 class="text-danger">Thông tin khách hàng</h3>
        </div>
        <div class="card-body">
            <form action="">
                <img src="{{url('public/khachhang')}}/{{Auth::guard('khachhang')->user()->anh}}" alt="" style="width: 180px">
                <br>
                <br>
                <div class="mb-3" style="color: black;margin-bottom:10px">
                    <label for="hovaten" class="form-label">Họ và tên</label>
                    <input type="text" style="color: black" class="form-control " disabled value="{{Auth::guard('khachhang')->user()->hovaten}}" >  
                </div>
                
                <div class="mb-3" style="color: black;margin-bottom:10px">
                    <label for="diachi" class="form-label">Địa chỉ</label>
                    <input type="diachi" style="color: black" class="form-control" disabled value="{{Auth::guard('khachhang')->user()->diachi}}" >  
                </div>
                
                <div class="mb-3" style="color: black;margin-bottom:10px">
                    <label for="dienthoai" class="form-label">Số điện thoại</label>
                    <input type="dienthoai" style="color: black" class="form-control " disabled value="{{Auth::guard('khachhang')->user()->dienthoai}}" >  
                </div>
                
                <div class="mb-3" style="color: black;margin-bottom:10px">
                    <label for="gioitinh" class="form-label">Giới tính :</label>
                    @if (Auth::guard('khachhang')->user()->gioitinh==0)
                        Nam
                    @else
                        Nữ
                    @endif  
                </div>
               
                <div class="mb-4" style="color: black;margin-bottom:10px">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" style="color: black" class="form-control " disabled value="{{Auth::guard('khachhang')->user()->email}}" >  
                </div>
               
            </form>
                <a href="{{route('account.change_account')}}" type="submit" class="btn btn-primary" >Cập nhật</a>
                
                
        </div>
            <br>
    </div>   
</div>
@endsection