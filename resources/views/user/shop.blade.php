@extends('user.layout')
@section('content')

<script src="{{asset('public/frontend/js/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">

    $( document ).ready(function() {

        $('.slider-range-price').each(function () {
            var min = jQuery(this).data('min');
            var max = jQuery(this).data('max');
            var unit = jQuery(this).data('unit');
            var value_min = jQuery(this).data('value-min');
            var value_max = jQuery(this).data('value-max');
            var label_result = jQuery(this).data('label-result');
            var t = $(this);
            $(this).slider({
                range: true,
                min: min,
                max: max,
                values: [value_min, value_max],
                slide: function (event, ui) {
                    var result = label_result + " " + unit + ui.values[0] + ' - ' + unit + ui.values[1];
                    t.closest('.slider-range').find('.range-price').html(result);
                }
            });
        });
    });

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
            }
        });
    };
</script>
<!-- ****** Quick View Modal Area Start ****** -->
@foreach($all_product as $product)
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
                                        <a href="{{URL::to('/item/'.$product->product_id)}}">Xem chi tiết sản phẩm</a>
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
<!-- ****** Quick View Modal Area End ****** -->

<section class="shop_grid_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="shop_sidebar_area">
                   
                    <div class="widget catagory mb-50">
                        <!--  Side Nav  -->
                        <div class="nav-side-menu">
                            <h6 class="mb-0">Danh mục</h6>
                            <div class="menu-list">
                                <ul id="menu-content2" class="menu-content collapse out">
                                    <li>
                                        <a href="{{URL::to('shop')}}">Tất cả</a>
                                    </li>
                                    @foreach($all_category as $category) 
                                    <li>
                                        <a href="{{URL::to('shop/'.$category->category_id)}}">{{$category->category_name}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="widget price mb-50">
                        <h6 class="widget-title mb-30">Lọc theo giá</h6>
                        <div class="widget-desc">
                            <div class="slider-range">
                                <div data-min="0" data-max="10" data-unit="" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="0" data-value-max="10" data-label-result="Giá:">
                                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                </div>
                                <div>
                                    <span class="range-price">Giá: 0 - 10</span>
                                    <span class="widget-title">triệu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget color mb-70">
                        <h6 class="widget-title mb-30">Xếp theo</h6>
                        <div class="widget-desc">
                            <select onchange="location = this.value;">
                                <option 
                                    @if(isset($_GET['orderby'])&&$_GET['orderby']=='newest') 
                                        selected 
                                    @endif 
                                    value="{{request()->fullUrlWithQuery(['orderby' => 'newest'])}}">
                                    Mới nhất
                                </option>
                                <option 
                                    @if(isset($_GET['orderby'])&&$_GET['orderby']=='oldest') 
                                        selected 
                                    @endif value="{{request()->fullUrlWithQuery(['orderby' => 'oldest'])}}">
                                    Cũ nhất
                                </option>
                                <option 
                                    @if(isset($_GET['orderby'])&&$_GET['orderby']=='priceasc') 
                                        selected 
                                    @endif 
                                    value="{{request()->fullUrlWithQuery(['orderby' => 'priceasc'])}}">
                                    Giá tăng dần
                                </option>
                                <option 
                                    @if(isset($_GET['orderby'])&&$_GET['orderby']=='pricedesc') 
                                        selected 
                                    @endif 
                                    value="{{request()->fullUrlWithQuery(['orderby' => 'pricedesc'])}}">
                                    Giá giảm dần
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="widget size mb-50">
                        <h6 class="widget-title mb-30">Filter by Size</h6>
                        <div class="widget-desc">
                            <ul class="d-flex justify-content-between">
                                <li><a href="#">XS</a></li>
                                <li><a href="#">S</a></li>
                                <li><a href="#">M</a></li>
                                <li><a href="#">L</a></li>
                                <li><a href="#">XL</a></li>
                                <li><a href="#">XXL</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget recommended">
                        <h6 class="widget-title mb-30">Đề xuất</h6>

                        <div class="widget-desc">
                            @foreach($recommend_products as $product)
                                <!-- Single Recommended Product -->
                                <div class="single-recommended-product d-flex mb-30">
                                    <div class="single-recommended-thumb mr-3">
                                        <img src="{{asset('storage/app/'.$product->product_img)}}" alt="">
                                    </div>
                                    <div class="single-recommended-desc">
                                        <h6>{{$product->product_name}}</h6>
                                        <p>{{$product->get_lowest_price()}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-9">
                <div class="shop_grid_product_area">
                    <div class="row">
                        @foreach($all_product as $product)
                            <!-- Single gallery Item -->
                            <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="1s">
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
                                    <!-- Add to Cart -->{{-- 
                                    <a onclick="add_to_cart({{$product->product_id}})" class="add-to-cart-btn btn btn-outline-danger">THÊM VÀO GIỎ</a> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="shop_pagination_area wow fadeInUp" data-wow-delay="1.1s">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm">
                            {{ $all_product->links() }}
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

      