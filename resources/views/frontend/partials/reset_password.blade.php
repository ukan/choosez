<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>  
  <link rel="stylesheet" href="css/style.css">  
  <link rel="stylesheet" href="{!! asset($pathp.'assets/general/css/style.css') !!}">
  {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}
</head>

<body>
  <div class="main-wrap">
      <div class="login-main-alert-repass">
        @if (Session::has('error'))
          <div class="alert alert-danger">{!! Session::get('error') !!}</div>
        @endif
      </div>
      <div class="login-main">
        <div class="error"></div>
        {!! Form::open(['route'=>'process-reset-password', 'files'=>true]) !!}
            <div class="form-group{{ Form::hasError('email') }} has-feedback text">
                {!! Form::text('email', null, ['id'=>'email','class' => 'form-control email', 'autofocus' => true,  'placeholder' => 'email']) !!}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <!-- {!! $errors->first('email') !!} -->
            </div>
            <input class="btn btn-danger btn-block" type="submit" value="Send">
        </form>
    </div>
  </div>  

  <!-- Vendor -->
  {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/jquery/jquery.js') !!}
  {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/bootstrap/js/bootstrap.js') !!}
</body>
</html>
