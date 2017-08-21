@extends('layout.backend.admin.master.master')

@section('title', 'User Management - '.$title)

@section('page-header', 'User Management <small>'.$title.'</small>')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i></a></li>
        <li><a href="{!! action('Backend\Admin\UserTrustee\UserController@index') !!}">User Management</a></li>
        <li><span>{{ $title }}</span></li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $title }}</h3>
                </div>
                {!! Form::modelHorizontal($form) !!}
                    <div class="panel-body">
                        @include('flash::message')
                        <div class="form-group{{ Form::hasError('email') }}">
                            {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('email') !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::submit('Reset Password', ['class' => 'btn btn-primary pull-right', 'title' => 'Save']) !!}
                    </div>
                {!! Form::close() !!}
                <div class="panel-body">
                    <div class="form-group{{ Form::hasError('password') }}">
                        {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::label($pass, $pass, ['class' => 'control-label']) !!}
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection