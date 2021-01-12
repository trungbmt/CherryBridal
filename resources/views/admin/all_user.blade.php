@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
    $(document).ready(function() {

    });

    async function change_password(user_id) {
        const { value: password } = await Swal.fire({
          title: 'Nhập mật khẩu mới',
          input: 'password',
          inputLabel: 'Mật khẩu',
          inputPlaceholder: 'Nhập mật khẩu mới',
        })

        if (password) {
          $.ajax({
              url:"{{ url('update-password') }}",
              method:"post",
              data:{user_id:user_id, password: password, _token: '{{csrf_token()}}'},
              success:function(data){ 
                  if(data) {
                      Swal.fire(
                        'Đã đổi mật khẩu!',
                        '',
                        'success'
                      )
                  }
              }
          });
        }
    }
    function addParam(key, value) {
        const urlParams = new URLSearchParams(window.location.search);

        urlParams.set(key, value);
        return urlParams;
    }
    function btn_remove(user_id) {
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
                    url:"{{ url('delete-user') }}",
                    method:"GET",
                    data:{user_id:user_id},
                    success:function(data){ 
                        if(data) {
                            $('#user_'+user_id).remove();
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
    function change_role(user_id, role) {
      Swal.fire({
          title: 'Bạn có chắc chắn muốn thay đổi quyền của người dùng này?',
          text: "Nếu nhầm lẫn sẽ rất nguy hiểm cho hệ thống!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Đồng ý!',
          cancelButtonText: 'Huỷ bỏ!'
        }).then((result) => {
          if (result.isConfirmed) {
                $.ajax({
                    url:"{{ url('update-role') }}",
                    method:"POST",
                    data:{user_id:user_id, role:role, _token: '{{csrf_token()}}'},
                    success:function(data){ 
                        if(data) {
                            Swal.fire(
                              'Thay đổi thành công!',
                              '',
                              'success'
                            )
                        }
                    }
                });
          }
        })
    }
</script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      LIỆT KÊ TÀI KHOẢN NGƯỜI DÙNG
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-3">
        <div class="form-group form-inline">
          <input type="text" id="search_text" class="input-sm form-control" placeholder="Tìm kiếm">
          <span class="input-group-btn">
            <button class="btn btn-success" onclick="window.location.search = addParam('search', $('#search_text').val());" type="button">Tìm</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ngày khởi tạo</th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Loại người dùng</th>
            <th>Quyền</th>
            <th style="width:30px;"></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_user as $key => $user)
          <tr id="user_{{$user->id}}">
            <td><a href="">{{ $user->id }}</a></td>
            <td><a href="">{{ $user->created_at }}</a></td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if(!$user->provider)
                Trong hệ thống
              @else
                {{$user->provider}}
              @endif
            </td>
            <td>
              <select onchange="change_role({{$user->id}}, this.value)">
                <option value="0">Người dùng</option>
                <option {{$user->hasRole('ADMIN')?'selected':''}} value="1">Người quản trị</option>
              </select>
            </td>
            <td>
              <a href="#" onclick="change_password({{$user->id}})" class="btn btn-success">ĐỔI MẬT KHẨU</i></a>
            </td>
            <td>
              <a onclick="btn_remove({{$user->id}})" class="btn btn-danger" href="#">XOÁ</i></a>
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
          {{ $all_user->links() }}
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection