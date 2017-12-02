@extends('layout.backend.admin.master.master')

@section('title', 'Download Category Management')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Download Category Management</span></li>
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

@section('page-header', 'Download Category Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Download Category Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="download-category-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">id</th>
                        <th class="center-align">Name</th>
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
        {!! Form::open(['route'=>'admin-post-download-category', 'files'=>true, 'class' => 'form-horizontal jquery-form-download']) !!}
                <input type="hidden" name="action" id="action" value="">      
                <input type="hidden" name="download_category_id" value=""> 
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Name<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('name', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-name"></p>
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
        var table = $('#download-category-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-download-category') !!}",
                order: [[ 1, 'desc' ]],
                columns: [
                    {data: 'id', name: 'id',visible:false},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });

        function show_form_create(){           
            $('.FormDownload-title').html('Create Download');
            $("[name='action']").val('create');
            $("[name='name']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormDownload').modal({backdrop: 'static', keyboard: false});
            $('#modalFormDownload').modal('show');
            $("[name='download_category_id']").val('');
            $(".fileinput-new.thumbnail.image").html('<img src="{{asset($pathp."assets/backend/porto-admin/images/!logged-user.png")}}" class="img-responsive">');
        }
        
        function show_form_update(id){          
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-download-category')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    
                    $("[name='name']").val(response.name);
                }
            });
            $("[name='download_category_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.FormDownload-title').html('Update Data');
            $("[name='action']").val('update');
            $('#modalFormDownload').modal({backdrop: 'static', keyboard: false});
            $('#modalFormDownload').modal('show');
        }
        
        function show_form_delete(id){         
            $("[name='download_category_id']").val(id);
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