@extends('layout.backend.admin.master.master')

@section('title', 'Bimtes')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Bimtes</span></li>
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

@section('page-header', 'Bimtes Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Bimtes Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <div class="scrollmenu">
                <table id="bimtes-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                    <thead>
                        <tr>
                            <th width="30%" class="center-align">Title</th>
                            <th class="center-align">Content</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
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

  <div class="modal fade modal-getstart" id="modalFormBimtes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div style="min-width: 1027px" class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormBimtes-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-bimtes', 'files'=>true, 'class' => 'form-horizontal jquery-form-bimtes']) !!}
                <input type="hidden" name="action" id="action" value="">      
                <input type="hidden" name="bimtes_id" value=""> 
                <div class="form-group area-insert-update">
                    <label class="col-md-2 control-label">Title <b class="text-danger">*</b></label>
                    <div class="col-lg-10">
                        {!! Form::text('title', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-title"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-2 control-label">Content <b class="text-danger">*</b></label>
                    <div class="col-lg-10">
                        {!! Form::textarea('content', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-content"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-2 control-label">Pamphlet <b class="text-danger">*</b></label>
                    <div class="col-md-9">
                        {!! form_input_file_img('file','image') !!}
                        <p class="has-error text-danger error-image"></p>
                        <p class="upload-notif"><i>Upload image size must be less than 1 Mb</i></p>
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
        var table = $('#bimtes-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-bimtes') !!}",
                order: [[ 1, 'desc' ]],
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'content', name: 'content'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        function show_bimtes(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-bimtes') }}",
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

        /*end ajaxForm for notification insert-update-delete*/
        function show_form_update(id){          
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-bimtes')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='title']").val(response.title);
                    $("[name='content']").val(response.content);
                }
            });
            $("[name='bimtes_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.area-publish').hide();
            $('.area-unpublish').hide();
            $('.FormBimtes-title').html('Update Data');
            $("[name='action']").val('update');
            $('#modalFormBimtes').modal({backdrop: 'static', keyboard: false});
            $('#modalFormBimtes').modal('show');
        }
        
            $('.jquery-form-bimtes').ajaxForm({
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
    </script>
    @include('backend.delete-modal-datatables')
@endsection