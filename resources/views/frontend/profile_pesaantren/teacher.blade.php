@extends('layout.frontend.general.layout')

@section('title', 'Teacher')

@section('css')
<style type="text/css">
	@import url(http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
	.droid-arabic-naskh{font-family: 'Droid Arabic Naskh', serif;}
	.disabled{pointer-events: none;cursor: default;}
	.image-resolution{min-height: 275px; max-height: 275px; height: 585px; width: 585px;}
	.effect1{box-shadow: -10px 10px 10px -6px #777;}
	.effect1 h4{padding-left: 10px;padding-top: 10px;}
</style>
@endsection

@section('content')
<section class="page-top">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ route('home') }}">@lang('general.menu.home')</a></li>
					<li class="active">@lang('general.menu.profile')</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1>@lang('general.menu.teacher')</h1>
			</div>
		</div>
	</div>
</section>
<div class="container back-content">
	<ul class="nav nav-pills sort-source" data-sort-id="team" data-option-key="filter">
		<li data-option-value="*" class="active"><a href="#">@lang('general.public.show_all')</a></li>
		<li data-option-value=".leadership"><a href="#">@lang('general.public.leadership')</a></li>
		<li data-option-value=".hod"><a href="#">@lang('general.public.hod')</a></li>
		<li data-option-value=".treasurer"><a href="#">@lang('general.public.treasurer')</a></li>
		<li data-option-value=".teacher"><a href="#">@lang('general.menu.teacher')</a></li>
	</ul>
	<div class="row">
		<ul class="team-list sort-destination" data-sort-id="team">
			@foreach($teacher as $key => $value)
				<?php
					$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$value->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
        			$sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);
				?>
				@if($value->position == 'leadership')
					<li class="col-md-3 col-sm-6 col-xs-12 isotope-item leadership effect1">
				@elseif($value->position == 'hod_ac' || $value->position == 'hod_ks')
					<li class="col-md-3 col-sm-6 col-xs-12 isotope-item hod effect1">
				@elseif($value->position == 'treasurer')
					<li class="col-md-3 col-sm-6 col-xs-12 isotope-item treasurer effect1">
				@else
					<li class="col-md-3 col-sm-6 col-xs-12 isotope-item teacher effect1">
				@endif
				<p></p>
					<div class="team-item thumbnail">
						<a href="{{ route('profile-teacher-detail', $sentEncrypt) }}" class="thumb-info team">
							<img class="img-responsive image-resolution" alt="" src="{{ asset($pathp.'storage/avatars/').'/'.$value->photo }}">
							<span class="thumb-info-title">
								<span class="thumb-info-inner">{{ $value->name }}</span>
								@if($value->position == 'leadership')
									<span class="thumb-info-type">@lang('general.public.leadership')</span>
								@elseif($value->position == 'hod_ac' || $value->position == 'hod_ks')
									<span class="thumb-info-type">@lang('general.public.hod')</span>
								@elseif($value->position == 'treasurer')
									<span class="thumb-info-type">@lang('general.public.treasurer')</span>
								@else
									<span class="thumb-info-type">@lang('general.public.teacher')</span>
								@endif			
							</span>
						</a>
						<span class="thumb-info-caption">
							@if(!empty($value->quote))
								<p style="color: #000">{{ $value->quote }}</p>
							@else
								<p></p>
							@endif
							<span class="thumb-info-social-icons">
								@if(!empty($value->facebook))
									<a data-tooltip data-placement="bottom" target="_blank" href="{{ $value->facebook }}" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
								@else
									<a data-tooltip data-placement="bottom" target="_blank" href="{{ $value->facebook }}" data-original-title="Facebook" class="disabled"><i class="fa fa-facebook"></i><span>Facebook</span></a>
								@endif

								@if(!empty($value->instagram))
									<a data-tooltip data-placement="bottom" href="{{ $value->instagram }}" data-original-title="Instagram"><i class="fa fa-instagram"></i><span>Instagram</span></a>
								@else
									<a class="disabled" data-tooltip data-placement="bottom" href="{{ $value->instagram }}" data-original-title="Instagram"><i class="fa fa-instagram"></i><span>Instagram</span></a>
								@endif

								@if(!empty($value->linkedin))
									<a data-tooltip data-placement="bottom" href="{{ $value->linkedin }}" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
								@else
									<a class="disabled" data-tooltip data-placement="bottom" href="{{ $value->linkedin }}" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
								@endif
							</span>
						</span>
					</div>
				</li>
			@endforeach
		</ul>
	</div>

</div>
@endsection

@section('scripts')

@endsection