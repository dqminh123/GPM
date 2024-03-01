<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> Đăng nhập quản trị </title>

    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="{{ url('public/lg') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('public/lg') }}/assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('public/lg') }}/assets/css/style.css" />
</head>

<body>
    <div class="container-fluid ">
        <form action="{{ route('admin.postdangnhap') }}" method="post">
            @csrf
            <div class=" no-pdding login-box">

                <div class="row no-margin w-100 bklmj">
                    <div class="col-lg-6 col-md-6 log-det">

                        <h2>Đăng nhập</h2>


                        
                        <li id="thongbaoloi" style="width:400px"></li>


                        <div class="text-box-cont">
                            <div class="input-group mb-3">

                                <input type="text" name="tendangnhap" id="tendangnhap" class="form-control"
                                    placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">

                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
                            </div>

                            <div class="row no-margin">
                                <p class="forget-p">Forget Password ?</p>
                            </div>
                            <div class="right-bkij mb-3">
                                <button class="btn btn-success btn-round" id="btn-login">Đăng nhập</button>
                            </div>

                            <br>
                            <div class="row linkoi">
                                <div class="col-sm-5">
                                    <p>Or login with</p>
                                </div>
                                <div class="col-sm-7">
                                    <ul>
                                        <li><i class="fab fa-facebook-f"></i></li>
                                        <li><i class="fab fa-twitter"></i></li>

                                    </ul>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="col-lg-6 col-md-6 box-de">
                        <div class="ditk-inf">
                            <h2 class="w-100">Welcome Back </h2>
                            <p>Simply Create your account by <br> clicking the Signup Button</p>
                            <button type="button" class="btn btn-outline-light">Sign Up</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

</body>

<script src="{{ url('public/lg') }}/assets/js/jquery-3.2.1.min.js"></script>
<script src="{{ url('public/lg') }}/assets/js/popper.min.js"></script>
<script src="{{ url('public/lg') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ url('public/lg') }}/assets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $('#btn-login').click(function(e) {
        e.preventDefault();
        var tendangnhap = $('#tendangnhap').val();
        var password = $('#password').val();
        var _csrf = '{{ csrf_token() }}';
        var _loginurl = "{{ route('admin.postdangnhap') }}";
        $.ajax({
            type: "POST",
            url: _loginurl,
            data: {
                tendangnhap: tendangnhap,
                password: password,
                _token: _csrf,
                _method: 'POST',
            },

            success: function(response) {
                if (response.code == 200) {
                    $('#thongbaoloi').html('');
                    const Msg = Swal.mixin({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Đăng nhập thành công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    //end
                    Msg.fire({

                        type: 'success',
                        title: 'Đăng nhập thành công',

                    });

                    window.location.replace("{{ route('admin.index') }}");

                } else if (response.code == 400) {
                    let mess = '';
                    mess +=
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        mess += '<strong>' + response.error + '';
                            mess +=
                            ' <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>';
                            mess += ' </div>';
                            $('#thongbaoloi').html(mess);

                } else{

                    let mess = '';
                    for (let error of response.error) {
                        mess += '';
                        mess +=
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        mess += '<strong>' + error + '';
                            mess +=
                            ' <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>';
                        mess += ' </div>';
                        mess += '';
                    }
                    $('#thongbaoloi').html(mess);


                }


            }
        });

    });
</script>

</html>
