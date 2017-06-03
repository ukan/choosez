@extends('layout.frontend.general.layout')

@section('title', 'Bimtes')

@section('css')
<script type="text/javascript">
	function removeHiddenClass(){
	  $("#imageLoadingClass").removeClass('hidden');
	}
</script>
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
.styleLoad{
	height: 50px;
	width: 50px;
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
<link rel="stylesheet" href="{!! asset($pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') !!}">
{!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}
{!! Html::style($pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.css') !!}
{!! Html::style( $pathp.'assets/general/library/bootstrap-file-input/bootstrap-file-input.css') !!}
{!! Html::style( $pathp.'assets/general/css/loader.css') !!}
<!-- <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script> -->
<script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
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
						<!-- <div class="post-image">
							<div class="owl-carousel" data-plugin-options='{"items":1, "dots": false, "autoplay": true, "autoplayTimeout": 5000}'>
								@foreach($slider as $key => $value)
								<div>
									<div class="img-thumbnail">
										<img style="height: 400px;width: 1280px" class="img-responsive" src="{{ asset($pathp.'storage/slider/'.$value->image) }}" alt="">
									</div>
								</div>
								@endforeach
							</div>
						</div> -->

						<div class="post-content back-content history-place">
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
							      <div class="panel-heading">
							        <h4 class="panel-title">
							          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><b>Informasi Bimtes</b></a>
							        </h4>
							      </div>
							      <div id="collapse1" class="panel-collapse collapse">
							        <div class="panel-body">
							        	@foreach($bimtes as $key => $value)
											<h2 class="center">{!! $value->title !!}</h2>
											<div class="post-meta">
												<hr>
											</div>
											{!! $value->content !!}
										@endforeach
							        </div>
							      </div>
							    </div>
							    <div class="panel panel-default">
							      <div class="panel-heading">
							        <h4 class="panel-title">
							          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><b>Form Pendaftaran Bimtes Online</b></a>
							        </h4>
							      </div>
							      <div id="collapse3" class="panel-collapse collapse in">
							        <div class="panel-body">
							        	{!! Form::open(['route'=>'post-register-bimtes', 'files'=>true, 'class' => 'form-horizontal jquery-form-data']) !!}
							            	<input type="hidden" name="method" id="method" value="add">
							            	<div class="form-group area-insert-update">
							                    <label class="col-md-3 control-label">Photo<b class="text-danger">*</b></label>
							                    <div class="col-md-9">
							                        {!! form_input_file_image('file','image','','200px','200px') !!}
							                        <p class="has-error text-danger error-image"></p>
							                    </div>
							                </div>
								            <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Nama Lengkap <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('nama', '', ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) !!}
								                    <p class="has-error text-danger error-nama"></p>
								                </div>
								            </div>
								            <div class="form-group {{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Tempat Lahir <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('tempat_lahir', '', ['class' => 'form-control', 'placeholder' => 'Tempat Lahir']) !!}
								                    <p class="has-error text-danger error-tempat_lahir"></p>
								                </div>
								            </div>
								            <div class="form-group {{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Tanggal Lahir <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir">
								                    <p class="has-error text-danger error-tanggal_lahir"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
							                    <label class="col-md-3 control-label">Jenis Kelamin <b class="text-danger">*</b></label>
							                    <div class="col-md-5">
							                        <select name="jenis_kelamin" id="jenis_kelamin" class="select2" data-plugin-selectTwo class="form-control populate" style="width:100%">
							                            <option value="Pilih Jenis Kelamin">Pilih Jenis Kelamin</option>
							                            <option value="Laki - laki">Laki - laki</option>
							                            <option value="Perempuan">Perempuan</option>
							                        </select>
							                        <p class="has-error text-danger error-jenis_kelamin"></p>
							                    </div>
							                </div>

								            <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Alamat <b class="text-danger">*</b></label>
								                <div class="col-lg-5">
							                        {!! Form::textarea('alamat', null, array('class' => 'form-control')) !!}
							                        <p class="has-error text-danger error-alamat"></p>
							                    </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Sekolah Asal<b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('sekolah_asal', '', ['class' => 'form-control', 'placeholder' => 'Sekolah Asal']) !!}
								                    <p class="has-error text-danger error-sekolah_asal"></p>
								                </div>
								                <label class="col-md-2 control-label">Tahun Lulus <b class="text-danger">*</b></label>
								                <div class="col-md-3">
								                    {!! Form::text('tahun_lulus', '', ['class' => 'form-control', 'placeholder' => 'Tahun Lulus']) !!}
								                    <p class="has-error text-danger error-tahun_lulus"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('no_kontak') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">No. Kontak <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('no_kontak', '', ['class' => 'form-control', 'placeholder' => 'No. Kontak']) !!}
								                    <p class="has-error text-danger error-no_kontak"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Email <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
								                    <p class="has-error text-danger error-email"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('no_tes') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">No. Tes <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('no_tes', '', ['class' => 'form-control', 'placeholder' => 'No. Tes']) !!}
								                    <p class="has-error text-danger error-no_tes"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('tanggal_tes') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Tanggal Tes <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    <input type="text" id="tanggal_tes" name="tanggal_tes" class="form-control" placeholder="Tanggal Tes">
								                    <p class="has-error text-danger error-tanggal_tes"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('pilihan_jurusan') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Pilihan Jurusan <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('pilihan_jurusan', '', ['class' => 'form-control', 'placeholder' => 'Jurusan 1']) !!}
								                    <p class="has-error text-danger error-pilihan_jurusan"></p>
								                </div>
								            </div>
								            <div class="form-group {{ $errors->has('pilihan_jurusan2') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label"></label>
								                <div class="col-md-4">
								                    {!! Form::text('pilihan_jurusan2', '', ['class' => 'form-control', 'placeholder' => 'Jurusan 2']) !!}
								                    <p class="has-error text-danger error-pilihan_jurusan2"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
							                    <label class="col-md-3 control-label">Bukti Pembayaran <b class="text-danger">*</b></label>
							                    <div class="col-md-9">
							                        {!! form_input_file_image('file','bukti_pembayaran','','300px','300px') !!}
							                        <p class="has-error text-danger error-bukti_pembayaran"></p>
							                    </div>
							                </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label"></label>
								                <div class="col-md-5">
								                    <button type="submit" onclick="removeHiddenClass()" title="Kirim" class="btn btn-primary btn-submit" >Kirim</button>
								                    <img id="imageLoadingClass" src="{!! asset($pathp.'assets/general/images/loaderx.gif') !!}" alt="loader" class="styleLoad hidden">
								                    
								                </div>
								            </div>
								        </form>
							        </div>
							      </div>
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
<script src="{!! asset($pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}"></script>
{!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.js') !!}
{!! Html::script( $pathp.'assets/general/library/bootstrap-file-input/bootstrap-file-input.js') !!}
<script type="text/javascript">
	$( function() {
		$('#tanggal_lahir').datepicker({
		    format: "mm-dd-yyyy",
		    forceParse: false
		});
		$('#tanggal_tes').datepicker({
		    format: "mm-dd-yyyy",
		    forceParse: false
		});
	});

	function reload(){
		setTimeout(function(){
            	window.location.reload(1);
            }, 1000);
	}

	$('.jquery-form-data').ajaxForm({
        dataType : 'json',
        success: function(response) {

            if(response.status == 'success'){
                var title_not = 'Notification';
                var type_not = 'success';
            }else{
                var title_not = 'Notification';
                var type_not = 'failed';
            }
            $("[name='nama']").val('');
            $("[name='nama_panggilan']").val('');
            $("[name='tempat_lahir']").val('');
            $("[name='tanggal_lahir']").val('');
            $("[name='jenis_kelamin']").val('Pilih Jenis Kelamin');
            $("[name='asrama']").val('Pilih Asrama');
            $("[name='kamar']").val('');
            $("[name='alamat']").val('');
            $("[name='provinsi']").val('pilih Provinsi');
            $("[name='kota']").val('Pilih Kabupaten/Kota');
            $("[name='kecamatan']").val('Pilih kecamatan');
            $("[name='desa']").val('');
            $("[name='rt']").val('');
            $("[name='rw']").val('');
            $("[name='kode_pos']").val('');
            $("[name='telepon']").val('');
            $("[name='sd']").val('');
            $("[name='tahun_lulus_sd']").val('');
            $("[name='smp']").val('');
            $("[name='tahun_lulus_smp']").val('');
            $("[name='sma']").val('');
            $("[name='tahun_lulus_sma']").val('');
            $("[name='ponpes']").val('');
            $("[name='univ']").val('');
            $("[name='fakultas']").val('');
            $("[name='jurusan']").val('');
            $("[name='semester']").val('');
            $("[name='ayah']").val('');
            $("[name='umur_ayah']").val('');
            $("[name='pendidikan_terakhir_ayah']").val('');
            $("[name='pekerjaan_ayah']").val('');
            $("[name='ibu']").val('');
            $("[name='umur_ibu']").val('');
            $("[name='pekerjaan_ibu']").val('');
            $("[name='pendidikan_terakhir_ibu']").val('');
            $("[name='email']").val('');

            $("#imageLoadingClass").addClass('hidden');

            var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
            new PNotify({
                title: response.status,
                text: response.notification,
                type: type_not,
                addclass: "stack-custom",
                stack: myStack
            });
            setTimeout(function(){
            	window.location.reload(1);
            }, 7000);
        },
        beforeSend: function() {
          $('.has-error').html('');
        },
        error: function(response){
          if (response.status === 422) {
              var data = response.responseJSON;
              $.each(data,function(key,val){
                  $('.error-'+key).html(val);
              });
              $("#imageLoadingClass").addClass('hidden');
            var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                new PNotify({
                    title: "Failed",
                    text: "Validate Error, Check Your Data Again",
                    type: 'danger',
                    addclass: "stack-custom",
                    stack: myStack
                });
            $("#modalFormTeacher").scrollTop(0);
          } else {
              $('.error').createClass('alert alert-danger').html(response.responseJSON.message);
          }
        }
    });
</script>
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