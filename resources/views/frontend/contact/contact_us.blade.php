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
	<div class="center-align map-place">
		<iframe width="100%" height="600" src="http://www.citymaps.ie/create-google-map/map.php?width=100%&amp;height=600&amp;hl=en&amp;coord=-6.937694,107.72247199999993&amp;q=Jl.%20Cibiru%20Hilir%20No.23%2C%20Cibiru%20Hilir%2C%20Cileunyi%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040626%2C%20Indonesia+(Pondok%20Pesantren%20Al%20Ihsan)&amp;ie=UTF8&amp;t=&amp;z=17&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
	</div>
	<br/>
	<div class="container back-content effect1">
		<div class="row">
			<div class="col-md-6">
				<h2 class="short back-color">@lang('general.about.contact_us_form')</h2>
				<form id="contactForm" action="#" method="POST">
					<div class="row">
						<div class="form-group">
							<div class="col-md-6">
								<label>@lang('general.about.name') <b class="text-danger">*</b></label>
								<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
							</div>
							<div class="col-md-6">
								<label>@lang('general.about.email') <b class="text-danger">*</b></label>
								<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>@lang('general.about.subject') <b class="text-danger">*</b></label>
								<input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>@lang('general.about.message') <b class="text-danger">*</b></label>
								<textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="message" id="message" required></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input disabled="disabled" type="submit" value="@lang('general.about.send')" class="btn btn-primary btn-lg" data-loading-text="Loading...">
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6">

				<h4 class="push-top">@lang('general.about.the_office')</h4>
				<ul class="list-unstyled">
					<li><i class="fa fa-map-marker"></i> <strong>@lang('general.about.address'):</strong> Jl. Cibiruhilir No.23 RT.01 Rw.02 Cileunyi Bandung.</li>
					<li><i class="fa fa-phone"></i> <strong>@lang('general.about.phone'):</strong> (123) 456-7890</li>
					<li><i class="fa fa-envelope"></i> <strong>@lang('general.about.email'):</strong> <a href="mailto:mail@example.com">mail@example.com</a></li>
				</ul>
				<hr />
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')

@endsection