@extends('user.layout')
@section('content')
<!-- ****** Checkout Area Start ****** -->
<div class="checkout_area section_padding_100">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-page-heading">
                        <h5>Billing Address</h5>
                        <p>Enter your cupone code</p>
                    </div>

                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">First Name <span>*</span></label>
                                <input type="text" class="form-control" id="first_name" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Last Name <span>*</span></label>
                                <input type="text" class="form-control" id="last_name" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="company">Company Name</label>
                                <input type="text" class="form-control" id="company" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="country">Country <span>*</span></label>
                                <select class="custom-select d-block w-100" id="country">
                                <option value="usa">United States</option>
                                <option value="uk">United Kingdom</option>
                                <option value="ger">Germany</option>
                                <option value="fra">France</option>
                                <option value="ind">India</option>
                                <option value="aus">Australia</option>
                                <option value="bra">Brazil</option>
                                <option value="cana">Canada</option>
                            </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="street_address">Address <span>*</span></label>
                                <input type="text" class="form-control mb-3" id="street_address" value="">
                                <input type="text" class="form-control" id="street_address2" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="postcode">Postcode <span>*</span></label>
                                <input type="text" class="form-control" id="postcode" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="city">Town/City <span>*</span></label>
                                <input type="text" class="form-control" id="city" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="state">Province <span>*</span></label>
                                <input type="text" class="form-control" id="state" value="">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Phone No <span>*</span></label>
                                <input type="number" class="form-control" id="phone_number" min="0" value="">
                            </div>
                            <div class="col-12 mb-4">
                                <label for="email_address">Email Address <span>*</span></label>
                                <input type="email" class="form-control" id="email_address" value="">
                            </div>

                            <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Terms and conitions</label>
                                </div>
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                </div>
                                <div class="custom-control custom-checkbox d-block">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Subscribe to our newsletter</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                <div class="order-details-confirmation">

                    <div class="cart-page-heading">
                        <h5>Đơn hàng của bạn</h5>
                        <p>Chi tiết</p>
                    </div>

                    <ul class="order-details-form mb-4">
                        <li><span>Sản phẩm</span> <span>Tổng tiền</span></li>
                        @foreach($all_cart as $cart)
                            <li style="text-transform: none; border: none">
                                <span>
                                    <strong>{{$cart->product()->product_name}}</strong>
                                    <span>(Size: {{$cart->get_product_detail()->product_size}} , x{{$cart->amount}})</span>
                                </span> 
                                <span>{{$cart->get_total_price_formated()}}</span>
                            </li>
                        @endforeach
                        <hr>
                        <li>
                            <span>Tổng tiền sản phẩm</span> 
                            <span style="text-transform: none">{{Auth::User()->total_cart_money_formated()}}</span>
                        </li>
                        <li>
                            <span>Phí vận chuyển</span> 
                            <span>Free</span>
                        </li>
                        <li>
                            <span>Thành tiền</span> 
                            <span style="text-transform: none">{{Auth::User()->total_cart_money_formated()}}</span>
                        </li>
                    </ul>


                    <div id="accordion" role="tablist" class="mb-4">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-circle-o mr-3"></i>Chuyển khoản ngân hàng</a>
                                </h6>
                            </div>

                            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Chuyển tiền cho chúng tôi và đơn hàng của bạn sẽ được thanh toán</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-circle-o mr-3"></i>Thanh toán khi nhận hàng</a>
                                </h6>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Thanh toán khi chúng tôi giao hàng đến nhà bạn, thanh toán bằng tiền mặt.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingFour">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="fa fa-circle-o mr-3"></i>Thanh toán trực tiếp</a>
                                </h6>
                            </div>
                            <div id="collapseFour" class="collapse show" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Trực tiếp đến cửa tiệm của chúng tôi và thanh toán bằng tiền mặt.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn karl-checkout-btn">Tiến hành thanh toán</a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- ****** Checkout Area End ****** -->
@endsection