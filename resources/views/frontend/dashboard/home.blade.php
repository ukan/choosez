@extends('layout.frontend.general.layout')

@section('title', 'Home')

@section('css')
<style type="text/css">
	/*-- Events Section --*/
.events{
	background-color:black;
	padding: 50px 0px;
}
.events h3{
	color:#fff;
	text-align:center;
    font-size:30px;
}
.edifice h3{
	text-align:center;
    font-size:30px;
}
/*-- Edifice-Starts-Here --*/
.edifice {
    padding-bottom: 50px;
    border-bottom: 1px solid #EEE;
    text-align: center;
}
img.lazyOwl {
    width: 100%;
}
#owl-demo .item img {
    height: 250px;
}
/*-- //Edifice-Ends-Here --*/
.events h6{
    color: #797979;
    padding-bottom: 30px;
    width: 45%;
    margin: 0 auto;
    font-size: 15px;
    text-align: center;
    line-height: 25px;

}
.egrid{
	width: 48%;
    margin: 10px 1%;
	border:5px solid white;
	padding:0;
	position:relative;
	padding:10px;
	margin-bottom:30px;
}
.egrid{
		width:48%;
		float:left;
	}
.egrid {
	width: 100%;
	margin-left: 0px;
}
.textt{
	width:45%;
	float:left;
	margin-left:5%;
}
.date-event{
	position:absolute;
	top: -16px;
    left: 230px;
	background-color:#0088cc;
	padding:10px 10px 10px 10px;
	height: 40px;
}
.date-event h5{
	color:white;
}
.img{
	float:left;
   width:50%;
 }
 .textt h3{
	font-size:18px;
    margin-top: 35px;
	text-align: left;
	color:#B3B3B3;
}
 .textt p{
	margin-top:3px ;
	margin-bottom:10px;
	font-size: 14px;
	color: #4E4E4E;
 }
  .textt a{
	color:#0088cc;
	border:2px solid #0088cc; 
	padding:7px 15px;
	display:inline-block;
    margin-top:10px;
	font-size: 14px;
}
.textt a:hover{
	border:2px solid white;
	color:white;
}
label.eline{
    display: block;
    background-color: #0088cc;
    width: 55px;
    height: 2px;
	margin: 15px 0px;
}
label.line{
	background-color:#0088cc;
	display:block;
	width: 100px;
    height: 2px;
	margin:15px auto;
}
label.line-infra{
	background-color:#000;
	display:block;
	width: 100px;
    height: 2px;
	margin:15px auto;
}
.bold-color{
	color: #0088cc;
}
	/*#2243e8 2807ff buru ungu
#32ddff 09cff7 tosca
#0011ff biru*/
.infra{
	background-color: #32ddff;
	padding-top: 40px;
}
.infra h3{
	color: #000;
}
.facilities-slider{
	background-color: #000;
	padding : 10px 10px 10px 10px; 
}
.facilities-slider label{
	padding-top: 5px;
	font-size: 18px; 
	color: #fff;
}
.img-recent{
	width: 250px;
	height: 250px;
}
.height_title{
	height: 20px;
}
.height_title_footer_news{
	height: 80px;
}
/*-- //Events Section --*/
</style>
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/style.css') !!}">
@endsection
@section('content')

