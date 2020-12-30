@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
    function btn_remove(comment_id) {
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
                    url:"{{ url('delete-comment') }}",
                    method:"GET",
                    data:{comment_id:comment_id},
                    success:function(data){ 
                        if(data) {
                            $('#comment_'+comment_id).remove();
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
    $( document ).ready(function() {
      $('.reply-comment').click(async function(){
        var id = $(this).data('id');
        var product_id = $(this).data('product_id');
        const { value: text } = await Swal.fire({
          html: 'Các trả lời trước đó: '
                +$('#list_reply_'+id).html(),
          input: 'textarea',
          inputLabel: 'Bình luận',
          inputPlaceholder: 'Nhập trả lời của bạn vào đây...',
          inputAttributes: {
            'aria-label': 'Type your message here'
          },
          showCancelButton: true
        })

        if (text) {
          $.ajax({
            url:"{{ url('add-reply-comment') }}",
            method:"GET",
            data:{content:text, reply_id:id, product_id: product_id},
            success:function(data){ 
                if(data) {
                  Swal.fire(
                    'Done!',
                    '',
                    'success'
                  )
                } 
            }
          });
        };
      });
    });
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
      </select>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Ngày bình luận</th>
            <th>Người bình luận</th>
            <th>Sản phẩm</th>
            <th>Nội dung bình luận</th>
            <th style="width:30px;"></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_comment as $key => $comment)
            <tr id="comment_{{$comment->id}}">
              <td>{{ $comment->created_at }}</td>
              <td>{{$comment->user()->username}}</td>
              <td>{{$comment->product()->product_name}}</td>
              <td>
                {{$comment->content}}
              </td>
              <td>
                <a href="#" data-product_id='{{$comment->product()->product_id}}' data-id='{{$comment->id}}' class="btn btn-success reply-comment">TRẢ LỜI</a>
                <div id="list_reply_{{$comment->id}}" style="display: none">
                  @foreach($comment->replies()->get() as $reply)
                    <p><strong class="
                      @if($reply->user()->hasRole('ADMIN'))
                      text-danger
                      @endif
                      ">{{$reply->user()->username}}</strong>: {{$reply->content}}</p>
                  @endforeach
                </div>
              </td>
              <td>
                <a onclick="btn_remove({{$comment->id}})" href="#"><i class="fa fa-2x fa-remove text-danger text"></i></a>
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
          {{ $all_comment->links() }}
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection