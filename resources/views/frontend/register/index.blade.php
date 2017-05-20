@extends('layout.frontend.general.layout')

@section('title', 'Register')

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
.styleLoad{
	height: 50px;
	width: 50px;
}
</style>
<script type="text/javascript">
	function removeHiddenClass(){
	  $("#imageLoadingClass").removeClass('hidden');
	}
</script>
<style type="text/css">
.hidden{
  display: none;
}
</style>
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/style.css') !!}">
<link rel="stylesheet" href="{!! asset($pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') !!}">
{!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}
{!! Html::style($pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.css') !!}
{!! Html::style( $pathp.'assets/general/library/bootstrap-file-input/bootstrap-file-input.css') !!}
{!! Html::style( $pathp.'assets/general/css/loader.css') !!}
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
@endsection

@section('content')
<div role="main" class="main">

	<section class="page-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ route('home') }}">@lang('general.menu.home')</a></li>
						<li class="active">@lang('general.menu.register')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.register')</h1>
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
							        <div class="panel-body">
							        	{!! Form::open(['route'=>'post-register-data', 'files'=>true, 'class' => 'form-horizontal jquery-form-data']) !!}
							            	<input type="hidden" name="method" id="method" value="add">
							            	<div class="form-group area-insert-update">
							                    <label class="col-md-3 control-label">Photo</label>
							                    <div class="col-md-9">
							                        {!! form_input_file_image('file','image','','200px','200px') !!}
							                        <p class="has-error text-danger error-image"></p>
							                    </div>
							                </div>
								            <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Nama Lengkap <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('nama', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-nama"></p>
								                </div>
								            </div>
								            <div class="form-group {{ $errors->has('nama_panggilan') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Nama Panggilan <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('nama_panggilan', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-nama_panggilan"></p>
								                </div>
								            </div>
								            <div class="form-group {{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Tempat Lahir <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('tempat_lahir', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-tempat_lahir"></p>
								                </div>
								            </div>
								            <div class="form-group {{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Tanggal Lahir <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
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

							                <div class="form-group {{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
							                    <label class="col-md-3 control-label">Asrama<b class="text-danger">*</b></label>
							                    <div class="col-md-5">
							                        <select name="asrama" id="asrama_id" onchange="ajaxroom(this.value)" class="select2" data-plugin-selectTwo class="form-control populate" style="width:100%">
							                            <option value="Pilih Asrama">Pilih Asrama</option>
							                            {{ user_info('select_asrama') }}
							                        </select>
							                        <p class="has-error text-danger error-asrama"></p>
							                    </div>
							                </div>

							                <div class="form-group {{ $errors->has('kamar') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Kamar <b class="text-danger">*</b></label>
								                <div class="col-md-5">
							                        <select name="kamar" id="room_id" class="select2" data-plugin-selectTwo class="form-control populate" style="width:100%">
							                            <option value="Pilih Kamar">Pilih Kamar</option>
							                            {{ user_info('select_kamar') }}
							                        </select>
							                        <p class="has-error text-danger error-asrama"></p>
							                    </div>
								            </div>

								            <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Alamat <b class="text-danger">*</b></label>
								                <div class="col-lg-5">
							                        {!! Form::textarea('alamat', null, array('class' => 'form-control')) !!}
							                        <p class="has-error text-danger error-alamat"></p>
							                    </div>
								            </div>

								            <div class="form-group {{ $errors->has('provinsi') ? ' has-error' : '' }}">
							                    <label class="col-md-3 control-label">Provinsi <b class="text-danger">*</b></label>
							                    <div class="col-md-5">
							                        <select name="provinsi" id="province_id" class="select2" onchange="ajaxdistrict(this.value)" data-plugin-selectTwo class="form-control populate" style="width:100%">
							                            <option value="Pilih Provinsi">Pilih Provinsi</option>
							                            {{ user_info('select_province') }}
							                        </select>
							                        <p class="has-error text-danger error-provinsi"></p>
							                    </div>
							                </div>
							                <div class="form-group {{ $errors->has('kota') ? ' has-error' : '' }}">
							                    <label class="col-md-3 control-label">Kabupaten/Kota <b class="text-danger">*</b></label>
							                    <div class="col-md-5">
							                        <select name="kota" id="district_id" class="select2" onchange="ajaxsubdistrict(this.value)" data-plugin-selectTwo class="full-width" style="width:100%" >
							                            <option value="Pilih Kabupaten/Kota">Pilih Kabupaten/Kota</option>
							                            {{ user_info('select_city') }}
							                        </select>
							                        <p class="has-error text-danger error-kota"></p>
							                    </div>
							                </div>
							                <div class="form-group {{ $errors->has('kecamatan') ? ' has-error' : '' }}">
							                    <label class="col-md-3 control-label">Kecamatan <b class="text-danger">*</b></label>
							                    <div class="col-md-5">
							                       <select name="kecamatan" id="sub_district_id" class="select2" onchange="ajaxvillage(this.value)" data-plugin-selectTwo class="full-width" style="width:100%">
							                            <option value="Pilih kecamatan">Pilih kecamatan</option>
							                            {{ user_info('select_district') }}
							                        </select>
							                        <p class="has-error text-danger error-kecamatan"></p>
							                    </div>
							                </div>

							                <div class="form-group {{ $errors->has('desa') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Desa <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('desa', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-desa"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('rt') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">RT <b class="text-danger">*</b></label>
								                <div style="width: 75px" class="col-sm-1">
							                        {!! Form::text('rt', '', ['class' => 'form-control']) !!}
							                        @if ($errors->has('rt'))
									                    <!-- <p class="has-error text-danger">{{ $errors->first('rt') }}</p> -->
									                @endif
							                    </div>
								            </div>
								            <div class="form-group {{ $errors->has('rw') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">RW <b class="text-danger">*</b></label>
								                <div style="width: 75px" class="col-lg-1">
							                        {!! Form::text('rw', '', ['class' => 'form-control']) !!}
							                        @if ($errors->has('rw'))
									                    <!-- <p class="has-error text-danger">{{ $errors->first('rw') }}</p> -->
									                @endif
							                    </div>
								            </div>

								            <div class="form-group {{ $errors->has('kode_pos') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Kode Pos <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('kode_pos', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-kode_pos"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('telepon') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Telepon <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('telepon', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-telepon"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Email <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('email', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-email"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-4 control-label"><strong>Pengalaman Pendidikan</strong></label>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">SD/MI <b class="text-danger">*</b></label>
								                <div class="col-md-3">
								                    {!! Form::text('sd', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-sd"></p>
								                </div>
								                <label class="col-md-3 control-label">Tahun Lulus <b class="text-danger">*</b></label>
								                <div class="col-md-3">
								                    {!! Form::text('tahun_lulus_sd', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-tahun_lulus_sd"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">SMP/M.Ts <b class="text-danger">*</b></label>
								                <div class="col-md-3">
								                    {!! Form::text('smp', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-smp"></p>
								                </div>
								                <label class="col-md-3 control-label">Tahun Lulus <b class="text-danger">*</b></label>
								                <div class="col-md-3">
								                    {!! Form::text('tahun_lulus_smp', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-tahun_lulus_smp"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">SMA/MA/SMK <b class="text-danger">*</b></label>
								                <div class="col-md-3">
								                    {!! Form::text('sma', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-sma"></p>
								                </div>
								                <label class="col-md-3 control-label">Tahun Lulus <b class="text-danger">*</b></label>
								                <div class="col-md-3">
								                    {!! Form::text('tahun_lulus_sma', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-tahun_lulus_sma"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Pondok Pesantren </label>
								                <div class="col-lg-9">
							                        {!! Form::textarea('ponpes', null, array('class' => 'ckeditor')) !!}
							                        <p class="has-error text-danger error-ponpes"></p>
							                    </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Univ/Institut </label>
								                <div class="col-md-5">
								                    {!! Form::text('univ', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-univ"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('jenjang_pendidikan') ? ' has-error' : '' }}">
							                    <label class="col-md-3 control-label">Jenjang Pendidikan</label>
							                    <div class="col-md-5">
							                        <select name="jenjang_pendidikan" id="jenjang_pendidikan" class="select2" data-plugin-selectTwo class="form-control populate" style="width:100%">
							                            <option value="Pilih Jenjang Pendidikan">Pilih Jenjang Pendidikan</option>
							                            <option value="D3">D3</option>
							                            <option value="S1">S1</option>
							                            <option value="S2">S2</option>
							                            <option value="S3">S3</option>
							                        </select>
							                        <p class="has-error text-danger error-jenjang_pendidikan"></p>
							                    </div>
							                </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Fakultas </label>
								                <div class="col-md-5">
								                    {!! Form::text('fakultas', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-fakultas"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Jurusan </label>
								                <div class="col-md-5">
								                    {!! Form::text('jurusan', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-jurusan"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Semester </label>
								                <div class="col-md-5">
								                    {!! Form::text('semester', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-semester"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label"><strong>Data Orang Tua</strong></label>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Ayah <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('ayah', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-ayah"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Umur <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('umur_ayah', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-umur_ayah"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Pendidikan Terakhir <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('pendidikan_terakhir_ayah', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-pendidikan_terakhir_ayah"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Pekerjaan <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('pekerjaan_ayah', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-pekerjaan_ayah"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Ibu <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('ibu', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-ibu"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Umur <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('umur_ibu', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-umur_ibu"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Pendidikan Terakhir <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('pendidikan_terakhir_ibu', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-pendidikan_terakhir_ibu"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label">Pekerjaan <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('pekerjaan_ibu', '', ['class' => 'form-control']) !!}
								                    <p class="has-error text-danger error-pekerjaan_ibu"></p>
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
							        <p><span style="font-style: italic;"><b>Note: </b> Jika ada kesulitan hubungi <b style="color: red">089661900320</b></span></p>
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
<!-- start datepicker method -->
{!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.js') !!}
{!! Html::script( $pathp.'assets/general/library/bootstrap-file-input/bootstrap-file-input.js') !!}
<script type="text/javascript">
	$( function() {
		$('#tanggal_lahir').datepicker({
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
                title: response.notification,
                text: "Please check your email to activate your account.",
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