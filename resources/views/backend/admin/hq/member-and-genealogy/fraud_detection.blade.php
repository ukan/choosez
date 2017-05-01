@extends('layout.backend.admin.master.master')

@section('title', 'Fraud Detection')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Fraud Detection</span></li>
    </ol>
@endsection
@section('page-header', 'Fraud Detection')

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
        <select style="" onchange="javascript:selectMethod()" class="pull-right dropdown form input-sm " id="filterMethod" name="filterMethod">
            <option value="member">Member</option>
            <option value="transaction">Transaction</option>
            <option value="order">Order</option>
        </select>
    </div>    
</div>

<div class="modal fade modal-getstart detail_users" id="detail_users" name="detail_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" onclick="javascript:hide_user_details()"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detail Users</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <div class="col-sm-12 img-avatar-area" align="center">
                        
                    </div>
                </div>                        

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputReadOnly">Scoido ID</label>
                    <div class="col-md-6">
                        <input type="text" name="member_id" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Upline ID</label>
                    <div class="col-md-6">
                        <input type="text" name="upline_id" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Placement Upline ID</label>
                    <div class="col-md-6">
                        <input type="text" name="mover_id" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Plan</label>
                    <div class="col-md-6">
                        <input type="text" name="plan" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">First Name</label>
                    <div class="col-md-6">
                        <input type="text" name="first_name" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Last Name</label>
                    <div class="col-md-6">
                        <input type="text" name="last_name" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-6">
                        <input type="text" name="email" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('pin_bbm', 'Pin BBm', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-6">
                        <input type="text" name="pin_bbm" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Phone</label>
                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Address</label>
                    <div class="col-md-6">
                        <textarea name="address" class="form-control" readonly></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Province</label>
                    <div class="col-md-6">
                        <input type="text" name="province" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">City / District</label>
                    <div class="col-md-6">
                        <input type="text" name="city" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Sub District</label>
                    <div class="col-md-6">
                        <input type="text" name="district" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Postal Code</label>
                    <div class="col-md-6">
                        <input type="text" name="postal_code" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Ktp Number</label>
                    <div class="col-md-6">
                        <input type="text" name="ktp_number" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Ktp Photo</label>
                    <div class="col-md-offset-3 img-ktp-photo-area"></div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Npwp Number</label>
                    <div class="col-md-6">
                        <input type="text" name="ktp_number" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Npwp Photo</label>
                    <div class="col-md-offset-3 img-npwp-photo-area"></div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Default Rotation</label>
                    <div class="col-md-6">
                        <input type="text" name="default_rotation" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Funnel Path Name</label>
                    <div class="col-md-6">
                        <input type="text" name="funnels_name" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Bank</label>
                    <div class="col-md-6">
                        <input type="text" name="bank" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Bank Acount Number</label>
                    <div class="col-md-6">
                        <input type="text" name="bank_account_number" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Account Name Holder</label>
                    <div class="col-md-6">
                        <input type="text" name="account_name_holder" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Branch</label>
                    <div class="col-md-6">
                        <input type="text" name="branch" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Rotation</label>
                    <div class="col-md-6">
                        <input type="text" name="rotation_privilage" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Number Of Rotation</label>
                    <div class="col-md-6">
                        <input type="text" name="number_rotations" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Start Date</label>
                    <div class="col-md-6">
                        <input type="text" name="created_at" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Start Paid Member</label>
                    <div class="col-md-6">
                        <input type="text" name="start_paid_member" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Last Due Date</label>
                    <div class="col-md-6">
                        <input type="text" name="last_due_date" class="form-control" readonly>
                    </div>
                </div>
        </div>

      </div>
    </div>
  </div>

<div style="display: none" class="user_duplication panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">User Duplications</h3>
    </div>
    <div class="panel-body">
        @include('flash::message')
        <br><br>
        <table id="user-duplication-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align">Member ID</th>
                    <th class="center-align">Name</th>
                    <th class="center-align">Email</th>
                    <th class="center-align">Gender</th>
                    <th class="center-align">Phone</th>
                    <th class="center-align">City Or District</th>
                    <th class="center-align">Account Number</th>
                    <th class="center-align">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div style="display: none" class="transaction panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Transaction</h3>
    </div>
    <div class="panel-body">
        @include('flash::message')
        <br><br>
        <table id="transaction-historys-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align">No Transaction</th>
                    <th class="center-align">Transaction</th>
                    <th class="center-align">Value</th>
                    <th class="center-align">Date</th>
                    <th class="center-align">Status</th>
                    <th class="center-align">Fraud</th>
                </tr>
            </thead>
        </table>
        <label class="pull-right"><b>Jumlah fraud : {{ $fraud_transaction }}</b></label>
    </div>
</div>

<div style="display: none" class="order panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Order</h3>
    </div>
    <div class="panel-body">
        @include('flash::message')

        <div >
        <br><br>
        <table id="history-order-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
            <thead>
                <tr>
                    <th class="center-align">No Order</th>
                    <th class="center-align">Funnel Name</th>
                    <th class="center-align">Billing Name</th>
                    <th class="center-align">Method Service Cost</th>
                    <th class="center-align">Date</th>
                    <th class="center-align">Status</th>
                    <th class="center-align">Fraud</th>
                </tr>
            </thead>
        </table>
        <label class="pull-right"><b>Jumlah fraud : {{ $fraud_order }}</b></label>
    </div>
</div>

@endsection

@section('header')

    {!! Html::style($pathp.'assets/plugins/datatables/dataTables.bootstrap.css') !!}

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
    
    {!! Html::script($pathp.'assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script($pathp.'assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script type="text/javascript">        
       var user_duplication_table = $('#user-duplication-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{!! route('admin-view-datatable-user-duplication') !!}",
                data: function ( d ) {
                   d.filter_start = $( 'input[name=filter_start]').val();
                   d.filter_end = $( 'input[name=filter_end]' ).val();
                   // d.filterMethod = $('#filterMethod').val();
                }
            },
            // ajax: "{!! route('admin-view-history-log-datatable-login') !!}",
            columns: [
                {data: 'member_id', name: 'member_id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'gender', name: 'gender'},
                {data: 'phone', name: 'phone'},
                {data: 'city_or_district', name: 'city_or_district'},
                {data: 'bank_account_number', name: 'bank_account_number'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ]
        });

       var transaction_history_table = $('#transaction-historys-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{!! route('admin-view-fraud-datatable-transaction') !!}",
                data: function ( d ) {
                   d.filter_start = $( 'input[name=filter_start]').val();
                   d.filter_end = $( 'input[name=filter_end]' ).val();
                }
            },
            columns: [
                {data: 'order_id', name: 'order_id'},
                {data: 'code', name: 'code'},
                {data: 'value', name: 'value'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'fraud_status', name: 'fraud_status'}
                
            ]
        });

        var order_history_table = $('#history-order-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{!! route('admin-view-fraud-datatable-order') !!}",
                data: function ( d ) {
                   d.filter_start = $( 'input[name=filter_start]').val();
                   d.filter_end = $( 'input[name=filter_end]' ).val();
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'full_name', name: 'full_name'},
                {data: 'shipping_method_service_cost', name: 'shipping_method_service_cost'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'fraud_status', name: 'fraud_status'}
            ]
        });

        function selectMethod(){ 
            if($("#filterMethod").val() == 'member'){
                document.getElementsByClassName('order')[0].style.display = 'none';
                document.getElementsByClassName('user_duplication')[0].style.display = 'block';
                document.getElementsByClassName('transaction')[0].style.display = 'none';
            }else if($("#filterMethod").val() == 'transaction'){
                document.getElementsByClassName('order')[0].style.display = 'none';
                document.getElementsByClassName('transaction')[0].style.display = 'block';
                document.getElementsByClassName('user_duplication')[0].style.display = 'none';
            }else if($("#filterMethod").val() == 'order'){
                document.getElementsByClassName('user_duplication')[0].style.display = 'none';
                document.getElementsByClassName('order')[0].style.display = 'block';
                document.getElementsByClassName('transaction')[0].style.display = 'none';
            }
        }
        document.getElementsByClassName('user_duplication')[0].style.display = 'block';
        
        function hide_user_details(){
            $('#detail_users').modal('hide');
        }

        function show_user(id){            
            $.ajax({
                type: "POST",
                url: "{!! route('hq-admin-dashboard-post') !!}",
                data: {
                    'action': 'show_user_details',
                    'user_id': id
                },
                dataType: "json",
                success: function(response)
                {
                    $("[name='plan']").val(response.plan);
                    $("[name='member_id']").val(response.member_id);
                    $("[name='upline_id']").val(response.upline_id);
                    $("[name='mover_id']").val(response.mover_id);
                    $("[name='first_name']").val(response.first_name);
                    $("[name='last_name']").val(response.last_name);
                    $("[name='phone']").val(response.phone);
                    $("[name='email']").val(response.email);
                    $("[name='address']").val(response.address);
                    $("[name='pin_bbm']").val(response.pin_bbm);
                    $("[name='province']").val(response.province);
                    $("[name='city']").val(response.city);
                    $("[name='district']").val(response.district);
                    $("[name='postal_code']").val(response.postal_code);
                    $("[name='ktp_number']").val(response.ktp_number);
                    $("[name='npwp_number']").val(response.npwp_number);
                    // $("[name='funnel_name']").val(response.funnel_name);
                    $("[name='default_rotation']").val(response.default_rotation);
                    $("[name='funnels_name']").val(response.funnels_name);
                    $("[name='bank']").val(response.bank);
                    $("[name='bank_account_number']").val(response.bank_account_number);
                    $("[name='account_name_holder']").val(response.account_name_holder);
                    $("[name='branch']").val(response.branch);
                    $("[name='rotation_privilage']").val(response.rotation_privilage);
                    $("[name='number_rotations']").val(response.number_rotations);
                    $("[name='created_at']").val(response.created_at);
                    $("[name='last_due_date']").val(response.last_due_date);
                    $("[name='start_paid_member']").val(response.start_paid_member);
                    $(".img-avatar-area").html('<img src="'+ response.avatar +'" width="120" class="img-circle img-responsive">')
                    if(response.ktp_photo == null){
                        $(".img-ktp-photo-area").addClass('hidden');
                    }else{
                        $(".img-ktp-photo-area").removeClass('hidden');
                    }
                    $(".img-ktp-photo-area").html('<img src="'+ response.ktp_photo +'" class="img-responsive">')
                    if(response.npwp_photo == null){
                        $(".img-npwp-photo-area").addClass('hidden');
                    }else{
                        $(".img-npwp-photo-area").removeClass('hidden');
                    }
                    $(".img-npwp-photo-area").html('<img src="'+ response.npwp_photo +'" class="img-responsive">')
                }
            });
            $('#detail_users').modal({backdrop: 'static', keyboard: false});
            $('#detail_users').modal('show');
        }

       $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.datepicker').on('change',function(){
            filter_start = $( 'input[name=filter_start]').val();
            filter_end = $( 'input[name=filter_end]' ).val();
            if(filter_start != '' && filter_end != ''){
                user_duplication_table.draw();                
                // transaction_history_table.draw();                
            }
        });
    </script>
@endsection