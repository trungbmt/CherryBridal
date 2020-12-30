@extends('user.layout')
@section('content')
<script type="text/javascript">
    var selected_detail;
    function click_size(price, amount, source, detail_id) {
        $('.price').text(price);
        $('.available_number').text(amount);
        $('#'+source.id).parent().parent().find('*').css("background-color","white");
        $('#'+source.id).parent().parent().find('*').css("color","black");
        $("#"+source.id).css("background-color","#ff084e");
        $("#"+source.id).css("color","#fff");

        
        selected_detail = detail_id;
    }
    function add_to_cart() {
        if(!selected_detail) {
            Swal.fire({
              icon: 'info',
              title: 'Vui lòng chọn size trước!',
            })
        } else 
        {
            let product_id = {{$product->product_id}};
            let detail_id = selected_detail;
            let amount = document.getElementById('qty').value;
            $.ajax({
                url:"{{ url('add-to-cart') }}",
                method:"GET",
                data:{product_id:product_id, detail_id:detail_id, amount:amount},
                success:function(data){ 
                    if(data) {
                        Swal.fire({
                          icon: 'success',
                          title: 'Thêm vào giỏ thành công!',
                          timer: 1500
                        })
                    } else {
                        location.href = "{{URL::to('/login')}}";
                    }
                }
            });
        }
    }

    function click_size(source, amount, product_id, detail_id) 
    {
        $(source).parent().parent().find('*').css("background-color","white");
        $(source).parent().parent().find('*').css("color","black");
        $(source).css("background-color","#ff084e");
        $(source).css("color","#fff");
        $('#available_number_'+product_id).text(amount);

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
            let amount = $('#qty_'+product_id).val();;
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
                    } else {
                        location.href = "{{URL::to('/login')}}";
                    }
                }
            });
        }
    }
    function add_comment() {
        if(!$('#comment_content').val()) {
            Swal.fire({
              icon: 'info',
              title: 'Vui lòng nhập bình luận!',
            })
        } else 
        {
            let content = $('#comment_content').val();
            let product_id = {{$product->product_id}};
            $.ajax({
                url:"{{ url('add-comment') }}",
                method:"GET",
                data:{product_id:product_id, content:content},
                success:function(data){ 
                    if(data) {
                        let string = '<div id="comment_'+data+'" class="mt-2">'+
                                    '<img style="width: 48px; height: 48px; display: inline;" src="{{asset('public/frontend/images/avatar.png')}}">'+
                                    '<h6 class="ml-2" style="display: inline;">{{Auth::check()?Auth::User()->username:'error'}}:</h6>'+
                                    '<p class="ml-2" style="display: inline">'+content+'</p>'+
                                    '</div>';
                        $('#all_comment').prepend(string);
                        $('#comment_content').val('');
                    } else {
                        location.href = "{{URL::to('/login')}}";
                    }
                }
            });
        }
    }
    function reply_append(element) {
        var id = element.dataset.comment;
        $('.reply-comment-input').remove();
        let string = 
                    '<div class="reply-comment-input row mb-5 col-lg-12" style="margin: 0">'+
                        '<div class="col-lg-10">'+
                            '<input class="form-control" type="text" id="reply_comment_content" name="">'+
                        '</div>'+
                        '<div class="col-lg-2">'+
                            '<button onclick="add_reply_comment('+id+')" class="btn btn-info">GỬI</button>'+
                        '</div>'+
                    '</div>';
        $('#comment_'+id).append(string);
    }
    function add_reply_comment(id){
        let content = $('#reply_comment_content').val();
        let product_id = {{$product->product_id}};
        let reply_id = id;
        $.ajax({
            url:"{{ url('add-reply-comment') }}",
            method:"GET",
            data:{product_id:product_id, content:content, reply_id:reply_id},
            success:function(data){ 
                if(data) {
                    $('#reply_comment_content').val('');
                } else {
                    location.href = "{{URL::to('/login')}}";
                }
            }
        });
    }
</script>
<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
<div class="breadcumb_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{URL::to('/shop/'.$category->category_id)}}">{{$category->category_name}}</a></li>
                    <li class="breadcrumb-item active">{{$product->product_name}}</li>
                </ol>
                <!-- btn -->
                <a href="{{URL::to('/shop/'.$category->category_id)}}" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Back to Category</a>
            </div>
        </div>
    </div>
</div>
<!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->

