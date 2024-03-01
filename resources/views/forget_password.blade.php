@extends('layouts.frontend')
@section('main')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
                <h3 class="text-primary">Lấy lại mật khẩu</h3>
        </div>
        <div class="card-body mb-3">
            <form action="" method="POST">
                @csrf
                <div class="mb-4" style="color: black;margin-bottom:10px" >
                    <label for="email" class="form-label" >Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Vui lòng nhập email" >
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                  </div>

                <button type="submit" class="btn btn-success" style="margin-bottom: 10px">Gửi email xác nhận</button>
            </form>
        </div>
    </div>   
</div>
@endsection