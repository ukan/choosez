@extends('layout.frontend.general.layout')

@section('title', 'Contact Us')

@section('css')

<style>
    .center-align {text-align: center;margin: auto;}
    .effect1{box-shadow: -10px 10px 10px -6px #777;}
	.effect1 h4{padding-left: 10px;padding-top: 10px;}
	.map-place{width: 100%;box-shadow: 0 10px 8px 0 rgba(0,0,0,0.2), 0 6px 40px 0 rgba(0,0,0,0.19);}
	.back-color{color: #0088cc}
</style>
@endsection

@section('content')
<div role="main" class="main">
	<section class="page-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ route('home') }}">@lang('general.menu.home')</a></li>
						<li class="active">@lang('general.menu.contact')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.contact')</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- <div class="container back-content effect1">
		<div class="row">
			<div class="center-align map-place">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6660.918550976284!2d107.72007585399265!3d-6.937618721017405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c32426bbfd0d%3A0xa15cf57dec9e78a0!2sPondok+Pesantren+Al+-+Ihsan!5e0!3m2!1sen!2sid!4v1494376723617" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
	
	<br/>
	 -->
	<div class="container back-content effect1">
		<div class="row">
			<div class="col-md-6">
				<h2 class="short back-color">@lang('general.about.contact_us_form')</h2>
				
				{!! Form::open(['route'=>'contact-us', 'files'=>true, 'class' => 'form-horizontal jquery-form-data']) !!}
					
						<div class="form-group">
							<div class="col-md-6">
		                		<label>@lang('general.about.name') <b class="text-danger">*</b></label>    
		                        <input type="text" value="" maxlength="100" class="form-control" name="name" id="name">
		                        <p class="has-error text-danger error-name"></p>
							</div>
							<div class="col-md-6">
		                		<label>@lang('general.about.email') <b class="text-danger">*</b></label>    
		                        <input type="email" value="" maxlength="100" class="form-control" name="email" id="email">
		                        <p class="has-error text-danger error-email"></p>
							</div>
						</div>
					
						<div style="margin-top: -20px" class="form-group">
							<div class="col-md-12">
								<label>@lang('general.about.subject') <b class="text-danger">*</b></label>
								<input type="text" value="" maxlength="100" class="form-control" name="subject" id="subject">
								<p class="has-error text-danger error-subject"></p>
							</div>
						</div>
					
						<div style="margin-top: -20px" class="form-group">
							<div class="col-md-12">
								<label>@lang('general.about.message') <b class="text-danger">*</b></label>
								<textarea maxlength="5000" rows="10" class="form-control" name="message" id="message"></textarea>
								<p class="has-error text-danger error-message"></p>
							</div>
						</div>
					
						<div class="col-md-12">
							<input style="margin-left: -15px" type="submit" value="@lang('general.about.send')" class="btn btn-primary btn-lg" data-loading-text="Loading...">
						</div>
					
				</form>

			</div>
			<div class="col-md-6">

				<h4 class="push-top">@lang('general.about.the_office')</h4>
				<ul class="list-unstyled">
					<li><i class="fa fa-map-marker"></i> <strong>@lang('general.about.address'):</strong> Jl. Cibiruhilir No.23 RT.01 Rw.02 Cileunyi Bandung.</li>
					<li><i class="fa fa-phone"></i> <strong>@lang('general.about.phone'):</strong> -</li>
					<li><i class="fa fa-envelope"></i> <strong>@lang('general.about.email'):</strong> <a href="mailto:alihsanpondokpesantren@gmail.com">alihsanpondokpesantren@gmail.com</a></li>
				</ul>
				<hr />
				<div class="center-align map-place">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6660.918550976284!2d107.72007585399265!3d-6.937618721017405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c32426bbfd0d%3A0xa15cf57dec9e78a0!2sPondok+Pesantren+Al+-+Ihsan!5e0!3m2!1sen!2sid!4v1494376723617" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<br>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
        <!-- Theme Base, Components and Settings -->
        {!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.js') !!}
<script type="text/javascript">
	$('.jquery-form-data').ajaxForm({
        dataType : 'json',
        success: function(response) {

            if(response.status == 'success'){
                var title_not = 'Notification';
                var type_not = 'success';
            }else{
                var title_not = 'Notification';
                var type_not = 'failed';
            }
            $("[name='name']").val('');
            $("[name='email']").val('');
            $("[name='subject']").val('');
            $("[name='message']").val('');

            var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
            new PNotify({
                title: response.status,
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
            $("#modalFormTeacher").scrollTop(0);
          } else {
              $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
          }
        }
    });
</script>
@endsection