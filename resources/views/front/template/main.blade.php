<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>@yield('title', 'Home') | Proyecto</title>
	<link rel="stylesheet" href="{{asset('plugins/bootstrap/css/darkly/bootstrap.css')}}">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<style type="text/css">
a:link
{
text-decoration:none;
}
</style>

<body>
	<header>
		@include('front.template.partials.header')
	</header>
	<div class='container'>
		@include('flash::message')
		@yield('content')
	<footer>
		<hr>
		Todos los derechos reservados &copy {{date('Y')}}
		<div class="pull-right">Daniel Quispe</div>
	</footer>
	</div>

	<script src="{{asset('plugins/jquery/js/jquery-3.4.0.js')}}"></script>
</body>
</html>