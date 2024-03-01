@extends('layouts.frontend')
@section('main')
<div class="container">
  <br>
    <div class="card">
      <div class="card-header mb-3">
            <h3 class="text-dark">Đăng ký khách hàng</h3>
      </div>
      <div class="card-body mb-3">
      <form action="{{route('Home.postdangky')}}" method="POST" enctype="multipart/form-data" style="color: black">
        @csrf
        <div class="mb-3">
          <label for="hovaten" class="form-label">Họ và tên</label>
          <input name="hovaten" type="text" class="form-control @error('hovaten') is-invalid @enderror" id="hovaten" aria-describedby="hovaten" >
          @error('hovaten')
          <span class="invalid-feedback" role="alert" style="color: red"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="privilege">Giới tính <span class="text-danger font-weight-bold">*</span></label>
          <select class="custom-select form-control @error('privilege') is-invalid @enderror" id="gioitinh" name="gioitinh" >
            <option value="">-- Choose --</option>
            <option value="0" selected="selected">Nam</option>
            <option value="1">Nữ</option> 
          </select>
          @error('privilege')
            <span class="invalid-feedback" role="alert" style="color: red"><strong>{{ $message }}</strong></span>
          @enderror
          
        </div>
        
        <div class="mb-3">
          <label for="diachi" class="form-label">Địa chỉ</label>
          <input type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi" >
          @error('diachi')
          <span class="invalid-feedback" role="alert" style="color: red"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      
        <div class="mb-3">
          <label for="dienthoai" class="form-label">Điện thoại</label>
          <input type="text" class="form-control @error('dienthoai') is-invalid @enderror" id="dienthoai" name="dienthoai" >
          @error('dienthoai')
          <span class="invalid-feedback" role="alert" style="color: red"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      
      
        
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" >
        @error('email')
        <span class="invalid-feedback" role="alert" style="color: red"s><strong>{{ $message }}</strong></span>
        @enderror
      </div>
      
        <div class="mb-3">
          <label for="tendangnhap" class="form-label">Tên đăng nhập</label>
          <input type="text" class="form-control @error('tendangnhap') is-invalid @enderror" id="tendangnhap" name="tendangnhap" >
          @error('tendangnhap')
          <span class="invalid-feedback" role="alert" style="color: red"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      
        <div class="mb-3">
          <label for="password" class="form-label">Mật khẩu</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" >
          @error('password')
          <span class="invalid-feedback" role="alert" style="color: red"><strong>{{ $message }}</strong></span>
        @enderror
        </div>
    
        <div class="mb-3">
          <label for="password_m" class="form-label">Xác nhận mật khẩu</label>
          <input type="password" class="form-control @error('password_m') is-invalid @enderror" id="password_m" name="password_m" >
          @error('password_m')
          <span class="invalid-feedback" role="alert" style="color: red"><strong>{{ $message }}</strong></span>
        @enderror
        </div>
       
        <div class="mb-3">
            <label for="file_uploads" class="form-label">Ảnh</label>
            <input name="file_uploads" type="file" class="form-control @error('file_uploads') is-invalid @enderror" id="file_uploads" value="{{ old('file_uploads') }}" aria-describedby="file_uploads" >
            @error('file_uploads')
            <span class="invalid-feedback" role="alert" style="color: red"><strong>{{ $message }}</strong></span>
          @enderror
          </div>
          <br>
        <button type="submit" class="btn btn-primary " style="margin-bottom: 10px">Đăng ký</button>
        </form>
      </div>
    </div>
  </div>  
@endsection