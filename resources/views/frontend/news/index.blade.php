@extends('layout.frontend.general.layout')

@section('title', 'History')

@section('css')
<style type="text/css">
p{
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
.events h6{
    color: #797979;
    padding-bottom: 30px;
    width: 45%;
    margin: 0 auto;
    font-size: 15px;
    text-align: center;
    line-height: 25px;

}
/*#2243e8 2807ff buru ungu
#32ddff 09cff7 tosca
#0011ff biru*/
#rcorners2 {
    border-radius: 25px;
    border: 2px solid #73AD21;
    padding: 20px;
    width: 200px;
    height: 150px;
}
.post-content h2{
	color: #0088cc;
}
.post-by{
	color: #0088cc;
}

/*post-custom*/
article.post-large-custom {
	margin-left: 0px;
}

article.post-large-custom h2 {
	margin-bottom: 5px;
}

article.post-large-custom .post-image-custom, article.post-large-custom .post-date-custom {
	margin-left: -60px;
}

article.post-large-custom .post-image-custom {
	margin-bottom: 15px;
}

article.post-large-custom .post-image.single-custom {
	margin-bottom: 30px;
}

article.post-large-custom .post-video-custom {
	margin-left: -60px;
}

article.post-large-custom .post-audio-custom {
	margin-left: -60px;
}
.img-recent{
	width: 300px;
	height: 260px;
	padding-right: 10px;
}
@media only screen and (max-width: 550px) {
	.img-recent{
		width: 270px;
		height: 250px;
		padding-right: 10px;
	}
}
.history-place{width: 100%;box-shadow: 0 10px 8px 0 rgba(0,0,0,0.2), 0 6px 40px 0 rgba(0,0,0,0.19);}
</style>
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/style.css') !!}">
@endsection

@section('content')
<div role="main" class="main">

	<section class="page-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ route('home') }}">@lang('general.menu.home')</a></li>
						<li class="active">@lang('general.menu.news')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.news')</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container">

		<div class="row">
			@foreach($news as $key => $value)
			<div class="col-md-9">
				<div class="blog-posts single-post">

					<article class="post post-large-custom blog-single-post">
						<div class="post-content back-content history-place">
							<h2>{{ $value->title }}</h2>
							<div class="post-meta">
								<i class="fa fa-user"></i>
									<span class="post-by">@lang('general.public.by') 
								 	@if(empty($value->author))
								 		Admin
								 	@else
								 		{{ $value->author }}
								 	@endif
								 	</span>
								<i class="fa fa-edit"></i><span class="post-by">@lang('general.public.by') {{ $value->edit_by }} </span>
							</div>
							
								<img style="float: left;" class="img-recent" src="{{ asset($pathp.'storage/news'.'/'.$value->img_url) }}">
								{!! $value->content !!}
						</div>
					</article>
				</div>
			</div>
			@endforeach

			@include('frontend.right_bar')
		</div>

	</div>

</div>
@endsection
