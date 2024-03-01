<div style="width:600px; margin:0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{$khachhang->hovaten}}</h2>
        <p>Email này để giúp bạn lấy lại mật khẩu</p>
        <p>Vui lòng nhấn váo link dưới đây để đặt lại mật khẩu</p>
        <p>Chú ý : Mã xác nhận chỉ có hiệu lực trong vòng 72 giờ</p>
        <p>
            <a href="{{route('Home.get_password',['khachhang'=>$khachhang->id,'token'=>$khachhang->token])}}" style="display:inline-block; background:green; color:#fff; padding:7px 25px; font-weight:bold">Lấy lại mật khẩu</a>
        </p>
    </div>
</div>