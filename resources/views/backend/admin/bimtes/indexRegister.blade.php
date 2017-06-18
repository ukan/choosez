@extends('layout.backend.admin.master.master')

@section('title', 'Bimtes Register User')

@section('breadcrumb')
    <ol class="breadcrumbs">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-users"></i> Home</a></li>
        <li><span>Bimtes Register User</span></li>
    </ol>
@endsection

@section('header')
    {!! Html::style($pathp.'assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
        a.disabled {
           /*pointer-events: none;*/
           cursor: default;
        }
    </style>
@endsection

@section('page-header', 'Bimtes Register User')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Bimtes Register User</h3>
        </div>
        <div class="panel-body">
            @include('flash::message')
            <br><br>
            <div class="scrollmenu">
                <table id="trustees-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                    <thead>
                        <tr>
                            <th class="center-align">Photo</th>
                            <th class="center-align">Name</th>
                            <th class="center-align">Phone</th>
                            <!-- <th class="center-align">Email</th> -->
                            <th class="center-align">Test Number</th>
                            <th class="center-align">Test Date</th>
                            <th class="center-align">Status</th>
                            <th class="center-align" width="2%">Action</th>
                        </tr>
                    </thead>
                </table>

                <!-- start fiture upload -->
                <div class="">
                    <!-- <div class="pull-left">
                        <button data-toggle="modal" data-target="#import" title="Upload" id="upload" name="upload" class="btn btn-primary">
                                <b>Bulk Upload</b>
                            </button>
                            &nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="pull-left">
                        <a href="{{ URL::to('lead-management/lead-report/download/xlsx') }}">
                            <button id="uploadFormat" name="uploadFormat" title="download format" class="btn btn-primary"><b>Download Format</b></button></a>
                        <i style="font-size: 18px;" class="fa fa-question-circle" rel="tooltip" title="" data-original-title="Aturan format file bulk upload sudah tertera didalam file, anda dapat menambahkan beberapa other attributes sesuai kebutuhan anda"></i>
                    </div>
                     --><div class="pull-left">
                        <a href="javascript:exportTo()">
                            <button title="Download" id="dwXls" name="dwXls" class="btn btn-primary"><b>Download</b></button>
                        </a>
                    </div>
                </div>
                <!-- end fiture download -->
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

    <div class="modal fade modal-getstart" id="modalFormApproval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title FormDecode-title" id="myModalLabel"><i class="fa fa-exclamation fa-fw"></i>Add</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['route'=>'change-status', 'files'=>true, 'class' => 'form-horizontal jquery-form-bimtes']) !!}
                    <input type="hidden" name="method" id="method" value="">      
                    <input type="hidden" name="id" value="">

                    <div class="form-group area-approve">                    
                        <div class="col-md-12">
                             <center class="confirmation-message">Are You Sure Want To Approve ?</center>
                        </div>
                    </div>

                    <div class="form-group area-approve">
                        <center>
                            <button type="submit" class="btn btn-success btn-submit btn-success">Approve</button>
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

    <script>
        var table = $('#trustees-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{!! route('datatables-bimtes-register') !!}",
            columns: [
                {data: 'photo', name: 'photo', class: 'center-align'},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
                // {data: 'email', name: 'email'},
                {data: 'test_number', name: 'test_number'},
                {data: 'test_day', name: 'test_day', searchable: false},
                {data: 'status', name: 'status', class: 'center-align', searchable: false},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ]
        });

        function show_bimtes_register(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-bimtes-register-show-user') }}",
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

        /*start set update */
        function show_form_proccess_approve(id){            
            
            $.ajax({
                type: "POST",
                url: "{{ route('get-data-approval')}}",
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='id']").val(response.id);
                }
            });
            
            $('.has-error').html('');
            $('.head-has-error').removeClass('text-danger');
            $('.area-approve').show();
            $('.area-deny').hide();
            $('.FormDecode-title').html('Approve');
            $("[name='method']").val('Approved');
            $('#modalFormApproval').modal({backdrop: 'static', keyboard: false});
            $('#modalFormApproval').modal('show');
        }
        /*end set update */

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
                $('#modalFormApproval').modal('hide'); 
                $('#getBimtesModal').modal('hide'); 
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
    <script language="javascript" type="text/javascript">
        var excelID = document.getElementById("dwXls");
        var type = '';
        excelID.onclick = function(){
            type = 'xlsx';
            fromDate = $('input[name=fromDate]').val();
            untilDate = $('input[name=untilDate]').val();
            keywords = $('input[type=search]').val();
        }
        
        exportTo = function() {
            if(keywords == ""){
                keywords = '';
            }
            location.href = "bimtes-register/download/"+type+"/"+fromDate+"/"+untilDate;
        }
    </script>
    @include('backend.delete-modal-datatables')
@endsection