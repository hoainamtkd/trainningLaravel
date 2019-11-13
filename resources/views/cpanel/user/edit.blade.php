@extends('cpanel.layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="wrap-main">
    <p>#{{ $user['id'] }}</p>
    <p><a href="{{ route('user') }}">Back</a></p>
    <form method="POST" action="{{ route('user-edit-post',$user['id']) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name" class=" col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user['name'] }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            <div class="">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user['email'] }}" readonly autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label class="col-form-label text-md-right">
                {{ __('Avatar') }}
            </label>
            <div class="avatar-img">
                <input type="file" class="form-control" name="avatar">
                @if($user['avatar'])
                    <p><img src="{{ asset($user['avatar']) }}"></p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class=" col-form-label text-md-right">
                {{ __('Position') }}
            </label>
            <div class="">
                <select class="form-control" name="position">
                    <option value="1" 
                    @if($user['position'] == 1)
                        selected="selected" 
                    @endif
                    >Administrator</option>
                    <option value="2"
                    @if($user['position'] == 2)
                        selected="selected" 
                    @endif
                    >Editor</option> 
                </select>
            </div>
        </div>
        <div class="form-group mb-0"> 
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button> 
        </div>
    </form>
</div>
@endsection