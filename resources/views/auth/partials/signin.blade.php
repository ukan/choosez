@extends('auth.layout')

@section('content')
<!-- start: page -->
<section class="body-sign">
	<div class="center-sign">
		<a href="/" class="logo pull-left">
			<img src="{{ asset($pathp.'assets/general/images/identity/web.png') }}" height="100" alt="Porto Admin" />
		</a>

		<div class="panel panel-sign">
			<div class="panel-title-sign mt-xl text-right">
				<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
			</div>
			<div class="panel-body">
				@include('flash::message')
				@if (Session::has('notice'))
      <div class="alert alert-info">{!! Session::get('notice') !!}</div>
    @endif
        {!! Form::open($form) !!}
            <input type="hidden" name="type" value="{{ $type }}">
            <div class="form-group mb-lg">
                <label>Email <b class="text-danger">*</b></label>
                <div class="input-group input-group-icon">
                    {!! Form::text('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'Email']) !!}
                    <span class="input-group-addon">
                        <span class="icon icon-lg">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </span>
                </div>
            </div>            
            <div class="form-group{{ Form::hasError('email') }} has-feedback">
                {!! Form::errorMsg('email') !!}
            </div>
            <div class="form-group mb-lg">
                <div class="clearfix">
                    <label class="pull-left">Password <b class="text-danger">*</b></label>
                    <a href="#" class="pull-right hidden"></a>
                </div>
                <div class="input-group input-group-icon">
                    {!! Form::password('password', ['class' => 'form-control input-lg', 'placeholder' => 'Password']) !!}
                    <span class="input-group-addon">
                        <span class="icon icon-lg">
                            <i class="fa fa-lock"></i>
                        </span>
                    </span>
                </div>
            </div>
            <div class="form-group{{ Form::hasError('password') }} has-feedback">
                                    {!! Form::errorMsg('password') !!}
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="checkbox-custom checkbox-default hidden">
                        {!! Form::checkbox('remember_me') !!}
                        <label for="RememberMe">Remember Me</label>
                    </div>
                </div>
                <div class="col-sm-4 text-right">
                    {!! Form::submit('Sign In', ['class' => 'btn btn-primary hidden-xs', 'Sign In']) !!}
                    {!! Form::submit('Sign In', ['class' => 'btn btn-primary btn-block btn-lg visible-xs mt-lg', 'Sign In']) !!}
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