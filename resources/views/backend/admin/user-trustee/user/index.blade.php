@extends('layout.backend.admin.master.master')

@section('title', 'User Management')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-users"></i> Home</a></li>
        <li><span>User Management</span></li>
    </ol>
@endsection

@section('header')
    {!! Html::style($pathp.'assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('page-header', 'User Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">User Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right" href="{{ action('Backend\Admin\UserTrustee\UserController@create') }}" title="Add"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="trustees-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">Email</th>
                        <th class="center-align">Full Name</th>
                        <!-- <th class="center-align">Nick Name</th> -->
                        <th class="center-align">Phone</th>
                        <th class="center-align">Role</th>
                        <th class="center-align">Status</th>
                        <th class="center-align">Last Login</th>
                        <th class="center-align" width="8%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script($pathp.'assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script($pathp.'assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
        $(document).ready(function() {
            $('#trustees-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-user-trustees') !!}",
                columns: [
                    {data: 'email', name: 'email'},
                    {data: 'username', name: 'username'},
                    // {data: 'first_name', name: 'first_name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'role', name: 'role', searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'last_login', name: 'last_login', class: 'center-align', searchable: false},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        });
    </script>
    @include('backend.update-status-modal-datatables')
@endsection