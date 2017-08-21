<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>  
  <link rel="stylesheet" href="css/style.css">  
  <link rel="stylesheet" href="{!! asset($pathp.'assets/general/css/style.css') !!}">
  <!-- {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!} -->
</head>

<body>
  <div class="main-wrap">
      <div class="login-main-alert">
        @include('flash::message')
        @if (Session::has('notice'))
          <div class="login-main-alert">{!! Session::get('notice') !!}</div>
        @endif
      </div>
      <div class="login-main">
    {!! Form::open($form) !!}
          <input type="hidden" name="type" value="{{ $type }}">
          <input type="text" id="email" name="email" placeholder="Email" class="box1 border1">
          <input type="password" id="password" name="password" placeholder="Password" class="box1 border2">
          <input type="submit" class="send" value="Go">    
    {!! Form::close() !!}
      </div>
  </div>  
</body>
</html>
