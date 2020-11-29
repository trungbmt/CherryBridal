@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
    $(document).ready(function() {
    });
    function btn_remove(tag_id) {
        Swal.fire({
          title: 'Bạn có chắc chắn muốn xoá?',
          text: "Sau khi xoá sẽ không thể khôi phục!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Đồng ý!',
          cancelButtonText: 'Huỷ bỏ!'
        }).then((result) => {
          if (result.isConfirmed) {
                $.ajax({
                    url:"{{ url('delete-tag') }}",
                    method:"GET",
                    data:{tag_id:tag_id},
                    success:function(data){ 
                        if(data) {
                            $('#tag_'+tag_id).remove();
                            Swal.fire(
                              'Đã xoá!',
                              '',
                              'success'
                            )
                        }
                    }
                });
          }
        })
    };
</script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ TAG
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tag</th>
            <th>Trạng thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_tag as $key => $tag)
          <tr id="tag_{{$tag->tag_id}}">
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $tag->tag_text }}</td>
            <td><span class="text-ellipsis">
                <?php
                    if($tag->tag_status==1) {
                        echo '<a href="'.URL::to('/unactive-tag/'.$tag->tag_id).'" class="fa fa-eye fa-2x text-success"></a>';
                       
                    } else {
                        echo '<a href="'.URL::to('/active-tag/'.$tag->tag_id).'" class="fa fa-eye-slash fa-2x text-danger"></a>';
                    }
                ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-tag/'.$tag->tag_id)}}"><i class="fa fa-edit fa-2x text-success text-active"></i></a>
            </td>
            <td>
              <a onclick="btn_remove(<?php echo $tag->tag_id;?>)" href="#"><i class="fa fa-2x fa-remove text-danger text"></i></a>
            </td>
          </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 15 items per page</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          {{ $all_tag->links() }}
        </div>
      </div>
        <?php 
            $update_category_message = Session::get('update_category_message');
            if($update_category_message) {
                echo "<div class='alert alert-success mt-5'>".$update_category_message."</div>";
            }
        ?>
    </footer>
  </div>
</div>
@endsection