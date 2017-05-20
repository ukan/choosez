@extends('layout.frontend.general.layout')

@section('title', 'Structure')

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
						<li class="active">@lang('general.menu.profile')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.structure')</h1>
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
							<h2 class="center">STRUKTUR ORGANISASI</h2>
							<h2 class="center">PONDOK PESANTREN AL IHSAN</h2>
              <hr>
              <div class="form-group">
                  <label class="col-md-3 control-label">Pimpinan</label>
                  <div class="col-md-9">
                      : KH. Tantan Taqiyudin, Lc
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">Bendahara</label>
                  <div class="col-md-9">
                      : Heni Haryani, S.Ag
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">Kabag Akademik</label>
                  <div class="col-md-9">
                      : Dr. H. Dindin Sholahudin, MA
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">Kabag Kesantrian</label>
                  <div class="col-md-9">
                      : Ramdan Juniarsyah, M.Ag
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">Ketua DKM Masjid Al Mubarok</label>
                  <div class="col-md-9">
                      : H Lilih Muslih, M. MP.d
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">Dewan Guru</label>
                  <div class="col-md-9">
                      : <br>
                      - Prof. Dr. KH. Rahmat Syafi`i, MA<br>
                      - H. Agus Rofiudin, Lc<br>
                      - H.M. Nurhasan M.Ag<br>
                      - Zaenal Muttaqin, M.Ag<br>
                      - K. Aceng Abdul Wahid<br>
                      - Ahmad Yani, S.Ag<br>
                      - Ucup Fathuddin, M.Ag<br>
                      - Miftah Subhan<br>
                      - Tarya Nurul Mustofa, M.Ag<br>
                      - Dede. S. Hidyat, S.H.I<br>
                      - Eman Sulaeman, M.Ag<br>
                      - Hj. Ridha Nur Farida, M.Ag<br>
                      - Alfi Ali Fatoni, S.Pd<br>
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