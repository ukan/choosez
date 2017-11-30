@extends('layout.backend.admin.master.master')

@section('title', 'Download Management')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Download Management</span></li>
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

@section('page-header', 'Download Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Download Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="download-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">id</th>
                        <th class="center-align">Image</th>
                        <th class="center-align">Title</th>
                        <th class="center-align">Link</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getDownloadModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body" id="getContentDownloadModal">
            
          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  <div class="modal fade modal-getstart" id="modalFormDownload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormDownload-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-download', 'files'=>true, 'class' => 'form-horizontal jquery-form-download']) !!}
                <input type="hidden" name="action" id="action" value="">      
                <input type="hidden" name="download_id" value=""> 
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Image<b class="text-danger">*</b></label>
                    <div class="col-md-9">
                        {!! form_input_file_img('file','image') !!}
                        <p class="has-error text-danger error-image"></p>
                        <p class="upload-notif"><i>Upload image size must be less than 1 Mb</i></p>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Title<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('title', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-title"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">link<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('link', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-author"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Description<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('description', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-description"></p>
                    </div>
                    <div class="clear"></div>
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

    <script>
        $(".select2").select2();
        var table = $('#download-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-download') !!}",
                order: [[ 1, 'desc' ]],
                columns: [
                    {data: 'id', name: 'id',visible:false},
                    {data: 'image', name: 'image', class: 'center-align', searchable: false, orderable: false},
                    {data: 'title', name: 'title'},
                    {data: 'link', name: 'link'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        function show_download(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-download') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getDownloadModal").modal("show");
                    $("#getContentDownloadModal").html(msg);
                }
            });
        }
        function show_form_create(){           
            $('.FormDownload-title').html('Create Download');
            $("[name='action']").val('create');
            $("[name='title']").val('');
            $("[name='link']").val('');
            // $("[name='description']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormDownload').modal({backdrop: 'static', keyboard: false});
            $('#modalFormDownload').modal('show');
            $("[name='download_id']").val('');
            $(".fileinput-new.thumbnail.image").html('<img src="{{asset($pathp."assets/backend/porto-admin/images/!logged-user.png")}}" class="img-responsive">');
        }
        
        function show_form_update(id){          
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-download')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    if(response.image_path != ''){
                        $('.fileinput-new.thumbnail.image').html('<img src="'+ response.image_path +'" style="width:100px;height:auto" class=" img-responsive">');
                    }else{
                        $('.fileinput-new.thumbnail.image').html('<img src="{{ asset("assets/backend/porto-admin/images/!logged-user.png") }}" style="width:100px;height:auto" class="img-circle img-responsive">');
                    }
                    $("[name='title']").val(response.title);
                    $("[name='link']").val(response.link);
                    // $("[name='description']").val(response.description);
                }
            });
            $("[name='download_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.FormDownload-title').html('Update Data');
            $("[name='action']").val('update');
            $('#modalFormDownload').modal({backdrop: 'static', keyboard: false});
            $('#modalFormDownload').modal('show');
        }
        function show_form_delete(id){         
            $("[name='download_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormDownload-title').html('Delete Book');
            $("[name='action']").val('delete');
            $('#modalFormDownload').modal({backdrop: 'static', keyboard: false});
            $('#modalFormDownload').modal('show');
        }
        
        $('.jquery-form-download').ajaxForm({
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
                $('#modalFormDownload').modal('hide'); 
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
                $("#modalFormDownload").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        }); 
    </script>
    @include('backend.delete-modal-datatables')
@endsection