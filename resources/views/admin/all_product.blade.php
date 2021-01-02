@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
    $(document).ready(function() {
    });
    function btn_remove(product_id) {
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
                    url:"{{ url('delete-product') }}",
                    method:"GET",
                    data:{product_id:product_id},
                    success:function(data){ 
                        if(data) {
                            $('#product_'+product_id).remove();
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
    function addParam(key, value) {
        const urlParams = new URLSearchParams(window.location.search);

        urlParams.set(key, value);
        return urlParams;
    }
    function deleteParam(key) {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.delete(key);
      return urlParams;
    }
    function selectCategory(category_id) {
      if(category_id!=0) 
      {
        window.location.search = addParam('category', category_id);
      }
      else 
      {
        window.location.search = deleteParam('category');
      }
    }
</script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ SẢN PHẨM
    </div>
    <div class="row w3-res-tb">
      <div class="form-group form-inline col-sm-2 m-b-xs inline">
        <select onchange="selectCategory(this.value)" class=" form-control w-sm inline v-middle">
          <option value="0">Tất cả</option>
          @foreach($all_category as $category)
          <option @if(isset($_GET['category'])&&$_GET['category']==$category->category_id) selected @endif value="{{$category->category_id}}">{{$category->category_name}}</option>
          @endforeach
        </select>
        <button class="btn btn-success">Duyệt</button>                
      </div>
      <div class="col-sm-3">
        <div class="form-group form-inline">
          <input type="text" class="input-sm form-control" id="search_text" placeholder="Tìm kiếm">
          <span class="input-group-btn">
            <button class="btn btn-success" onclick="window.location.search = addParam('search', $('#search_text').val());" type="button">Tìm</button>
          </span>
        </div>
      </div>
      <div class="col-sm-3">
        @if(isset($_GET['search'])&&$_GET['search'])
          <h4>Tìm kiếm: {{$_GET['search']}}</h4>
        @endif
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Hiển thị</th>
            <th>Ngày tạo</th>
            <th>Lần thay đổi cuối</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_product as $key => $product)
          <tr id="product_{{$product->product_id}}">
            <td><a href="">{{ $product->product_name }}</a></td>
            <td><a class="text-ellipsis" href="storage/app/<?php echo $product->product_img; ?>">{{ $product->product_img }}</a></td>
            <td><span class="text-ellipsis">
                <?php
                    if($product->product_status==1) {
                        echo '<a href="'.URL::to('/unactive-product/'.$product->product_id).'" class="fa fa-eye fa-2x text-success"></a>';
                       
                    } else {
                        echo '<a href="'.URL::to('/active-product/'.$product->product_id).'" class="fa fa-eye-slash fa-2x text-danger"></a>';
                    }
                ?>
            </span></td>
            <td><span class="text-ellipsis">{{ $product->created_at }}</span></td>
            <td><span class="text-ellipsis">{{ $product->updated_at }}</span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$product->product_id)}}"><i class="fa fa-edit fa-2x text-success text-active"></i></a>
            </td>
            <td>
              <a onclick="btn_remove(<?php echo $product->product_id;?>)" href="#"><i class="fa fa-2x fa-remove text-danger text"></i></a>
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
          {{ $all_product->links() }}
        </div>
      </div>
        <?php 
            $update_product_message = Session::get('update_product_message');
            if($update_product_message) {
                echo "<div class='alert alert-success mt-5'>".$update_product_message."</div>";
            }
        ?>
    </footer>
  </div>
</div>
@endsection