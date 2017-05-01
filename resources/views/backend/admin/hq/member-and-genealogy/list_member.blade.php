@extends('layout.backend.admin.master.master')

@section('title', 'List Member')

@section('page-header', 'List Member')

@section('breadcrumb')
	<ol class="breadcrumbs">
	  <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
	  <li><span>Member And Genealogy</span></li>
      <li><span>List Member</span></li>
	</ol>
@endsection

@section('content')
    	<div class="panel panel-primary">
    		<div class="panel-heading"><h3 class="panel-title">Member</h3></div>
    		<div class="panel-body">
                <div class="row">
                    <div class="col-md-7">
                        <label class="col-md-3 control-label"><b>Filter By Date</b> </label>                    
                        <div class="col-md-9">
                            <div class = "input-group">
                                <span class ="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="filter_start" class="form-control datepicker">
                                    <span class = "input-group-addon">To</span>
                                <input type="text" name="filter_end" class="form-control datepicker">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        
                        <div class="input-group">
                          <span class="input-group-btn">
                            <button class="btn btn-default" onclick="javascript:reset_zero_upline()">Reset</button>
                            <button class="btn btn-primary" onclick="javascript:check_zero_upline()">Check Zero Upline</button>
                          </span>
                        </div>
                    </div>
                </div>
                <br>
                <div>
                    Toggle column:
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="2">Member ID</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="3">Upline ID</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="4">Placement ID</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="5">Name</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="6">Upline Name</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="7">Plan</a>
                    <a class="toggle-vis btn-xs btn btn-primary btn-xs btn btn-primary" data-column="8">Gender</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="9">Date Of Birth</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="10">Email</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="11">Phone</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="12">Address</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="13">Province</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="14">City Or District</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="15">Sub District</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="16">Postal Code</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="17">Know Scoido From</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="18">Ktp Number</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="19">Npwp Number</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="20">Funnels Name</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="21">Status</a>
                    <a class="toggle-vis btn-xs btn btn-primary" data-column="22">Profile Completions</a>
                    <a class="btn btn-primary pull-right"onclick="javascript:show_form_create()" title="Create"><i class="fa fa-plus fa-fw"></i></a>
                </div>
                <br>
                <div style="overflow-y: hidden;-ms-overflow-style: -ms-autohiding-scrollbar">                    
                    <table id="list-member-table" class="table table-hover table-bordered table-condensed display nowrap" data-tables="true">
                        <thead>
                            <tr>
                                <th class="center-align">Crea</th>
                                <th class="center-align">Plan ID</th>
                                <th class="center-align">Member ID</th>
                                <th class="center-align">Upline ID</th>
                                <th class="center-align">Placement Upline ID</th>
                                <th class="center-align">Name</th>
                                <th class="center-align">Upline Name</th>
                                <th class="center-align">Plan</th>
                                <th class="center-align">Gender</th>
                                <th class="center-align">Date Of Birth</th>
                                <th class="center-align">Email</th>
                                <th class="center-align">Phone</th>
                                <th class="center-align">Address</th>
                                <th class="center-align">Province</th>
                                <th class="center-align">City Or District</th>
                                <th class="center-align">Sub District</th>
                                <th class="center-align">Postal Code</th>
                                <th class="center-align">Know Scoido From</th>
                                <th class="center-align">KTP Number</th>
                                <th class="center-align">NPWP Number</th>
                                <th class="center-align">Funnels Name</th>
                                <th class="center-align">Status</th>
                                <th class="center-align">Profile Completion</th>
                                <th class="center-align noExport">Action</th>
                        </thead>
                    </table>
                </div>
    		</div>
        </div>
                <!-- modal action member -->
                <div class="modal fade modal-getstart" id="modalFormMemberAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title FormFunnelProduct-title" id="myModalLabel">Add</h4>
                        </div>
                        <div class="modal-body">

                        {!! Form::open(['route'=>'admin-post-member', 'files'=>true, 'class' => 'form-horizontal jquery-form-change-status']) !!}
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="email" value="">
                            <div class="form-group area-insert-update">
                                <div class="col-sm-12 image-block" align="center"></div>
                            </div>
                            <div class="form-group area-banned">
                                <label class="col-md-3 control-label">Banneds Reason</label>
                                <div class="col-md-6">
                                    <textarea name="reason" class="form-control" rows="4"></textarea>
                                    <p class="has-error text-danger error-reason"></p>
                                </div>
                            </div>
                            <div class="form-group area-active">
                                <div class="col-md-12">
                                    <center>Are you sure want to active for user ?</center>
                                </div>
                            </div>
                            <div class="form-group area-banned">
                                <div class="col-md-12">
                                    <center>Are you sure want to banned this user ?</center>
                                </div>
                            </div>
                            <div class="form-group area-reset-password">
                                <div class="col-md-12">
                                    <center>Are you sure want to reset password for this user ?</center>
                                </div>
                            </div>

                            <div class="form-group area-active">
                                <center>
                                    {!! Form::submit('Active', ['class' => 'btn btn-success btn-submit', 'title' => 'Active']) !!}
                                    <input type="hidden" name="action">
                                    <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </center>
                            </div>
                            <div class="form-group area-banned">
                                <center>
                                    {!! Form::submit('Banned', ['class' => 'btn btn-danger btn-submit', 'title' => 'Banned']) !!}
                                    <input type="hidden" name="action">
                                    <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </center>
                            </div>
                            <div class="form-group area-reset-password">
                                <center>
                                    {!! Form::submit('Reset', ['class' => 'btn btn-danger btn-submit', 'title' => 'Reset']) !!}
                                    <input type="hidden" name="action">
                                    <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </center>
                            </div>
                        </form>
                       </div>
                      </div>
                    </div>
                </div>

  <div class="modal fade modal-getstart detail_users" id="detail_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" onclick="javascript:hide_user_details()"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detail Users</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <div class="col-sm-12 img-avatar-area" align="center">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputReadOnly">Scoido ID</label>
                    <div class="col-md-6">
                        <input type="text" name="member_id" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Upline ID</label>
                    <div class="col-md-6">
                        <input type="text" name="upline_id" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Placement Upline ID</label>
                    <div class="col-md-6">
                        <input type="text" name="mover_id" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Plan</label>
                    <div class="col-md-6">
                        <input type="text" name="plan" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">First Name</label>
                    <div class="col-md-6">
                        <input type="text" name="first_name" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Last Name</label>
                    <div class="col-md-6">
                        <input type="text" name="last_name" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        <input type="text" name="email" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('pin_bbm', 'Pin BBm', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        <input type="text" name="pin_bbm" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Phone</label>
                    <div class="col-md-6">
                        <input type="text" name="phone" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Address</label>
                    <div class="col-md-6">
                        <textarea name="address" class="form-control" readonly></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Province</label>
                    <div class="col-md-6">
                        <input type="text" name="province" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">City / District</label>
                    <div class="col-md-6">
                        <input type="text" name="city" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Sub District</label>
                    <div class="col-md-6">
                        <input type="text" name="district" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Postal Code</label>
                    <div class="col-md-6">
                        <input type="text" name="postal_code" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Ktp Number</label>
                    <div class="col-md-6">
                        <input type="text" name="ktp_number" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Ktp Photo</label>
                    <div class="col-md-offset-3 img-ktp-photo-area"></div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Npwp Number</label>
                    <div class="col-md-6">
                        <input type="text" name="ktp_number" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Npwp Photo</label>
                    <div class="col-md-offset-3 img-npwp-photo-area"></div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Default Rotation</label>
                    <div class="col-md-6">
                        <input type="text" name="default_rotation" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Funnel Path Name</label>
                    <div class="col-md-6">
                        <input type="text" name="funnels_name" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Bank</label>
                    <div class="col-md-6">
                        <input type="text" name="bank" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Bank Acount Number</label>
                    <div class="col-md-6">
                        <input type="text" name="bank_account_number" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Account Name Holder</label>
                    <div class="col-md-6">
                        <input type="text" name="account_name_holder" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Branch</label>
                    <div class="col-md-6">
                        <input type="text" name="branch" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Rotation</label>
                    <div class="col-md-6">
                        <input type="text" name="rotation_privilage" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Number Of Rotation</label>
                    <div class="col-md-6">
                        <input type="text" name="number_rotations" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Know Scoido From</label>
                    <div class="col-md-6">
                        <input type="text" name="knowing_scoido_of" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Start Date</label>
                    <div class="col-md-6">
                        <input type="text" name="created_at" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Start Paid Member</label>
                    <div class="col-md-6">
                        <input type="text" name="start_paid_member" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Last Due Date</label>
                    <div class="col-md-6">
                        <input type="text" name="last_due_date" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Funnels</label>
                    <div class="col-md-8">
                        <div class="list-funnels" readonly></div>
                    </div>
                </div>
        </div>

      </div>
    </div>
  </div>
<style type="text/css">
    .modal-body .col-md-6 .form-group{
        margin-left: 10px;
        margin-right: 10px;
    }
.btn-custom {
  background: transparent !important;
  border: 1px solid #fff !important;
  border-radius: 3px;
  padding: 6px 12px;
  margin-top: 15px;
  color: #fff !important;
  transition:0.5s ease all;
  -moz-transition:0.5s ease all;
  -webkit-transition:0.5s ease all;
}
.btn-custom-crop{

  background: rgb(155,213,161);
  border: 1px solid #fff !important;
  border-radius: 3px;
  padding: 6px 12px;
  margin-top: 15px;
  color: #fff !important;
  transition:0.5s ease all;
  -moz-transition:0.5s ease all;
  -webkit-transition:0.5s ease all;
}
.profile-box{
  background: #0088CC;
  color: #fff;
  padding-top: 15px;
  margin-bottom: 15px;
}
.btn-custom:hover,.btn-custom-crop:hover {  
/*  background: #fff !important;
  color: #ccc !important;
  border: 1px solid #fff !important;*/
}
.modal-header{
    border-bottom: 1px solid rgb(0,126,189) !important;
}
</style>
<div class="modal fade modal-getstart" id="modalFormCUUser" tabindex="-1" role="dialog" aria-labelledby="modalFormCUUser">
    <div class="" role="document" style="max-width:1027px;margin:10px auto">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title modalFormCUUser-title" id="modalFormCUUser">Edit Profile</h4>
        </div>
        <div class="modal-body" style="padding-top:0px">
        {!! Form::open(['route'=>'admin-post-member', 'files'=>true, 'class' => 'form-horizontal   jquery-form-update']) !!}
        <div class="row profile-box">            
            <div class="col-md-12">                
                <div class="form-group">
                    <div class="upload-msg" style="display: none;">
                        Upload a file to start cropping
                    </div>
                    <div class="box-upload-demo" style="display: none;"></div>
                    <div class="box-peview-avatar" align="center">
                        <img src="{{ user_info('avatar_path') }}" width="120" class="img-circle img-responsive">
                    </div>
                </div>
                        
                <div class="form-group demo-wrap upload-demo ">
                    <div class="actions" style="text-align: center">
                        <a class="btn file-btn" style="cursor: pointer;">
                            <span class="btn btn-primar btn-custom">Change Photo</span>
                            <input type="file" id="avatar" name="avatar" value="Choose a file" accept="image/*" />
                            <input type="hidden" name="image_base64_edit" id="image_base64_edit" value=""></input>
                            <input type="hidden" name="filename_edit" id="image_filename_edit" value=""></input>
                        </a>
                        <button type="button" id="btn-crop" class="btn btn-success upload-result-edit btn-custom" style="display: none;"><i class="fa fa-check"></i> Crop</button>
                        <p class="has-error text-danger edit-profile-avatar"></p>
                    </div>
                </div>
            </div>
        </div>        
            <input type="hidden" name="user_id" value="">    
            <input type="hidden" name="action" value="update">    
            <div class="col-md-6 update-area">
                <div class="form-group">
                    <label for="inputReadOnly">Scoido ID</label>
                    <div>                        
                      <div class = "input-group">
                        <input type="text" name="member_id" value="" id="inputReadOnly" class="form-control" readonly="readonly">                
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 create-area">
                <div class="form-group">
                    <label>Upline <b class="text-danger">*</b></label>
                    <div>
                        <select name="upline" id="upline_id" data-plugin-selectTwo class="form-control" style="width:100%">
                            
                            <option value="">Choose User</option> 
                        </select>
                        <p class="has-error text-danger edit-profile-upline"></p>
                    </div>
                </div>
            </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="clearfix">&nbsp;</div>
                        <div class="col-md-6 create-area">
                            <div class="form-group">
                                <label>Email <b class="text-danger">*</b></label>
                                <div>
                                    <input type="text" name="email" class="form-control">
                                    <p class="has-error text-danger edit-profile-email"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 create-area">
                            <div class="form-group">
                                <label>Password <b class="text-danger">*</b></label>
                                <div>
                                    <input type="password" name="password" class="form-control">
                                    <p class="has-error text-danger edit-profile-password"></p>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name <b class="text-danger">*</b></label>
                            <div>
                                <input type="text" name="first_name" class="form-control">
                                <p class="has-error text-danger edit-profile-first_name"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <div>
                                <input type="text" name="last_name" class="form-control">
                                <p class="has-error text-danger edit-profile-last_name"></p>
                            </div>
                        </div>
                    </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gender <b class="text-danger">*</b></label>
                    <div>
                        <div class="radio-inline">
                            <input id="radioExample1" name="gender" type="radio" value="male">
                            <label for="radioExample1">Male</label>
                        </div>
                        <div class="radio-inline">
                            <input id="radioExample1" name="gender" type="radio" value="female">
                            <label for="radioExample1">Female</label>
                        </div>
                        <p class="has-error text-danger edit-profile-gender"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
      <!--           <div class="form-group{{ Form::hasError('last_name') }}">
                    <label>Place Of Birth <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('place_of_birth', user_info('place_of_birth'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-place_of_birth"></p>
                    </div>
                </div> -->

                <div class="form-group">
                    <label>Date Of Birth <b class="text-danger">*</b></label>
                    <div>
                        <input type="text" name="date_of_birth" class="form-control datepicker-birthday">
                        <p class="has-error text-danger edit-profile-date_of_birth"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group hidden">
                    {!! Form::label('pin_bbm', 'Pin BBm', ['class' => 'col-md-3 control-label']) !!}
                    <div>
                        <input type="text" name="pin_bbm" class="form-control" maxlength="8">
                        <p class="text-helper">Min 6 Characters</p>
                        <p class="has-error text-danger edit-profile-pin_bbm"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone <b class="text-danger">*</b></label>
                    <div>
                        <input type="text" name="phone" class="form-control" maxlength="13">
                        <p class="text-helper">Max 13 Digit</p>
                        <p class="has-error text-danger edit-profile-phone"></p>
                    </div>
                </div>


                <div class="form-group">
                    <label>Province <b class="text-danger">*</b></label>
                    <div>
                        <select name="province" id="province_id" onchange="ajaxdistrict(this.value)" data-plugin-selectTwo class="form-control populate" style="width:100%">
                            
                            <option value="">Choice Province</option> 
                        </select>
                        <p class="has-error text-danger edit-profile-province"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label>City / District <b class="text-danger">*</b></label>
                    <div>
                        <select name="city" id="district_id" onchange="ajaxsubdistrict(this.value)" data-plugin-selectTwo class="full-width" style="width:100%" >
                            <option value="">Choice City / District</option>
                        </select>
                        <p class="has-error text-danger edit-profile-city"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label>Sub District <b class="text-danger">*</b></label>
                    <div>
                       <select name="district" id="sub_district_id" onchange="ajaxvillage(this.value)" data-plugin-selectTwo class="full-width" style="width:100%">
                            <option value="">Choice Sub District</option>                
                        </select>
                        <p class="has-error text-danger edit-profile-district"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Address <b class="text-danger">*</b></label>
                    <div>
                        
                        <textarea name="address" class="form-control" rows="4">{{ user_info('address') }}</textarea>
                        <p class="has-error text-danger edit-profile-address"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label>Postal Code <b class="text-danger">*</b></label>
                    <div>

                        <input type="text" name="postal_code" class="form-control" maxlength="5">
                        <p class="has-error text-danger edit-profile-postal_code"></p>
                    </div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>KTP Number <b class="text-danger">*</b></label>
                    <div>
                        <input type="text" name="ktp_number" class="form-control" maxlength="16">
                        <p class="has-error text-danger edit-profile-ktp_number"></p>
                    </div>
                </div>

                <div class="form-group">
                    <label>KTP Photo <b class="text-danger">*</b></label>
                    <div class="">
                        {!! form_input_file_img('file','ktp_photo',user_info('ktp_photo_path')) !!}
                        <input type="hidden" name="value_ktp_photo" value="{{ user_info('ktp_photo') }}">
                        <p class="has-error text-danger edit-profile-value_ktp_photo"></p>
                        <p class="has-error text-danger edit-profile-ktp_photo"></p>
                    </div>
                </div>

                <div class="form-group">
                    <div id="box-image-ktp" class="col-md-offset-3"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>NPWP Number</label>                    
                    <div>
                        <input type="text" name="npwp_number" class="form-control" maxlength="15">
                        <p class="has-error text-danger edit-profile-npwp_number"></p>
                    </div>
                </div>
                <div class="form-group{{ Form::hasError('npwp_photo') }}">
                    <label>NPWP Photo</label>
                    <div class="">
                        {!! form_input_file_img('file','npwp_photo',user_info('npwp_photo_path')) !!}
                        <p class="has-error text-danger edit-profile-npwp_photo"></p>
                    </div>
                </div>
                <div class="form-group">
                    <div id="box-image-npwp" class="col-md-offset-3"></div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Know Scoido From <b class="text-danger">*</b></label>
                    <div>
                        <div class="radio-inline">
                            <input id="radioExample2" name="information" type="radio" value="Search_Engine">
                            <label for="radioExample2">Search Engine</label>
                        </div>
                        <div class="radio-inline">
                            <input id="radioExample1" name="information" type="radio" value="Sosial_Media">
                            <label for="radioExample1">Sosial Media</label>
                        </div>
                        <div class="radio-inline">
                            <input id="radioExample2" name="information" type="radio" value="Iklan_Banner">
                            <label for="radioExample2">Iklan Banner</label>
                        </div>
                        <div class="radio-inline">
                            <input id="radioExample1" name="information" type="radio" value="Saudara">
                            <label for="radioExample1">Saudara</label>
                        </div>
                        <div class="radio-inline">
                            <input id="radioExample2" name="information" type="radio" value="Teman-Kerabat">
                            <label for="radioExample2">Teman/Kerabat</label>
                        </div>
                        <div class="radio-inline">
                            <input id="radioExample1" name="information" type="radio" value="Lainnya">
                            <label for="radioExample1">Lainnya</label>
                        </div>
                        <p class="has-error text-danger edit-profile-information"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ Form::hasError('funnels_name') }}">
                    <label>Funnels Name <b class="text-danger">*</b></label>
                    <div>
                                    
                      <div class = "input-group">
                        <input type="text" name="funnels_name" value="{{ user_info('funnels_name') }}" class="form-control" >
                         <span class = "input-group-addon"><i class="fa fa-question-circle" rel="tooltip" title="Funnels Name akan digunakan sebagai URL master setiap funnels Anda, dan hanya dapat diinput 1x"></i></span>
                      </div>
                        <p class="has-error text-danger edit-profile-funnels_name"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <center>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary', 'title' => 'Save']) !!}&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default modal-dismiss" type="button" data-dismiss="modal" aria-label="Close" styl>Cancel</button>
                    </center>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="clearfix">&nbsp;</div>
        <br>
      </div>
    </div>
  </div>
<div class="modal fade modal-getstart" id="modalFormDUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title modalFormDUser-title" id="myModalLabel">Delete User</h4>
            </div>
            <div class="modal-body">  
                    <div class="form-group area-delete">                    
                        <div class="col-md-12">
                             <center>Are You Sure for Delete This Data ?</center>
                        </div>
                    </div>      
                    <div class="form-group area-delete">
                        <center>
                            <button class="btn btn-danger btn-delete-submit" type="button">Delete</button>
                            <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title">Accoun Closure Request</h3></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-7">
                        <label class="col-md-3 control-label"><b>Filter By Date</b> </label>                    
                        <div class="col-md-9">
                            <div class = "input-group">
                                <span class ="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="filter_start_request" class="form-control datepicker-request">
                                    <span class = "input-group-addon">To</span>
                                <input type="text" name="filter_end_request" class="form-control datepicker-request">
                            </div>
                        </div>
                    </div>
                </div>    
                <br>
                <table id="user-request-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                    <thead>
                        <tr>
                            <th class="center-align">Crea</th>
                            <th class="center-align">Member ID</th>
                            <th class="center-align">Email</th>
                            <th class="center-align">User</th>
                            <th class="center-align">Code</th>
                            <th class="center-align">Reason</th>
                            <th class="center-align">Date</th>
                            <th class="center-align">Status</th>
                            <th class="center-align noExport">Action</th>
                    </thead>
                </table>
            </div>
        </div>

<div class="modal fade modal-getstart" id="modalShowFormApprovalRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title modalShowFormApprovalRequest-title" id="myModalLabel">Form Approval</h4>
            </div>
            <div class="modal-body">

            {!! Form::open(['route'=>'admin-hq-user-request-post', 'files'=>true, 'class' => 'form-horizontal jquery-form-approval-request']) !!}
                    <input type="hidden" name="id" class="user_request_id">
                    <input type="hidden" name="code" class="code">
                    <input type="hidden" name="action" value="approval_request">
                    <input type="hidden" name="status" value="">
                    
                    <div class="form-group">
                        <center>
                            <button class="btn btn-success" onclick="javascript:action_user_request_options('approved')">Approve</button>
                            <button class="btn btn-danger" onclick="javascript:action_user_request_options('not_approved')">Reject</button>
                            
                            <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                            
                        </center>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="check_zero_upline">
@endsection

@section('header')

    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}
    <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
    <style type="text/css">
        .center-align{
            text-align: center;
        }
        div.dataTables_wrapper {
        max-width: 1020px;
        margin: 0 auto;
    }
    </style>

