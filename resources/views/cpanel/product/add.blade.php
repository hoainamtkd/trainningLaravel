@extends('cpanel.layouts.app')
@section('title', 'Product Add')
@section('content')
<div class="wrap-main">
	<form method="POST" action="{{ route('product-add') }}" enctype="multipart/form-data">
		<p>#Product Add</p>
		<p><a href="{{ route('product') }}">Back</a></p>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="email">Name:</label>
			<input type="text" class="form-control" name="name" value="" required>
		</div>
		<div class="form-group">
			<label for="img">Feature Image:</label>
			<input type="file" class="form-control" name="feature_img">
		</div>
		<div class="form-group">
			<label for="gallery">Gallery:</label>
			<input type="file" class="form-control" name="gallery[]" multiple>
		</div>
		
		<div class="form-group">
			<label for="desc">Description:</label>
			<textarea class="form-control" name="description" rows="10" required></textarea>
		</div>
		<div class="form-group">
			<label for="price">Price:</label>
			<input type="number" class="form-control" name="price" value="" required>
		</div>
		<div class="form-group">
			<label for="price_sales">Price Sales:</label>
			<input type="number" class="form-control" name="price_sales" value="" required>
		</div>
		<div class="form-group">
			<label for="category">Category:</label>
			<select name="category" class="form-control" required>
				<option value="">-----</option>
				@if(@$category)
					@foreach($category as $cat)
						<option value="{{ $cat['category_id'] }}">
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