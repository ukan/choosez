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
                    <th class="center-align">Member ID</th>
                    <th class="center-align">First Name</th>
                    <th class="center-align">Email</th>
                    <th class="center-align">Ip Address</th>
                    <th class="center-align">Login</th>
                    <th class="center-align">Logout</th>
                    <th class="center-align">Created At</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">History Transaction</h3>
    </div>
    <div class="panel-body">
        <div class="col-md-3">
            <select class="col-md-2 dropdown form-control input-sm pull-left" id="filterCode" name="filterCode" onchange="javascript:showDataTablesOnChange()" required>
                <option value="all">All</option>
                @foreach($items as $item)
                    <option value="{{$item->code}}">{{ucwords(str_replace('_', ' ', $item->code))}}</option>
                @endforeach
            </select>
        </div>
        <div>
        <br><br>
        <table id="transaction-historys-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align">No Transaction</th>
                    <th class="center-align">Transaction</th>
                    <th class="center-align">Value</th>
                    <th class="center-align">Admin Fee</th>
                    <th class="center-align">Balance</th>
                    <th class="center-align">Date</th>
                    <th class="center-align">Status</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<br>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">History Order</h3>
    </div>
    <div class="panel-body">
        <div >
        <br><br>
        <table id="history-order-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align">No Order</th>
                    <th class="center-align">Funnel Name</th>
                    <th class="center-align">Billing Name</th>
                    <th class="center-align">Value</th>
                    <th class="center-align">Date</th>
                    <th class="center-align">Status</th>
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
<script>

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
    
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script type="text/javascript">        
       var login_history_table = $('#history-login-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{!! route('admin-view-history-log-datatable-login') !!}",
                data: function ( d ) {
                   d.filter_start = $( 'input[name=filter_start]').val();
                   d.filter_end = $( 'input[name=filter_end]' ).val();
                }
            },
            order: [[ 2, 'desc' ]],
            columns: [
                {data: 'member_id', name: 'member_id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'email', name: 'email'},
                {data: 'ip_address', name: 'ip_address'},
                {data: 'login', name: 'login'},
                {data: 'logout', name: 'logout'},
                {data: 'created_at', name: 'created_at',visible:false}
            ]
        });

        var transaction_history_table = $('#transaction-historys-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{!! route('admin-view-history-log-datatable-transaction') !!}",
                data: function ( data ) {
                    data.filter_start = $( 'input[name=filter_start]').val();
                    data.filter_end = $( 'input[name=filter_end]' ).val();
                    data.filterCode = $('#filterCode').val();
                }
            },
            order: [[ 5 , 'desc' ]],
            columns: [
                {data: 'order_id', name: 'order_id'},
                {data: 'code', name: 'code'},
                {data: 'value', name: 'value'},
                {data: 'admin_fee', name: 'admin_fee'},
                {data: 'balance', name: 'balance'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                
            ]
        });

        var order_history_table = $('#history-order-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{!! route('admin-view-history-log-datatable-order') !!}",
                data: function ( d ) {
                   d.filter_start = $( 'input[name=filter_start]').val();
                   d.filter_end = $( 'input[name=filter_end]' ).val();
                }
            },
            order: [[ 4, 'desc' ]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'full_name', name: 'full_name'},
                {data: 'value', name: 'value'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
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
                transaction_history_table.draw();                
                order_history_table.draw();                
            }
        });
        function showDataTablesOnChange(){
            transaction_history_table.draw();
        }
    </script>
@endsection