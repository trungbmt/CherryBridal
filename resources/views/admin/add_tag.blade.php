@extends('admin.admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    THÊM TAG

                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-tag')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="tag_text">TAG</label>
                            <input type="text" name="tag_text" class="form-control" id="tag_text" placeholder="Thiết kế tag">
                        </div>
                        <div class="form-group">
                            <label for="tag_status">Trạng thái</label>
                            <select name="tag_status" id="tag_status" class="form-control">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_tag" class="btn btn-info">THÊM TAG</button>

                        <?php 
                            $add_tag_message = Session::get('add_tag_message');
                            if($add_tag_message) {
                                echo "<div class='alert alert-success mt-5'>".$add_tag_message."</div>";
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
        CKEDITOR.replace('tag_text');
    });
</script>
@endsection