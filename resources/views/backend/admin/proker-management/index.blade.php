@extends('layout.backend.admin.master.master')

@section('title', 'Proker Management')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Proker Management</span></li>
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

@section('page-header', 'Proker Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Proker Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="proker-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">id</th>
                        <th class="center-align">Bidang</th>
                        <th class="center-align">Proker Bulanan</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getProkerModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body" id="getContentProkerModal">
            
          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  <div class="modal fade modal-getstart" id="modalFormProker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormProker-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-proker', 'files'=>true, 'class' => 'form-horizontal jquery-form-proker']) !!}
                <input type="hidden" name="action" id="action" value="">      
                <input type="hidden" name="proker_id" value=""> 
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Bidang<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        <select name="bidang" class="select2" style="width:100px">
                            @foreach($bidang as $key => $value)
                                <option value="{{ $value->id}}">{{ $value->nama_bidang}}</option>
                            @endforeach
                        </select>                   
                        <p class="has-error text-danger error-bidang"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Proker Mingguan<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('proker_mingguan', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-proker_mingguan"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Proker Bulanan<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('proker_bulanan', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-proker_bulanan"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Proker Tahunan<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('proker_tahunan', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-proker_tahunan"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Proker Kondisional<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('proker_kondisional', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-proker_kondisional"></p>
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
        var table = $('#proker-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-proker') !!}",
                order: [[ 1, 'desc' ]],
                columns: [
                    {data: 'id', name: 'id',visible:false},
                    {data: 'nama_bidang', name: 'nama_bidang'},
                    {data: 'proker_bulanan', name: 'proker_bulanan'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        function show_proker(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-proker-pusat') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getProkerModal").modal("show");
                    $("#getContentProkerModal").html(msg);
                }
            });
        }
        function show_form_create(){           
            $('.FormProker-title').html('Create Proker');
            $("[name='action']").val('create');
            $("[name='proker_mingguan']").val('');
            $("[name='proker_bulanan']").val('');
            $("[name='proker_tahunan']").val('');
            $("[name='proker_kondisional']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormProker').modal({backdrop: 'static', keyboard: false});
            $('#modalFormProker').modal('show');
            $("[name='proker_id']").val('');
        }
        
        function show_form_update(id){          
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-proker')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='bidang']").val(response.bidang);
                    $("[name='proker_mingguan']").val(response.proker_mingguan);
                    $("[name='proker_bulanan']").val(response.proker_bulanan);
                    $("[name='proker_tahunan']").val(response.proker_tahunan);
                    $("[name='proker_kondisional']").val(response.proker_kondisional);
                }
            });
            $("[name='proker_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.FormProker-title').html('Update Data');
            $("[name='action']").val('update');
            $('#modalFormProker').modal({backdrop: 'static', keyboard: false});
            $('#modalFormProker').modal('show');
        }

        function show_form_delete(id){         
            $("[name='proker_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormProker-title').html('Delete Proker');
            $("[name='action']").val('delete');
            $('#modalFormProker').modal({backdrop: 'static', keyboard: false});
            $('#modalFormProker').modal('show');
        }
        
        $('.jquery-form-proker').ajaxForm({
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
                $('#modalFormProker').modal('hide'); 
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
                $("#modalFormProker").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        }); 
    </script>
    @include('backend.delete-modal-datatables')
@endsection