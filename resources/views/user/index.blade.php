@extends('user.layout')
@section('content')
<!-- ****** Welcome Slides Area Start ****** -->
<section class="welcome_area">
    <div class="welcome_slides owl-carousel">
        <!-- Single Slide Start -->
        <div class="single_slide height-800 bg-img background-overlay" style="background-image: url({{asset('public/frontend/images/bg-img/bg-1.jpg')}});">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="welcome_slide_text">
                            <h6 data-animation="bounceInDown" data-delay="0" data-duration="500ms">* Only today we offer free shipping</h6>
                            <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">Fashion Trends</h2>
                            <a href="#" class="btn karl-btn" data-animation="fadeInUp" data-delay="1s" data-duration="500ms">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Slide Start -->
        <div class="single_slide height-800 bg-img background-overlay" style="background-image: url({{asset('public/frontend/images/bg-img/bg-4.jpg')}});">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="welcome_slide_text">
                            <h6 data-animation="fadeInDown" data-delay="0" data-duration="500ms">* Only today we offer free shipping</h6>
                            <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">Summer Collection</h2>
                            <a href="#" class="btn karl-btn" data-animation="fadeInLeftBig" data-delay="1s" data-duration="500ms">Check Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Slide Start -->
        <div class="single_slide height-800 bg-img background-overlay" style="background-image: url({{asset('public/frontend/images/bg-img/bg-2.jpg')}});">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="welcome_slide_text">
                            <h6 data-animation="fadeInDown" data-delay="0" data-duration="500ms">* Only today we offer free shipping</h6>
                            <h2 data-animation="bounceInDown" data-delay="500ms" data-duration="500ms">Women Fashion</h2>
                            <a href="#" class="btn karl-btn" data-animation="fadeInRightBig" data-delay="1s" data-duration="500ms">Check Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ****** Welcome Slides Area End ****** -->

<!-- ****** Top Catagory Area Start ****** -->
<section class="top_catagory_area d-md-flex clearfix">
    <!-- Single Catagory -->
    <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url({{asset('public/frontend/images/bg-img/bg-2.jpg')}});">
        <div class="catagory-content">
            <h6>On Accesories</h6>
            <h2>Sale 30%</h2>
            <a href="#" class="btn karl-btn">SHOP NOW</a>
        </div>
    </div>
    <!-- Single Catagory -->
    <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url({{asset('public/frontend/images/bg-img/bg-3.jpg')}});">
        <div class="catagory-content">
            <h6>in Bags excepting the new collection</h6>
            <h2>Designer bags</h2>
            <a href="#" class="btn karl-btn">SHOP NOW</a>
        </div>
    </div>
</section>
<!-- ****** Top Catagory Area End ****** -->

<!-- ****** Quick View Modal Area Start ****** -->

