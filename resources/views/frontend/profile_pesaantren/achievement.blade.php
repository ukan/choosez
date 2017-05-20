@extends('layout.frontend.general.layout')

@section('title', 'Archievement')

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
.left-achievement{padding-left: 20px}
</style>
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
						<li class="active">@lang('general.menu.profile')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.achievement')</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container">

		<div class="row">
			<div class="col-md-9">
				<div class="blog-posts single-post">

					<article class="post post-large-custom blog-single-post">
						<div class="post-image">
							<div class="owl-carousel" data-plugin-options='{"items":1, "dots": false, "autoplay": true, "autoplayTimeout": 9000}'>
								@foreach($slider as $key => $value)
								<div>
									<div class="img-thumbnail">
										<img style="height: 400px;width: 1280px" class="img-responsive" src="{{ asset($pathp.'storage/slider/'.$value->image) }}" alt="">
									</div>
								</div>
								@endforeach
							</div>
						</div>

						<div class="post-content back-content history-place">
							<h2>Prestasi Pondok Pesantren Al Ihsan</h2>
              <hr>
              <p class="justify">Alhamdulillah, Pondok Pesantren Al-Ihsan dari awal mula berdiri hingga kini mencapai berbagai prestasi yang cukup membanggakan baik di bidang bahasa, olahraga, seni, sains , karya ilmiah, syar'i, dan bidang lainnya.</p>
              <p class="justify">Berikut beberapa contoh prestasi santri Pondok Pesantren Al-Ihsan :</p>
              <p class="justify left-achievement">
                1. Juara I Piala Pamiliar Volley Ball antar pesantren Se Bandung Timur Milad II Pesantren Nailul Kirom<br>
                2. Terbaik I Cabang Fahmil Qur’an MTQ Ke XXIV Tingkat Provinsi Jawa Barat Tahun 2002<br>
                3. Terbaik I Fahmil Qur’an MTQ Ke XXXIII Tingkat Kabupate Bandung<br>
                4. Terbaik II M2KQ Putra MTQ Ke XXXVII se Kabupaten Karawang tahun 2007<br>
                5. Juara II M2KQ Putra MTQ Ke VII Kota Tasikmalaya 2009<br>
                6. Juara I Bidang Tarikh Tingkat Wustha Putra MTQ Ke IV Kab Bandung 2010<br>
                7. Juara I Menulis Cerpen FPMIPA UPI 2014<br>
                8. Juara III Turnamen Futsal antar Pesantren Se Bandung Raya 2015<br>
                9. Juara 1 Seni Marawis Kategori Umum Se-Provinsi Jaw Barat 2015<br>
                10. Juara 2 lomba menulis essay tingkat Mahasiswa Se-Jabar  dalam acara Islamic Psychology Fair 2016<br>
                11. Juara 3 lomba poster tingkat Mahasiswa Se-Jabar dalam acara Islamic Psychology Fair 2016<br>
                12. 29. Juara 1 Nasyid terbaik pada acara Gebyar Nasyid Eureka Fisika se-Jawa Barat tahun 2016.<br>
                13. Juara III Lomba  Qiroatul Kutub Putra, Musabaqah Kitab Kuning 2017 yang dilaksanakan oleh DKC Garda Bangsa Kab.Bandung<br>
              </p>
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