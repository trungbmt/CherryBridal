@extends('user.layout')
@section('content')
<div class="section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart-table clearfix">
                    @if(count($all_order))
                    <table class="text-justify table table-responsive">
                    <thead style="background-color: #ff99bb">
                        <tr class="border">
                            <th class="border">ID Đơn Hàng</th>
                            <th class="border">Ngày Đặt</th>
                            <th class="border">Trạng Thái</th>
                            <th class="border">Sản Phẩm</th>
                            <th class="border">Thông Tin Khách</th>
                            <th class="border">Thành Tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_order as $order)
                            <tr class="border">
                                <td class="border"><span>{{$order->order_id}}</span></td>
                                <td class="border"><span>{{$order->created_at}}</span></td>
                                <td class="border">
                                    <span>
                                        @switch($order->order_status)
                                            @case(-1)
                                                Đã huỷ đơn
                                                @break
                                            @case(0)
                                                Đang xử lí
                                                @break
                                            @case(1)
                                                Đã giao hàng
                                                @break
                                            @default
                                                Không xác định
                                        @endswitch
                                    </span>
                                </td>
                                <td class="border">
                                    @foreach($order->items()->get() as $item)
                                        <p>
                                            <h8>{{$item->product()->product_name}}</h8>
                                            <span> - Size: {{$item->get_product_detail()->product_size}}</span>
                                            <span> (x{{$item->quantity}})</span>
                                        </p>
                                    @endforeach
                                </td>
                                <td class="border">
                                    <p>Họ và tên: {{$order->order_full_name}}</p>
                                    <p>Số điện thoại: {{$order->order_phone}}</p>
                                    <p>Địa chỉ: {{$order->order_city}}, {{$order->order_province}}, {{$order->order_address}}</p>
                                </td>
                                <td class="border">{{$order->price_formated()}}</td>
                                <td class="border">
                                    @if($order->order_status==0)
                                        <a href="{{URL::to('order-cancel/'.$order->order_id)}}" class="btn btn-danger">HUỶ ĐƠN</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="container d-flex justify-content-center">
                    <h2>KHÔNG CÓ ĐƠN HÀNG NÀO</h2>
                </div>
                <div class="container d-flex justify-content-center">
                    <img class="img-fluid" src="https://i1.wp.com/www.huratips.com/wp-content/uploads/2019/04/empty-cart.png?fit=603%2C288&ssl=1">
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection