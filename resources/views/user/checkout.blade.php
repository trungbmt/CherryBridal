@extends('user.layout')
@section('content')
<!-- ****** Checkout Area Start ****** -->
<div class="checkout_area section_padding_100">
    <div class="container">

        <form class="row" id="form" action="{{URL::to('/checkout-done')}}" method="post">
            {{ csrf_field() }}
            <div class="col-12 col-md-6">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-page-heading">
                        <h5>Địa chỉ nhận hàng</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="full_name">Họ và tên <span>*</span></label>
                            <input type="text" class="form-control" id="full_name" name="order_full_name" value="" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="phone_number">Số điện thoại <span>*</span></label>
                            <input type="text" class="form-control" id="phone_number" min="0" value="" name="order_phone" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="city">Thành phố <span>*</span></label>
                            <input type="text" class="form-control" id="city" value="" name="order_city" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="state">Tỉnh <span>*</span></label>
                            <input type="text" class="form-control" id="state" value="" name="order_province" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="street_address">Địa chỉ <span>*</span></label>
                            <input type="text" class="form-control mb-3" id="street_address" name="order_address" required>
                        </div>

                        <div class="col-12">
                            <div class="custom-control custom-checkbox d-block mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                <label class="custom-control-label" for="customCheck1">Đồng ý các điều khoản sử dụng</label>
                            </div>
                        </div>
                    </div>
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

                    <button type="submit" class="btn karl-checkout-btn">Tiến hành đặt hàng</button>
                </div>
            </div>

        </form>
    </div>
</div>
<!-- ****** Checkout Area End ****** -->
@endsection