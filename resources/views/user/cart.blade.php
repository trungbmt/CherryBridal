@extends('user.layout')
@section('content')
<script src="{{asset('public/frontend/js/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('.qty-text').change(function() {
            var amount = $('#'+this.id).val();
            var cart_id = $('#'+this.id).data('cart_id');
            update_cart_item(cart_id, amount);
        });
        $('.qty-minus').click(function() {
            var amount = $('#amount_'+this.id).val();
            var cart_id = this.id;
            update_cart_item(cart_id, amount);
        });
        $('.qty-plus').click(function() {
            var amount = $('#amount_'+this.id).val();
            var cart_id = this.id;
            update_cart_item(cart_id, amount);
        });
        function update_cart_item(id, amount) {
            $.ajax({
                url:"{{ url('update-cart') }}",
                method:"GET",
                data:{cart_id:id, amount:amount},
                success:function(data){ 
                    if(data) {
                        $('#total_price_'+id).text(data);
                    }
                }
            });
        }
    });
</script>
<!-- ****** Cart Area Start ****** -->
<div class="cart_area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_cart as $cart)
                                <?php 
                                    $product = $cart->product();
                                    $detail = $cart->get_product_detail();
                                ?>
                                <tr>
                                    <td class="cart_product_img d-flex align-items-center">
                                        <a href="#"><img src="{{asset('storage/app/'.$product->product_img)}}" alt="Product"></a>
                                        <h6>{{$product->product_name}}</h6>
                                    </td>
                                    <td class="size"><span>{{$detail->product_size}}</span></td>
                                    <td id="price_{{$cart->cart_id}}" class="price"><span>{{$cart->price_format($detail->product_price)}}</span></td>
                                    <td class="qty">
                                        <div class="quantity">
                                            <span id="{{$cart->cart_id}}" class="qty-minus" onclick="
                                                var effect = document.getElementById('amount_{{$cart->cart_id}}'); 
                                                var qty = effect.value; 
                                                if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) 
                                                effect.value--;
                                                return false;">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </span>
                                            <input data-cart_id='{{$cart->cart_id}}' type="number" class="qty-text" id="amount_{{$cart->cart_id}}" step="1" min="1" max="99" name="quantity" value="{{$cart->amount}}">
                                            <span id="{{$cart->cart_id}}" class="qty-plus" onclick="
                                                var effect = document.getElementById('amount_{{$cart->cart_id}}'); 
                                                var qty = effect.value; 
                                                if( !isNaN( qty )) effect.value++;
                                                return false;">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="total_price"><span id="total_price_{{$cart->cart_id}}">{{$cart->price_format($cart->get_total_price())}}</span></td>
                                    <td><a href="{{URL::to('cart-delete/'.$cart->cart_id)}}" class="btn btn-danger">XOÁ</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-footer d-flex mt-30">
                    <div class="back-to-shop w-50">
                        <a href="{{URL::to('/shop/')}}">Continue shooping</a>
                    </div>
                    <div class="update-checkout w-50 text-right">
                        <a href="{{URL::to('cart-delete-all')}}" class="btn btn-danger">clear cart</a>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="coupon-code-area mt-70">
                    <div class="cart-page-heading">
                        <h5>Cupon code</h5>
                        <p>Enter your cupone code</p>
                    </div>
                    <form action="#">
                        <input type="search" name="search" placeholder="#569ab15">
                        <button type="submit">Apply</button>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="shipping-method-area mt-70">
                    <div class="cart-page-heading">
                        <h5>Shipping method</h5>
                        <p>Select the one you want</p>
                    </div>

                    <div class="custom-control custom-radio mb-30">
                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1"><span>Next day delivery</span><span>$4.99</span></label>
                    </div>

                    <div class="custom-control custom-radio mb-30">
                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2"><span>Standard delivery</span><span>$1.99</span></label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3"><span>Personal Pickup</span><span>Free</span></label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="cart-total-area mt-70">
                    <div class="cart-page-heading">
                        <h5>Cart total</h5>
                        <p>Final info</p>
                    </div>

                    <ul class="cart-total-chart">
                        <li><span>Subtotal</span> <span>$59.90</span></li>
                        <li><span>Shipping</span> <span>Free</span></li>
                        <li><span><strong>Total</strong></span> <span><strong>$59.90</strong></span></li>
                    </ul>
                    <a href="checkout.html" class="btn karl-checkout-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ****** Cart Area End ****** -->
@endsection