<div style="width:600px; margin:0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{$khachhang->hovaten}}</h2>
        <p>Bạn đã đăng ký thành công tài khoản tại cửa hàng của chúng tôi</p>
        <p>Vui lòng nhấn vào nút kích hoạt tài khoản để có thể sử dụng tài khoản</p>
        <p>
            <a href="{{route('Home.active',['khachhang'=>$khachhang->id,'token'=>$khachhang->token])}}" style="display:inline-block; background:green; color:#fff; padding:7px 25px; font-weight:bold">Kích hoạt tài khoản</a>
        </p>
    </div>
</div>