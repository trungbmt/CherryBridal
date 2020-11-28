@extends('admin.admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    CẬP NHẬT TAG

                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-tag/'.$tag->tag_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="tag_text">Tag</label>
                            <input type="text" name="tag_text" class="form-control" id="tag_text" placeholder="Thiết kế tag" value="{{$tag->tag_text}}">
                        </div>
                        <button type="submit" class="btn btn-info">CẬP NHẬT TAG</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection