@extends('layout.frontend.general.layout')

@section('title', 'Facilities')

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
.history-place{width: 100%;box-shadow: 0 10px 8px 0 rgba(0,0,0,0.2), 0 6px 40px 0 rgba(0,0,0,0.19);}

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
    height: 350px;
}
/*-- //Edifice-Ends-Here --*/
.facilities-slider{
	background-color: #000;
	padding : 10px 10px 10px 10px; 
}
.facilities-slider label{
	padding-top: 5px;
	font-size: 18px; 
	color: #fff;
}
</style>
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/style.css') !!}">
{!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}
{!! Html::style($pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.css') !!}
@endsection

@section('content')
<div role="main" class="main">

	<section class="page-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ route('home') }}">@lang('general.menu.home')</a></li>
						<li class="active">@lang('general.menu.facilities')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.facilities')</h1>
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
							<h2 class="center"><b>Fasilitas Pondok Pesantren Al Ihsan</b></h2>
							<div class="post-meta">
								<hr>
							</div>
							<p class="justify">Dalam proses pembangunannya, Kini Pondok Pesantren Al-Ihsan mempunyai berbagai fasilitas atau sarana prasarana yang menunjang kegiatan pembejaran di pondok. Diantara fasilitas tersebut sebagai berikut.
							<br> 1. Masjid Al-Mubarak ( dua lantai ) yang menjadi tempat jamaah dan mengaji para santri
							<br> 2. Asrama, merupakan tempat tinggal atau tempat domisili santri selama mengaji di pondok . yang terdiri dari 11 asrama putri (aspi) dan 4 asrama putra (aspa). Tujuh asrama putris tersebut terbagi lagi menjadi beberapa wilayah asrama putri yaitu ASPI 1 (A,B & C), ASPI 2, ASPI 3 (A,B & C), ASPI 4, (A & B) ASPI 5, ASPI 6 DAN ASPI 7. Sedangkan asrama Putra (ASPA) saat ini terdiri dari ASPA 1, ASPA 2, ASPA 3 dan ASPA 4.
							<br> 3. Aula merupakan tempat berkumpul santri atau tempat diadakanannya kegiatan Santri.
							<br> 4. Sekretariat pengurus merupakan ruang administrasi dan inventaris OSPAI
							<br> 5. Sarana Olahraga yang multifungsi dapat dimanfaatkan santri untuk kegiatan olahraga ataupun yang lainnya
							<br> 6. Halaman Parkir yang cukup luas yang menampung kendaran bermotor
							</p>
							<!-- Edifice-Starts-Here -->
						    <div class="edifice slideanim infra" id="edifice">
								<h4><b>Masjid</b></h4>
						    	<label class="line-infra"></label>
						        <div class="gallery-cursual">
						            <!-- start content_slider -->
						            <div id="owl-demo" class="owl-carousel text-center" data-plugin-options='{"items": 1, "dots": false, "autoplay": true, "autoplayTimeout": 3000}'>
						                <div class="item facilities-slider">
						                    <img class="lazyOwl" src="{{ asset($pathp.'storage/masjid1.jpg') }}" alt="name">
						                </div>
						                <div class="item facilities-slider">
						                    <img class="lazyOwl" src="{{ asset($pathp.'storage/masjid2.jpg') }}" alt="name">
						                </div>
						                <div class="item facilities-slider">
						                    <img class="lazyOwl" src="{{ asset($pathp.'storage/masjid3.jpg') }}" alt="name">
						                </div>
						            </div>
						            <!--//sreen-gallery-cursual -->
						        </div>
						    </div>
							<!-- Edifice-Starts-Here -->
						    <div class="edifice slideanim infra" id="edifice">
								<h4><b>Asrama</b></h4>
						    	<label class="line-infra"></label>
						        <div class="gallery-cursual">
						            <!-- start content_slider -->
						            <div id="owl-demo" class="owl-carousel text-center" data-plugin-options='{"items": 1, "dots": false, "autoplay": true, "autoplayTimeout": 3000}'>
						                <div class="item facilities-slider">
						                    <img class="lazyOwl" src="{{ asset($pathp.'storage/holder.png') }}" alt="name">
						                </div>
						            </div>
						            <!--//sreen-gallery-cursual -->
						        </div>
						    </div>
						    <!-- Edifice-Starts-Here -->
						    <div class="edifice slideanim infra" id="edifice">
								<h4><b>Aula</b></h4>
						    	<label class="line-infra"></label>
						        <div class="gallery-cursual">
						            <!-- start content_slider -->
						            <div id="owl-demo" class="owl-carousel text-center" data-plugin-options='{"items": 1, "dots": false, "autoplay": true, "autoplayTimeout": 3000}'>
						                <div class="item facilities-slider">
						                    <img class="lazyOwl" src="{{ asset($pathp.'storage/holder.png') }}" alt="name">
						                </div>
						            </div>
						            <!--//sreen-gallery-cursual -->
						        </div>
						    </div>
						    <!-- Edifice-Starts-Here -->
						    <div class="edifice slideanim infra" id="edifice">
								<h4><b>Sekretariat Pengurus</b></h4>
						    	<label class="line-infra"></label>
						        <div class="gallery-cursual">
						            <!-- start content_slider -->
						            <div id="owl-demo" class="owl-carousel text-center" data-plugin-options='{"items": 1, "dots": false, "autoplay": true, "autoplayTimeout": 3000}'>
						                <div class="item facilities-slider">
						                    <img class="lazyOwl" src="{{ asset($pathp.'storage/holder.png') }}" alt="name">
						                </div>
						            </div>
						            <!--//sreen-gallery-cursual -->
						        </div>
						    </div>
						    <!-- Edifice-Starts-Here -->
						    <div class="edifice slideanim infra" id="edifice">
								<h4><b>Sarana Olahraga</b></h4>
						    	<label class="line-infra"></label>
						        <div class="gallery-cursual">
						            <!-- start content_slider -->
						            <div id="owl-demo" class="owl-carousel text-center" data-plugin-options='{"items": 1, "dots": false, "autoplay": true, "autoplayTimeout": 3000}'>
						                <div class="item facilities-slider">
						                    <img class="lazyOwl" src="{{ asset($pathp.'storage/gor.JPG') }}" alt="name">
						                </div>
						                <div class="item facilities-slider">
						                    <img class="lazyOwl" src="{{ asset($pathp.'storage/volly.JPG') }}" alt="name">
						                </div>
						            </div>
						            <!--//sreen-gallery-cursual -->
						        </div>
						    </div>
						    <!-- Edifice-Starts-Here -->
						    <div class="edifice slideanim infra" id="edifice">
								<h4><b>Halaman Parkir</b></h4>
						    	<label class="line-infra"></label>
						        <div class="gallery-cursual">
						            <!-- start content_slider -->
						            <div id="owl-demo" class="owl-carousel text-center" data-plugin-options='{"items": 1, "dots": false, "autoplay": true, "autoplayTimeout": 3000}'>
						                <div class="item facilities-slider">
						                    <img class="lazyOwl" src="{{ asset($pathp.'storage/parkir.jpg') }}" alt="name">
						                </div>
						            </div>
						            <!--//sreen-gallery-cursual -->
						        </div>
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

@section('scripts')
{!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.js') !!}
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
                  $('#content').html(val);
              });
            // $("#modalFormTicket").scrollTop(0);
            $('#loader').addClass("hidden");
            var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
            new PNotify({
                title: "Failed",
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
</script>
@endsection