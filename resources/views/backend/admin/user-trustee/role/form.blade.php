@extends('layout.backend.admin.master.master')

@section('title', 'Role Management - '.$title)

@section('header')
@endsection

@section('page-header', 'Role Management <small>'.$title.'</small>')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i></a></li>
        <li><a href="{!! action('Backend\Admin\UserTrustee\RoleController@index') !!}">Role Management</a></li>
        <li><span>{{ $title }}</span></li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $title }}</h3>
                </div>
                {!! Form::modelHorizontal($data, $form) !!}
                    <div class="panel-body">
                        <div class="form-group{{ Form::hasError('name') }}">
                            {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('name') !!}
                            </div>
                        </div>
                        @if($status == "create")
                            <div class="form-group{{ Form::hasError('slug') }}">
                                {!! Form::label('slug', 'Slug', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('slug') !!}
                                </div>
                            </div>
                        @endif
                        <div class="form-group{{ Form::hasError('permissions') }}">
                            {!! Form::label('permissions', 'Permissions', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('permissions[]', $data['dropdown'], null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'permissions']) !!}
                                {!! Form::errorMsg('permissions') !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {!! link_to_action('Backend\Admin\UserTrustee\RoleController@index', 'Back', [], ['class' => 'btn btn-default']).' '.Form::submit('Save', ['class' => 'btn btn-primary pull-right', 'title' => 'Save']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#permissions').select2();
        });
    </script>
@endsection