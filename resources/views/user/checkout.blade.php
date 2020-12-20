@extends('user.layout')
@section('content')
<!-- ****** Checkout Area Start ****** -->
<div class="checkout_area section_padding_100">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-page-heading">
                        <h5>Địa chỉ nhận hàng</h5>
                    </div>

                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="full_name">Họ và tên <span>*</span></label>
                                <input type="text" class="form-control" id="full_name" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Số điện thoại <span>*</span></label>
                                <input type="text" class="form-control" id="phone_number" min="0" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="city">Thành phố <span>*</span></label>
                                <input type="text" class="form-control" id="city" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="state">Tỉnh <span>*</span></label>
                                <input type="text" class="form-control" id="state" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="street_address">Địa chỉ <span>*</span></label>
                                <input type="text" class="form-control mb-3" id="street_address" value="" required>
                            </div>

                            <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                    <label class="custom-control-label" for="customCheck1">Đồng ý các điều khoản sử dụng</label>
                                </div>
                                <div class="custom-control custom-checkbox d-block">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">Nhận email tin tức của chúng tôi</label>
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
                                    <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="fa fa-circle-o mr-3"></i>Thanh toán tại quầy</a>
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