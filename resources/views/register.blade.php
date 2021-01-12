<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Đăng ký</title>
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
  <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}" >
  <link rel="stylesheet" href="{{asset('public/frontend/css/login/main.css')}}" >
  <link rel="stylesheet" href="{{asset('public/frontend/css/login/util.css')}}" >
  <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
 
</head>
<body>
    <div class="limiter">
      <div class="container-login100" style="background-image: url({{url('public/frontend/images/bg-img/login.jpg')}});">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33 flex-sb flex-w">
          <span class="login100-form-title p-b-53">
            Đăng ký với
          </span>
          <a href="{{ route('redirect', 'facebook') }}" class="btn-face m-b-20">
            <i class="fa fa-facebook-official"></i>
            Facebook
          </a>

          <a href="{{ route('redirect', 'google') }}" class="btn-google m-b-20">
            <img src="{{asset('public/frontend/images/icon-google.png')}}" alt="GOOGLE">
            Google
          </a>
          <span class="login100-form-title p-b-20">
            hoặc
          </span>
          <?php 
              $failed_register_message = Session::get('failed_register_message');
              if($failed_register_message) {
                echo "<div class='alert alert-danger w-100'>".$failed_register_message."</div>";
              }
          ?>

          <form id="myform" class="login100-form validate-form flex-sb flex-w" action="{{URL::to('/register-account')}}" method="post">
            {{ csrf_field() }}
            <div class="p-b-9">
              <span class="txt1">
                Địa chỉ email
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate = "Email is required">
              <input class="input100" required type="email" name="email" >
              <span class="focus-input100"></span>
            </div>
            <div class="p-t-13 p-b-9">
              <span class="txt1">
                Tên tài khoản
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate = "Username is required">
              <input class="input100" maxlength="15" required type="text" name="username" >
              <span class="focus-input100"></span>
            </div>
            <div class="p-t-13 p-b-9">
              <span class="txt1">
                Mật khẩu
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate = "Password is required">
              <input class="input100" data-msg-minlength="Mật khẩu phải dài hơn 8 ký tự" minlength="8"n id="password" required type="password" name="password" >
              <span class="focus-input100"></span>
            </div>
            <div class="p-t-13 p-b-9">
              <span class="txt1">
                Nhập lại mật khẩu
              </span>
            </div>
            <div class="wrap-input100 validate-input" data-validate = "Password is required">
              <input class="input100" data-msg-equalTo="Phải trùng khớp với mật khẩu" required type="password" id="password_again" name="password_again" >
              <span class="focus-input100"></span>
            </div>
            <div class="container-login100-form-btn m-t-17">
              <input id="submit-button" type="submit" value="Đăng Ký" class="login100-form-btn">
            </div>
          </form>
            
          <div class="w-full text-center p-t-55">
            <span class="txt2">
              Đã có tài khoản?
            </span>

            <a href="{{URL::to('/login')}}" class="txt2 bo1">
              Đăng nhập ngay
            </a>
          </div>
        </div>
      </div>
    </div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
  // just for the demos, avoids form submit
  jQuery.validator.setDefaults({
    debug: false,
    success: "valid"
  });
  $( "#myform" ).validate({
    rules: {
      password_again: {
        equalTo: "#password"
      }
    }
  });
</script>
</body>
</html>