<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login V5</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}" >
  <link rel="stylesheet" href="{{asset('public/frontend/css/login/main.css')}}" >
  <link rel="stylesheet" href="{{asset('public/frontend/css/login/util.css')}}" >
  <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!--===============================================================================================-->
</head>
<body>
  <div class="limiter">
    <div class="container-login100" style="background-image: url('https://i.pinimg.com/originals/c3/2e/1d/c32e1d90990d799eb1037f29db3c0e7f.jpg');">
      <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
        <form class="login100-form validate-form flex-sb flex-w" action="{{URL::to('/login-check')}}" method="post">
          {{ csrf_field() }}
          <span class="login100-form-title p-b-53">
            Đăng ký với
          </span>
          <?php 
              $failed_register_message = Session::get('failed_register_message');
              if($failed_register_message) {
                echo "<div class='alert alert-danger'>".$failed_register_message."</div>";
              }
          ?>
          <a href="#" class="btn-face m-b-20">
            <i class="fa fa-facebook-official"></i>
            Facebook
          </a>

          <a href="#" class="btn-google m-b-20">
            <img src="{{asset('public/frontend/images/icon-google.png')}}" alt="GOOGLE">
            Google
          </a>
          
          <span class="login100-form-title p-b-20">
            hoặc
          </span>
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
            <input class="input100" required type="text" name="username" >
            <span class="focus-input100"></span>
          </div>
          
          <div class="p-t-13 p-b-9">
            <span class="txt1">
              Mật khẩu
            </span>
          </div>
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="input100" required type="password" name="password" >
            <span class="focus-input100"></span>
          </div>
          <div class="p-t-13 p-b-9">
            <span class="txt1">
              Nhập lại mật khẩu
            </span>
          </div>
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="input100" required type="password" name="repassword" >
            <span class="focus-input100"></span>
          </div>

          <div class="container-login100-form-btn m-t-17">
            <button class="login100-form-btn">
              Đăng Ký
            </button>
          </div>

          <div class="w-full text-center p-t-55">
            <span class="txt2">
              Đã có tài khoản?
            </span>

            <a href="{{URL::to('/login')}}" class="txt2 bo1">
              Đăng nhập ngay
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  

</body>
</html>