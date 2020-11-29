@extends('admin.admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    THÊM SẢN PHẨM

                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Mô tả</label>
                            <textarea style="resize: none" name="product_desc" class="form-control" id="product_desc" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_status">Trạng thái</label>
                            <select name="product_status" id="product_status" class="form-control">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_category">Danh mục</label>
                            <select name="product_category" id="product_category" class="form-control">
                                @foreach($all_category as $category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_tag">Tag</label>
                            <select name="product_tag" id="product_tag" class="form-control">
                                <option value="0">Không</option>
                                @foreach($all_tag as $tag)
                                <option value="{{$tag->tag_id}}">{{$tag->tag_text}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="size-price-number">
                            <div id="size-price-number-append">
                                <div class="row border-success rounded mb-3" style="border: 1px solid; margin:0px;">
                                    <div class="form-group col-sm-4">
                                        <label for="size[]">Size</label>
                                        <input name="size[]" class="form-control" type="text" placeholder="Size">
                                    </div>
                                    <div class="form-group col-sm-4" id="price-div">
                                        <label for="price[]">Giá</label>
                                        <input name="price[]" type="number" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-4" id="price-div">
                                        <label for="amount[]">Số lượng</label>
                                        <input name="amount[]" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-outline-secondary" id="btnAddSize" type="button">Thêm size</button>
                        <br><br>
                        <div class="form-group">
                            <label for="product_img">Ảnh sản phẩm</label>
                            <input type="file" name="product_img" id="product_img">
                            <p class="help-block">Chọn ảnh có kích thước phù hợp.</p>
                            <img src="#" alt="" id="preview_img" style="width: 100%">
                        </div>
                        <button type="submit" name="add_porduct" class="btn btn-info">THÊM SẢN PHẨM</button>
                        <?php 
                            $add_product_message = Session::get('add_product_message');
                            if($add_product_message) {
                                echo "<div class='alert alert-success mt-5'>".$add_product_message."</div>";
                                Session::put('add_product_message', null);
                            }
                        ?>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#btnAddSize").click(function(){
                $("#size-price-number").append($("#size-price-number-append").html());
            });
        });
    </script>

    <script src="{{('public/backend/js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
          CKEDITOR.replace('product_desc');
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#product_img").change(function() {
          readURL(this);
        });
    </script>       
@endsection