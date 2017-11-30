@extends('layout.backend.admin.master.master')

@section('title', 'Banner Management')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Banner Management</span></li>
    </ol>
@endsection

@section('header')
    {!! Html::style($pathp.'assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
        .hidden {
            display: none;
        }
    </style>
@endsection

@section('page-header', 'Banner Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Banner Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="data-tables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">id</th>
                        <th class="center-align">updated</th>
                        <th class="center-align">Image</th>
                        <th class="center-align">Name</th>
                        <th class="center-align">Category</th>
                        <th class="center-align">Link</th>
                        <th class="center-align">Index</th>
                        <th class="center-align" width="12%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getModalData" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body" id="getContentModal">

          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  <div class="modal fade modal-getstart" id="modalFormData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormData-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-banner', 'files'=>true, 'class' => 'form-horizontal jquery-form-data']) !!}
                <input type="hidden" name="action" id="action" value="">
                <input type="hidden" name="data_id" value="">
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Image<b class="text-danger">*</b></label>
                    <div class="col-md-9">
                        {!! form_input_file_img('file','image') !!}
                        <p class="has-error text-danger error-image"></p>
                        <p class="upload-notif"><i>Upload image size must be less than 1 Mb</i></p>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-lg-9">
                        {!! Form::text('name', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-name"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-lg-9">
                        <select name="category" class="select2" style="width:150px">
                            <option value="Category">Category</option>
                            <option value="Hompage Headline">Hompage Headline</option>
                            <option value="Hompage Facilities">Hompage Facilities</option>
                        </select>
                        <p class="has-error text-danger error-category"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Link</label>
                    <div class="col-lg-9">
                        {!! Form::text('link', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-link"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Index Order<b class="text-danger">*</b></label>
                    <div class="col-xs-2">
                        <!-- <input type="text" name="indexOrder" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57"> -->
                        {!! Form::text('indexOrder', null, array('class' => 'form-control', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-indexOrder"></p>
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
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });

        $(".select2").select2();
        var table = $('#data-tables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-banner') !!}",
                order: [[ 1, 'desc' ]],
                columns: [
                    {data: 'id', name: 'id',visible:false},
                    {data: 'updated_at', name: 'updated_at',visible:false},
                    {data: 'image', name: 'image', class: 'center-align', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'category', name: 'category'},
                    {data: 'link', name: 'link'},
                    {data: 'index_order', name: 'index_order'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        function show_data(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-banner') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getModalData").modal("show");
                    $("#getContentModal").html(msg);
                }
            });
        }
        function show_form_create(){
            $('.FormData-title').html('Create Banner');
            $("[name='action']").val('create');
            $("[name='name']").val('');
            $("[name='link']").val('');
            $('select[name=category]').val('Category').change();
            $("[name='indexOrder']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormData').modal({backdrop: 'static', keyboard: false});
            $('#modalFormData').modal('show');
            $("[name='data_id']").val('');
            $(".fileinput-new.thumbnail.image").html('<img src="{{asset($pathp.'assets/backend/admin/img/boxed-bg.jpg')}}" class="img-responsive">');
        }

        function show_form_update(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-banner')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    if(response.image != ''){
                        $('.fileinput-new.thumbnail.image').html('<img src="'+ response.image +'" style="width:100px;height:auto" class=" img-responsive">');
                    }else{
                        $('.fileinput-new.thumbnail.image').html('<img src="{{ asset("assets/backend/admin/img/boxed-bg.jpg") }}" style="width:100px;height:auto" class="img-circle img-responsive">');
                    }
                    $("[name='name']").val(response.name);
                    $("[name='link']").val(response.link);
                    $('select[name=category]').val(response.category).change();
                    $("[name='indexOrder']").val(response.indexOrder);
                }
            });

            $("[name='data_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.FormData-title').html('Update Banner');
            $("[name='action']").val('update');
            $('#modalFormData').modal({backdrop: 'static', keyboard: false});
            $('#modalFormData').modal('show');
        }
        function show_form_delete(id){
            $("[name='data_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormData-title').html('Delete Banner');
            $("[name='action']").val('delete');
            $('#modalFormData').modal({backdrop: 'static', keyboard: false});
            $('#modalFormData').modal('show');
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
                $('#modalFormData').modal('hide');
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
                $("#modalFormData").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        });
    </script>
    @include('backend.delete-modal-datatables')
@endsection
