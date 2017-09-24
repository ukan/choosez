@extends('layout.backend.admin.master.master')

@section('title', 'Organigram Management')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Organigram Management</span></li>
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

@section('page-header', 'Organigram Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Organigram Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="organigram-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">id</th>
                        <th class="center-align">Image</th>
                        <th class="center-align">Name</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getOrganigramModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body" id="getContentOrganigramModal">

          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  <div class="modal fade modal-getstart" id="modalFormOrganigram" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormOrganigram-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-organigram', 'files'=>true, 'class' => 'form-horizontal jquery-form-organigram']) !!}
                <input type="hidden" name="action" id="action" value="">
                <input type="hidden" name="organigram_id" value="">
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Image<b class="text-danger">*</b></label>
                    <div class="col-md-9">
                        {!! form_input_file_img('file','image') !!}
                        <p class="has-error text-danger error-image"></p>
                        <p class="upload-notif"><i>Upload image size must be less than 1 Mb</i></p>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Name<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        <select name="nama" class="select2" style="width:100px">
                            @foreach($asrama as $key => $value)
                                <option value="{{ $value->id}}">{{ $value->nama_asrama}}</option>
                            @endforeach
                        </select>
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
  <div class="modal fade modal-getstart" id="modalFormOrganigramEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormOrganigram-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-organigram', 'files'=>true, 'class' => 'form-horizontal jquery-form-organigram']) !!}
                <input type="hidden" name="action" id="action" value="">
                <input type="hidden" name="organigram_id" value="">
                <input type="hidden" name="status_center" value="">
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Image<b class="text-danger">*</b></label>
                    <div class="col-md-9">
                        {!! form_input_file_img('file','image') !!}
                        <p class="has-error text-danger error-image"></p>
                        <p class="upload-notif"><i>Upload image size must be less than 1 Mb</i></p>
                    </div>
                </div>

                <div id="center" class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Name<b class="text-danger">*</b></label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control col-lg-8" id="nama" name="nama" readonly>
                        <p class="has-error text-danger error-nama"></p>
                    </div>
                    <div class="clear"></div>
                </div>

                <div id="hostel" class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Name<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        <select name="nama_asrama" class="select2" style="width:100px">
                            @foreach($asrama as $key => $value)
                                <option value="{{ $value->id}}">{{ $value->nama_asrama}}</option>
                            @endforeach
                        </select>
                        <p class="has-error text-danger error-name"></p>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="form-group area-insert-update">
                    <center>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary btn-submit', 'title' => 'Save']) !!}&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-warning btn-reset" type="reset">Reset</button>&nbsp;&nbsp;&nbsp;
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
        var table = $('#organigram-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-organigram') !!}",
                order: [[ 0, 'desc' ]],
                columns: [
                    {data: 'updated_at', name: 'updated_at',visible:false},
                    {data: 'image', name: 'image', class: 'center-align', searchable: false, orderable: false},
                    {data: 'nama', name: 'nama'},
                    {data: 'action', name: 'action', class: '', searchable: false, orderable: false}
                ]
            });
        function show_organigram(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-organigram-pusat') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getOrganigramModal").modal("show");
                    $("#getContentOrganigramModal").html(msg);
                }
            });
        }
        function show_form_create(){
            $('.FormOrganigram-title').html('Create Organigram');
            $("[name='action']").val('create');
            $("[name='nama']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormOrganigram').modal({backdrop: 'static', keyboard: false});
            $('#modalFormOrganigram').modal('show');
            $("[name='organigram_id']").val('');
            $(".fileinput-new.thumbnail.image").html('<img src="{{asset($pathp.'assets/backend/porto-admin/images/!logged-user.png')}}" class="img-responsive">');
        }

        function show_form_update(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-organigram')}}",
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
                        $('.fileinput-new.thumbnail.image').html('<img src="{{ asset($pathp."assets/backend/porto-admin/images/!logged-user.png") }}" style="width:100px;height:auto" class="img-circle img-responsive">');
                    }
                    $("[name='nama']").val(response.nama);
                }
            });
            if(id < 3){
                $("[name='status_center']").val('pusat');
                $("#hostel").addClass("hidden");
                $("#center").removeClass("hidden");
            }else{
                $("[name='status_center']").val('hostel');
                $("#center").addClass("hidden");
                $("#hostel").removeClass("hidden");
            }

            $("[name='organigram_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.FormOrganigram-title').html('Update Data');
            $("[name='action']").val('update');
            $('#modalFormOrganigramEdit').modal({backdrop: 'static', keyboard: false});
            $('#modalFormOrganigramEdit').modal('show');
        }
        function show_form_delete(id){
            $("[name='organigram_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormOrganigram-title').html('Delete Book');
            $("[name='action']").val('delete');
            $('#modalFormOrganigram').modal({backdrop: 'static', keyboard: false});
            $('#modalFormOrganigram').modal('show');
        }

        $('.jquery-form-organigram').ajaxForm({
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
                $('#modalFormOrganigram').modal('hide');
                $('#modalFormOrganigramEdit').modal('hide');
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
                $("#modalFormOrganigram").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        });
    </script>
    @include('backend.delete-modal-datatables')
@endsection
