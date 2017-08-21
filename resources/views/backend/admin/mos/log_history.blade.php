@extends('layout.backend.admin.master.master')

@section('title', 'Log History')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Log History</span></li>
    </ol>
@endsection
@section('page-header', 'Log History')

@section('content')
<div class="form-group tab-content area-insert-update">
    <div class="row">
        <div class="col-md-7">
            <label class="col-md-3 control-label"><b>Filter By Date</b> </label>                    
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
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">History Login</h3>
    </div>
    <div class="panel-body">
        @include('flash::message')
        <br><br>
        <table id="history-login-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align">Name</th>
                    <th class="center-align">Email</th>
                    <th class="center-align">Ip Address</th>
                    <th class="center-align">Login</th>
                    <th class="center-align">Logout</th>
                    <th class="center-align">Created At</th>
                    <th class="center-align">Updated At</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('header')

    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
        #tickets-table tbody tr {
    cursor: pointer;
}
    </style>
@endsection
@section('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">

    $('.lightbox a[href]').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }
    });
  $('.ckeditor').ckeditor();
 $.fn.modal.Constructor.prototype.enforceFocus = function() {
    $( document )
        .off( 'focusin.bs.modal' ) // guard against infinite focus loop
        .on( 'focusin.bs.modal', $.proxy( function( e ) {
            if (
                this.$element[ 0 ] !== e.target && !this.$element.has( e.target ).length
                // CKEditor compatibility fix start.
                && !$( e.target ).closest( '.cke_dialog, .cke' ).length
                // CKEditor compatibility fix end.
            ) {
                this.$element.trigger( 'focus' );
            }
        }, this ) );
};
</script>
    
    {!! Html::script($pathp.'assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script($pathp.'assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script type="text/javascript">        
       var login_history_table = $('#history-login-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{!! route('admin-view-history-log-datatable-mos') !!}",
                data: function ( d ) {
                   d.filter_start = $( 'input[name=filter_start]').val();
                   d.filter_end = $( 'input[name=filter_end]' ).val();
                }
            },
            order: [[ 6, 'desc' ]],
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'ip_address', name: 'ip_address'},
                {data: 'login', name: 'login'},
                {data: 'logout', name: 'logout'},
                {data: 'created_at', name: 'created_at',visible:false},
                {data: 'updated_at', name: 'updated_at',visible:false}
            ]
        });

       $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.datepicker').on('change',function(){
            filter_start = $( 'input[name=filter_start]').val();
            filter_end = $( 'input[name=filter_end]' ).val();
            if(filter_start != '' && filter_end != ''){
                login_history_table.draw();             
            }
        });
        function showDataTablesOnChange(){
            transaction_history_table.draw();
        }
    </script>
@endsection