@endsection
@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('assets/plugins/bootstrap-validator/bootstrap-validator.js') !!}
    {!! Html::script('assets/general/library/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('assets/general/library/tableExport.jquery.plugin/tableExport.js') !!}
    {!! Html::script('assets/general/library/tableExport.jquery.plugin/jquery.base64.js') !!}

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    {!! Html::script('assets/backend/porto-admin/vendor/bootstrap-confirmation/bootstrap-confirmation.js') !!}

    <script type="text/javascript">
        $('html').addClass(' sidebar-left-collapsed');
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.datepicker').on('change',function(){
            filter_start = $( 'input[name=filter_start]').val();
            filter_end = $( 'input[name=filter_end]' ).val();
            if(filter_start != '' && filter_end != ''){
                list_member_table.draw();                           
            }
        });
       var list_member_table = $('#list-member-table').DataTable({
            // "sDom": '<"toolbr">frtip',

            // "searching": false,
            processing: true,
            serverSide: true,
            ajax: {
                url : "{!! route('admin-datatables-list-member') !!}",
                data: function(d){
                   d.filterMember = $('#filterMember').val();
                   d.filter_start = $( 'input[name=filter_start]').val();
                   d.filter_end = $( 'input[name=filter_end]' ).val();
                   d.check_zero_upline = $( 'input[name=check_zero_upline]' ).val();
                }
            },
            // ajax: "{!! route('admin-datatables-list-member') !!}",
            order: [[ 0, 'desc' ]],
            columns: [
                {data: 'created_at', name: 'created_at',visible:false},
                {data: 'plan_id', name: 'plan_id',visible:false},
                {data: 'member_id', name: 'member_id'},
                {data: 'upline_id', name: 'upline_id'},
                {data: 'mover_id', name: 'mover_id'},
                {data: 'name', name: 'name'},
                {data: 'upline_name', name: 'upline_name'},
                {data: 'plan_name', name: 'plan_name'},
                {data: 'gender', name: 'gender'},
                {data: 'date_of_birth', name: 'date_of_birth',visible:false},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'address', name: 'address',visible:false},
                {data: 'province', name: 'province',visible:false},
                {data: 'city_or_district', name: 'city_or_district',visible:false},
                {data: 'sub_district', name: 'sub_district',visible:false},
                {data: 'postal_code', name: 'postal_code',visible:false},
                {data: 'information', name: 'information',visible:false},
                {data: 'ktp_number', name: 'ktp_number',visible:false},
                {data: 'npwp_number', name: 'npwp_number',visible:false},
                {data: 'funnels_name', name: 'funnels_name',visible:false},
                {data: 'status_account', name: 'status_account'},
                {data: 'profile_completions', name: 'profile_completions',visible:false},
                {data: 'action', name: 'action', searchable: false, orderable: false},
            ],
            dom: 'lBfrtip',
            "scrollX": true,
            buttons: [
                {
                    extend: 'pdf',
                    title: 'List Member Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },{
                    extend: 'excel',
                    title: 'List Member Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'csv',
                    title: 'List Member Data export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },{
                text: 'Text',
                action: function ( e, dt, node, config ) {
                    list_member_table.column( 10 ).visible( false );
                    $('#list-member-table').tableExport({type:'txt',escape:'false',tableName:'list-member'});
                    list_member_table.column( 10 ).visible( true );
                },
                    exportOptions: {
                    columns: 'thead th:not(.noExport)'
                    }
                }
            ]
        });
       $('a.toggle-vis').on( 'click', function (e) {
            e.preventDefault();
     
            // Get the column API object
            var column = list_member_table.column( $(this).attr('data-column') );
     
            // Toggle the visibility
            column.visible( ! column.visible() );
        } );
        @if($member_id != '')
            list_member_table.search( '{{ $member_id }}' ).draw();
        @endif

        $("div.toolbr").append('<b style="margin-left:400px" >Custom tool bar! Text/images etc.</b>');

        if($("[name='status_account']").val() == 'active'){
            $("[name='activeMember']").prop('checked', true);
        }
        function showDataTablesOnChange(){
            list_member_table.draw();
        }
        function hide_user_details(){
            $('#detail_users').modal('hide');
        }
        function show_user(id){
            $.ajax({
                type: "POST",
                url: "{!! route('hq-admin-dashboard-post') !!}",
                data: {
                    'action': 'show_user_details',
                    'user_id': id
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='plan']").val(response.plan);
                    $("[name='member_id']").val(response.member_id);
                    $("[name='upline_id']").val(response.upline_id);
                    $("[name='mover_id']").val(response.mover_id);
                    $("[name='first_name']").val(response.first_name);
                    $("[name='last_name']").val(response.last_name);

                    $("[name='phone']").val(response.phone);
                    $("[name='email']").val(response.email);
                    $("[name='address']").val(response.address);
                    $("[name='pin_bbm']").val(response.pin_bbm);
                    $("[name='province']").val(response.province);
                    $("[name='city']").val(response.city);
                    $("[name='district']").val(response.district);
                    $("[name='postal_code']").val(response.postal_code);
                    $("[name='ktp_number']").val(response.ktp_number);
                    $("[name='npwp_number']").val(response.npwp_number);
                    $("[name='knowing_scoido_of']").val(response.knowing_scoido_of);
                    $("[name='default_rotation']").val(response.default_rotation);
                    $("[name='funnels_name']").val(response.funnels_name);
                    $("[name='bank']").val(response.bank);
                    $("[name='bank_account_number']").val(response.bank_account_number);
                    $("[name='account_name_holder']").val(response.account_name_holder);
                    $("[name='branch']").val(response.branch);
                    $("[name='rotation_privilage']").val(response.rotation_privilage);
                    $("[name='number_rotations']").val(response.number_rotations);
                    $("[name='created_at']").val(response.created_at);
                    $("[name='last_due_date']").val(response.last_due_date);
                    $("[name='start_paid_member']").val(response.start_paid_member);
                    $(".list-funnels").html(response.list_funnels);
                    
                    $(".img-avatar-area").html('<img src="'+ response.avatar +'" width="120" class="img-circle img-responsive">')
                    if(response.ktp_photo == null){
                        $(".img-ktp-photo-area").addClass('hidden');
                    }else{
                        $(".img-ktp-photo-area").removeClass('hidden');
                    }
                    $(".img-ktp-photo-area").html('<img src="'+ response.ktp_photo +'" class="img-responsive">')
                    if(response.npwp_photo == null){
                        $(".img-npwp-photo-area").addClass('hidden');
                    }else{
                        $(".img-npwp-photo-area").removeClass('hidden');
                    }
                    $(".img-npwp-photo-area").html('<img src="'+ response.npwp_photo +'" class="img-responsive">')
                }
            });
            $('#detail_users').modal({backdrop: 'static', keyboard: false});
            $('#detail_users').modal('show');
        }

        /*start show for active member*/
        function execute_active(id){
            $("[name='id']").val(id);
            $('.area-banned').hide();
            $('.area-reset-password').hide();
            $('.area-active').show();
            $('.FormFunnelProduct-title').html('Active Member');
            $("[name='action']").val('active');
            $('#modalFormMemberAction').modal({backdrop: 'static', keyboard: false});
            $('#modalFormMemberAction').modal('show');
        }
        /*end show for active member*/

        /*start show for banned member*/
        function execute_banned(id){
            $("[name='id']").val(id);
            $("[name='reason']").val('');
            $('.area-active').hide();
            $('.area-reset-password').hide();
            $('.area-banned').show();
            $('.FormFunnelProduct-title').html('Banned Member');
            $("[name='action']").val('banned');
            $('#modalFormMemberAction').modal({backdrop: 'static', keyboard: false});
            $('#modalFormMemberAction').modal('show');
        }
        /*end show for banned member*/

        /*start show for reset member*/
        function execute_reset(id){
            $.ajax({
                type: "POST",
                url: "{{ route('admin-get-data-member')}}",
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='email']").val(response.email);
                }
            });

            $('.area-active').hide();
            $('.area-banned').hide();
            $('.area-reset-password').show();
            $('.FormFunnelProduct-title').html('Reset Password');
            $("[name='action']").val('reset');
            $('#modalFormMemberAction').modal({backdrop: 'static', keyboard: false});
            $('#modalFormMemberAction').modal('show');
        }
        /*end show for reset member*/

        /*start ajaxForm for notification insert-update-delete*/
        $('.jquery-form-change-status').ajaxForm({
            dataType : "json",

            success: function(response) {

                if(response.status == 'success'){
                    var title_not = 'Notification';
                    var type_not = 'success';

                    list_member_table.ajax.reload();
                    $('#modalFormMemberAction').modal('hide');
                    $('#modalFormMemberAction').modal('hide');
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
                    $("#modalFormMemberAction").scrollTop(0);
                    $("#modalFormMemberAction").scrollTop(0);
                  } else {
                      $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                  }
            }
        });
        /*end ajaxForm for notification insert-update-delete*/
        function reset_zero_upline(){
            $( 'input[name=check_zero_upline]' ).val('');
            list_member_table.draw();                    
        }
        function check_zero_upline(){            
            $( 'input[name=check_zero_upline]' ).val('zero');
            list_member_table.draw();                    
        }
