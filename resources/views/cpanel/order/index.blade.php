@extends('cpanel.layouts.app')
@section('title', 'Product')
@section('content')
<div class="wrap-main"> 
	<p>#ORDER</p>
	@if($orders)
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Order ID</th>
					<th width="15%" class="text-center">Name</th>
					<th>Address</th>  
					<th>Phone</th>  
					<th width="15%" class="text-center">Order Status</th>
					<th width="10%" class="text-center">Price</th>
					<th width="10%" class="text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if($orders->total() > 0)
					@foreach($orders as $order)
						<tr>
							<td class="text-center">#{{ $order['order_id'] }}</td>
							<td class="text-center">{{ $order['name'] }}</td>
							<td> 
								@php($address = json_decode($order['address'] ))
								{{  $address->address.' - '.  $address->province.' - '.$address->county }}
							</td>
							<td>{{ $order['phone'] }}</td>
							<td class="text-center">
								@if($order['order_status'] == 0)
									<span class="badge badge-secondary">Chờ xác nhận</span>
								@elseif($order['order_status'] == 1)
									<span class="badge badge-primary">Đã xác nhận</span> 
								@elseif($order['order_status'] == 2) 
									<span class="badge badge-warning">Đang giao hàng</span> 
								@elseif($order['order_status'] == 3)
									<span class="badge badge-success">Giao hàng thành công</span> 
								@elseif($order['order_status'] == 4)
									<span class="badge badge-danger">Giao hàng thất bại</span> 
								@endif
							</td>
							<td class="text-center">{{ number_format($order['total_amount'],0,',','.') }} đ</td>
							<td><a href="{{ route('order-detail',$order['id']) }}" >View Detail</a></td> 
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="6">Không tìm thấy dữ liệu.</td>
					</tr>
				@endif
			</tbody>
		</table>
		{{ $orders->links() }}
	@endif
</div> 
@endsection