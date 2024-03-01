@extends('layouts.frontend')
@section('main')
<div class="container">
    <div class="card">
      <br>
        <div class="card-header">
              <h3 class="text-dark">Thay đổi thông tin</h3>
        </div>
        <div class="card-body">
          <form action="{{route('account.update_account',$kh->id)}}" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="mb-3">
              <label for="TieuDe"  style="color: black" class="form-label">Họ và tên</label>
              <input type="text" style="color: black" value="{{$kh->hovaten}}" class="form-control @error('hovaten') is-invalid @enderror" id="hovaten" name="hovaten" >
              @error('hovaten')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
          </div>
        
          <div class="mb-3">
            <label for="gioitinh"  style="color: black">Giới tính <span class="text-danger font-weight-bold">*</span></label>
            <select class="custom-select form-control @error('gioitinh') is-invalid @enderror" id="gioitinh" name="gioitinh"  style="color: black" >
              <option value="">-- Choose --</option>
              <option value="0">Nam</option>
              <option value="1" selected="selected">Nữ</option>
            </select>
            @error('gioitinh')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
          
          <div class="mb-3">
            <label for="diachi"  style="color: black" class="form-label">Địa chỉ</label>
            <input  value="{{$kh->diachi}}"  style="color: black" type="text" class="form-control @error('diachi') is-invalid @enderror" id="diachi" name="diachi" >
            @error('diachi')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="dienthoai"  style="color: black" class="form-label">SĐT</label>
            <input  value="{{$kh->dienthoai}}" type="number"  style="color: black" class="form-control @error('dienthoai') is-invalid @enderror" id="dienthoai" name="dienthoai" >
            @error('dienthoai')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
        <div class="mb-3">
          <label for="email"  style="color: black" class="form-label">Email</label>
          <input type="text" value="{{$kh->email}}"  style="color: black" class="form-control @error('email') is-invalid @enderror" id="email" name="email" >
          @error('email')
          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
        
          <div class="form-group">
            <label for="file_uploads"  style="color: black">Ảnh<span class="text-danger font-weight-bold">*</span></label>
            <img class="d-block" src="{{url('public/khachhang')}}/{{$kh->anh}}"  width="30px"/>
            <input id="file_uploads" type="file" class="form-control @error('file_uploads') is-invalid @enderror" name="file_uploads" value="{{ $kh->anh }}" autocomplete="file_uploads" />
            @error('file_uploads')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
            
            <button type="submit" class="btn btn-primary" style="margin-bottom:10px">Lưu</button>
        </form>
        </div>
    </div>   
</div>
@endsection