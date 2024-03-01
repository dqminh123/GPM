@extends('layouts.frontend')
@section('main')
<div class="container">
    <div class="card">
        <div class="card-header">
                <h3 class="text-dark">Đặt lại mật khẩu</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="mb-3" style="color: black">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" >
                    @error('password')
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

                <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
            </form>
        </div>
    </div>   
</div>
@endsection