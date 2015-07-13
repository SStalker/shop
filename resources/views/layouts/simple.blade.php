<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Shop</title>
	<!-- Latest compiled and minified CSS -->
	{!! HTML::style('css/bootstrap.min.css') !!}
	{!! HTML::style('css/bootstrap-theme.min.css') !!}
	{!! HTML::style('css/style.css') !!}
	{!! HTML::script('js/jquery.min.js') !!}
	{!! HTML::script('js/bootstrap.min.js') !!}
</head>
<body>
	@include('layouts.nav')
	<br/>
	<div class="container">
		@yield('content')	
	</div>
</body>
</html>