@extends('layout.backend.admin.master.master')

@section('title', 'Genealogy')

@section('page-header', 'Genealogy')

@section('breadcrumb')
	<ol class="breadcrumbs">
	  <li>
	      <a href="#">
	          <i class="fa fa-home"></i> Home
	      </a>
	  </li>
	  <li><span>Member And Genealogy</span></li>
      <li><span>Genealogy</span></li>
	</ol>
@endsection

@section('content')
    	<div class="panel panel-default">
    		<div class="panel-heading">
    			Member
    		</div>
    		<div class="panel-body">
                <table id="list-member-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                    <thead>
                        <tr>
                            <th class="center-align">Plan ID</th>
                            <th class="center-align">Member ID</th>
                            <th class="center-align">Name</th>
                            <th width="2%" class="center-align">Action</th>
                    </thead>
                </table>
    		</div>
    	</div>
        <div class="panel panel-default">
            <div class="panel-heading heading-genealogy">

            </div>
            <div class="panel-body body-genealogy">
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Active Member
            </div>
            <div class="panel-body">
                <table id="active-member-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                    <thead>
                        <tr>
                            <th class="center-align">Plan ID</th>
                            <th class="center-align">Member ID</th>
                            <th class="center-align">Name</th>
                            <th class="center-align">Action</th>
                    </thead>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Non Active Member
            </div>
            <div class="panel-body">
                <table id="non-active-member-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                    <thead>
                        <tr>
                            <th class="center-align">Member ID</th>
                            <th class="center-align">Name</th>
                    </thead>
                </table>
            </div>
        </div>
  <div class="modal fade modal-getstart detail_users" id="detail_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <label class="col-md-4 control-label" for="inputReadOnly">Scoido ID</label>
                    <div class="col-md-6">
                        <input type="text" name="member_id" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('first_name') }}">
                    <label class="col-md-4 control-label">Plan</label>
                    <div class="col-md-6">
                        <input type="text" name="plan" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('first_name') }}">
                    <label class="col-md-4 control-label">First Name</label>
                    <div class="col-md-6">
                        <input type="text" name="first_name" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('last_name') }}">
                    <label class="col-md-4 control-label">Last Name</label>
                    <div class="col-md-6">
                        <input type="text" name="last_name" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('email') }}">
                    {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        <input type="text" name="email" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('address') }}">
                    <label class="col-md-4 control-label">Address</label>
                    <div class="col-md-6">
                        <textarea name="address" class="form-control" readonly></textarea>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('pin_bbm') }}">
                    {!! Form::label('pin_bbm', 'Pin BBm', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        <input type="text" name="pin_bbm" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('phone') }}">
                    <label class="col-md-4 control-label">Phone</label>
                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('province') }}">
                    <label class="col-md-4 control-label">Province</label>
                    <div class="col-md-6">
                        <input type="text" name="province" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('city') }}">
                    <label class="col-md-4 control-label">City / District</label>
                    <div class="col-md-6">
                        <input type="text" name="city" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group{{ Form::hasError('district') }}">
                    <label class="col-md-4 control-label">Sub District</label>
                    <div class="col-md-6">
                        <input type="text" name="district" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Postal Code</label>
                    <div class="col-md-6">
                        <input type="text" name="postal_code" class="form-control" readonly>
                    </div>
                </div>

								<div class="form-group">
                    <label class="col-md-4 control-label">Know Scoido From</label>
                    <div class="col-md-6">
                        <input type="text" name="knowing_scoido_of" class="form-control" readonly>
                    </div>
                </div>
        </div>

      </div>
    </div>
  </div>
<div class="modal fade modal-form-move" id="modal_form_move" role="dialog" aria-labelledby="myModalLabell">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Spillover</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-genealogy', 'files'=>true, 'class' => 'form-horizontal jquery-form-move']) !!}
                <input type="hidden" name="generation_id">
                <input type="hidden" name="action" value="move-action">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputReadOnly">Member ID</label>
                    <div class="col-md-6">
                        <input type="text" name="member_id" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputReadOnly">Name</label>
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" readonly>
                    </div>
                </div>
                <input type="hidden" name="user_id" value="">
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputReadOnly">Upline Id</label>
                    <div class="col-md-6">
                        <select name="upline_id" class="select2-single" style="width:100%;">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputReadOnly">Filter Generation</label>
                    <div class="col-md-6">
                        <select name="filter_generation" class="select2-single" style="width:100%;">
                            <option value="all">All</option>
                            <option value="gen_1">1st Generation</option>
                            <option value="gen_2">2nd Generation</option>
                            <option value="gen_3">3rd Generation</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputReadOnly">To</label>
                    <div class="col-md-6">
                        <select name="to_user_id" id="select2" style="width:100%;">
                        </select>
                        <p><small class="text-muted">Type Member ID, Name or Plan</small></p>
                        <p class="has-error text-danger error-to_user_id"></p>
                    </div>
                </div>
                <div class="form-group area-delete">
                    <center>
                        <button type="submit" class="btn-submit hidden">&nbsp;</button>
                        <button class="btn btn-primary" data-toggle="confirmation">Spillover</button>
                        <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </center>
                </div>
        </form>
        </div>

      </div>
    </div>
</div>
@endsection

