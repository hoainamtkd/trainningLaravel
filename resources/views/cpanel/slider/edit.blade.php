@extends('cpanel.layouts.app')
@section('title', 'Slider Edit')
@section('content')
<div class="wrap-main">
	<form method="POST" action="{{ route('slider-edit-post',$slider['id']) }}" enctype="multipart/form-data">
		<p>#Add Slider</p>
		<p><a href="{{ route('slider') }}">Back</a></p>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="img">Slider:</label>
			<input type="file" class="form-control" name="slider">
			@if($slider['slider'])
				<p class="wrap_img"><img src="{{ asset($slider['slider']) }}"></p>
			@endif
		</div>
		<div class="form-group">
			<label for="category">Link:</label>

			<input type="text" class="form-control" name="link"
				@if(@$slider['link'])
					value="{{ $slider['link'] }}"
				@endif
			>
		</div>
		<div class="form-group">
			<label for="category">Position:</label>
			<select name="position" class="form-control">
				<option value="">-----</option>
				<option 
					@if(@$slider['position'] == 1)
						selected="selected" 
					@endif
					value="1" 
				>Banner Lager</option>
				<option
					@if(@$slider['position'] == 2)
						selected="selected" 
					@endif
					value="2"
				>Banner Small</option>
			</select>
		</div>
		<button type="submit" class="btn btn-default">Update</button>
	</form>
</div> 
@endsection