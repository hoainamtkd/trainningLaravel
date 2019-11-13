@extends('cpanel.layouts.app')
@section('title', 'Slider')
@section('content')
<div class="wrap-main">
	<p>#Review</p>
	<table class="table table-bordered table-slider">
		<thead>
			<tr>
				<th width="5%">STT</th>
				<th class="img text-center" width="40%">Đánh giá</th>
				<th width="30%">Product</th>
				<th>Approve</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if(@$reviews)
				@foreach($reviews as $review)
					<tr>
						<td>#{{ $review['id'] }}</td>
						<td>{{ mb_strimwidth($review['content'], 0, 150, "...") }}</td>
						<td>{{ mb_strimwidth($review['product_name'], 0, 150, "...") }}</td>
						<td>
							<!--  
							/ 1: Unapproved
							/ 2: Approved 
							-->
							@if($review['approve_status'] == 1)
								<span class="badge badge-danger">
									Unapproved
								</span>
							@elseif($review['approve_status'] == 2)
								<span class="badge badge-success">
									Approved
								</span>
							@endif 
						</td>
						<td>
							@if($review['approve_status'] == 1)
								<a href="{{ route('review-approve',$review['id']) }}">
									Approve
								</a>
							@elseif($review['approve_status'] == 2)
								<a href="{{ route('review-unapprove',$review['id']) }}">
									UnApprove
								</a>
							@endif
							| <a href="{{ route('review-delete',$review['id']) }}">Delete</a>
						</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</div> 
@endsection