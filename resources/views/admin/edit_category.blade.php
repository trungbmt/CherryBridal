@extends('admin.admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    CẬP NHẬT DANH MỤC

                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-category/'.$category->category_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="category_name">Tên danh mục</label>
                            <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Tên danh mục" value="{{$category->category_name}}">
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Mô tả</label>
                            <textarea style="resize: none" name="category_desc" class="form-control" id="category_desc" placeholder="Mô tả">{{$category->category_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_img">Ảnh danh mục: </label><a href="{{URL::to('/storage/app/'.$category->category_img)}}">&nbsp;{{$category->category_img}}</a>
                            <input type="file" name="category_img" id="category_img">
                            <p class="help-block">Chọn ảnh có kích thước phù hợp.</p>
                        </div>
                        <button type="submit" name="add_category" class="btn btn-info">CẬP NHẬT DANH MỤC</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
<script type="text/javascript">
    
    $(document).ready(function(){
        CKEDITOR.replace('category_desc');
    });
</script>
@endsection