@extends('layout.backend.admin.master.master')

@section('title', 'Student Management')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-users"></i> Home</a></li>
        <li><span>Student Management</span></li>
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

@section('page-header', 'Student Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Student Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right" href="{{ action('Backend\Admin\UserTrustee\UserController@create') }}" title="Add"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="trustees-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">Photo</th>
                        <th class="center-align">Email</th>
                        <th class="center-align">Full Name</th>
                        <th class="center-align">Nick Name</th>
                        <th class="center-align">Phone</th>
                        <th class="center-align">Hostel</th>
                        <th class="center-align">Room</th>
                        <!-- <th width="12%">&nbsp;</th> -->
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
                ajax: "{!! route('datatables-user-register') !!}",
                columns: [
                    {data: 'image', name: 'image'},
                    {data: 'email', name: 'email'},
                    {data: 'username', name: 'username'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'hostel', name: 'hostel', searchable: false},
                    {data: 'room', name: 'room', class: 'center-align', searchable: false},
                    // {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        });
    </script>
    @include('backend.delete-modal-datatables')
@endsection