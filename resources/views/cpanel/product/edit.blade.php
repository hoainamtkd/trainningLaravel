@extends('cpanel.layouts.app')
@section('title', 'Product Edit')
@section('content')
<div class="wrap-main">
	<form method="POST" action="{{ route('product-update',$product['product_id']) }}" enctype="multipart/form-data">
		<p>#{{ $product['product_id'] }}</p>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="email">Name:</label>
			<input type="text" class="form-control" required name="name" value="{{ $product['product_name'] }}">
		</div>
		<div class="form-group">
			<label for="img">Feature Image:</label>
			<input type="file" class="form-control" name="feature_img">
			<div class="wrap_feature_img">
				<img src="{{ asset($product['feature_image']) }}">
			</div>
		</div>
		<div class="form-group">
			<label for="gallery">Gallery:</label>
			<input type="file" class="form-control" name="gallery[]" multiple>
			<div class="wrap_gallery">
				<?php
					if(@$product['gallery']){
						$galleries = json_decode($product['gallery']);
						if($galleries){
							foreach($galleries as $gallery){
								echo '<img src="'.asset($gallery).'">';
							}
						}
					}
				?>
			</div>
		</div>
		<div class="form-group">
			<label for="desc">Description:</label>
			<textarea class="form-control" name="description" rows="10">{{ $product['product_description'] ? $product['product_description'] : '' }}</textarea>
		</div>
		<div class="form-group">
			<label for="price">Price:</label>
			<input type="number" class="form-control" name="price" value="{{ $product['product_price'] ? $product['product_price'] : '' }}">
		</div>
		<div class="form-group">
			<label for="price_sales">Price Sales:</label>
			<input type="number" class="form-control" name="price_sales" value="{{ $product['product_price_sales'] ? $product['product_price_sales'] : '' }}">
		</div>
		<div class="form-group">
			<label for="category">Category:</label>
			<select name="category" class="form-control">
				<option value="">-----</option>
				@if($category)
					@foreach($category as $cat)
						<option value="{{ $cat['category_id'] }}" 
							{{ ($product['category_id'] == $cat['category_id']) ? "selected='selected'" : '' }}>
							{{ $cat['category_name'] }}
						</option>
					@endforeach
				@endif
			</select>
		</div>
		<button type="submit" class="btn btn-default">Update</button>
	</form>
</div> 
@endsection