</script>
    <script type="text/javascript">
    $('button[name="btn-upload"]').prop('disabled', true);
    $('#upload-result').click(function() {
        $('button[name="btn-upload"]').prop('disabled', false);
    });
    $('#upload-input').on('change', function(){ $('button[name="btn-upload"]').prop('disabled', true); });


    </script>
    
    @include('frontend.member.profile.js.script-crop')
<script type="text/javascript">
    $(document).ready(function() {
        photoUpload();
        photoUploadEdit();
    });
</script>
    <script type="text/javascript">
  Date.prototype.yyyymmdd = function() {
      var mm = this.getMonth() + 1; // getMonth() is zero-based
      var dd = this.getDate();

      return [this.getFullYear(), !mm[1] && '0', mm, !dd[1] && '0', dd].join(''); // padding
    };

    var date = new Date();
    $(".datepicker-birthday").datepicker({
        format:"yyyy-mm-dd",
        endDate:date.yyyymmdd(),
    });
    $(".datepicker-birthday").keydown(function() {
        return false;
    });
    function ajaxdistrict(id){
        var url= '{{ route('user-location-information-process') }}';
        url=url+"/province";
        url=url+"/"+id;

        $.get(url, function(data, status){
        $("#district_id").html(data);
        });
    }

    function ajaxsubdistrict(id){
        var url= '{{ route('user-location-information-process') }}';
        url=url+"/subdistrict";
        url=url+"/"+id;
        $.get(url, function(data, status){
        $("#sub_district_id").html(data);
        });
    }

    function ajaxvillage(id){
        var url= '{{ route('user-location-information-process') }}';
        url=url+"/village";
        url=url+"/"+id;
        $.get(url, function(data, status){
        $("#village_id").html(data);
        });
    }
    function show_form_create(){
        $("#modalFormCUUser").modal('show');  
        $("[name='action']").val('create');
        $(".modalFormCUUser-title").html('Create User');        
        $(".box-peview-avatar").html('<img src="{{asset('assets/backend/porto-admin/images/!logged-user.jpg')}}" width="120" class="img-circle img-responsive">');
        $(".thumbnail.ktp_photo").html('<img src="{{asset('assets/backend/porto-admin/images/!logged-user.jpg')}}" class="img-responsive">');
        $(".thumbnail.npwp_photo").html('<img src="{{asset('assets/backend/porto-admin/images/!logged-user.jpg')}}" class="img-responsive">');
        $("[name='first_name']").val('');
        $("[name='last_name']").val('');
        $("[name='phone']").val('');
        $("[name='email']").val('');
        $("[name='address']").val('');
        $("[name='pin_bbm']").val('');
        $("[name='province']").val('');
        $("[name='city']").val('');
        $("[name='district']").val('');
        $("[name='postal_code']").val('');
        $("[name='ktp_number']").val('');
        $("[name='npwp_number']").val('');
        $("[name='funnels_name']").val('');
        $("[name='date_of_birth']").val('');
        $("#district_id").html('');
        $("#sub_district_id").html('');
        $.ajax({
                type: "POST",
                url: "{!! route('hq-admin-dashboard-post') !!}",
                data: {
                    'action': 'show_user_option'
                },
                dataType: 'json',
                success: function(response)
                {
                    $("#upline_id").html(response.select_user);
                    $("#upline_id").select2();
                }
            });
        $.ajax({
                type: "POST",
                url: "{!! route('hq-admin-dashboard-post') !!}",
                data: {
                    'action': 'show_provice_option'
                },
                dataType: 'json',
                success: function(response)
                {
                    $("#province_id").html(response.select_province);
                    $("#province_id").select2();
                }
            });
        $("#district_id").select2();
        $("#sub_district_id").select2();
        $(".create-area").show();
        $(".update-area").hide();
    }
    function show_form_update(user_id){
        $("[name='user_id']").val(user_id);
        $("[name='action']").val('update');
        $(".modalFormCUUser-title").html('Update User');        
        $(".create-area").hide();
        $(".update-area").show();
        $.ajax({
                type: "POST",
                url: "{!! route('hq-admin-dashboard-post') !!}",
                data: {
                    'action': 'show_user_details',
                    'user_id': user_id
                },
                dataType: 'json',
                success: function(response)
                {
                    $("[name='plan']").val(response.plan);
                    $("[name='member_id']").val(response.member_id);
                    $("[name='upline_id']").val(response.upline_id);
                    $("[name='mover_id']").val(response.mover_id);
                    $("[name='first_name']").val(response.first_name);
                    $("[name='last_name']").val(response.last_name);
                    $("[name='phone']").val(response.phone);
                    $("[name='email']").val(response.email);
                    $("[name='address']").val(response.address);
                    $("[name='pin_bbm']").val(response.pin_bbm);
                    $("[name='province']").val(response.province);
                    $("[name='city']").val(response.city);
                    $("[name='district']").val(response.district);
                    $("[name='postal_code']").val(response.postal_code);
                    $("[name='ktp_number']").val(response.ktp_number);
                    $("[name='npwp_number']").val(response.npwp_number);
                    $("[name='knowing_scoido_of']").val(response.knowing_scoido_of);
                    $("[name='default_rotation']").val(response.default_rotation);
                    $("[name='funnels_name']").val(response.funnels_name);
                    $("[name='bank']").val(response.bank);
                    $("[name='bank_account_number']").val(response.bank_account_number);
                    $("[name='account_name_holder']").val(response.account_name_holder);
                    $("[name='branch']").val(response.branch);
                    $("[name='rotation_privilage']").val(response.rotation_privilage);
                    $("[name='number_rotations']").val(response.number_rotations);
                    $("[name='created_at']").val(response.created_at);
                    $("[name='last_due_date']").val(response.last_due_date);
                    $("[name='date_of_birth']").val(response.date_of_birth);
                    $("input[name=gender][value=" + response.gender + "]").prop('checked', true);
                    $("input[name=information][value=" + response.information + "]").prop('checked', true);
                    $("#province_id").html(response.select_province);
                    $("#district_id").html(response.select_city);
                    $("#sub_district_id").html(response.select_district);
                    $("#province_id").select2();
                    $("#district_id").select2();
                    $("#sub_district_id").select2();
                    $("[name='start_paid_member']").val(response.start_paid_member);
                    $(".list-funnels").html(response.list_funnels);
                    
                    $(".box-peview-avatar").html('<img src="'+ response.avatar +'" width="120" class="img-circle img-responsive">')
                    if(response.ktp_photo == null){
                        $(".img-ktp-photo-area").addClass('hidden');
                    }else{
                        $(".img-ktp-photo-area").removeClass('hidden');
                    }
                    $(".thumbnail.ktp_photo").html('<img src="'+ response.ktp_photo +'" class="img-responsive">')
                    if(response.npwp_photo == null){
                        $(".img-npwp-photo-area").addClass('hidden');
                    }else{
                        $(".img-npwp-photo-area").removeClass('hidden');
                    }
                    $(".thumbnail.npwp_photo").html('<img src="'+ response.npwp_photo +'" class="img-responsive">')
                }
            });
        $("#modalFormCUUser").modal('show');       
    }
    $('.jquery-form-update').ajaxForm({
        dataType:'json',
        success: function(response) {
            if(response.status == 'success'){
                var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                new PNotify({
                    title: "Success",
                    text: response.notification,
                    type: 'success',
                    addclass: "stack-custom",
                    stack: myStack
                });
                list_member_table.ajax.reload();
                user_request_table.ajax.reload();
                $("#modalFormCUUser").modal('hide'); 
            }else{
                $('.errorsMessage').html(response);
            }

        },
        beforeSend: function() {
          $('.has-error').html('');
        },
        error: function(response){
          if (response.status === 422) {
              var data = response.responseJSON;
              $.each(data,function(key,val){
                  $('.edit-profile-'+key).html(val);
              });
            var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                new PNotify({
                    title: "Failed",
                    text: "Validate Error, Check Your Data Again",
                    type: 'danger',
                    addclass: "stack-custom",
                    stack: myStack
                });
            $("#editProfile").scrollTop(0);
          } else {
              $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
          }
        }
    });
    function show_form_delete(user_id){
        $("#modalFormDUser").modal('show');       
        $(".btn-delete-submit").attr('onClick',"javascript:delete_user('"+user_id+"')");
    }

    function delete_user(user_id){
        $.ajax({
            url: '{{ route("admin-post-member") }}',
            method: "POST",
            data: {
            id: user_id,
            action:'delete'
            },
            success: function(response) {
                list_member_table.ajax.reload();
                user_request_table.ajax.reload();
                $("#modalFormDUser").modal('hide'); 
            },
            beforeSend: function() {
            },
            error: function(response){
            }
        });
    }


        $('.datepicker-request').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.datepicker-request').on('change',function(){
            filter_start = $( 'input[name=filter_start_request]').val();
            filter_end = $( 'input[name=filter_end_request]' ).val();
            if(filter_start != '' && filter_end != ''){
                user_request_table.draw();                           
            }
        });
                /*start show data member in table*/
        var user_request_table = $('#user-request-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "{!! route('admin-hq-user-request-datatables') !!}",
                data: function(d){
                            d.filter_start = $( 'input[name=filter_start_request]').val();
                            d.filter_end = $( 'input[name=filter_end_request]' ).val();
                }
            },
            order: [[ 0, 'desc' ]],
            columns: [
                {data: 'created_at', name: 'user_requests.created_at',visible:false},
                {data: 'member_id', name: 'users.member_id',visible:false},
                {data: 'email', name: 'users.email',visible:false},
                {data: 'first_name', name: 'users.first_name'},
                {data: 'code', name: 'code'},
                {data: 'reason', name: 'reason'},
                {data: 'created_at', name: 'user_requests.created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
            ],
            "order": [[ 3, "desc" ]],
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    title: 'Member List Export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },{
                    extend: 'excel',
                    title: 'Member List Export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }, {
                    extend: 'csv',
                    title: 'Member List Export',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },{
                text: 'Text',
                action: function ( e, dt, node, config ) {
                    coin_order_table.column(5).visible( false );
                    $('#funnel-table').tableExport({type:'txt',escape:'false',tableName:'Request'});
                    coin_order_table.column(5).visible( true );
                },
                    exportOptions: {
                    columns: 'thead th:not(.noExport)'
                    }
                }
            ]
        });

        @if($member_id != '')
            user_request_table.search( '{{ $member_id }}' ).draw();
        @endif
        function show_form_approval_request(id){
            $("[class=user_request_id]").val(id);
            $.ajax({
                type: "POST",
                url: "{{ route('admin-hq-user-request-post') }}",
                data: {
                    'id': id,
                    'action' : 'get-data'
                },
                dataType : 'json',
                success: function(response)
                {
                    $("[class=code]").val(response.code);
                    $("#modalShowFormApprovalRequest").modal("show");
                }
            });
        }
        $('.jquery-form-approval-request').ajaxForm({
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
                user_request_table.ajax.reload();
                list_member_table.ajax.reload();                
                $('#modalShowFormApprovalRequest').modal('hide');
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
                $("#modalShowFormApprovalRequest").scrollTop(0);
              } else {
                  $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
              }
            }
        });
        function action_user_request_options(status){
            $("input[name=status]").val(status);
            $(".jquery-form-approval-request").submit();
        }
        
    </script>
@endsection
