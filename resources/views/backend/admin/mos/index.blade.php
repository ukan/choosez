@extends('layout.backend.admin.master.master')

@section('title', "Ta'aruf Register")

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-users"></i> Home</a></li>
        <li><span>Ta'aruf Register</span></li>
    </ol>
@endsection

@section('header')
    {!! Html::style($pathp.'assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
        a.disabled {
           /*pointer-events: none;*/
           cursor: default;
        }
    </style>
@endsection

@section('page-header', "Ta'aruf Register")

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Ta'aruf Register</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <br><br>
            <div class="scrollmenu">
                <table id="trustees-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                    <thead>
                        <tr>
                            <th class="center-align">updated at</th>
                            <th class="center-align">Name</th>
                            <th class="center-align">Email</th>
                            <th class="center-align">Phone</th>
                            <th class="center-align">Dormitory</th>
                            <th class="center-align">Room</th>
                            <th class="center-align">Status</th>
                            <th class="center-align" width="2%">Action</th>
                        </tr>
                    </thead>
                </table>

                <!-- start fiture upload -->
                <div class="">
                     <div class="pull-left">
                        <a href="javascript:exportTo()">
                            <button title="Download" id="dwXls" name="dwXls" class="btn btn-primary"><b>Download</b></button>
                        </a>&nbsp;&nbsp;&nbsp;<i><b>Yang bisa di download hanya yang sudah di approve.</b></i>
                    </div>
                </div>
                <!-- end fiture download -->
            </div>
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

    <div class="modal fade modal-getstart" id="modalFormApproval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title FormDecode-title" id="myModalLabel"><i class="fa fa-exclamation fa-fw"></i>Add</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['route'=>'change-status', 'files'=>true, 'class' => 'form-horizontal jquery-form-mos']) !!}
                    <input type="hidden" name="method" id="method" value="">      
                    <input type="hidden" name="id" value="">

                    <div class="form-group area-approve">                    
                        <div class="col-md-12">
                             <center class="confirmation-message">Are You Sure Want To Approve ?</center>
                        </div>
                    </div>

                    <div class="form-group area-approve">
                        <center>
                            <button type="submit" class="btn btn-success btn-submit btn-success">Approve</button>
                            <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </center>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade modal-getstart" id="modalFormBimtes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title FormBook-title" id="myModalLabel">Create</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['route'=>'admin-post-mos-data', 'files'=>true, 'class' => 'form-horizontal jquery-form-bimtes-data']) !!}
                    <input type="hidden" name="action" id="action" value="">      
                    <input type="hidden" name="mos_register_id" value=""> 
                    <div class="form-group area-delete">                    
                        <div class="col-md-12">
                             <center>Are You Sure for Delete This Data ?</center>
                        </div>
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

    <script>
        var table = $('#trustees-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('datatables-mos') !!}",
            order: [[ 0, 'desc' ]],
            columns: [
                {data: 'updated_at', name: 'updated_at', class: 'center-align', visible:false},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'dorm', name: 'dorm'},
                {data: 'room', name: 'room'},
                {data: 'status', name: 'status', class: 'center-align', searchable: false, "render": function (data, type, JsonResultRow, meta) {
                        var check = "";
                        if(JsonResultRow.status == "Not Yet Checked"){
                            check = '<p style="text-align:right">'+JsonResultRow.status+'</p>';
                        }else {
                            check = '<b><p style="text-align:right;font-style:italic;color:green;">'+JsonResultRow.status+'</p></b>';
                        }
                        return check;
                    }
                },
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ]
        });

        function show_mos_register(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-mos-show-user') }}",
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

        function show_form_delete(id){         
            $("[name='mos_register_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormBook-title').html('Delete Data');
            $("[name='action']").val('delete');
            $('#modalFormBimtes').modal({backdrop: 'static', keyboard: false});
            $('#modalFormBimtes').modal('show');
        }

        /*start set update */
        function show_form_proccess_approve(id){            
            
            $.ajax({
                type: "POST",
                url: "{{ route('get-data-approval')}}",
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='id']").val(response.id);
                }
            });
            
            $('.has-error').html('');
            $('.head-has-error').removeClass('text-danger');
            $('.area-approve').show();
            $('.area-deny').hide();
            $('.FormDecode-title').html('Approve');
            $("[name='method']").val('Approved');
            $('#modalFormApproval').modal({backdrop: 'static', keyboard: false});
            $('#modalFormApproval').modal('show');
        }
        /*end set update */

        $('.jquery-form-bimtes-data').ajaxForm({
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
                $('#modalFormBimtes').modal('hide'); 
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
                $("#modalFormBimtes").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        }); 

        $('.jquery-form-mos').ajaxForm({
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
                $('#modalFormApproval').modal('hide'); 
                $('#getBimtesModal').modal('hide'); 
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
                $("#modalFormBimtes").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        }); 

    </script>
    <script language="javascript" type="text/javascript">
        var excelID = document.getElementById("dwXls");
        var type = '';
        excelID.onclick = function(){
            type = 'xlsx';
            fromDate = $('input[name=fromDate]').val();
            untilDate = $('input[name=untilDate]').val();
            keywords = $('input[type=search]').val();
        }
        
        exportTo = function() {
            if(keywords == ""){
                keywords = '';
            }
            location.href = "mos/download/"+type+"/"+fromDate+"/"+untilDate;
        }
    </script>
    @include('backend.delete-modal-datatables')
@endsection