@foreach($all_category as $category)
    @foreach($category->get_newest_products(5) as $product)
        <div class="modal fade" id="quickview_{{$product->product_id}}" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                    <div class="modal-body">
                        <div class="quickview_body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="quickview_pro_img">
                                            <img src="{{asset('storage/app/'.$product->product_img)}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="quickview_pro_des">
                                            <h4 class="title">{{$product->product_name}}</h4>
                                            <div class="top_seller_product_rating mb-15">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <h5 class="price">{{$product->get_lowest_price()}}<span>{{$product->get_fake_price()}}</span></h5>
                                            <div class="widget size mt-5">
                                                <h6 class="widget-title">Size</h6>
                                                <div class="widget-desc">
                                                    <ul>
                                                        @foreach($product->details as $detail)
                                                            <li><a class="border border-dark" href="#">{{$detail->product_size}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#">Xem chi tiết sản phẩm</a>
                                        </div>
                                        <!-- Add to Cart Form -->
                                        <form class="cart" method="post">
                                            <div class="quantity">
                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                                <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">

                                                <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                            <button type="submit" name="addtocart" value="5" class="btn btn-danger">Thêm vào giỏ hàng</button>
                                            <!-- Wishlist -->
                                            <div class="modal_pro_wishlist">
                                                <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                            </div>
                                            <!-- Compare -->
                                            <div class="modal_pro_compare">
                                                <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                            </div>
                                        </form>

                                        <div class="share_wf mt-30">
                                            <p>Share</p>
                                            <div class="_icon">
                                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach
<!-- ****** Quick View Modal Area End ****** -->

<!-- ****** New Arrivals Area Start ****** -->
<section class="new_arrivals_area section_padding_100_0 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>MỚI NHẤT</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="karl-projects-menu mb-100">
        <div class="text-center portfolio-menu">
            <button class="btn active" data-filter="*">TẤT CẢ</button>
            @foreach($all_category as $category)
                <button class="btn" data-filter=".filter_{{$category->category_id}}">{{$category->category_name}}</button>
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="row karl-new-arrivals">
            @foreach($all_category as $category)
                @foreach($category->get_newest_products(5) as $product)
                    <div class="col-12 col-sm-6 col-md-4 single_gallery_item filter_{{$category->category_id}} wow fadeInUpBig" data-wow-delay="0.2s">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="{{asset('storage/app/'.$product->product_img)}}" alt="">
                            <div class="product-quicview">
                                <a href="#" data-toggle="modal" data-target="#quickview_{{$product->product_id}}"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <h4 class="product-price">{{$product->get_lowest_price()}}</h4>
                            <p>{{$product->product_name}}</p>
                            <!-- Add to Cart -->
                            <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                        </div>
                    </div>
{{--                     <div class="col-12 col-sm-6 col-md-4 single_gallery_item filter_{{$category->category_id}} wow fadeInUpBig" data-wow-delay="0.2s">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="{{asset('public/frontend/images/product-img/product-1.jpg')}}" alt="">
                            <div class="product-quicview">
                                <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <h4 class="product-price">$39.90</h4>
                            <p>Jeans midi cocktail dress</p>
                            <!-- Add to Cart -->
                            <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                        </div>
                    </div> --}}
                @endforeach
            @endforeach
        </div>
    </div>
</section>
<!-- ****** New Arrivals Area End ****** -->

<!-- ****** Offer Area Start ****** -->
<section class="offer_area height-700 section_padding_100 bg-img" style="background-image: url({{asset('public/frontend/images/bg-img/bg-5.jpg')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-end justify-content-end">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="offer-content-area wow fadeInUp" data-wow-delay="1s">
                    <h2>White t-shirt <span class="karl-level">Hot</span></h2>
                    <p>* Free shipping until 25 Dec 2017</p>
                    <div class="offer-product-price">
                        <h3><span class="regular-price">$25.90</span> $15.90</h3>
                    </div>
                    <a href="#" class="btn karl-btn mt-30">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ****** Offer Area End ****** -->

<!-- ****** Popular Brands Area Start ****** -->
<section class="karl-testimonials-area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>Testimonials</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="karl-testimonials-slides owl-carousel">

                    <!-- Single Testimonial Area -->
                    <div class="single-testimonial-area text-center">
                        <span class="quote">"</span>
                        <h6>Nunc pulvinar molestie sem id blandit. Nunc venenatis interdum mollis. Aliquam finibus nulla quam, a iaculis justo finibus non. Suspendisse in fermentum nunc.Nunc pulvinar molestie sem id blandit. Nunc venenatis interdum mollis. </h6>
                        <div class="testimonial-info d-flex align-items-center justify-content-center">
                            <div class="tes-thumbnail">
                                <img src="{{asset('public/frontend/images/bg-img/tes-1.jpg')}}" alt="">
                            </div>
                            <div class="testi-data">
                                <p>Michelle Williams</p>
                                <span>Client, Los Angeles</span>
                            </div>
                        </div>
                    </div>

                    <!-- Single Testimonial Area -->
                    <div class="single-testimonial-area text-center">
                        <span class="quote">"</span>
                        <h6>Nunc pulvinar molestie sem id blandit. Nunc venenatis interdum mollis. Aliquam finibus nulla quam, a iaculis justo finibus non. Suspendisse in fermentum nunc.Nunc pulvinar molestie sem id blandit. Nunc venenatis interdum mollis. </h6>
                        <div class="testimonial-info d-flex align-items-center justify-content-center">
                            <div class="tes-thumbnail">
                                <img src="{{asset('public/frontend/images/bg-img/tes-1.jpg')}}" alt="">
                            </div>
                            <div class="testi-data">
                                <p>Michelle Williams</p>
                                <span>Client, Los Angeles</span>
                            </div>
                        </div>
                    </div>

                    <!-- Single Testimonial Area -->
                    <div class="single-testimonial-area text-center">
                        <span class="quote">"</span>
                        <h6>Nunc pulvinar molestie sem id blandit. Nunc venenatis interdum mollis. Aliquam finibus nulla quam, a iaculis justo finibus non. Suspendisse in fermentum nunc.Nunc pulvinar molestie sem id blandit. Nunc venenatis interdum mollis. </h6>
                        <div class="testimonial-info d-flex align-items-center justify-content-center">
                            <div class="tes-thumbnail">
                                <img src="{{asset('public/frontend/images/bg-img/tes-1.jpg')}}" alt="">
                            </div>
                            <div class="testi-data">
                                <p>Michelle Williams</p>
                                <span>Client, Los Angeles</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<!-- ****** Popular Brands Area End ****** -->
@endsection