@extends('layout.backend.admin.master.master')

@section('title', 'Slider Management')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Slider Management</span></li>
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

@section('page-header', 'Slider Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Slider Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="slider-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">id</th>
                        <th class="center-align">Image</th>
                        <th class="center-align">Category</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getSliderModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body" id="getContentSliderModal">

          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  <div class="modal fade modal-getstart" id="modalFormSlider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormSlider-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-slider', 'files'=>true, 'class' => 'form-horizontal jquery-form-slider']) !!}
                <input type="hidden" name="action" id="action" value="">
                <input type="hidden" name="slider_id" value="">
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Image<b class="text-danger">*</b></label>
                    <div class="col-md-9">
                        {!! form_input_file_img('file','image') !!}
                        <p class="has-error text-danger error-image"></p>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Category<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        <select name="category" class="select2" style="width:100px">
                            <option value="Achievement">Achievement</option>
                            <option value="Bimtes">Bimtes</option>
                            <option value="Facilities">Facilities</option>
                            <option value="History">History</option>
                            <option value="Structure">Structure</option>
                            <option value="UKS">UKS</option>
                        </select>
                        <p class="has-error text-danger error-category"></p>
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
  <div class="modal fade modal-getstart" id="modalFormSliderEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormSlider-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-slider', 'files'=>true, 'class' => 'form-horizontal jquery-form-slider']) !!}
                <input type="hidden" name="action" id="action" value="">
                <input type="hidden" name="slider_id" value="">
                <input type="hidden" name="status_center" value="">
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Image<b class="text-danger">*</b></label>
                    <div class="col-md-9">
                        {!! form_input_file_img('file','image') !!}
                        <p class="has-error text-danger error-image"></p>
                    </div>
                </div>

                <div id="center" class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Category<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        <select name="category" class="select2" style="width:100px">
                            <option value="Achievement">Achievement</option>
                            <option value="Bimtes">Bimtes</option>
                            <option value="Facilities">Facilities</option>
                            <option value="History">History</option>
                            <option value="Structure">Structure</option>
                            <option value="UKS">UKS</option>
                        </select>
                        <p class="has-error text-danger error-category"></p>
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
        var table = $('#slider-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-slider') !!}",
                order: [[ 0, 'desc' ]],
                columns: [
                    {data: 'id', name: 'id',visible:false},
                    {data: 'image', name: 'image', class: 'center-align', searchable: false, orderable: false},
                    {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', class: '', searchable: false, orderable: false}
                ]
            });
        function show_slider(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-slider') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getSliderModal").modal("show");
                    $("#getContentSliderModal").html(msg);
                }
            });
        }
        function show_form_create(){
            $('.FormSlider-title').html('Create Slider');
            $("[name='action']").val('create');
            $("[name='category']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormSlider').modal({backdrop: 'static', keyboard: false});
            $('#modalFormSlider').modal('show');
            $("[name='slider_id']").val('');
            $(".fileinput-new.thumbnail.image").html('<img src="{{asset($pathp.'assets/frontend/porto/img/holder.png')}}" class="img-responsive">');
        }

        function show_form_update(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-slider')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    if(response.img_url != ''){
                        $('.fileinput-new.thumbnail.image').html('<img src="'+ response.image +'" style="width:100px;height:auto" class=" img-responsive">');
                    }else{
                        $('.fileinput-new.thumbnail.image').html('<img src="{{asset($pathp.'assets/frontend/porto/img/holder.png')}}" style="width:100px;height:auto" class="img-circle img-responsive">');
                    }
                    $("[name='category']").val(response.category);
                }
            });

            $("[name='slider_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.FormSlider-title').html('Update Data');
            $("[name='action']").val('update');
            $('#modalFormSliderEdit').modal({backdrop: 'static', keyboard: false});
            $('#modalFormSliderEdit').modal('show');
        }
        function show_form_delete(id){
            $("[name='slider_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormSlider-title').html('Delete Slider');
            $("[name='action']").val('delete');
            $('#modalFormSlider').modal({backdrop: 'static', keyboard: false});
            $('#modalFormSlider').modal('show');
        }

        $('.jquery-form-slider').ajaxForm({
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
                $('#modalFormSlider').modal('hide');
                $('#modalFormSliderEdit').modal('hide');
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
                $("#modalFormSlider").scrollTop(0);
              } else {
                  $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        });
    </script>
    @include('backend.delete-modal-datatables')
@endsection
