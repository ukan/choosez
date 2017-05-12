@extends('layout.backend.admin.master.master')

@section('title', 'Bulletin Boards')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-home"></i> Home</a></li>
        <li><span>Bulletin Boards</span></li>
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

@section('page-header', 'News Management')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">News Management</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
            <br><br>
            <table id="bulletin-boards-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">Image</th>
                        <th class="center-align">Create At</th>
                        <th class="center-align">Title</th>
                        <th class="center-align">Content</th>
                        <th class="center-align">Type</th>
                        <th class="center-align">Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="getBulletinBoardModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" id="getContentBulletinBoardModal">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    <!-- modal action member -->
    <div class="modal fade modal-getstart" id="modalFormAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title FormFunnelProduct-title" id="myModalLabel">Create</h4>
            </div>
            <div class="modal-body">

            {!! Form::open(['route'=>'admin-post-publish-bulletin-board', 'files'=>true, 'class' => 'form-horizontal jquery-form-change-status']) !!}
                <input type="hidden" name="id" value="">
                <div class="form-group area-insert-update">
                    <div class="col-sm-12 image-block" align="center"></div>
                </div>
                <div class="form-group area-publish">
                    <div class="col-md-12">
                        <center>Are you sure want to publish ?</center>
                    </div>
                </div>
                <div class="form-group area-unpublish">
                    <div class="col-md-12">
                        <center>Are you sure want to unpublish ?</center>
                    </div>
                </div>

                <div class="form-group area-publish">
                    <center>
                        {!! Form::submit('Publish', ['class' => 'btn btn-success btn-submit', 'title' => 'Publish']) !!}
                        <input type="hidden" name="action">
                        <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </center>
                </div>
                <div class="form-group area-unpublish">
                    <center>
                        {!! Form::submit('Unpublish', ['class' => 'btn btn-success btn-submit', 'title' => 'Unpublish']) !!}
                        <input type="hidden" name="action">
                        <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </center>
                </div>
            </form>
           </div>
          </div>
        </div>
    </div>
    <!-- modal register -->
  <div class="modal fade modal-getstart" id="modalFormBulletinBoard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title FormBulletinBoard-title" id="myModalLabel">Create</h4>
        </div>
        <div class="modal-body">
        {!! Form::open(['route'=>'admin-post-bulletin-board', 'files'=>true, 'class' => 'form-horizontal jquery-form-bulletin-board']) !!}
                <input type="hidden" name="action" id="action" value="">      
                <input type="hidden" name="bulletin_board_id" value=""> 
                <div class="form-group area-insert-update">
                    {!! Form::label('type', 'Type', array('class' => 'col-lg-3 control-label')) !!}
                    <div class="col-lg-9">
                        <select onchange="changeCondition()" id="type" name="type" class="select2" style="width:100px">
                            <option value="news">News</option>
                            <option value="article">Article</option>
                        </select>                   
                        <p class="has-error text-danger error-type"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Image <b class="text-danger">*</b></label>
                    <div class="col-md-9">
                        {!! form_input_file_img('file','image') !!}
                        <p class="has-error text-danger error-image"></p>
                    </div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Title <b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::text('title', null, array('class' => 'form-control col-lg-8', 'autofocus' => 'true')) !!}
                        <p class="has-error text-danger error-title"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="form-group area-insert-update">
                    <label class="col-md-3 control-label">Content <b class="text-danger">*</b></label>
                    <div class="col-lg-9">
                        {!! Form::textarea('content', null, array('class' => 'ckeditor')) !!}
                        <p class="has-error text-danger error-content"></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div id="author" class="form-group area-insert-update hidden">
                    {!! Form::label('author', 'Author', array('class' => 'col-lg-3 control-label')) !!}
                    <div class="col-lg-9">
                        {!! Form::text('author', null, array('class' => 'form-control')) !!}
                        <p class="has-error text-danger error-author"></p>
                    </div>
                    <div class="clear"></div>
                </div>
               <!--  <div class="form-group area-insert-update">
                    {!! Form::label('publish_status', 'Publish', array('class' => 'col-lg-3 control-label')) !!}
                    <div class="col-lg-9">
                        <select name="publish_status" class="select2" style="width:100px">
                            <option value="on">Yes</option>
                            <option value="off">No</option>
                        </select>                   
                        <p class="has-error text-danger error-publish_status"></p>
                    </div>
                    <div class="clear"></div>
                </div> -->
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
        function changeCondition(){
            if($("#type").val() == "article"){
                $('#author').removeClass('hidden');
            }else{
                $('#author').addClass('hidden');
            }
        }
        var table = $('#bulletin-boards-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('datatables-bulletin-boards') !!}",
                order: [[ 1, 'desc' ]],
                columns: [
                    {data: 'img_url', name: 'img_url', class: 'center-align', searchable: false, orderable: false},
                    {data: 'created_at', name: 'created_at',visible:false},
                    {data: 'title', name: 'title'},
                    {data: 'content', name: 'content'},
                    {data: 'status', name: 'status'},
                    {data: 'publish_status', name: 'publish_status'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        function show_bulletin_boards(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-show-bulletin-board') }}",
                data: {
                    'id': id
                },
                success: function(msg)
                {
                    $("#getBulletinBoardModal").modal("show");
                    $("#getContentBulletinBoardModal").html(msg);
                }
            });
        }
        function show_form_create(){           
            $('.FormBulletinBoard-title').html('Create Bulletin');
            $("[name='action']").val('create');
            $("[name='title']").val('');
            $("[name='content']").val('');
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('#modalFormBulletinBoard').modal({backdrop: 'static', keyboard: false});
            $('#modalFormBulletinBoard').modal('show');
            $("[name='bulletin_board_id']").val('');
            $(".thumbnail.image").html('<img src="{{asset($pathp.'assets/backend/admin/img/boxed-bg.jpg')}}" class="img-responsive">');
        }
        /*start show for active member*/
        function show_form_unpublish(id){
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

            $("[name='bulletin_board_id']").val(id);
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
                url: "{{ route('admin-post-bulletin-board')}}",
                data: {
                    'id': id,
                    'action': 'get-data'
                },
                dataType: 'json',
                success: function(response)
                {
                    if(response.img_url != ''){
                        $('.fileinput-new.thumbnail.image').html('<img src="'+ response.img_url +'" style="width:100px;height:auto" class="img-circle img-responsive">');
                    }else{
                        $('.fileinput-new.thumbnail.image').html('<img src="{{ asset("assets/backend/porto-admin/images/!logged-user.png") }}" style="width:100px;height:auto" class="img-circle img-responsive">');
                    }
                    $("[name='title']").val(response.title);
                    $("[name='content']").val(response.content);
                    $("[name='author']").val(response.author);
                    $("[name='type']").val(response.type);
                    $('select[name=publish_status]').val(response.publish_status).change();

                }
            });
            $("[name='bulletin_board_id']").val(id);
            $('.area-insert-update').show();
            $('.area-delete').hide();
            $('.area-publish').hide();
            $('.area-unpublish').hide();
            $('.FormBulletinBoard-title').html('Update Bulletin Board');
            $("[name='action']").val('update');
            $('#modalFormBulletinBoard').modal({backdrop: 'static', keyboard: false});
            $('#modalFormBulletinBoard').modal('show');
        }
        function show_form_delete(id){         
            $("[name='bulletin_board_id']").val(id);
            $('.area-insert-update').hide();
            $('.area-delete').show();
            $('.FormBulletinBoard-title').html('Delete Bulletin Board');
            $("[name='action']").val('delete');
            $('#modalFormBulletinBoard').modal({backdrop: 'static', keyboard: false});
            $('#modalFormBulletinBoard').modal('show');
        }
        
            $('.jquery-form-bulletin-board').ajaxForm({
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
                    $('#modalFormBulletinBoard').modal('hide'); 
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
                    $("#modalFormBulletinBoard").scrollTop(0);
                  } else {
                      $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
                  }
                }
            }); 
    </script>
    @include('backend.delete-modal-datatables')
@endsection