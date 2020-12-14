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
            Sign In With
          </span>
          <?php 
              $failed_login_message = Session::get('failed_login_message');
              if($failed_login_message) {
                echo "<div class='alert alert-danger'>".$failed_login_message."</div>";
                Session::put('failed_login_message', null);
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
          
          <div class="p-t-31 p-b-9">
            <span class="txt1">
              Username
            </span>
          </div>
          <div class="wrap-input100 validate-input" data-validate = "Username is required">
            <input class="input100" type="text" name="username" >
            <span class="focus-input100"></span>
          </div>
          
          <div class="p-t-13 p-b-9">
            <span class="txt1">
              Password
            </span>

            <a href="#" class="txt2 bo1 m-l-5">
              Forgot?
            </a>
          </div>
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="input100" type="password" name="password" >
            <span class="focus-input100"></span>
          </div>

          <div class="container-login100-form-btn m-t-17">
            <button class="login100-form-btn">
              Sign In
            </button>
          </div>

          <div class="w-full text-center p-t-55">
            <span class="txt2">
              Not a member?
            </span>

            <a href="#" class="txt2 bo1">
              Sign up now
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  

</body>
</html>