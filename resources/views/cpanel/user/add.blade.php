@extends('cpanel.layouts.app')
@section('title', 'Add User')
@section('content')
<div class="wrap-main">
    <p>#Register</p>
    <p><a href="{{ route('user') }}">Back</a></p>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name" class=" col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>
            <div class="">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class=" col-form-label text-md-right">
                {{ __('Confirm Password') }}
            </label>

            <div class="">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group">
            <label class="col-form-label text-md-right">
                {{ __('Avatar') }}
            </label>
            <div class="">
                <input type="file" class="form-control" name="avatar">
            </div>
        </div>
        <div class="form-group">
            <label class=" col-form-label text-md-right">
                {{ __('Position') }}
            </label>
            <div class="">
                <select class="form-control" name="position">
                    <option value="1">Administrator</option>
                    <option value="2">Editor</option> 
                </select>
            </div>
        </div>
        <div class="form-group mb-0">
            <div class=" offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection