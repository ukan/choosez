<!DOCTYPE html>
<html lang="en">
	<head>
		<title>{{ env('APP_WEB_ADMIN_NAME', 'Ganteng Shop') }} - @yield('title')</title>
		{!! Html::style('assets/frontend/css/') !!}
		
		{!! Html::script('assets/frontend/js/') !!}
		
		@yield('header')
	</head>

	<body>
	
		@yield('content')
		
		@yield('scripts')
	</body>
</html>