<div role="main" class="main">

	<div class="slider-container slider-container-fullscreen">
		<div class="slider" id="revolutionSliderFullScreen" data-plugin-revolution-slider data-plugin-options='{"fullScreen": "on"}'>
			<ul>
				<!-- <li data-transition="fade" data-slotamount="10" data-masterspeed="300">
					<img src="{{ asset($pathp.'assets/frontend/general/img/slides/cek.png') }}" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" />

					<div class="tp-caption tp-fade fadeout fullscreenvideo"
						data-x="0"
						data-y="0"
						data-speed="1000"
						data-start="100"
						data-easing="Power4.easeOut"
						data-elementdelay="0.01"
						data-endelementdelay="0.1"
						data-endspeed="1500"
						data-endeasing="Power4.easeIn"
						data-autoplay="true"
						data-autoplayonlyfirsttime="false"
						data-nextslideatend="true"
						data-volume="mute"
						data-forceCover="1"
						data-aspectratio="16:9"
						data-forcerewind="on">

						<video preload="none" width="100%" height="100%" poster="{{ asset('public/assets/frontend/general/img/slides/cek.png') }}"> 
							<source src="{{ asset($pathp.'assets/frontend/general/video/cek.mp4') }}" type="video/mp4" />
						</video>

					</div> -->

					<!-- <div class="tp-caption top-label lfl stl"
						 data-x="140"
						 data-y="180"
						 data-speed="300"
						 data-start="500"
						 data-easing="easeOutExpo">You just found the</div>

					<div class="tp-caption main-label sft stb"
						 data-x="135"
						 data-y="210"
						 data-speed="300"
						 data-start="1500"
						 data-easing="easeOutExpo">BEST SOLUTION</div>

					<div class="tp-caption bottom-label sft stb"
						 data-x="150"
						 data-y="280"
						 data-speed="500"
						 data-start="2000"
						 data-easing="easeOutExpo">The #1 Selling HTML Site Template on ThemeForest</div>

					<a class="tp-caption customin btn btn-lg btn-primary main-button" data-hash href="#home-intro"
						data-x="260"
						data-y="335"
						data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
						data-speed="800"
						data-start="2500"
						data-easing="Back.easeInOut"
						data-endspeed="300">
							Get Started Now!
					</a>

					<div class="tp-caption main-label sft stb visible-lg"
						 data-x="345"
						 data-y="415"
						 data-speed="500"
						 data-start="2700"
						 data-easing="easeOutExpo"><a data-hash href="#home-intro"><i class="fa fa-arrow-circle-o-down"></i></a></div> -->

				<!-- </li> -->
				<li data-transition="fade" data-slotamount="5" data-masterspeed="600">
					<img src="{{ asset($pathp.'assets/frontend/general/img/slides/slide_web.jpg') }}" data-fullwidthcentering="on" alt="">

						<!-- <div class="tp-caption sft stb visible-lg"
							 data-x="417"
							 data-y="100"
							 data-speed="300"
							 data-start="1000"
							 data-easing="easeOutExpo"><img src="{{ asset($pathp.'assets/frontend/general/img/slides/slide-title-border.png') }}" alt=""></div>

						<div class="tp-caption top-label lfl stl"
							 data-x="center" data-hoffset="0"
							 data-y="100"
							 data-speed="300"
							 data-start="500"
							 data-easing="easeOutExpo">DO YOU NEED A NEW</div>

						<div class="tp-caption sft stb visible-lg"
							 data-x="717"
							 data-y="100"
							 data-speed="300"
							 data-start="1000"
							 data-easing="easeOutExpo"><img src="{{ asset($pathp.'assets/frontend/general/img/slides/slide-title-border.png') }}" alt=""></div>

						<div class="tp-caption main-label sft stb"
							 data-x="center" data-hoffset="0"
							 data-y="130"
							 data-speed="300"
							 data-start="1500"
							 data-easing="easeOutExpo">WEB DESIGN?</div>

						<div class="tp-caption bottom-label sft stb"
							 data-x="center" data-hoffset="0"
							 data-y="200"
							 data-speed="500"
							 data-start="2000"
							 data-easing="easeOutExpo">Check out our options and features.</div>

						<a class="tp-caption customin btn btn-lg btn-primary main-button" data-hash href="#projects"
							data-x="center" data-hoffset="0"
							data-y="250"
							data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
							data-speed="800"
							data-start="1700"
							data-easing="Back.easeInOut"
							data-endspeed="300">
								Get Started Now!
						</a> -->
				</li>
				<li data-transition="fade" data-slotamount="5" data-masterspeed="600">
					<img src="{{ asset($pathp.'assets/frontend/general/img/slides/slider_1.jpeg') }}" data-fullwidthcentering="on" alt="">

						<!-- <div class="tp-caption sft stb visible-lg"
							 data-x="417"
							 data-y="100"
							 data-speed="300"
							 data-start="1000"
							 data-easing="easeOutExpo"><img src="{{ asset($pathp.'assets/frontend/general/img/slides/slide-title-border.png') }}" alt=""></div>

						<div class="tp-caption top-label lfl stl"
							 data-x="center" data-hoffset="0"
							 data-y="100"
							 data-speed="300"
							 data-start="500"
							 data-easing="easeOutExpo">DO YOU NEED A NEW</div>

						<div class="tp-caption sft stb visible-lg"
							 data-x="717"
							 data-y="100"
							 data-speed="300"
							 data-start="1000"
							 data-easing="easeOutExpo"><img src="{{ asset($pathp.'assets/frontend/general/img/slides/slide-title-border.png') }}" alt=""></div>

						<div class="tp-caption main-label sft stb"
							 data-x="center" data-hoffset="0"
							 data-y="130"
							 data-speed="300"
							 data-start="1500"
							 data-easing="easeOutExpo">WEB DESIGN?</div>

						<div class="tp-caption bottom-label sft stb"
							 data-x="center" data-hoffset="0"
							 data-y="200"
							 data-speed="500"
							 data-start="2000"
							 data-easing="easeOutExpo">Check out our options and features.</div>

						<a class="tp-caption customin btn btn-lg btn-primary main-button" data-hash href="#projects"
							data-x="center" data-hoffset="0"
							data-y="250"
							data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
							data-speed="800"
							data-start="1700"
							data-easing="Back.easeInOut"
							data-endspeed="300">
								Get Started Now!
						</a> -->
				</li>
				<li data-transition="fade" data-slotamount="5" data-masterspeed="600">
					<img src="{{ asset($pathp.'assets/frontend/general/img/slides/slider_2.jpeg') }}" data-fullwidthcentering="on" alt="">

						<!-- <div class="tp-caption sft stb visible-lg"
							 data-x="417"
							 data-y="100"
							 data-speed="300"
							 data-start="1000"
							 data-easing="easeOutExpo"><img src="{{ asset($pathp.'assets/frontend/general/img/slides/slide-title-border.png') }}" alt=""></div>

						<div class="tp-caption top-label lfl stl"
							 data-x="center" data-hoffset="0"
							 data-y="100"
							 data-speed="300"
							 data-start="500"
							 data-easing="easeOutExpo">DO YOU NEED A NEW</div>

						<div class="tp-caption sft stb visible-lg"
							 data-x="717"
							 data-y="100"
							 data-speed="300"
							 data-start="1000"
							 data-easing="easeOutExpo"><img src="{{ asset($pathp.'assets/frontend/general/img/slides/slide-title-border.png') }}" alt=""></div>

						<div class="tp-caption main-label sft stb"
							 data-x="center" data-hoffset="0"
							 data-y="130"
							 data-speed="300"
							 data-start="1500"
							 data-easing="easeOutExpo">WEB DESIGN?</div>

						<div class="tp-caption bottom-label sft stb"
							 data-x="center" data-hoffset="0"
							 data-y="200"
							 data-speed="500"
							 data-start="2000"
							 data-easing="easeOutExpo">Check out our options and features.</div>

						<a class="tp-caption customin btn btn-lg btn-primary main-button" data-hash href="#projects"
							data-x="center" data-hoffset="0"
							data-y="250"
							data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
							data-speed="800"
							data-start="1700"
							data-easing="Back.easeInOut"
							data-endspeed="300">
								Get Started Now!
						</a> -->
				</li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<hr class="tall" />
		</div>
	</div>
	<!-- Edifice-Starts-Here -->
    <div class="edifice slideanim infra" id="edifice">
    	<h3><b>@lang('general.title.infrastructure')</b></h3>
    	<label class="line-infra"></label>
        <div class="gallery-cursual">
            <!-- start content_slider -->
            <div id="owl-demo" class="owl-carousel text-center" data-plugin-options='{"items": 3, "dots": false, "autoplay": true, "autoplayTimeout": 3000}'>
                <div class="item facilities-slider">
                    <img class="lazyOwl" src="{{ asset($pathp.'storage/masjid2.jpg') }}" alt="name">
                </div>
                <div class="item facilities-slider">
                    <img class="lazyOwl" src="{{ asset($pathp.'storage/volly.JPG') }}" alt="name">
                </div>
                <div class="item facilities-slider">
                    <img class="lazyOwl" src="{{ asset($pathp.'storage/parkir.jpg') }}" alt="name">
                </div>
                <div class="item facilities-slider">
                    <img class="lazyOwl" src="{{ asset($pathp.'storage/gor.JPG') }}" alt="name">
                </div>
            </div>
            <!--//sreen-gallery-cursual -->
        </div>
    </div>
	<!-- //Edifice-Ends-Here -->
	<div class="container">
		<div class="row">
			<hr class="tall" />
		</div>
	</div>
	<!-- Events Section -->
	<div class="events" id="events">
		<div class="container">
	        <h3><b>@lang('general.title.recent_post')</b></h3>
	        <label class="line"></label>
	        @foreach($bulletin_recent as $key => $value)
	        	<?php
					$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$value->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
        			$sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);
				?>
	        <div class="col-md-6 col-sm-6 egrid">
				<div class="img">
				    <img class="img-recent" src="{{ asset($pathp.'storage/news'.'/'.$value->img_url) }}">
				</div>
			    <div class="textt">
				    <div class="date-event">
					    <h5>{{ eform_datemonth($value->updated_at) }}</h5>
					</div>
				    <h3 class="height_title">{{ str_limit($value->title,40) }}</h3>
					<label class="eline"></label>
				    <p>{!! str_limit($value->content,80) !!}</p>
					<a href="{{ route('news-detail', $sentEncrypt) }}" >@lang('general.public.read_more')</a>
				</div>
				<div class="clearfix"></div>
	        </div>
	        @endforeach
			<div class="clearfix"></div>
		</div>
	</div>
	<!--// Events Section -->
	
	<div class="container">
		<div class="row">
			<hr class="tall" />
		</div>
	</div>
	<div id="projects" class="">
		<section class="featured footer map">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="recent-posts push-bottom news-bottom">
							<h2>@lang('general.title.latest_article')</h2>
							<div class="row">
								<div class="owl-carousel" data-plugin-options='{"items": 1, "dots": false, "autoplay": true, "autoplayTimeout": 3000}'>
									<?php 
										$x=0;
									?>
									@for ($i=0;$i<(intval($count_article/2));$i++)
										<div>
											@for($y=0;$y<2;$y++)
												<?php
													$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
								        			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$bulletin_article[$x]->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
								        			$sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);
												?>
												<div class="col-md-6">
													<article>
														<div class="date">
															<span class="day">{{ eform_date_number($bulletin_article[$x]->updated_at) }}</span>
															<span class="month">{{ eform_date_month($bulletin_article[$x]->updated_at) }}</span>
														</div>
														<h4 class="height_title_footer_news"><a href="{{ route('news-detail', $sentEncrypt) }}">{{ str_limit($bulletin_article[$x]->title,41) }}</a></h4>
														{!! str_limit($bulletin_article[$x]->content, 100) !!}<a href="{{ route('news-detail', $sentEncrypt) }}" class="read-more">@lang('general.public.read_more') <i class="fa fa-angle-right"></i></a>
													</article>
												</div>
												@php $x++; @endphp
											@endfor
										</div>
									@endfor
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="recent-posts push-bottom news-bottom">
							<h2>@lang('general.title.latest_news')</h2>
							<div class="row">
								<div class="owl-carousel" data-plugin-options='{"items": 1, "dots": false, "autoplay": true, "autoplayTimeout": 3000}'>
									<?php 
										$x=0;
									?>
									@for ($i=0;$i<(intval($count_news/2));$i++)
										<div>
											@for($y=0;$y<2;$y++)
												<?php
													$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
								        			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$bulletin_news[$x]->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
								        			$sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);
												?>
												<div class="col-md-6">
													<article>
														<div class="date">
															<span class="day">{{ eform_date_number($bulletin_news[$x]->updated_at) }}</span>
															<span class="month">{{ eform_date_month($bulletin_news[$x]->updated_at) }}</span>
														</div>
														<h4 class="height_title_footer_news"><a href="{{ route('news-detail', $sentEncrypt) }}">{{ str_limit($bulletin_news[$x]->title,41) }}</a></h4>
														{!! str_limit($bulletin_news[$x]->content, 100) !!}<a href="{{ route('news-detail', $sentEncrypt) }}" class="read-more">@lang('general.public.read_more') <i class="fa fa-angle-right"></i></a>
													</article>
												</div>
												@php $x++; @endphp
											@endfor
										</div>
									@endfor
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
@endsection

@section('scripts')

@endsection