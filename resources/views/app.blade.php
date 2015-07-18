<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Shop</title>
	<!-- Latest compiled and minified CSS -->
	{{--!! HTML::style('css/bootstrap.min.css') !!--}
	{{--!! HTML::style('css/bootstrap-theme.min.css') !!--}}
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

	<!-- Optional theme -->
	<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css"-->
	{!! HTML::style('css/style.css') !!}
	{!! HTML::style('css/leftmenu.css') !!}
	{!! HTML::script('js/jquery.min.js') !!}
	{{--!! HTML::script('js/bootstrap.min.js') !!--}}


	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	@include('layouts.nav')
	<br/>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				@yield('leftmenu', View::make('layouts.menuleft')->render())
				
			</div>
			<div class="col-md-9">
				@yield('content')	
			</div>
		</div>		
	</div>
</body>
</html>