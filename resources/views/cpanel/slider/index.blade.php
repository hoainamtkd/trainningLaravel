@extends('cpanel.layouts.app')
@section('title', 'Slider')
@section('content')
<div class="wrap-main">
	<p>
		<a href="{{ route('slider-add') }}">Add Slider</a>
	</p>
	<table class="table table-bordered table-slider">
		<thead>
			<tr>
				<th width="5%">STT</th>
				<th class="img text-center" width="50%">Banner</th>
				<th>Link</th>
				<th>Position</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if(@$sliders)
				@foreach($sliders as $data)
					<tr>
						<td>
							{{ $data['id'] }}
						</td>
						<td class="img" width="10%">
							@if($data['slider'])
								<span style="background-image: url({{ asset($data['slider']) }});"></span>
							@endif
						</td>
						<td>
							@if($data['link'])
								{{ $data['link'] }}
							@endif
						</td>
						<td>
							<span class="badge badge-success">
								@if($data['position'])
									@switch($data['position'])
										@case(1)
											Banner Lager
											@break
										@case(2)
											Banner Small
											@break
										@default
											@break
									@endswitch
								@endif
							</span> 
						</td>
						<td>
							<a href="{{ route('slider-edit',$data['id']) }}">Edit</a> |
							<a href="{{ route('slider-delete',$data['id']) }}">Delete</a>
						</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</div> 
@endsection