<!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
<section class="single_product_details_area section_padding_0_100">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                            <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url({{asset('storage/app/'.$product->product_img)}});">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url({{asset('storage/app/'.$product->product_img)}});">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="2" style="background-image: url({{asset('storage/app/'.$product->product_img)}});">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="3" style="background-image: url({{asset('storage/app/'.$product->product_img)}});">
                            </li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a class="gallery_img" href="{{asset('storage/app/'.$product->product_img)}}">
                                <img class="d-block w-100" src="{{asset('storage/app/'.$product->product_img)}}" alt="First slide">
                            </a>
                            </div>
                            <div class="carousel-item">
                                <a class="gallery_img" href="{{asset('storage/app/'.$product->product_img)}}">
                                <img class="d-block w-100" src="{{asset('storage/app/'.$product->product_img)}}" alt="Second slide">
                            </a>
                            </div>
                            <div class="carousel-item">
                                <a class="gallery_img" href="{{asset('storage/app/'.$product->product_img)}}">
                                <img class="d-block w-100" src="{{asset('storage/app/'.$product->product_img)}}" alt="Third slide">
                            </a>
                            </div>
                            <div class="carousel-item">
                                <a class="gallery_img" href="{{asset('storage/app/'.$product->product_img)}}">
                                <img class="d-block w-100" src="{{asset('storage/app/'.$product->product_img)}}" alt="Fourth slide">
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="single_product_desc">

                    <h4 class="title"><a href="#">{{$product->product_name}}</a></h4>

                    <h4 class="price">{{$product->get_lowest_price()}}</h4>

                    <p class="available">Có sẵn: <span class="text-muted available_number"></span><span class="text-muted"> In Stock</span></p>

                    <div class="single_product_ratings mb-15">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    </div>

                    <div class="widget size mb-50">
                        <h6 class="widget-title">Size</h6>
                        <div id="size_list" class="widget-desc">
                            <ul>
                                @foreach($product->details as $detail)
                                    <li><a id="detail_{{$detail->detail_id}}" href="#" onclick="click_size('{{$detail->get_price_formated()}}', {{$detail->product_amount}}, this, {{$detail->detail_id}})">{{$detail->product_size}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="cart clearfix mb-50 d-flex">
                        <div class="quantity">
                            <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                            <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        </div>
                        <button onclick="add_to_cart()" value="5" class="btn cart-submit d-block">Add to cart</button>
                    </div>

                    <div id="accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Information</a>
                                </h6>
                            </div>

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    {{$product->product_desc}}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Cart Details</a>
                                </h6>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quis in veritatis officia inventore, tempore provident dignissimos nemo, nulla quaerat. Quibusdam non, eos, voluptatem reprehenderit hic nam! Laboriosam, sapiente! Praesentium.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia magnam laborum eaque.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" role="tab" id="headingThree">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">shipping &amp; Returns</a>
                                </h6>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint repudiandae suscipit ab soluta delectus voluptate, vero vitae, tempore maxime rerum iste dolorem mollitia perferendis distinctio. Quibusdam laboriosam rerum distinctio. Repudiandae fugit odit, sequi id!</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae qui maxime consequatur laudantium temporibus ad et. A optio inventore deleniti ipsa.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- Comments --}}
            <div class="col-12 mt-5">
                <h3>BÌNH LUẬN</h3>
                <div class="row mb-5">
                    <div class="col-lg-10">
                        <input class="form-control" type="text" id="comment_content" name="">
                    </div>
                    <div class="col-lg-2">
                        <button onclick="add_comment()" class="btn btn-info">GỬI</button>
                    </div>
                </div>
                <div id="all_comment">
                    @foreach($product->comments()->get() as $comment)
                    <div id="comment_{{$comment->id}}" class="mt-2 row" style="margin: 0">
                        <img style="width: 48px; height: 48px; display: inline;" src="{{asset('public/frontend/images/avatar.png')}}"> 
                        <div class="col-lg-11 row">
                            <div class="col-lg-2 col-5 mt-1">
                                <h6 class="
                                @if($comment->user()->hasRole('ADMIN'))
                                    text-danger
                                @endif
                                " style="margin-bottom: 0px">
                                    {{$comment->user()->username}}:
                                </h6>
                                <span>
                                    {{$comment->content}}
                                </span>
                                @if($comment->replies()->count()>0)
                                    <a class="text-primary" href="#" onclick="
                                    $('#reply_view_{{$comment->id}}').css('display','block'); this.remove()
                                    ">
                                    Xem {{$comment->replies()->count()}} câu trả lời
                                    </a>
                                @endif
                                <div>
                                    <a data-comment='{{$comment->id}}' id="reply_comment_{{$comment->id}}" class="text-info" href="#" onclick="reply_append(this)">
                                    Trả lời
                                    </a>
                                </div>
                            </div>

                            <div style="display: none" id="reply_view_{{$comment->id}}" class="col-12">
                                @foreach($comment->replies()->get() as $reply)
                                    <div>
                                        <img style="width: 32px; height: 32px; display: inline;" src="{{asset('public/frontend/images/avatar.png')}}"> 
                                        <h7 class="
                                        @if($reply->user()->hasRole('ADMIN'))
                                            text-danger
                                        @endif  
                                        " style="margin-bottom: 0">
                                            {{$reply->user()->username}}:
                                        </h7>
                                        <span>{{$reply->content}}</span>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

<!-- ****** Quick View Modal Area Start ****** -->
@foreach($related_products as $product)
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
                                        <p class="available">Có sẵn: <span id="available_number_{{$product->product_id}}" class="text-muted"></span><span class="text-muted"> In Stock</span></p>
                                        <div class="widget size mt-5">
                                            <h6 class="widget-title">Size</h6>
                                            <div class="widget-desc">
                                                <ul>
                                                    @foreach($product->details as $detail)
                                                        <li>
                                                            <a onclick="
                                                            click_size(this, {{$detail->product_amount}}, {{$product->product_id}}, {{$detail->detail_id}})
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
<!-- ****** Quick View Modal Area End ****** -->

<section class="you_may_like_area clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading text-center">
                    <h2>SẢN PHẨM LIÊN QUAN</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="you_make_like_slider owl-carousel">
                    @foreach($related_products as $product)
                        <!-- Single gallery Item -->
                        <div class="single_gallery_item">
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection