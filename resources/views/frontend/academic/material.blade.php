@extends('layout.frontend.general.layout')

@section('title', 'Teacher')

@section('css')
<style type="text/css">
	@import url(http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
	.droid-arabic-naskh{font-family: 'Droid Arabic Naskh', serif;}
	.disabled{pointer-events: none;cursor: default;}
	.image-resolution{min-height: 300px; height: 600px; width: 585px;}
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
					<li class="active">@lang('general.menu.academic')</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1>@lang('general.menu.material')</h1>
			</div>
		</div>
	</div>
</section>
<div class="container back-content">
	<div class="row">
		<ul class="team-list sort-destination" data-sort-id="team">
			@foreach($book as $key => $value)
				<li class="col-md-3 col-sm-6 col-xs-12 isotope-item effect1">
					<p></p>
					<div class="team-item thumbnail">
						<a href="#" class="thumb-info team">
							<img class="img-responsive image-resolution" alt="" src="{{ asset($pathp.'storage/books/').'/'.$value->image }}">
							<span class="thumb-info-title">
								<span class="thumb-info-inner">{{ $value->nama_kitab }}</span>
									<span class="thumb-info-type">{{ $value->pengarang }}</span>		
							</span>
						</a>
						
					</div>
				</li>
			@endforeach
		</ul>
	</div>

</div>
@endsection

@section('scripts')

@endsection