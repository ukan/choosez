@extends('layout.backend.admin.master.master')

@section('title', 'Ministry Of Finance')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Ministry Of Finance</span></li>
    </ol>
@endsection

@section('header')
    {!! Html::style($pathp.'assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
        .hidden{
            display: none;
        }
    </style>

@endsection

@section('page-header', 'Ministry Of Finance')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Ministry Of Finance</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="finances-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">update at</th>
                        <th class="center-align">Type</th>
                        <th class="center-align">Value</th>
                        <th class="center-align">Date</th>
                        <th class="center-align">Description</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getFinance" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title form-title" id="myModalLabel">Show Detail</h4>
      </div>
      <div class="modal-body" id="getContentFinance">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <!-- modal form -->
  <div class="modal fade modal-getstart" id="modalFormFinance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title form-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-finance', 'files'=>true, 'class' => 'form-horizontal jquery-form-data']) !!}
                <input type="hidden" name="action" id="action" value="">      
                <input type="hidden" name="finance_id" value=""> 
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Type <b class="text-danger">*</b></label>
                    <div class="col-md-5">
                        <select onchange="changeCondition()" id="type" name="type" class="select2" style="width:100px">
                            <option value="select type">Select Type</option>
                            <option value="income">Income</option>
                            <option value="spending">Spending</option>
                        </select>                   
                        <p class="has-error text-danger error-type"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Date <b class="text-danger">*</b></label>
                    <div class="col-md-3">
                        <input type="text" id="date" name="date" class="form-control date-disabled" placeholder="Date">
                        <p class="has-error text-danger error-date"></p>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Value <b class="text-danger">*</b></label>
                    <div class="col-md-3">
                        <input type="text" id="value" name="value" class="form-control" placeholder="Value" onkeypress="return isNumber(event)">
                        <p class="has-error text-danger error-value"></p>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Description <b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
                        <p class="has-error text-danger error-description"></p>
                    </div>
                </div>
                <div class="form-group area-delete">                    
                    <div class="col-md-12">
                         <center>Are You Sure for Delete This Data ?</center>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <center>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary btn-submit', 'title' => 'Save']) !!}&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-warning btn-reset" type="reset">Reset</button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </center>
                </div>
                <div class="form-group area-delete">
                    <center>
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-submit', 'title' => 'Delete']) !!}
                        <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </center>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    {!! Html::script($pathp.'assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script($pathp.'assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    {!! Html::script($pathp.'assets/general/library/ckeditor/ckeditor.init.js') !!}
    {!! Html::script($pathp.'assets/plugins/ckeditor/ckeditor.js') !!}
    <script>
        $( function() {
            $('#date').datepicker({
                format: "yyyy-mm-dd",
                forceParse: false
            });
        });
        $(".select2").select2();
        function changeCondition(){
            if($("#type").val() == "article"){
                $('#author').removeClass('hidden');
            }else{
                $('#author').addClass('hidden');
            }
        }
        var table = $('#finances-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-ministry-of-finance') !!}",
                order: [[ 0, 'desc' ]],
                columns: [
                    {data: 'updated_at', name: 'updated_at', visible:false},
                    {data: 'type', name: 'type'},
                    {data: 'value', name: 'value'},
                    {data: 'date', name: 'date'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        function show_finance(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-ministry-of-finance') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getFinance").modal("show");
                    $("#getContentFinance").html(msg);
                }
            });
        }
        function show_form_create(){           
            $('.form-title').html('Create Data');
            $("[name='action']").val('create');
            $("[name='type']").val('select type').trigger('change');
            $("[name='value']").val('');
            $("[name='date']").val('');
            $("[name='description']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormFinance').modal({backdrop: 'static', keyboard: false});
            $('#modalFormFinance').modal('show');
            $("[name='finance_id']").val('');
        }

        function show_form_update(id){          
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-finance')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='type']").val(response.type).trigger('change');
                    $("[name='date']").val(response.date);
                    $("[name='value']").val(response.value);
                    $("[name='description']").val(response.description);

                }
            });
            $("[name='finance_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.form-title').html('Update Data');
            $("[name='action']").val('update');
            $('#modalFormFinance').modal({backdrop: 'static', keyboard: false});
            $('#modalFormFinance').modal('show');
        }
        function show_form_delete(id){         
            $("[name='finance_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.form-title').html('Delete Data');
            $("[name='action']").val('delete');
            $('#modalFormFinance').modal({backdrop: 'static', keyboard: false});
            $('#modalFormFinance').modal('show');
        }
        
        $('.jquery-form-data').ajaxForm({
            dataType : 'json',
            success: function(response) {

                if(response.status == 'success'){
                    var title_not = 'Notification';
                    var type_not = 'success';
                }else{
                    var title_not = 'Notification';
                    var type_not = 'failed';
                }
                var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                new PNotify({
                    title: response.status,
                    text: response.notification,
                    type: type_not,
                    addclass: "stack-custom",
                    stack: myStack
                });
                table.ajax.reload();    
                $('#modalFormFinance').modal('hide');
                // location.href=url; 
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
                $("#modalFormFinance").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        }); 
    </script>
    @include('backend.delete-modal-datatables')
@endsection