@extends('layout.backend.admin.master.master')

@section('title', 'Change Password')

@section('page-header', 'Change Password')

@section('breadcrumb')
	<ol class="breadcrumbs">
	  <li>
	      <a href="{!! action('Frontend\Member\DashboardController@index') !!}">
	          <i class="fa fa-home"></i> Home
	      </a>
	  </li>
	  <li><a href="{!! action('Frontend\Member\ProfileController@index') !!}">Profile</a></li>
	  <li><span>Change Password</span></li>
	</ol>
@endsection

@section('content')
	<div class="tabs tabs-primary">
		<ul class="nav nav-tabs">
			<li>
				<a href="{{ route('member-profile') }}"><i class="fa fa-info"></i> Personal Information</a>
			</li>
			<li class="active">
				<a><i class="fa fa-edit"></i> Change Password</a>
			</li>
		</ul>
		<div class="tab-content has-loader">
<a class="modal-with-form" href="#modalForm" style="display:none;"></a>
    	<div class="errorsMessageChangePassword"></div>

                <div class="alert-sending-otp">
                </div>
        		{!! Form::open($form) !!}
        <div style="width:100%; height:100%;outline: 0 none;position: relative;">
                <div class="form-group">
                    <label class="col-md-3 control-label">Old Password <b class="text-danger">*</b></label>
                   <div class="col-md-6">
                     {!! Form::password('old_password', array('class' => 'form-control')) !!}
                     {!! $errors->first('old_password') !!}                   </div>
                  <div class="clear"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password <b class="text-danger">*</b></label>
                   <div class="col-md-6">

                    <div id="pwd-container">
                        <div>
                            <div>
                                <input type="password" class="form-control password-meter" id="password" name="password" placeholder="Password">

                            </div>
                        </div>
                        <br>
                        <div>
                            <div class="pwstrength_viewport_progress"></div>
                        </div>
                    </div>
                     {!! $errors->first('password') !!}                   </div>
                  <div class="clear"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password Confirm <b class="text-danger">*</b></label>
                 <div class="col-md-6">
                    {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                  </div>
                  <div class="clear"></div>
                </div>

                <div class="form-group">
                    {!! Form::label('', '', ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-6">
						{!! Form::submit('Save', ['class' => 'btn btn-primary btn-block', 'title' => 'Save']) !!}
                    </div>
                </div>
            </div>
                {!! Form::close() !!}

		</div>
	</div>
	<!-- Modal Form -->
	<div id="modalForm" class="modal-block modal-block-primary mfp-hide">

			{!! Form::open($form) !!}
			<section class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">Fill Your OTP Code from Your Email</h2>
				</header>
				<div class="panel-body">
	                <div class="errorsMessageOtpCode">

	                </div>

	                <div class="form-group{{ Form::hasError('email') }}">
                    <label class="col-md-3 control-label">OTP Code <b class="text-danger">*</b></label>
	                    <div class="col-md-6">
	                        {!! Form::text('otp_code', '', ['class' => 'form-control']) !!}
	                        <p class="text-danger"><small>Please Check Your Email</small></p>
	                    </div>
	                </div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
								{!! Form::submit('Confirm', ['class' => 'btn btn-success', 'title' => 'Save']) !!}
                   				<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</div>
				</footer>
			</section>
            {!! Form::close() !!}
		</div>
@endsection

@section('header')
<style type="text/css">

.pwstrength_viewport_progress .progress{
  margin-bottom: 0px !important;
}
</style>
@endsection

@section('scripts')
    {!! Html::style('assets/plugins/croppie/prism.css') !!}
    {!! Html::style('assets/plugins/croppie/croppie.css') !!}
    {!! Html::style('assets/plugins/croppie/demo.css') !!}

<script>
	/*
	Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
	$('.jquery-form-change-password').ajaxForm({
	    success: function(response) {
			$('.errorsMessageOtpCode').show();
			$('.errorsMessageChangePassword').show();
	    	if(response.indexOf('fill_otp_code_mode') >= 0){
		      		$('.modal-with-form').click();
	    	}else{
		      	if(response.indexOf('success_change_password') >= 0){
					var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
					new PNotify({
					    title: "Success",
					    text: "Password Has Been Changed",
						type: 'success',
					    addclass: "stack-custom",
					    stack: myStack
					});
		       		$.magnificPopup.close();
					setTimeout(function(){
					   window.location.reload(1);
					}, 3000);
				}else{
					$('.errorsMessageChangePassword').html(response);
				}
			}
	    },
		beforeSend: function() {
		  	$('.has-error').html('');
			$('.errorsMessageOtpCode').hide();
			$('.errorsMessageChangePassword').hide();
		},
		error: function(response){
		  if (response.status === 422) {
		      var data = response.responseJSON;
		      $.each(data,function(key,val){
		          $('.'+key).html(val);
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
	/*
	Modal Confirm
	*/
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		$.magnificPopup.close();

		new PNotify({
			title: 'Success!',
			text: 'Modal Confirm Message.',
			type: 'success'
		});
	});

	/*
	Form
	*/
	$('.modal-with-form').magnificPopup({
		type: 'inline',
		preloader: false,
		focus: '#name',
		modal: true,

		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		}
	});


</script>
        {!! Html::script('assets/general/library/strength/strength.js') !!}
    <script type="text/javascript">
        jQuery(document).ready(function () {
            "use strict";
            var options = {};
            options.ui = {
                container: "#pwd-container",
                showVerdictsInsideProgressBar: true,
                viewports: {
                    progress: ".pwstrength_viewport_progress"
                },
                progressBarExtraCssClasses: "progress-bar-striped active progress-bar-meter"
            };
            options.common = {
                debug: true,
                onLoad: function () {
                    $('#messages').text('Start typing password');
                }
            };
            $('.password-meter').pwstrength(options);
        });
    </script>
@endsection
