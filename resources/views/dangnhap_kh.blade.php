
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{url('public/login_kh')}}/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{url('public/login_kh')}}/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('public/login_kh')}}/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{url('public/login_kh')}}/css/style.css">

    <title>Đăng nhập</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="{{url('public/login_kh')}}/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Đăng nhập <strong>khách hàng</strong></h3>
              
            </div>
            <div class="container">
              @if (Session::has('yes'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert"
                          aria-hidden="true">&times;</button>
                      {{ Session::get('yes') }}
  
                  </div>
              @endif
              @if (Session::has('no'))
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert"
                          aria-hidden="true">&times;</button>
                      {!! Session::get('no') !!}
                  </div>
              @endif
          </div>
            <form action="{{route('Home.postdangnhap')}}" method="post">
				@csrf
              <div class="form-group first">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
				@error('email')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
              </div>
              <div class="form-group last mb-4">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
					<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
				@enderror
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Ghi nhớ</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="{{route('Home.forget_password')}}" class="forgot-pass">Quên mật khẩu</a></span> 
              </div>
			  <p>Chưa có tài khoản ?  <a href="{{route('Home.dangky')}}">Đăng ký</a></p>
              <input type="submit" value="Đăng nhập" class="btn text-white btn-block btn-primary">

              <span class="d-block text-left my-4 text-muted"> or sign in with</span>
              
              <div class="social-login">
                <a href="https://www.facebook.com/" class="facebook">
                  <span class="icon-facebook mr-3"></span> 
                </a>
                <a href="https://twitter.com/?lang=vi" class="twitter">
                  <span class="icon-twitter mr-3"></span> 
                </a>
                <a href="https://accounts.google.com/ServiceLogin/identifier?service=mail&passive=1209600&osid=1&continue=https%3A%2F%2Fmail.google.com%2Fmail%2Fu%2F0%2F&followup=https%3A%2F%2Fmail.google.com%2Fmail%2Fu%2F0%2F&emr=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin" class="google">
                  <span class="icon-google mr-3"></span> 
                </a>
              </div>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="{{url('public/login_kh')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{url('public/login_kh')}}/js/popper.min.js"></script>
    <script src="{{url('public/login_kh')}}/js/bootstrap.min.js"></script>
    <script src="{{url('public/login_kh')}}/js/main.js"></script>
  </body>
</html>
