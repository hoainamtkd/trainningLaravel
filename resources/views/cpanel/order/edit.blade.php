@extends('cpanel.layouts.app')
@section('title', 'Product')
@section('content')
<div class="wrap-main"> 
	<p><a href="{{ route('order') }}">Back</a></p>
	<p>#OrderID: {{ $orders['order_id'] }}</p>
	<p>
		@if($orders['order_status'] == 0)
			<span class="badge badge-secondary">Chờ xác nhận</span>
		@elseif($orders['order_status'] == 1) 
			<span class="badge badge-primary">Đã xác nhận</span> 
		@elseif($orders['order_status'] == 2) 
			<span class="badge badge-warning">Đang giao hàng</span> 
		@elseif($orders['order_status'] == 3)
			<span class="badge badge-success">Giao hàng thành công</span> 
		@elseif($orders['order_status'] == 4)
			<span class="badge badge-danger">Giao hàng thất bại</span> 
		@endif
	</p>
	<p>#Product List</p>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Product Name</th>
				<th>Price</th>
				<th>Qty</th>
				<th>Total</th>
			</tr> 
		</thead>
		<tbody>
			@php($products = json_decode($orders['product']))
			@php($total = 0)
			@if($products)
				@foreach($products as $ord)
					<tr>
						<td class="text-left">{{ $ord->title }}</td>
						<td>{{ number_format($ord->price , 0 , ',','.') }}</td>
						<td>{{ $ord->qty }}</td>
						<td>{{ number_format(($ord->price * $ord->qty) , 0 , ',','.') }}</td> 
						@php($total += $ord->price * $ord->qty)
					</tr>
				@endforeach
			@endif
			<tr>
				<td>Total</td>
				 
				<td colspan="3" class="text-center">{{  number_format(($total) , 0 , ',','.') }}</td> 
			</tr>
		</tbody>
	</table>
	<p>#Info</p>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th >Name</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Email</th>
			</tr> 
		</thead>
		<tbody>
			<tr>
				<td class="text-left">{{ $orders['name'] }}</td>
				<td>
					@php($address = json_decode($orders['address']))

					{{  $address->address.' - '. $address->wards.' - '.$address->province.' - '.$address->county }}
				</td>
				<td>{{ $orders['phone'] }}</td>
				<td>{{ $orders['email'] }}</td> 
			</tr>
		</tbody>
	</table>
	<br>
	<form method="POST" action="{{ route('order-update',$orders['id']) }}">
		@csrf
		<div>
			<p>#Trạng thái đơn hàng :</p>
			<select class="form-control" name="order_status">
				<option 
					value="0" 
					{{ $orders->order_status == 0 ? 'selected="selected"' : '' }}
				>Chờ xác nhận</option>
				<option 
					value="1" 
					{{ $orders->order_status == 1 ? 'selected="selected"' : '' }}
				>Đã xác nhận</option>
				<option 
					value="2"
					{{ $orders->order_status == 2 ? 'selected="selected"' : '' }}
				>Đang giao hàng</option>
				<option 
					value="3"
					{{ $orders->order_status == 3 ? 'selected="selected"' : '' }}
				>Giao hàng thành công</option>
				<option 
					value="4"
					{{ $orders->order_status == 4 ? 'selected="selected"' : '' }}
				>Giao hàng thất bại</option>
			</select>
			<button type="submit" class="btn btn-success">
				Order Update
			</button>
		</div>
	</form>
</div> 
@endsection