@extends('layout.backend.admin.master.master')

@section('title', 'Manage Teacher')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Manage Teacher</span></li>
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

@section('page-header', 'Manage Teacher')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Manage Teacher</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="teacher-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">Photo</th>
                        <th class="center-align">Photo</th>
                        <th class="center-align">Name</th>
                        <th class="center-align">Email</th>
                        <th class="center-align">Phone</th>
                        <th class="center-align">Position</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getTeacherModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body" id="getContentTeacherModal">
            
          </div>
          <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
  <div class="modal fade modal-getstart" id="modalFormTeacher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormTeacher-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-teacher', 'files'=>true, 'class' => 'form-horizontal jquery-form-teacher']) !!}
                <input type="hidden" name="action" id="action" value="">      
                <input type="hidden" name="teacher_id" value=""> 
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Photo <b class="text-danger">*</b></label>
                    <div class="col-md-9">
                        {!! form_input_file_img('file','image') !!}
                        <p class="has-error text-danger error-image"></p>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">name<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('name', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-name"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Email<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('email', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-email"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">phone<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('phone', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-phone"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Position<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        <select name="position" class="select2" style="width:100px">
                            <option value="leadership">Pimpinan</option>
                            <option value="hod_ac">Kepala Bidang Akademik</option>
                            <option value="hod_ks">Kepala Bidang Kesantrian</option>
                            <option value="treasurer">Bendahara</option>
                            <option value="teacher">Dewan Guru</option>
                        </select>                   
                        <p class="has-error text-danger error-position"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Address <b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('address', null, array('class' => '')) !!}
                        <p class="has-error text-danger error-address"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Academic <b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('academic', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-academic"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Organization <b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('organization', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-organization"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Postal Code<b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('postal_code', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-postal_code"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Facebook</label>
                    <div class="col-lg-9">
                        {!! Form::text('facebook', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-facebook"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Instagram</label>
                    <div class="col-lg-9">
                        {!! Form::text('instagram', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-instagram"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">LinkedIn</label>
                    <div class="col-lg-9">
                        {!! Form::text('linkedin', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-linkedin"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Caption</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('caption', null, array('class' => '')) !!}
                        <p class="has-error text-danger error-caption"></p>
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
        var table = $('#teacher-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-teacher') !!}",
                order: [[ 1, 'desc' ]],
                columns: [
                    {data: 'id', name: 'id',visible:false},
                    {data: 'photo', name: 'photo', class: 'center-align', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'position', name: 'position'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        function show_teacher(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-teacher') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getTeacherModal").modal("show");
                    $("#getContentTeacherModal").html(msg);
                }
            });
        }
        function show_form_create(){           
            $('.FormTeacher-title').html('Create Teacher');
            $("[name='action']").val('create');
            $("[name='name']").val('');
            $("[name='email']").val('');
            $("[name='phone']").val('');
            $("[name='address']").val('');
            $("[name='academic']").val('');
            $("[name='organization']").val('');
            $("[name='postal_code']").val('');
            $("[name='facebook']").val('');
            $("[name='instagram']").val('');
            $("[name='linkedin']").val('');
            $("[name='caption']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormTeacher').modal({backdrop: 'static', keyboard: false});
            $('#modalFormTeacher').modal('show');
            $("[name='teacher_id']").val('');
            $(".fileinput-new.thumbnail.image").html('<img src="{{asset($pathp.'assets/backend/porto-admin/images/!logged-user.jpg')}}" class="img-responsive">');
        }
        /*start show for active member*/
        function show_form_unpublish(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-get-publish-teacher')}}",
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='id']").val(response.id);
                }
            });

            $("[name='teacher_id']").val(id);
            $('.area-delete').hide();
            $('.area-insert-update').hide();
            $('.area-publish').hide();
            $('.area-unpublish').show();
            $('.FormFunnelProduct-title').html('Unpublish');
            $("[name='action']").val('unpublish');
            $('#modalFormAction').modal({backdrop: 'static', keyboard: false});
            $('#modalFormAction').modal('show');
        }
        /*end show for active member*/

        /*start show for active member*/
        function show_form_publish(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-get-publish-bulletin-board')}}",
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='id']").val(response.id);
                }
            });
            $('.area-delete').hide();
            $('.area-insert-update').hide();
            $('.area-unpublish').hide();
            $('.area-publish').show();
            $('.FormFunnelProduct-title').html('Publish');
            $("[name='action']").val('publish');
            $('#modalFormAction').modal({backdrop: 'static', keyboard: false});
            $('#modalFormAction').modal('show');
        }
        /*end show for active member*/

        /*start ajaxForm for notification insert-update-delete*/
        $('.jquery-form-change-status').ajaxForm({
            dataType : "json",

            success: function(response) {
                if(response.status == 'success'){
                    var title_not = 'Notification';
                    var type_not = 'success';

                    table.ajax.reload();
                    $('#modalFormAction').modal('hide');
                }else{
                    var title_not = 'Notification';
                    var type_not = 'failed';
                }
                var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                new PNotify({
                    title: title_not,
                    text: response.notification,
                    type: type_not,
                    addclass: "stack-custom",
                    stack: myStack
                });
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
                    $("#modalFormAction").scrollTop(0);
                    $("#modalFormAction").scrollTop(0);
                  } else {
                      $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
                  }
            }
        });
        /*end ajaxForm for notification insert-update-delete*/
        function show_form_update(id){          
            $.ajax({
                type: "POST",
                url: "{{ route('admin-post-teacher')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    if(response.img_url != ''){
                        $('.fileinput-new.thumbnail.image').html('<img src="'+ response.photo +'" style="width:100px;height:auto" class=" img-responsive">');
                    }else{
                        $('.fileinput-new.thumbnail.image').html('<img src="{{ asset("assets/backend/porto-admin/images/!logged-user.jpg") }}" style="width:100px;height:auto" class="img-circle img-responsive">');
                    }
                    $("[name='name']").val(response.name);
                    $("[name='email']").val(response.email);
                    $("[name='phone']").val(response.phone);
                    $('select[name=position]').val(response.position).change();
                    $("[name='address']").val(response.address);
                    $("[name='academic']").val(response.academic);
                    $("[name='organization']").val(response.organization);
                    $("[name='postal_code']").val(response.postal_code);
                    $("[name='facebook']").val(response.facebook);
                    $("[name='instagram']").val(response.instagram);
                    $("[name='linkedin']").val(response.linkedin);
                    $("[name='caption']").val(response.caption);

                }
            });
            $("[name='teacher_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.area-publish').hide();
            $('.area-unpublish').hide();
            $('.FormTeacher-title').html('Update Teacher Data');
            $("[name='action']").val('update');
            $('#modalFormTeacher').modal({backdrop: 'static', keyboard: false});
            $('#modalFormTeacher').modal('show');
        }
        function show_form_delete(id){         
            $("[name='teacher_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormTeacher-title').html('Delete Teacher');
            $("[name='action']").val('delete');
            $('#modalFormTeacher').modal({backdrop: 'static', keyboard: false});
            $('#modalFormTeacher').modal('show');
        }
        
            $('.jquery-form-teacher').ajaxForm({
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
                    $('#modalFormTeacher').modal('hide'); 
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
                    $("#modalFormTeacher").scrollTop(0);
                  } else {
                      $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
                  }
                }
            }); 
    </script>
    @include('backend.delete-modal-datatables')
@endsection