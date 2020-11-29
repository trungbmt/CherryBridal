@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
    $(document).ready(function() {
    });
    function btn_remove(category_id) {
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
                    url:"{{ url('delete-category') }}",
                    method:"GET",
                    data:{category_id:category_id},
                    success:function(data){ 
                        if(data) {
                            $('#category_'+category_id).remove();
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
      LIỆT KÊ DANH MỤC
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
            <th>Tên danh mục</th>
            <th>Ảnh</th>
            <th>Hiển thị</th>
            <th>Ngày tạo</th>
            <th>Lần thay đổi cuối</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_category as $key => $category)
          <tr id="category_{{$category->category_id}}">
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $category->category_name }}</td>
            <td><a class="text-ellipsis" href="storage/app/<?php echo $category->category_img; ?>">{{ $category->category_img }}</a></td>
            <td><span class="text-ellipsis">
                <?php
                    if($category->category_status==1) {
                        echo '<a href="'.URL::to('/unactive-category/'.$category->category_id).'" class="fa fa-eye fa-2x text-success"></a>';
                       
                    } else {
                        echo '<a href="'.URL::to('/active-category/'.$category->category_id).'" class="fa fa-eye-slash fa-2x text-danger"></a>';
                    }
                ?>
            </span></td>
            <td><span class="text-ellipsis">{{ $category->created_at }}</span></td>
            <td><span class="text-ellipsis">{{ $category->updated_at }}</span></td>
            <td>
              <a href="{{URL::to('/edit-category/'.$category->category_id)}}"><i class="fa fa-edit fa-2x text-success text-active"></i></a>
            </td>
            <td>
              <a onclick="btn_remove(<?php echo $category->category_id;?>)" href="#"><i class="fa fa-2x fa-remove text-danger text"></i></a>
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
          {{ $all_category->links() }}
        </div>
      </div>
        <?php 
            $update_category_message = Session::get('update_category_message');
            if($update_category_message) {
                echo "<div class='alert alert-success mt-5'>".$update_category_message."</div>";
                Session::put('update_category_message', null);
            }
        ?>
    </footer>
  </div>
</div>
@endsection