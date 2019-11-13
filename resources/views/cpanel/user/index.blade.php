@extends('cpanel.layouts.app')
@section('title', 'User')
@section('content')
<div class="wrap-main">
	<p><a href="{{ route('user-add') }}">Add User</a></p>
	<table class="table table-bordered table-user">
		<thead>
			<tr>
				<th width="5%">STT</th>
				<th class="img text-center" width="10%">Avatar</th>
				<th>Name</th>
				<th>Email</th>
				<th>Position</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($users))
				@foreach($users as $user)
				<tr>
					<td>
						{{ $user['id'] }}
					</td>
					<td class="img" width="10%">
						@if(@$user['avatar'])
							<span style="background-image:url({{ asset($user['avatar']) }})"></span>
						@else
							<span style="background-image:url({{ asset('images/default-avatar.png') }})"></span>
						@endif
					</td>
					<td>{{ $user['name'] }}</td>
					<td> 
						@if($user['email'])
						<a href="mailto:{{ $user['email'] }}">
							{{ $user['email'] }}
						</a>
						@endif
					</td>
					<td>
						@if($user['position'])
							<span class="badge badge-success">
								@switch($user['position'])
									@case(1)
										Administrator
										@break
									@case(2)
										Editor
										@break
									@default
										Other
										@break
								@endswitch
							</span> 
						@endif
					</td>
					<td>
						<a href="{{ route('user-edit',$user['id']) }}">Edit</a> |
						<a href="{{ route('user-delete',$user['id']) }}">Delete</a>
					</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>
	{{ $users->links() }}
</div> 
@endsection