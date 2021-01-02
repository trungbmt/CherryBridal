@extends('admin.admin_layout')
@section('admin_content')
<script type="text/javascript">
	function format_vnd(number) {
		number = number.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
		return number;
	}
</script>
<!--main content start-->
		<div class="chart_agile">

            <div class="col-md-6 col-lg-6 chart_agile_left">
                <div class="chart_agile_top">
            		<h6>SẢN PHẨM NHẬP VỀ</h6>
                    <div class="chart_agile_bottom">
                        <div id="product_graph"></div>
                            <script>
                            var neg_data = [];
                            @foreach($list_data as $data)
                            	var ele = {"period": "{{$data['month']}}", "a": {{$data['products']}} }
                            	neg_data.push(ele);
                            @endforeach
                            Morris.Line({
                              element: 'product_graph',
                              data: neg_data,
                              xkey: 'period',
                              ykeys: ['a'],
                              labels: ['Sản phẩm'],
                              units: '',
                            });
                            </script>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 chart_agile_right">
                <div class="chart_agile_top">
            		<h6>ĐƠN ĐẶT HÀNG</h6>
                    <div class="chart_agile_bottom">
                        <div id="order_graph"></div>
                            <script>
                            var order_data = [];
                            @foreach($list_data as $data)
                            	var ele2 = {"period": "{{$data['month']}}", "a": {{$data['orders']}} }
                            	order_data.push(ele2);
                            @endforeach
                            Morris.Line({
                              element: 'order_graph',
                              data: order_data,
                              xkey: 'period',
                              ykeys: ['a'],
                              lineColors: ['green'],
                              labels: ['Đơn hàng'],
                              units: ''
                            });
                            </script>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 chart_agile_left">
                <div class="chart_agile_top">
            		<h6>NGƯỜI DÙNG MỚI ĐĂNG KÝ</h6>
                    <div class="chart_agile_bottom">
                        <div id="user_graph"></div>
                            <script>
                            var user_data = [];
                            @foreach($list_data as $data)
                            	var ele3 = {"period": "{{$data['month']}}", "user": {{$data['users']}} }
                            	user_data.push(ele3);
                            @endforeach
                            Morris.Line({
                              element: 'user_graph',
                              data: user_data,
                              xkey: 'period',
                              ykeys: ['user'],
                              lineColors: ['blue'],
                              labels: ['Người dùng'],
                              units: ''
                            });
                            </script>
                    </div>
                </div>
            </div>
			<div class="col-md-6 chart_agile_right">
				<div class="chart_agile_top">
            		<h6>THU NHẬP</h6>
					<div class="chart_agile_bottom">
						<div id="income_graph"></div>
						<script>
                            var income_data = [];
                            @foreach(array_reverse($list_data) as $data)
                            	var ele3 = 
                            	{
                            		"period": "{{$data['month']}}", 
                            		"income": {{$data['income']}}, 
                            		formatted: format_vnd({{$data['income']}}) 
                            	};
                            	income_data.push(ele3);
                            @endforeach
							Morris.Bar({
							  element: 'income_graph',
							  data: income_data,
							  xkey: 'period',
							  ykeys: ['income'],
                              labels: ['Thu nhập'],
							  formatter: function (x, data) { return data.formatted; }
							});
						</script>

					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>

@endsection