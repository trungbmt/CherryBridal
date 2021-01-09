@extends('user.layout')
@section('content')
<!-- ****** Welcome Slides Area Start ****** -->
<section class="welcome_area">
    <div class="welcome_slides owl-carousel">
        <!-- Single Slide Start -->
        <div class="single_slide height-800 bg-img background-overlay" style="background-image: url({{asset('public/frontend/images/bg-img/slide-1.jpg')}});">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="welcome_slide_text">
                            <h6 data-animation="bounceInDown" data-delay="0" data-duration="500ms">* Miễn phí vận chuyển trong hôm nay</h6>
                            <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">Váy cưới</h2>
                            <a href="#" class="btn karl-btn" data-animation="fadeInUp" data-delay="1s" data-duration="500ms">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Slide Start -->
        <div class="single_slide height-800 bg-img background-overlay" style="background-image: url({{asset('public/frontend/images/bg-img/slide-2.jpg')}});">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="welcome_slide_text">
                            <h6 data-animation="fadeInDown" data-delay="0" data-duration="500ms">* Miễn phí vận chuyển trong hôm nay</h6>
                            <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">Vest Nam</h2>
                            <a href="#" class="btn karl-btn" data-animation="fadeInLeftBig" data-delay="1s" data-duration="500ms">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Slide Start -->
        <div class="single_slide height-800 bg-img background-overlay" style="background-image: url({{asset('public/frontend/images/bg-img/slide-3.jpg')}});">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="welcome_slide_text">
                            <h6 data-animation="fadeInDown" data-delay="0" data-duration="500ms">* Miễn phí vận chuyển trong hôm nay</h6>
                            <h2 data-animation="bounceInDown" data-delay="500ms" data-duration="500ms">Bộ sư tập ảnh</h2>
                            <a href="#" class="btn karl-btn" data-animation="fadeInRightBig" data-delay="1s" data-duration="500ms">Xem ngay</a>
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
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($product->rating_value()-$i>=0)
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        @if(($product->rating_value() - (float)$i < 1) && ($product->rating_value() - (float)$i > 0))
                                                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                                            <?php $i++; ?>
                                                        @endif
                                                    @else
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @endif
                                                @endfor
                                                @if(count($product->rates()->get())==0)
                                                    <span class="text-muted">(chưa có đánh giá)</span>
                                                @endif
                                            </div>
                                            <h5 class="price" id="price_{{$product->product_id}}">{{$product->get_lowest_price()}}<span>{{$product->get_fake_price()}}</span></h5>
                                            <p class="available">Có sẵn: <span id="available_number_{{$product->product_id}}" class="text-muted"></span><span class="text-muted"> In Stock</span></p>
                                            <div class="widget size mt-5">
                                                <h6 class="widget-title">Size</h6>
                                                <div class="widget-desc">
                                                    <ul>
                                                        @foreach($product->details as $detail)
                                                            <li>
                                                                <a onclick="
                                                                click_size(this, {{$detail->product_amount}}, {{$product->product_id}}, {{$detail->detail_id}}, '{{$detail->get_price_formated()}}')
                                                                " class="border border-dark" href="#">{{$detail->product_size}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="{{URL::to('/item/'.$product->product_id)}}">Xem chi tiết sản phẩm</a>
                                        </div>
                                        <!-- Add to Cart Form -->
                                        <div class="cart">
                                            <div class="quantity">
                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty_{{$product->product_id}}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                                <input type="number" class="qty-text" id="qty_{{$product->product_id}}" step="1" min="1" max="12" name="quantity" value="1">

                                                <span class="qty-plus" onclick="var effect = document.getElementById('qty_{{$product->product_id}}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                            <button id="fast_cart_{{$product->product_id}}" onclick="fast_add_to_cart(this, {{$product->product_id}})" data-detail='0' class="btn btn-danger">Thêm vào giỏ hàng</button>
                                            <!-- Wishlist -->
                                            <div class="modal_pro_wishlist">
                                                <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                            </div>
                                            <!-- Compare -->
                                            <div class="modal_pro_compare">
                                                <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                            </div>
                                        </div>

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
                            <a href="#" class="add-to-cart-btn" data-toggle="modal" data-target="#quickview_{{$product->product_id}}">ADD TO CART</a>
                        </div>
                    </div>
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
                    <h2>ĐẾN VÀ TƯ VẤN <span class="karl-level">Hot</span></h2>
                    <div class="offer-product-price">
                        <h3>MIỄN PHÍ</h3>
                    </div>
                    <a href="https://www.facebook.com/phamductrungbmt/" target="_blank" class="btn karl-btn mt-30">ĐẶT LỊCH NGAY</a>
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
                    <h2>Phản hồi của khách</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="karl-testimonials-slides owl-carousel">

                    <!-- Single Testimonial Area -->
                    <div class="single-testimonial-area text-center">
                        <span class="quote">"</span>
                        <h6>The product quality here is very good, the fabric of the wedding dress is very smooth, the shop's customer service is perfect
                        </h6>
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
                        <h6>여기의 제품 품질이 매우 좋고 웨딩 드레스 원단이 매우 부드럽고 가게 고객 서비스가 완벽합니다.</h6>
                        <div class="testimonial-info d-flex align-items-center justify-content-center">
                            <div class="tes-thumbnail">
                                <img src="{{asset('public/frontend/images/bg-img/tes-2.jpg')}}" alt="">
                            </div>
                            <div class="testi-data">
                                <p>Chuwŏn</p>
                                <span>Client, Korean</span>
                            </div>
                        </div>
                    </div>

                    <!-- Single Testimonial Area -->
                    <div class="single-testimonial-area text-center">
                        <span class="quote">"</span>
                        <h6>Váy cưới ở đây rất là xịn, mình cưới 3 lần rồi và lần nào cũng mua váy cưới và áo vest ở đây, mình còn được giảm giá vì là học sinh nữa, không còn gì tuyệt hơn.</h6>
                        <div class="testimonial-info d-flex align-items-center justify-content-center">
                            <div class="tes-thumbnail">
                                <img src="{{asset('public/frontend/images/bg-img/tes-3.jpg')}}" alt="">
                            </div>
                            <div class="testi-data">
                                <p>Nguyễn Linh Chi</p>
                                <span>Client, Vietnam</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<script type="text/javascript">
    function add_to_cart(product_id, detail_id, amount) {
        $.ajax({
            url:"{{ url('add-to-cart') }}",
            method:"GET",
            data:{product_id:product_id, detail_id:detail_id, amount:amount},
            success:function(data){ 
                if(data) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Thêm thành công!',
                      timer: 1000
                    })
                }
            },
            error: function (jqXHR, exception) {
                if(jqXHR.status==401) 
                {
                    location.href = "{{URL::to('/login')}}";
                }
            }
        });
    };
    function click_size(source, amount, product_id, detail_id, price) {
        $(source).parent().parent().find('*').css("background-color","white");
        $(source).parent().parent().find('*').css("color","black");
        $(source).css("background-color","#ff084e");
        $(source).css("color","#fff");
        $('#available_number_'+product_id).text(amount);
        $('#price_'+product_id).text(price);

        $('#fast_cart_'+product_id).data('detail', detail_id);

        
    }
    function fast_add_to_cart(source, product_id) 
    {
        let detail_id = $(source).data('detail');
        if(detail_id==0) 
        {
            Swal.fire({
              icon: 'info',
              title: 'Vui lòng chọn size trước!',
            })
        } else 
        {

            let amount = $('#qty_'+product_id).val();
            add_to_cart(product_id, detail_id, amount);
        }
    }
</script>
<!-- ****** Popular Brands Area End ****** -->
@endsection