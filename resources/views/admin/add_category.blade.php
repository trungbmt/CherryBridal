@extends('admin.admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    THÊM DANH MỤC

                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-category')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="category_name">Tên danh mục</label>
                            <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Mô tả</label>
                            <textarea style="resize: none" name="category_desc" class="form-control" id="category_desc" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_status">Trạng thái</label>
                            <select name="category_status" id="category_status" class="form-control">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_img">Ảnh danh mục</label>
                            <input type="file" name="category_img" id="category_img">
                            <p class="help-block">Chọn ảnh có kích thước phù hợp.</p>
                        </div>
                        <button type="submit" name="add_category" class="btn btn-info">THÊM DANH MỤC</button>

                        <?php 
                            $add_category_message = Session::get('add_category_message');
                            if($add_category_message) {
                                echo "<div class='alert alert-success mt-5'>".$add_category_message."</div>";
                                Session::put('add_category_message', null);
                            }
                        ?>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection