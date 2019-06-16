<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'Default') | Panel de Administracion</title>
	<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.css')}}">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/chosen/chosen.css')}}">
	<link rel="stylesheet" href="{{ asset('plugins/trumbowyg/dist/ui/trumbowyg.min.css')}}">
	<link rel="stylesheet" href="{{ asset('general.css')}}">
</head>
<style>
section {
  width: 65%;
  margin: auto;
}

</style>
<body class="admin-body">

	<section>
	@include('admin.template.partials.nav')
	</section>
	<section class="section-admin">
		<div class= "panel panel-default">
			<div class="panel panel-heading">
				<h3 class="panel-title">@yield('title')</h3>
			</div>

			<div class="panel-body">
				@include('flash::message')
				@include('admin.template.partials.errors')
				@yield('content')
			</div>
		</div>

	</section>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
	<script src="{{asset('plugins/jquery/js/jquery-3.4.0.js')}}"></script>
	<script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
	<script src="{{asset('plugins/chosen/chosen.jquery.js')}}"></script>
	<script src="{{asset('plugins/trumbowyg/dist/trumbowyg.min.js')}}"></script>
@yield('js')
</body>
</html>