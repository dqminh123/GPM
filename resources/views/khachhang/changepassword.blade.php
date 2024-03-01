@extends('layouts.frontend')
@section('main')
<div class="container">
  <br>
    <div class="card">
        <div class="card-header">
                <h3 class="text-danger">Đổi mật khẩu</h3>
        </div>
        <div class="card-body">
            <form action="{{route('khachhang.update_password')}}" method="POST">
                @csrf
                <div class="mb-3" style="color: black">
                    <label for="password_c" class="form-label">Mật khẩu cũ</label>
                    <input type="password" class="form-control @error('password_c') is-invalid @enderror" id="password_c" name="password_c" >
                    @error('password_c')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                  </div>

                <div class="mb-3" style="color: black">
                    <label for="password_m" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control @error('password_m') is-invalid @enderror" id="password_m" name="password_m" >
                    @error('password_m')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>

                <div class="mb-3" style="color: black">
                    <label for="password_xn" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control @error('password_xn') is-invalid @enderror" id="password_xn" name="password_xn" >
                    @error('password_xn')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-success" style="margin-top: 10px">Cập nhật</button>
            </form>
            <br>
        </div>
    </div>   
</div>
@endsection