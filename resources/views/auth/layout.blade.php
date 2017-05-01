<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		{!! Html::style($pathp.'assets/plugins/bootstrap/css/bootstrap.min.css') !!}
                {!! Html::style($pathp.'assets/backend/porto-admin/vendor/magnific-popup/magnific-popup.css') !!}
                {!! Html::style($pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') !!}
                {!! Html::style($pathp.'assets/backend/porto-admin/stylesheets/theme.css') !!}
                {!! Html::style($pathp.'assets/backend/porto-admin/stylesheets/skins/default.css') !!}
                {!! Html::style($pathp.'assets/backend/porto-admin/stylesheets/theme-custom.css') !!}

                {!! Html::script($pathp.'assets/backend/porto-admin/vendor/modernizr/modernizr.js') !!}

	</head>
	<body>
		@yield('content')

		<!-- Vendor -->
                {!! Html::script($pathp.'assets/backend/porto-admin/vendor/jquery/jquery.js') !!}
                {!! Html::script($pathp.'assets/backend/porto-admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js') !!}
                {!! Html::script($pathp.'assets/backend/porto-admin/vendor/bootstrap/js/bootstrap.js') !!}
                {!! Html::script($pathp.'assets/backend/porto-admin/vendor/nanoscroller/nanoscroller.js') !!}
                {!! Html::script($pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
                {!! Html::script($pathp.'assets/backend/porto-admin/vendor/magnific-popup/jquery.magnific-popup.js') !!}
                {!! Html::script($pathp.'assets/backend/porto-admin/vendor/jquery-placeholder/jquery-placeholder.js') !!}
                
                <!-- Theme Base, Components and Settings -->
                {!! Html::script($pathp.'assets/backend/porto-admin/javascripts/theme.js') !!}

                <!-- Theme Custom -->
                {!! Html::script($pathp.'assets/backend/porto-admin/javascripts/theme.custom.js') !!}

                <!-- Theme Initialization Files -->
                {!! Html::script($pathp.'assets/backend/porto-admin/javascripts/theme.init.js') !!}
                
                @yield('scripts')

	</body>
</html>