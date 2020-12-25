@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
    $(document).ready(function() {
      $('.order_status').change(function(){
        let order_id = $(this).data('id');
        let order_status = $(this).val();
        $.ajax({
            url:"{{ url('update-order-status') }}",
            method:"GET",
            data:{order_id:order_id, order_status:order_status},
            success:function(data){ 
              //do something
            }
        });
      });
    });
    function btn_remove(order_id) {
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
                    url:"{{ url('delete-order') }}",
                    method:"GET",
                    data:{order_id:order_id},
                    success:function(data){ 
                        if(data) {
                            $('#order_'+order_id).remove();
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
      LIỆT KÊ ĐƠN HÀNG
    </div>
    <div class="row w3-res-tb ml-2">
      <h6>LỌC</h6>
      <label class="ml-5">Trạng thái</label>
      <select onchange="location= this.value;" id="status_filter" class="ml-2">
        <option @if(isset($_GET['status'])) selected @endif value="{{request()->fullUrlWithQuery(['status' => 2])}}">Tất cả</option>
        <option @if(isset($_GET['status'])&&$_GET['status']==0) selected @endif value="{{request()->fullUrlWithQuery(['status' => 0])}}">Đang xử lí</option>
        <option @if(isset($_GET['status'])&&$_GET['status']==-1) selected @endif value="{{request()->fullUrlWithQuery(['status' => -1])}}">Đã huỷ đơn</option>
        <option @if(isset($_GET['status'])&&$_GET['status']==1) selected @endif value="{{request()->fullUrlWithQuery(['status' => 1])}}">Đã giao hàng</option>
      </select>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ngày đặt</th>
            <th>Sản phẩm</th>
            <th>Tình trạng đơn hàng</th>
            <th>Khách hàng</th>
            <th>Thành tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_order as $key => $order)
            <tr id="order_{{$order->order_id}}">
              <td>{{ $order->order_id }}</td>
              <td>{{ $order->created_at }}</td>
              <td>
                @foreach($order->items()->get() as $item)
                    <p>
                        <h8>{{$item->product()->product_name}}</h8>
                        <span> - Size: {{$item->get_product_detail()->product_size}}</span>
                        <span> (x{{$item->quantity}})</span>
                    </p>
                @endforeach
              </td>
              <td class="border">
                <select class="order_status" data-id='{{$order->order_id}}'>
                  <option {{$order->order_status==0?'selected':''}} value="0">Đang xử lí</option>
                  <option {{$order->order_status==-1?'selected':''}} value="-1">Đã huỷ đơn</option>
                  <option {{$order->order_status==1?'selected':''}} value="1">Đã giao hàng</option>
                </select>
              </td>
              <td class="border">
                <p>Họ và tên: {{$order->order_full_name}}</p>
                <p>Số điện thoại: {{$order->order_phone}}</p>
                <p>Địa chỉ: {{$order->order_city}}, {{$order->order_province}}, {{$order->order_address}}</p>
              </td>
              <td class="border">{{$order->price_formated()}}</td>
              <td>
                <a onclick="btn_remove({{$order->order_id}})" href="#"><i class="fa fa-2x fa-remove text-danger text"></i></a>
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
          {{ $all_order->links() }}
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection