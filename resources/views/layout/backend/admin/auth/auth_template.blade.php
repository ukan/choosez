<!DOCTYPE html>
<html>
    <head>
        {!! Html::meta(null, null, ['charset' => 'UTF-8']) !!}
        {!! Html::meta('robots', 'noindex, nofollow') !!}
        {!! Html::meta('product', env('APP_WEB_ADMIN_NAME', 'Al-Ihsan Website')) !!}
        {!! Html::meta('description', env('APP_WEB_ADMIN_NAME', 'Al-Ihsan Website')) !!}
        {!! Html::meta('author', 'Al-Ihsan IT Team') !!}
        {!! Html::meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') !!}

        <title>{{ env('APP_WEB_ADMIN_NAME', 'Al-Ihsan Website') }}</title>

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        {!! Html::style( $pathp.'assets/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/magnific-popup/magnific-popup.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/stylesheets/theme.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/stylesheets/skins/default.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/stylesheets/theme-custom.css') !!}

        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/modernizr/modernizr.js') !!}
        <link rel="shortcut icon" type="image/png" href="{{ asset( $pathp.'assets/general/images/identity/favicon.png')}}"/>

        <!-- todo: Link shorcut icon will be here. -->
    </head>
    <!-- todo: Add dynamic skin... -->
    <body>
        <div class="loader loader-body">
            <div class="loader-progress">
                <div class="smt1"></div>
                <div class="smt2"></div>
                <div class="smt3"></div>
                <div class="smt4"></div>
                <div class="smt5"></div>
            </div> 
        </div>

        <section class="body-sign">
            <div class="center-sign">
                <a href="/" class="logo pull-left">
                   <h1>{{ env('APP_WEB_ADMIN_NAME', 'Web Admin') }}</h1>
                </a>

                <div class="panel panel-sign">
                    @yield('content')
                </div>

                <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2017. All Rights Reserved.</p>
            </div>
        </section>

        <!-- Vendor -->
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/jquery/jquery.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/bootstrap/js/bootstrap.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/nanoscroller/nanoscroller.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/magnific-popup/jquery.magnific-popup.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/jquery-placeholder/jquery-placeholder.js') !!}
        
        <!-- Theme Base, Components and Settings -->
        {!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.js') !!}

        <!-- Theme Custom -->
        {!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.custom.js') !!}

        <!-- Theme Initialization Files -->
        {!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.init.js') !!}
        @yield('scripts')
    </body>
</html>
