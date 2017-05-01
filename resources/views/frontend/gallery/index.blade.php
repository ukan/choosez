@extends('layout.frontend.general.layout')

@section('title', 'History')

@section('css')
<style type="text/css">
.justify{
	text-align: justify;
	font-size: 16px;
	color: #000;
}
.box h3{
	text-align:center;
	position:relative;
	top:80px;
}
.box {
	width:100%;
	background:#FFF;
}

/*==================================================
 * Effect 1
 * ===============================================*/
.effect1{
     box-shadow: -10px 10px 10px -6px #777;
}
.effect1 h4{
     padding-left: 10px;
     padding-top: 10px;
}
label.line{
	background-color:#0088cc;
	display:block;
	width: 100px;
    height: 2px;
	margin-left: 10px;
}
.events{
	background-color:black;
}
.events h3{
	color:#fff;
	text-align:center;
    font-size:30px;
}
.thumb-info-edit {
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
	word-break:break-all;
}
</style>
<style type="text/css">
	@import url(http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
	.droid-arabic-naskh{font-family: 'Droid Arabic Naskh', serif;}
	.disabled{pointer-events: none;cursor: default;}
	.image-resolution{width: 385px; max-height: 200px}
	.effect1{box-shadow: -10px 10px 10px -6px #777;}
	.effect1 h4{padding-left: 10px;padding-top: 10px;}
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
						<li class="active">@lang('general.menu.gallery')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.gallery')</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container">

		<div class="row">
			<div class="col-md-9">
				<div class="blog-posts single-post">

					<article class="post post-large-custom blog-single-post">
						<div class="post-content back-content history-place">
							<div class="row">
								<ul class="team-list sort-destination" data-sort-id="team">
									@foreach($album as $key => $value)
										<?php
											$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
						        			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$value->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
						        			$sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);
										?>
										<li class="col-sm-6 isotope-item effect1">
											<p></p>
											<div class="team-item thumbnail">
												<a href="{{ route('gallery-detail', $sentEncrypt) }}" class="thumb-info team">
													<img class="img-responsive image-resolution" alt="" src="{{ asset($pathp.'storage/gallery/').'/'.$value->image }}">
													<span class="thumb-info-title">
														<span class="thumb-info-edit">{{ $value->name }}</span>
														<br>
															<span class="thumb-info-type">{{ eform_date($value->date) }}</span>		
													</span>
												</a>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					</article>

				</div>
			</div>

			@include('frontend.right_bar')
		</div>

	</div>

</div>
@endsection
