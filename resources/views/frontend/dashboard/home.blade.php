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
	/*margin-top:3px ;*/
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
	height: 30px;
}
.height_content{
	height: 100px;
}
.height_title_footer_news{
	height: 80px;
}
/*-- //Events Section --*/

/*.full-screen {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}*/
.carousel-inner > .item > img, .carousel-inner > .item > a > img {
        display: block;
        /*height: 400px;*/
        min-width: 100%;
        width: 100%;
        max-width: 100%;
        line-height: 1;
    }
</style>
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/style.css') !!}">
<!-- {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!} -->
{!! Html::style($pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.css') !!}
@endsection
@section('content')

<div role="main" class="main">
	<div id="myCarousel" class="carousel slide">
	    <ol class="carousel-indicators">
	        <li data-target="#myCarousel" data-slide-to="0" class="active" contenteditable="false"></li>
	        <li data-target="#myCarousel" data-slide-to="1" class="" contenteditable="false"></li>
	        <li data-target="#myCarousel" data-slide-to="2" class="" contenteditable="false"></li>
	        <li data-target="#myCarousel" data-slide-to="3" class="" contenteditable="false"></li>
	    </ol>
	    <div class="carousel-inner">
	        <div class="item active" style="">
	           <a href="in/mos"> <img src="{{ asset($pathp.'assets/frontend/general/img/slides/pamflet.png') }}" alt="" class=""></a>
	        </div>
	        <div class="item ">
	            <img src="{{ asset($pathp.'assets/frontend/general/img/slides/rsz_slide_web.png') }}" alt="" class="">
	        </div>
	        <div class="item" style="">
	            <img src="{{ asset($pathp.'assets/frontend/general/img/slides/slider_1.jpeg') }}" alt="" class="">
	        </div>
	        <div class="item" style="">
	            <img src="{{ asset($pathp.'assets/frontend/general/img/slides/slider_2.jpeg') }}" alt="" class="">
	        </div>
	    </div>    
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
                    <img alt="fasilitas 5" class="lazyOwl" src="{{ asset($pathp.'storage/asrama1.jpeg') }}" alt="name">
                </div>
                <div class="item facilities-slider">
                    <img alt="fasilitas 1" class="lazyOwl" src="{{ asset($pathp.'storage/masjid2.jpg') }}" alt="name">
                </div>
                <div class="item facilities-slider">
                    <img alt="fasilitas 2" class="lazyOwl" src="{{ asset($pathp.'storage/volly.JPG') }}" alt="name">
                </div>
                <div class="item facilities-slider">
                    <img alt="fasilitas 3" class="lazyOwl" src="{{ asset($pathp.'storage/parkir.jpg') }}" alt="name">
                </div>
                <div class="item facilities-slider">
                    <img alt="fasilitas 4" class="lazyOwl" src="{{ asset($pathp.'storage/gor.JPG') }}" alt="name">
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
					// $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        			// $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$value->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
        			// $sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);
				?>
	        <div class="col-md-6 col-sm-6 egrid">
				<div class="img">
				    <img alt="recent post" class="img-recent" src="{{ asset($pathp.'storage/news'.'/'.$value->img_url) }}">
				</div>
			    <div class="textt">
				    <div class="date-event">
					    <h5><b>{{ eform_datemonth($value->created_at) }}</b></h5>
					</div>
				    <h3 class="height_title">{{ str_limit($value->title,40) }}</h3>
					<label class="eline"></label>
				    <div class="height_content">{!! str_limit($value->content,100) !!}</div>
					<a href="{{ route('news-detail', $value->slug) }}" >@lang('general.public.read_more')</a>
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
													/*$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
								        			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$bulletin_article[$x]->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
								        			$sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);*/
												?>
												<div class="col-md-6">
													<article>
														<div style="color:#0088cc" class="date">
															<span class="day">{{ eform_date_number($bulletin_article[$x]->created_at) }}</span>
															<span style="background-color: #0088cc;" class="month">{{ eform_date_month($bulletin_article[$x]->created_at) }}</span>
														</div>
														<h4 class="height_title_footer_news"><a href="{{ route('news-detail', $value->slug) }}">{{ str_limit($bulletin_article[$x]->title,41) }}</a></h4>
														{!! str_limit($bulletin_article[$x]->content, 100) !!}<a href="{{ route('news-detail', $value->slug) }}" class="read-more">@lang('general.public.read_more') <i class="fa fa-angle-right"></i></a>
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
													/*$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
								        			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$bulletin_news[$x]->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
								        			$sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);*/
												?>
												<div class="col-md-6">
													<article>
														<div class="date">
															<span style="color:#0088cc" class="day">{{ eform_date_number($bulletin_news[$x]->created_at) }}</span>
															<span style="background-color: #0088cc;" class="month">{{ eform_date_month($bulletin_news[$x]->created_at) }}</span>
														</div>
														<h4 class="height_title_footer_news"><a href="{{ route('news-detail', $bulletin_news[$x]->slug) }}">{{ str_limit($bulletin_news[$x]->title,41) }}</a></h4>
														{!! str_limit($bulletin_news[$x]->content, 100) !!}<a href="{{ route('news-detail', $bulletin_news[$x]->slug) }}" class="read-more">@lang('general.public.read_more') <i class="fa fa-angle-right"></i></a>
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
<!-- {!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.js') !!} -->
<script type="text/javascript">
	$('.jquery-form-tickets').ajaxForm({
        dataType : 'json',
        success: function(response) {
            if(response.status == 'success'){
                var title_not = 'Notification';
                var type_not = 'success';
                // $(":file").filestyle('clear');
                $(".btn.btn-default .badge").remove();
            }else{
                var title_not = 'Notification';
                var type_not = 'failed';
            }
            $('#loader').addClass("hidden");
            $("[name='email']").val('');
            var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
            new PNotify({
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
                  $('#content').html(val);
              });
            // $("#modalFormTicket").scrollTop(0);
            $('#loader').addClass("hidden");
            var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
            new PNotify({
                text: "Validate Error, Check Your Data Again",
                type: 'danger',
                addclass: "stack-custom",
                stack: myStack
            });
          } else {
              $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
          }
        }
    });

	$('#myCarousel').carousel();
    var winWidth = $(window).innerWidth();
    $(window).resize(function () {

        if ($(window).innerWidth() < winWidth) {
            $('.carousel-inner>.item>img').css({
                'min-width': winWidth, 'width': winWidth
            });
        }
        else {
            winWidth = $(window).innerWidth();
            $('.carousel-inner>.item>img').css({
                'min-width': '', 'width': ''
            });
        }
    });
    $('.carousel').carousel({
	  interval: 6000,
	  pause: "false"
	});

    // var $item = $('.carousel .item'); 
	// var $wHeight = $(window).height();
	// $item.eq(0).addClass('active');
	// $item.height($wHeight); 
	// $item.addClass('full-screen');

	// $('.carousel img').each(function() {
	//   var $src = $(this).attr('src');
	//   var $color = $(this).attr('data-color');
	//   $(this).parent().css({
	//     'background-image' : 'url(' + $src + ')',
	//     'background-color' : $color
	//   });
	//   $(this).remove();
	// });
</script>
@endsection