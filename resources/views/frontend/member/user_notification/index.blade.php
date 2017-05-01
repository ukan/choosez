@extends('layout.backend.admin.master.master')

@section('title', 'User Notifications')

@section('page-header', 'User Notifications')

@section('breadcrumb')
	<ol class="breadcrumbs">
	  <li>
	      <a href="#">
	          <i class="fa fa-home"></i> Home
	      </a>
	  </li>
	  <li><span>User Notifications</span></li>
	</ol>
@endsection

@section('content')

	<div class="panel panel-primary">
		<div class="panel-heading">
			User Notifications
		</div>
		<div class="panel-body">
            <div class="form-group area-insert-update">
                <div class="row">
                    <div class="col-md-7">
                        <label class="col-md-3 control-label">Filter By Date</label>
                        <div class="col-md-9">
                          <div class = "input-group">
                             <span class ="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="filter_start" class="form-control datepicker">
                             <span class = "input-group-addon">To</span>
                            <input type="text" name="filter_end" class="form-control datepicker">
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <table id="user-notification-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">Crea</th>
                        <th class="center-align">Name</th>
                        <th class="center-align">Message</th>
                        <th class="center-align">ID</th>
                    </tr>
                </thead>
            </table>
		</div>
	</div>
@endsection

@section('header')

    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align,#announcements-table tr  {
            text-align: center;
        }
        tr:hover{
            cursor: pointer;
        }
    </style>
        {!! Html::style('assets/backend/porto-admin/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css') !!}
        <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
@endsection
@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('assets/plugins/bootstrap-validator/bootstrap-validator.js') !!}
    {!! Html::script('assets/general/library/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('assets/general/library/tableExport.jquery.plugin/tableExport.js') !!}
    {!! Html::script('assets/general/library/tableExport.jquery.plugin/jquery.base64.js') !!}

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
   var coin_transaction_history_table = $('#user-notification-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : "{!! route('datatables-user-notifications') !!}",
            data: function ( d ) {
               d.filter_start = $( 'input[name=filter_start]').val();
               d.filter_end = $( 'input[name=filter_end]' ).val();
            }
        },
        order: [[ 0, 'desc' ]],
        columns: [
            {data: 'created_at', name: 'created_at',visible:false},
            {data: 'name', name: 'name'},
            {data: 'content', name: 'content'},
            {data: 'id', name: 'id', visible:false},

        ],
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',{
            text: 'Text',
            action: function ( e, dt, node, config ) {
                $('#user-notification-table').tableExport({type:'txt',escape:'false',tableName:'User Notifications'});
            }
        }
        ]
    });
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('.datepicker').on('change',function(){
        filter_start = $( 'input[name=filter_start]').val();
        filter_end = $( 'input[name=filter_end]' ).val();
        $("[name='link_top_up_coin_transaction_history_export_to_text']").val("{{ URL::to('coin/export') }}/txt/top_up_coin_transaction_history/"+filter_start+"/"+filter_end);
        if(filter_start != '' && filter_end != ''){
            coin_transaction_history_table.draw();
        }
    });
</script>
@endsection
