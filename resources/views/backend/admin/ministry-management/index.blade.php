@extends('layout.backend.admin.master.master')

@section('title', 'Ministry Management')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Ministry Management</span></li>
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

@section('page-header', 'Ministry Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Ministry Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="ministry-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">id</th>
                        <th class="center-align">Bidang</th>
                        <th class="center-align">Menteri</th>
                        <th class="center-align">Sekretaris</th>
                        <th class="center-align">Bendahara</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getMinistryModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body" id="getContentMinistryModal">
            
          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  <div class="modal fade modal-getstart" id="modalFormMinistry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormMinistry-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-kementerian', 'files'=>true, 'class' => 'form-horizontal jquery-form-ministry']) !!}
                <input type="hidden" name="action" id="action" value="">      
                <input type="hidden" name="kementerian_id" value=""> 
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
                    <label class="col-md-3 control-label">Menteri<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('menteri', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-menteri"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Sekretaris<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('sekretaris', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-sekretaris"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Bendahara<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('bendahara', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-bendahara"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Anggota<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('anggota', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-anggota"></p>
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
        var table = $('#ministry-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-ministry') !!}",
                order: [[ 1, 'desc' ]],
                columns: [
                    {data: 'id', name: 'id',visible:false},
                    {data: 'nama_bidang', name: 'nama_bidang'},
                    {data: 'menteri', name: 'menteri'},
                    {data: 'sekretaris', name: 'sekretaris'},
                    {data: 'bendahara', name: 'bendahara'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        function show_kementerian(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-kementerian-pusat') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getMinistryModal").modal("show");
                    $("#getContentMinistryModal").html(msg);
                }
            });
        }
        function show_form_create(){           
            $('.FormMinistry-title').html('Create Ministry');
            $("[name='action']").val('create');
            $("[name='menteri']").val('');
            $("[name='sekretaris']").val('');
            $("[name='bendahara']").val('');
            $("[name='anggota']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormMinistry').modal({backdrop: 'static', keyboard: false});
            $('#modalFormMinistry').modal('show');
            $("[name='kementerian_id']").val('');
        }
        
        function show_form_update(id){          
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-kementerian')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='bidang']").val(response.bidang);
                    $("[name='menteri']").val(response.menteri);
                    $("[name='sekretaris']").val(response.sekretaris);
                    $("[name='bendahara']").val(response.bendahara);
                    $("[name='anggota']").val(response.anggota);
                }
            });
            $("[name='kementerian_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.FormMinistry-title').html('Update Data');
            $("[name='action']").val('update');
            $('#modalFormMinistry').modal({backdrop: 'static', keyboard: false});
            $('#modalFormMinistry').modal('show');
        }

        function show_form_delete(id){         
            $("[name='kementerian_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormMinistry-title').html('Delete Ministry');
            $("[name='action']").val('delete');
            $('#modalFormMinistry').modal({backdrop: 'static', keyboard: false});
            $('#modalFormMinistry').modal('show');
        }
        
        $('.jquery-form-ministry').ajaxForm({
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
                $('#modalFormMinistry').modal('hide'); 
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
                $("#modalFormMinistry").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        }); 
    </script>
    @include('backend.delete-modal-datatables')
@endsection