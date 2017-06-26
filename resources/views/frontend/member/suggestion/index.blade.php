@extends('layout.backend.admin.master.master')

@section('title', 'Suggestion')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="#0"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Suggestion</span></li>
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

@section('page-header', 'Suggestion')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Suggestion</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create Suggestion"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="teacher-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">date</th>
                        <th width="25%" class="center-align">Subject</th>
                        <th class="center-align">Content</th>
                        <th width="13%" class="center-align">Status</th>
                        <th width="15%">Action </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getSuggestionModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body" id="getContentSuggestionModal">
            
          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  <div class="modal fade modal-getstart" id="modalFormSuggestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormSuggestion-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'member-post-suggestion','files'=>true, 'class' => 'form-horizontal jquery-form-suggestion']) !!}
                <input type="hidden" name="action" id="action" value="">      
                <input type="hidden" name="suggestion_id" value=""> 
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Subject<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('subject', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-subject"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Content <b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('content', null, array('class' => '')) !!}
                        <p class="has-error text-danger error-content"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-delete">                    
                    <div class="col-md-12">
                         <center>Are You Sure Want To Delete This Data ?</center>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <center>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary btn-submit', 'title' => 'Save ']) !!}&nbsp;&nbsp;&nbsp;
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

    <script>
        $(".select2").select2();
        var table = $('#teacher-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('member-suggestion-datatables') !!}",
                order: [[ 0, 'desc' ]],
                columns: [
                    {data: 'updated_at', name: 'updated_at',visible:false},
                    {data: 'subject', name: 'subject'},
                    {data: 'content', name: 'content'},
                    {data: 'status', name: 'status',"render": function (data, type, JsonResultRow, meta) {
                        var check = "";
                        if(JsonResultRow.status == "Not Yet Checked"){
                            check = '<p style="text-align:right;color:red">'+JsonResultRow.status+'</p>';
                        }else {
                            check = '<b><p style="text-align:right;font-style:italic;color:green;"> Read By : Admin</p></b>';
                        }
                            return check;
                    }},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        function show_suggestion(id){
            $.ajax({
                type: "POST",
                url: "{!! route('member-show-suggestion') !!}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getSuggestionModal").modal("show");
                    $("#getContentSuggestionModal").html(msg);
                }
            });
        }
        function show_form_create(){           
            $('.FormSuggestion-title').html('Create Suggestion');
            $("[name='action']").val('create');
            $("[name='subject']").val('');
            $("[name='content']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormSuggestion').modal({backdrop: 'static', keyboard: false});
            $('#modalFormSuggestion').modal('show');
            $("[name='suggestion_id']").val('');
        }

        function show_form_update(id){          
            $.ajax({
                type: "POST",
                url: "{!! route('member-post-suggestion') !!}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='subject']").val(response.subject);
                    $("[name='content']").val(response.content);
                }
            });
            $("[name='suggestion_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.area-publish').hide();
            $('.area-unpublish').hide();
            $('.FormSuggestion-title').html('Edit Suggestion');
            $("[name='action']").val('update');
            $('#modalFormSuggestion').modal({backdrop: 'static', keyboard: false});
            $('#modalFormSuggestion').modal('show');
        }
        function show_form_delete(id){         
            $("[name='suggestion_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormSuggestion-title').html('Delete Suggestion');
            $("[name='action']").val('delete');
            $('#modalFormSuggestion').modal({backdrop: 'static', keyboard: false});
            $('#modalFormSuggestion').modal('show');
        }
        
        $('.jquery-form-suggestion').ajaxForm({
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
                $('#modalFormSuggestion').modal('hide'); 
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
                        text: "Validation error, Check your data again !",
                        type: 'danger',
                        addclass: "stack-custom",
                        stack: myStack
                    });
                $("#modalFormSuggestion").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        }); 
    </script>
    @include('backend.delete-modal-datatables')
@endsection