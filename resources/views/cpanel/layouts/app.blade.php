<html>
<head>
    <title>App Name - @yield('title')</title>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body>
    <div class="container">
        @include('cpanel.layouts.header')
        @if (session('status_success'))
		    <div class="alert alert-success">
		        {{ session('status_success') }}
		    </div>
		@endif
		@if (session('status_error'))
		    <div class="alert alert-danger">
		        {{ session('status_error') }}
		    </div>
		@endif
        @yield('content')  
    </div>
</body>
</html> 