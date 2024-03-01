@extends('layouts.frontend')
@section('main')
<br>
    {{-- <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('Home.index') }}">Home</a></div>
            </div>
        </div>
    </div> --}}

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="icon-check_circle display-3 text-success"></span>
                    <h1 class="display-3 text-black">Đặt Hàng Thành Công !</h1>
                    <h3 class="lead mb-3 text-black">Vui lòng check Email {{ Auth::guard('khachhang')->user()->email }}</h3>
                    <p><a href="{{ route('Home.shop') }}" class="btn btn-sm btn-primary">Tiếp tục mua hàng</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