@section('header')

    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}
    <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <style type="text/css">
        .center-align{
            text-align: center;
        }
    </style>

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
    {!! Html::script('assets/backend/porto-admin/vendor/bootstrap-confirmation/bootstrap-confirmation.js') !!}

    <script type="text/javascript">
       var list_member_table = $('#list-member-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('admin-datatables-genealogy',['list_member']) !!}",
            order: [[ 0, 'desc' ]],
            columns: [
                {data: 'plan_id', name: 'plan_id',visible:false},
                {data: 'member_id', name: 'member_id'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ]
        });
       var active_table = $('#active-member-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('admin-datatables-genealogy',['active_member']) !!}",
            order: [[ 0, 'desc' ]],
            columns: [
                {data: 'plan_id', name: 'plan_id',visible:false},
                {data: 'member_id', name: 'member_id'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ]
        });
       var non_active_table = $('#non-active-member-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('admin-datatables-genealogy',['non_active_member']) !!}",
            columns: [
                {data: 'member_id', name: 'member_id'},
                {data: 'name', name: 'name'},
            ]
        });
        function hide_user_details(){
            $('#detail_users').modal('hide');
        }
        function show_genealogy(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-genealogy') }}",
                data: {
                    'id': id,
                    'action': 'show_genealogy'
                },
                dataType: 'json',
                success: function(response)
                {
                    $(".heading-genealogy").html('Genealogy : ' + response.scoido_id + ' - ' + response.name);
                    $(".body-genealogy").html(response.content_genealogy);
                    $('html, body').animate({
                        scrollTop: $(".heading-genealogy").offset().top
                    }, 2000);
                }
            });
        }
        show_genealogy('{{ $ceo }}');
        function show_user(id){
            $.ajax({
                type: "POST",
                url: "{{ route('hq-admin-dashboard-post')}}",
                data: {
                    'action': 'show_user_details',
                    'user_id': id
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='plan']").val(response.plan);
                    $("[name='member_id']").val(response.member_id);
                    $("[name='first_name']").val(response.first_name);
                    $("[name='last_name']").val(response.last_name);
                    $("[name='phone']").val(response.phone);
                    $("[name='email']").val(response.email);
                    $("[name='address']").val(response.address);
                    $("[name='pin_bbm']").val(response.pin_bbm);
                    $("[name='province']").val(response.province);
                    $("[name='city']").val(response.city);
                    $("[name='district']").val(response.district);
					$("[name='knowing_scoido_of']").val(response.knowing_scoido_of);
                    $("[name='postal_code']").val(response.postal_code);
                    $("[name='ktp_number']").val(response.ktp_number);
                    $("[name='npwp_number']").val(response.npwp_number);
                    $("[name='funnel_name']").val(response.funnel_name);
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

    $('[data-toggle="confirmation"]').confirmation(
{

    title: "Apakah Anda yakin akan memindahkan customer tersebut pada Upline yang telah Anda tunjuk?",
    btnOkClass: "btn-primary btn btn-sm",
    btnCancelClass: "btn-default btn btn-sm",
    btnOkLabel: "Yes",
    btnCancelLabel: "No",
    onConfirm: function() {
            $('.btn-submit').click();
    }
}

);
       function getOptionRecord(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-genealogy')}}",
                data: {
                    'id': id,
                    'action': 'getOptionRecord',
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='upline_id']").html(response.getOptionRecord);
                    $("#select2").select2('open');
                }
            });
       }
       function getOptionRecordTableGeneration(id,gen,upline_id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-genealogy')}}",
                data: {
                    'id': id,
                    'upline_id': upline_id,
                    'action': 'getOptionRecordTableGeneration',
                    'gen' : gen

                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='to_user_id']").html(response.getOptionRecordTableGeneration);
                    $("#select2").select2('open');
                }
            });
       }
        $(document.body).on("change",".select2-single",function(){
            getOptionRecordTableGeneration($("[name='generation_id']").val(),$("[name='filter_generation']").val(),$("[name='upline_id']").val());
            $("#select2").select2("val", "");
        });
        function show_form_spillover(id){
            $(".select2-single").select2({multiple:false});
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-genealogy')}}",
                data: {
                    'id': id,
                    'action': 'get-data-form-spillover'
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='user_id']").val(id);
                    $("[name='member_id']").val(response.scoido_id);
                    $("[name='name']").val(response.name);
                    $("[name='generation_id']").val(response.generation_id);
                    getOptionRecord(id);
                    $("#select2").select2({
                    width: '100%',
                    allowClear: true,
                    multiple: true,maximumSelectionLength: 1});

                }
            });
                    active_table.ajax.reload();

            $('#modal_form_move').modal({backdrop: 'static', keyboard: false});
            $('#modal_form_move').modal('show');
        }

        $('.jquery-form-move').ajaxForm({
            dataType:'json',
            success: function(response) {
                if(response.status == "success"){
                    var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                    new PNotify({
                        title: "Success",
                        text: response.notification,
                        type: 'success',
                        addclass: "stack-custom",
                        stack: myStack
                    });
                    active_table.ajax.reload();

                    $('#modal_form_move').modal('hide');
                }else{
                    $('.errorsMessage').html(response);
                }
            },
            beforeSend: function() {
              $('.has-error').html('');
            },
            error: function(response){
              if (response.status === 422) {
                  var data = response.responseJSON;
                  $.each(data,function(key,val){
                      $('.error-'+key).html(val);
                  });
                var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                    new PNotify({
                        title: "Failed",
                        text: "Validate Error, Check Your Data Again",
                        type: 'danger',
                        addclass: "stack-custom",
                        stack: myStack
                    });
                $("#editProfile").scrollTop(0);
              } else {
                  $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        });
    </script>
@endsection
