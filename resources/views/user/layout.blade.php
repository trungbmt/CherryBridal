<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Cherry Bridal - Wedding Store | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('public/frontend/images/icon.png')}}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/login/main.css')}}" >
    <link rel="stylesheet" href="{{asset('public/frontend/css/login/util.css')}}" >
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/core-style.css')}}">
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 

    <!-- Responsive CSS -->
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">

</head>

<body>
    <div class="catagories-side-menu">
        <!-- Close Icon -->
        <div id="sideMenuClose">
            <i class="ti-close"></i>
        </div>
        <!--  Side Nav  -->
        <div class="nav-side-menu">
            <div class="menu-list">
                @if(Auth::check())
                    <h6>Người dùng: <span>{{Auth::User()->username}}</span></h6>
                    
                    <div class="w-full text-center p-t-55">
                        <a href="{{URL::to('/logout')}}" style="font-size: 1.2rem" class="txt2 bo1">
                            Đổi mật khẩu
                        </a>
                    </div>
                    <div class="w-full text-center p-t-55">
                        <a href="{{URL::to('/logout')}}" style="font-size: 1.2rem" class="txt2 bo1">
                            Đăng xuất
                        </a>
                    </div>
                @else
                    <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33" style="width: 100%; padding: 50px 10px">
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
                          <a href="#" class="btn-face m-b-20" style="font-size: 15px">
                            <i class="fa fa-facebook-official"></i>
                            Facebook
                          </a>

                          <a href="#" class="btn-google m-b-20" style="font-size: 15px">
                            <img src="{{asset('public/frontend/images/icon-google.png')}}" alt="GOOGLE">
                            Google
                          </a>
                          
                          <div class="p-t-31 p-b-9">
                            <span class="txt1">
                              Tài khoản
                            </span>
                          </div>
                          <div class="wrap-input100 validate-input" data-validate = "Username is required">
                            <input class="input100" type="text" name="username" >
                            <span class="focus-input100"></span>
                          </div>
                          
                          <div class="p-t-13 p-b-9">
                            <span class="txt1">
                              Mật khẩu
                            </span>

                            <a href="#" class="txt2 bo1 m-l-5">
                              Quên?
                            </a>
                          </div>
                          <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input class="input100" type="password" name="password" >
                            <span class="focus-input100"></span>
                          </div>

                          <div class="container-login100-form-btn m-t-17">
                            <button class="login100-form-btn">
                              Đăng Nhập
                            </button>
                          </div>

                          <div class="w-full text-center p-t-55">
                            <span class="txt2">
                              Chưa có tài khoản?
                            </span>

                            <a href="{{URL::to('/register')}}" class="txt2 bo1">
                              Đăng ký ngay
                            </a>
                          </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div id="wrapper">

        <!-- ****** Header Area Start ****** -->
        <header class="header_area">
            <!-- Top Header Area Start -->
            <div class="top_header_area">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-end">

                        <div class="col-12 col-lg-7">
                            <div class="top_single_area d-flex align-items-center">
                                <!-- Logo Area -->
                                <div class="top_logo">
                                    <a href="{{URL::to('/')}}"><img src="{{asset('public/frontend/images/core-img/logo.png')}}" alt=""></a>
                                </div>
                                <!-- Cart & Menu Area -->
                                <div class="header-cart-menu d-flex align-items-center ml-auto">
                                    <!-- Cart Area -->
                                    <div class="cart">
                                        <a href="#" id="header-cart-btn" target="_blank"><span class="cart_quantity">
                                            {{Auth::User()?count(Auth::User()->carts()->get()):0}}</span> 
                                            <i class="ti-bag"></i> 
                                            Giỏ hàng: 
                                            <span>
                                                {{Auth::check()?Auth::User()->total_cart_money_formated():'0đ'}}
                                            </span>
                                        </a>
                                        <!-- Cart List Area Start -->
                                        <ul class="cart-list">
                                            @if($all_cart)
                                                @foreach($all_cart as $cart) 
                                                <?php $product = $cart->product(); ?>
                                                    <li>
                                                        <a href="{{URL::to('item/'.$product->product_id)}}" class="image"><img src="{{asset('storage/app/'.$product->product_img)}}" class="cart-thumb" alt=""></a>
                                                        <div class="cart-item-desc">
                                                            <h6>
                                                                <a href="#">{{$product->product_name}}</a>
                                                            </h6>
                                                            <p>{{$cart->amount}}x - 
                                                                <span style="text-transform: none" class="price">
                                                                    {{$cart->get_total_price_formated()}}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                                    </li>
                                                @endforeach
                                            @endif
                                            <li class="total">
                                                <span class="pull-right">Tổng: 
                                                    <span style="text-transform: none;">
                                                        {{Auth::check()?Auth::User()->total_cart_money_formated():'0đ'}}
                                                    </span>
                                            </span>
                                                <a href="{{URL::to('/cart')}}" class="btn btn-sm btn-cart">Giỏ</a>
                                                <a href="{{URL::to('/checkout')}}" class="btn btn-sm btn-checkout">Đặt hàng</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="header-right-side-menu ml-15">
                                        <a href="#" id="sideMenuBtn"><i class="ti-menu" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Top Header Area End -->
            <div class="main_header_area">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-12 d-md-flex justify-content-between">
                            <!-- Header Social Area -->
                            <div class="header-social-area">
                                <a href="#"><span class="karl-level">Share</span> <i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                            <!-- Menu Area -->
                            <div class="main-menu-area">
                                <nav class="navbar navbar-expand-lg align-items-start">

                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="ti-menu"></i></span></button>

                                    <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
                                        <ul class="navbar-nav animated" id="nav">
                                            <li class="nav-item active"><a class="nav-link" href="{{URL::to('/')}}">Trang Chủ</a></li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="{{URL::to('/shop')}}" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="karl-level">hot</span>Shop</a>
                                                <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                                    <a class="dropdown-item" href="{{URL::to('/shop')}}">TẤT CẢ</a>
                                                    @foreach($all_category as $category)
                                                        <a class="dropdown-item" href="{{URL::to('/shop/'.$category->category_id)}}">{{$category->category_name}}</a>
                                                    @endforeach
                                                </div>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#">Ảnh cưới</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#">Liên hệ</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <!-- Help Line -->
                            <div class="help-line">
                                <a href="tel:+84946416465"><i class="ti-headphone-alt"></i> +84 94641645</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ****** Header Area End ****** -->

        <!-- ****** Top Discount Area Start ****** -->
        <section class="top-discount-area d-md-flex align-items-center">
            <!-- Single Discount Area -->
            <div class="single-discount-area">
                <h5>Free Shipping &amp; Returns</h5>
                <h6><a href="#">BUY NOW</a></h6>
            </div>
            <!-- Single Discount Area -->
            <div class="single-discount-area">
                <h5>20% Discount for all dresses</h5>
                <h6>USE CODE: Colorlib</h6>
            </div>
            <!-- Single Discount Area -->
            <div class="single-discount-area">
                <h5>20% Discount for students</h5>
                <h6>USE CODE: Colorlib</h6>
            </div>
        </section>
        <!-- ****** Top Discount Area End ****** -->
        @yield('content')
        <!-- ****** Footer Area Start ****** -->
        <footer class="footer_area">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Area Start -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="single_footer_area">
                            <div class="footer-logo">
                                <img src="{{asset('public/frontend/images/core-img/logo.png')}}" alt="">
                            </div>
                            <div class="copywrite_text d-flex align-items-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Footer Area Start -->
                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                        <div class="single_footer_area">
                            <ul class="footer_widget_menu">
                                <li><a href="#">About</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Faq</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Area Start -->
                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                        <div class="single_footer_area">
                            <ul class="footer_widget_menu">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Our Policies</a></li>
                                <li><a href="#">Afiliates</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Single Footer Area Start -->
                    <div class="col-12 col-lg-5">
                        <div class="single_footer_area">
                            <div class="footer_heading mb-30">
                                <h6>Subscribe to our newsletter</h6>
                            </div>
                            <div class="subscribtion_form">
                                <form action="#" method="post">
                                    <input type="email" name="mail" class="mail" placeholder="Your email here">
                                    <button type="submit" class="submit">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line"></div>

                <!-- Footer Bottom Area Start -->
                <div class="footer_bottom_area">
                    <div class="row">
                        <div class="col-12">
                            <div class="footer_social_area text-center">
                                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ****** Footer Area End ****** -->
    </div>
    <!-- /.wrapper end -->


    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{asset('public/frontend/js/jquery/jquery.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('public/frontend/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('public/frontend/js/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('public/frontend/js/active.js')}}"></script>
    <script src="{{asset('public/backend/js/sweetalert2.all.min.js')}}"></script>
</body>

</html>