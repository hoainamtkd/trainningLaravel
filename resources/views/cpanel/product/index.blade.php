@extends('cpanel.layouts.app')
@section('title', 'Product')
@section('content')
<div class="wrap-main">
	<p>
		<a href="{{ route('product-add') }}">Add Product</a>
	</p>
	<div class="form_filter">
		<form method="GET" action="{{ route('product') }}">
			@csrf
			<table class="table table-bordered">
				<tbody>
					<tr>
						@php($req = app('request'))
						<input type="hidden" name="search" value="true">
						<td>
							<input 
								type="text" 
								name="title" 
								value="{{ $req->input('title') }}" 
								placeholder="Enter title" 
								class="form-control"
							>
						</td>
						<td>
							<select name="category" class="form-control">
								<option value="">-----</option>
								@if(@$category)
									@foreach($category as $cat)
										<option value="{{ $cat['category_id'] }}" {{ $req->input('category') == $cat['category_id'] ? 'selected="selected"' : '' }} >
											{{ $cat['category_name'] }}
										</option>
									@endforeach
								@endif
							</select>
						</td>
						<td>
							<input 
								type="text" 
								name="price_from" 
								placeholder="Price From" 
								class="form-control"
								value="{{ $req->input('price_from') }}" 
							>
						</td>
						<td>
							<input 
								type="text" 
								name="price_to" 
								placeholder="Price To" 
								class="form-control"
								value="{{ $req->input('price_to') }}"
							>
						</td>
						<td><button type="submit" class="search_box btn btn-success form-control">Search</button></td> 
					</tr>
				</tbody>
			</table>
		</form>
	</div>
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
						<td colspan="7">Không tìm thấy dữ liệu.</td>
					</tr>
				@endif
			</tbody>
		</table>
		{{ $products->links() }}
	@endif
</div> 
@endsection