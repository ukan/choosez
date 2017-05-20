@extends('layout.frontend.general.layout')

@section('title', 'Bimtes')

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
						<li class="active">@lang('general.menu.bimtes')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.bimtes')</h1>
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
							<div class="owl-carousel" data-plugin-options='{"items":1, "dots": false, "autoplay": true, "autoplayTimeout": 5000}'>
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
							<h2 class="center">BIMTES DAN JALUR MANDIRI UIN BANDUNG : Pondok Pesantren AL Ihsan</h2>
							<div class="post-meta">
								<hr>
							</div>
							<label style="font-style:italic;font-size: 16px;color:#000">Assalamua’laikum WR.WB...</label>
							<p class="justify">Bismillah,  bagi kalian akang-akang dan teteh-teteh calon mahasiswa baru yang mau ikut jalur mandiri UIN Sunan Gunung Djati Bandung, yang masih bingung dengan masuk atau tidaknya ke jurusan yang ada di UIN Sunan Gunung Djati Bandung atau masih belum percaya diri dengan ujian tulis jalur mandiri.</p>
							<p class="justify"><span style="color: red">Nah nah nah ada kabar gembira....</span> sudah di buka lhoo BIMTES (Bimbingan Test) buat jalur mandiri di PONPES AL-IHSAN Cibiruhilir. Kalau kalian sedang mencari informasi, kami solusinya. dari pendaftaran, biaya kuliah, beasiswa, insya Allah kami bisa memberikan informasi yang up to date ,terkini bahkan sudah terbukti lulusan Bimtes Al Ihsan ini telah meloloskan seleksi jalur mandiri UIN Bandung ini.</p>
							<p class="justify">Ah-ya... kami juga membuka pendaftaran BIMTES jalur mandiri untuk akang-akang/teteh-teteh yang ikut jalur mandiri. so' come along with us.</p>
							<p class="justify">Buat pendaftarannya cukup<span style="color: red"><b> Rp. 125.000,- </b></span> fasilitas yang kalian dapatkan dijamin deh buat kalian terpana. fasilitasnya antara lain :
							<br>1. Sertifikat
							<br>2. Notebook
							<br>3. Stiker
							<br>4. PENGINAPAN (ini dia, buat kalian yang rumahnya jauh gak usah khawatir mencari tempat tinggal semasa BIMTES. kami siapkan dengan sebaik mungkin)
							<br>5. Paket soal 
							<br>6. Bolpoin
							<br>7. Snack
							<br>8. Makan sebanyak 6x selama bimtes berjalan.
							</p>
							<p style="color: red;font-style: oblique;" class="justify"><strong>Fasilitas super kumplit ini hanya ada di BIMTES kami.</strong> </p>
							<p class="justify"><b>BIMTEST PONPES AL IHSAN</b> tentunya yang paling dekat dan pesantren paling favororit lho di UIN Bandung ini.
							<p class="justify">Ayoo... kalian tinggal registrasi di halaman WEB ini, dengan mengisi formulir <a href="#0">disini</a></p>
							

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