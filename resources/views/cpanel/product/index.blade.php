@extends('cpanel.layouts.app')
@section('title', 'Product')
@section('content')
<div class="wrap-main">
	<p>
		<a href="{{ route('product-add') }}">Add Product</a>
	</p>
	@if($products)
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="5%">STT</th>
					<th>Image</th>
					<th class="name" width="30%">Name</th>
					<th>Price</th>
					<th>Price Sales</th>
					<th>Category</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@if($products->total() > 0)
					@foreach($products as $product)
						<tr>
							<td>{{ $product['product_id'] }}</td>
							<td class="img" width="10%">
								<img src="<?php echo asset($product['feature_image']); ?>">
							</td>
							<td> 
								{{ $product['product_name'] ? $product['product_name'] : '' }}
							</td>
							<td>
								{{ $product['product_price'] ? number_format($product['product_price'], 0, ',', '.') .' đ' : '' }}
							</td>
							<td>
								<span class="badge badge-success">
									{{ $product['product_price_sales'] ? number_format($product['product_price_sales'], 0, ',', '.') .' đ' : '' }}
								</span>
							</td>
							<td>
								<span class="badge badge-success">
									{{ $product['category_name'] }}
								</span> 
							</td>
							<td>
								<a href="{{ route('product-edit',$product['product_id']) }}">Edit</a> |
								<a href="{{ route('product-delete',$product['product_id']) }}">Delete</a>
							</td>
						</tr>
					@endforeach
				@else
					<tr>
						<td colspan="6">Không tìm thấy dữ liệu.</td>
					</tr>
				@endif
			</tbody>
		</table>
		{{ $products->links() }}
	@endif
</div> 
@endsection