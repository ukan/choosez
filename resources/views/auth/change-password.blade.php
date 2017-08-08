@extends('auth.layout')

@section('content')
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo pull-left">
            <img src="{{ asset($pathp.'assets/general/images/identity/web.png') }}" height="100" alt="Al-Ihsan" />
        </a>

        <div class="panel panel-sign">
            <div class="panel-title-sign mt-xl text-right">
                <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Change Password</h2>
            </div>
            <div class="panel-body">
                @include('flash::message')
                    <p class="login-box-msg">Type your new password</p>
                {!! Form::open(['route'=>'process-change-password', 'files'=>true, 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('forgot_token', $forgot_token) !!}
                    <div class="form-group{{ Form::hasError('password') }} has-feedback">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        {!! Form::errorMsg('password') !!}
                    </div>
                    <div class="form-group{{ Form::hasError('password_confirmation') }} has-feedback">
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        {!! Form::errorMsg('password_confirmation') !!}
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            &nbsp;
                        </div>
                        <div class="col-xs-4">
                            {!! Form::submit('Change', ['class' => 'btn btn-primary btn-block', 'Change']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2017. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->
@endsection