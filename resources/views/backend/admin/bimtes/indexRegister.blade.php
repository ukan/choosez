@extends('layout.backend.admin.master.master')

@section('title', 'Bimtes Register User')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-users"></i> Home</a></li>
        <li><span>Bimtes Register User</span></li>
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

@section('page-header', 'Bimtes Register User')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Bimtes Register User</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <br><br>
            <table id="trustees-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">Photo</th>
                        <th class="center-align">Name</th>
                        <th class="center-align">Phone</th>
                        <!-- <th class="center-align">Email</th> -->
                        <th class="center-align">Test Number</th>
                        <th class="center-align">Test Date</th>
                        <th class="center-align">Status</th>
                        <th class="center-align" width="2%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div id="getBimtesModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body" id="getContentBimtesModal">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script($pathp.'assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script($pathp.'assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
        var table = $('#trustees-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('datatables-bimtes-register') !!}",
            columns: [
                {data: 'photo', name: 'photo', class: 'center-align'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                // {data: 'email', name: 'email'},
                {data: 'test_number', name: 'test_number'},
                {data: 'test_day', name: 'test_day', searchable: false},
                {data: 'status', name: 'status', class: 'center-align', searchable: false},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ]
        });

        function show_bimtes_register(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-bimtes-register-show-user') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getBimtesModal").modal("show");
                    $("#getContentBimtesModal").html(msg);
                }
            });
        }
    </script>
    @include('backend.delete-modal-datatables')
@endsection