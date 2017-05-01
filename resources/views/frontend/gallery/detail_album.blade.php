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

</style>
<style type="text/css">
	@import url(http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
	.droid-arabic-naskh{font-family: 'Droid Arabic Naskh', serif;}
	.disabled{pointer-events: none;cursor: default;}
	.image-resolution{min-height: 200px; height: 585px; width: 585px;}
	.effect1{box-shadow: -10px 10px 10px -6px #777;}
	.effect1 h4{padding-left: 10px;padding-top: 10px;}
</style>
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/zoomwall.css') !!}">
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

	<div class="container back-content">
		<div class="row">
			<div id="gallery" class="zoomwall">
				@foreach($album as $key => $value)
			    	<img src="{{ asset($pathp.'storage/gallery/').'/'.$value->image }}" data-highres="{{ asset($pathp.'storage/gallery/').'/'.$value->image }}"  />
			    @endforeach
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script src="{!! asset($pathp.'assets/frontend/general/js/zoomwall.js') !!}"></script>
	<script type="text/javascript">
		window.onload = function() {
			zoomwall.create(document.getElementById('gallery'), true);
		};
	</script>
@endsection