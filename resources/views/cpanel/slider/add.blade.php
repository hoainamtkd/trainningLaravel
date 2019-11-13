@extends('cpanel.layouts.app')
@section('title', 'Product Add')
@section('content')
<div class="wrap-main">
	<form method="POST" action="{{ route('slider-add-post') }}" enctype="multipart/form-data">
		<p>#Add Slider</p>
		<p><a href="{{ route('slider') }}">Back</a></p>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="img">Slider:</label>
			<input type="file" class="form-control" name="slider">
		</div>
		<div class="form-group">
			<label for="category">Link:</label>
			<input type="text" class="form-control" name="link">
		</div>
		<div class="form-group">
			<label for="category">Position:</label>
			<select name="position" class="form-control">
				<option value="">-----</option>
				<option value="1">Banner Lager</option>
				<option value="2">Banner Small</option>
			</select>
		</div>
		<button type="submit" class="btn btn-default">Add</button>
	</form>
</div> 
@endsection