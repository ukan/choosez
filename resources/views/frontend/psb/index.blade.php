@extends('layout.frontend.general.layout')

@section('title', 'PSB')

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
<link rel="stylesheet" href="{!! asset($pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') !!}">
@endsection

@section('content')
<div role="main" class="main">

	<section class="page-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ route('home') }}">@lang('general.menu.home')</a></li>
						<li class="active">@lang('general.menu.psb')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.psb_detail')</h1>
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
							<h2>Form pendaftaran Santri Baru</h2>
							<div class="post-meta">
								<hr>
							</div>
							{!! Form::open(['route'=>'post-data-psb', 'files'=>true, 'class' => 'form-horizontal']) !!}
				            	<input type="hidden" name="method" id="method" value="add">       
					            <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">Nama Lengkap <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('nama', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('nama'))
						                    <p class="has-error text-danger">{{ $errors->first('nama') }}</p>
						                @endif
					                </div>
					            </div>
					            <div class="form-group {{ $errors->has('nama_panggilan') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">Nama Panggilan <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('nama_panggilan', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('nama_panggilan'))
						                    <p class="has-error text-danger">{{ $errors->first('nama_panggilan') }}</p>
						                @endif
					                </div>
					            </div>
					            <div class="form-group {{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">Tempat Lahir <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('tempat_lahir', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('tempat_lahir'))
						                    <p class="has-error text-danger">{{ $errors->first('tempat_lahir') }}</p>
						                @endif
					                </div>
					            </div>
					            <div class="form-group {{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">Tanggal Lahir <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control">
					                    @if ($errors->has('tanggal_lahir'))
						                    <p class="has-error text-danger">{{ $errors->first('tanggal_lahir') }}</p>
						                @endif
					                </div>
					            </div>
					            <div class="form-group {{ $errors->has('alamat') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">Alamat <b class="text-danger">*</b></label>
					                <div class="col-lg-5">
				                        {!! Form::textarea('alamat', null, array('class' => 'form-control')) !!}
				                        @if ($errors->has('alamat'))
						                    <p class="has-error text-danger">{{ $errors->first('alamat') }}</p>
						                @endif
				                    </div>
					            </div>

					            <div class="form-group {{ $errors->has('provinsi') ? ' has-error' : '' }}">
				                    <label class="col-md-3 control-label">Provinsi <b class="text-danger">*</b></label>
				                    <div class="col-md-5">
				                        <select name="provinsi" id="province_id" class="select2" onchange="ajaxdistrict(this.value)" data-plugin-selectTwo class="form-control populate" style="width:100%">
				                            <option value="">Pilih Provinsi</option>                       
				                            {{ user_info('select_province') }}  
				                        </select>
				                        @if ($errors->has('provinsi'))
						                    <p class="has-error text-danger">{{ $errors->first('provinsi') }}</p>
						                @endif
				                    </div>
				                </div>
				                <div class="form-group {{ $errors->has('kota') ? ' has-error' : '' }}">
				                    <label class="col-md-3 control-label">Kabupaten/Kota <b class="text-danger">*</b></label>
				                    <div class="col-md-5">
				                        <select name="kota" id="district_id" class="select2" onchange="ajaxsubdistrict(this.value)" data-plugin-selectTwo class="full-width" style="width:100%" >
				                            <option value="">Pilih Kabupaten/Kota</option>                                
				                            {{ user_info('select_city') }}  
				                        </select>
				                        @if ($errors->has('kota'))
						                    <p class="has-error text-danger">{{ $errors->first('kota') }}</p>
						                @endif
				                    </div>
				                </div>
				                <div class="form-group {{ $errors->has('kecamatan') ? ' has-error' : '' }}">
				                    <label class="col-md-3 control-label">Kecamatan <b class="text-danger">*</b></label>
				                    <div class="col-md-5">
				                       <select name="kecamatan" id="sub_district_id" class="select2" onchange="ajaxvillage(this.value)" data-plugin-selectTwo class="full-width" style="width:100%">
				                            <option value="">Pilih kecamatan</option>                                   
				                            {{ user_info('select_district') }}                  
				                        </select>
				                        @if ($errors->has('kecamatan'))
						                    <p class="has-error text-danger">{{ $errors->first('kecamatan') }}</p>
						                @endif
				                    </div>
				                </div>

				                <div class="form-group {{ $errors->has('desa') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">Desa <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('desa', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('desa'))
						                    <p class="has-error text-danger">{{ $errors->first('desa') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group {{ $errors->has('rt') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">RT <b class="text-danger">*</b></label>
					                <div style="width: 75px" class="col-sm-1">
				                        {!! Form::text('rt', '', ['class' => 'form-control']) !!}
				                        @if ($errors->has('rt'))
						                    <p class="has-error text-danger">{{ $errors->first('rt') }}</p>
						                @endif
				                    </div>
					            </div>
					            <div class="form-group {{ $errors->has('rw') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">RW <b class="text-danger">*</b></label>
					                <div style="width: 75px" class="col-lg-1">
				                        {!! Form::text('rw', '', ['class' => 'form-control']) !!}
				                        @if ($errors->has('rw'))
						                    <p class="has-error text-danger">{{ $errors->first('rw') }}</p>
						                @endif
				                    </div>
					            </div>

					            <div class="form-group {{ $errors->has('kode_pos') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">Kode Pos <b class="text-danger">*</b></label>
					                <div class="col-md-2">
					                    {!! Form::text('kode_pos', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('kode_pos'))
						                    <p class="has-error text-danger">{{ $errors->first('kode_pos') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group {{ $errors->has('telepon') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">Telepon <b class="text-danger">*</b></label>
					                <div class="col-md-4">
					                    {!! Form::text('telepon', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('telepon'))
						                    <p class="has-error text-danger">{{ $errors->first('telepon') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
					                <label class="col-md-3 control-label">Email <b class="text-danger">*</b></label>
					                <div class="col-md-4">
					                    {!! Form::text('email', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('email'))
						                    <p class="has-error text-danger">{{ $errors->first('email') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-4 control-label"><strong>Pengalaman Pendidikan</strong></label>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">SD/MI <b class="text-danger">*</b></label>
					                <div class="col-md-3">
					                    {!! Form::text('sd', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('sd'))
						                    <p class="has-error text-danger">{{ $errors->first('sd') }}</p>
						                @endif
					                </div>
					                <label class="col-md-3 control-label">Tahun Lulus <b class="text-danger">*</b></label>
					                <div class="col-md-3">
					                    {!! Form::text('tahun_lulus_sd', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('tahun_lulus_sd'))
						                    <p class="has-error text-danger">{{ $errors->first('tahun_lulus_sd') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">SMP/M.Ts <b class="text-danger">*</b></label>
					                <div class="col-md-3">
					                    {!! Form::text('smp', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('smp'))
						                    <p class="has-error text-danger">{{ $errors->first('smp') }}</p>
						                @endif
					                </div>
					                <label class="col-md-3 control-label">Tahun Lulus <b class="text-danger">*</b></label>
					                <div class="col-md-3">
					                    {!! Form::text('tahun_lulus_smp', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('tahun_lulus_smp'))
						                    <p class="has-error text-danger">{{ $errors->first('tahun_lulus_smp') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">SMA/MA/SMK <b class="text-danger">*</b></label>
					                <div class="col-md-3">
					                    {!! Form::text('sma', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('sma'))
						                    <p class="has-error text-danger">{{ $errors->first('sma') }}</p>
						                @endif
					                </div>
					                <label class="col-md-3 control-label">Tahun Lulus <b class="text-danger">*</b></label>
					                <div class="col-md-3">
					                    {!! Form::text('tahun_lulus_sma', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('tahun_lulus_sma'))
						                    <p class="has-error text-danger">{{ $errors->first('tahun_lulus_sma') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">Pondok Pesantren </label>
					                <div class="col-lg-5">
				                        {!! Form::textarea('ponpes', null, array('class' => 'form-control')) !!}
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
					                    @if ($errors->has('ayah'))
						                    <p class="has-error text-danger">{{ $errors->first('ayah') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">Umur <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('umur_ayah', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('umur_ayah'))
						                    <p class="has-error text-danger">{{ $errors->first('umur_ayah') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">Pendidikan Terakhir <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('pendidikan_terakhir_ayah', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('pendidikan_terakhir_ayah'))
						                    <p class="has-error text-danger">{{ $errors->first('pendidikan_terakhir_ayah') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">Pekerjaan <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('pekerjaan_ayah', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('pekerjaan_ayah'))
						                    <p class="has-error text-danger">{{ $errors->first('pekerjaan_ayah') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">Ibu <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('ibu', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('ibu'))
						                    <p class="has-error text-danger">{{ $errors->first('ibu') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">Umur <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('umur_ibu', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('umur_ibu'))
						                    <p class="has-error text-danger">{{ $errors->first('umur_ibu') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">Pendidikan Terakhir <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('pendidikan_terakhir_ibu', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('pendidikan_terakhir_ibu'))
						                    <p class="has-error text-danger">{{ $errors->first('pendidikan_terakhir_ibu') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label">Pekerjaan <b class="text-danger">*</b></label>
					                <div class="col-md-5">
					                    {!! Form::text('pekerjaan_ibu', '', ['class' => 'form-control']) !!}
					                    @if ($errors->has('pekerjaan_ibu'))
						                    <p class="has-error text-danger">{{ $errors->first('pekerjaan_ibu') }}</p>
						                @endif
					                </div>
					            </div>

					            <div class="form-group area-insert-update">
					                <label class="col-md-3 control-label"></label>
					                <div class="col-md-5">
					                    {!! Form::submit('Kirim', ['class' => 'btn btn-primary btn-submit', 'title' => 'Kirim']) !!}
					                </div>
					            </div>
					        </form>

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
<!-- start datepicker method -->
<script type="text/javascript">
	$( function() {
		$('#tanggal_lahir').datepicker({
		    format: "dd-mm-yyyy",
		    forceParse: false
		});
	});
</script>
<script type="text/javascript">
	/*start ajaxForm for notification insert-update-delete*/
    $('.jquery-form-edit').ajaxForm({
    	dataType : "json",

		success: function(response) {

		    if(response.status == 'success'){
		    	var title_not = 'Notification';
		      	var type_not = 'success';

		    }else{
		    	var title_not = 'Notification';
		      	var type_not = 'failed';
		    }
			var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
			new PNotify({
				title: title_not,
				text: response.notification,
				type: type_not,
				addclass: "stack-custom",
				stack: myStack
			});

			location.href = '{{ route("get-page-psb") }}';
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
				var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
				new PNotify({
					title: "Failed",
					text: "Validate Error, Check Your Data Again",
					type: 'danger',
					addclass: "stack-custom",
					stack: myStack
				});
	            $("#modalFormMemberEdit").scrollTop(0);
	            $("#modalFormNewMember").scrollTop(0);
			  } else {
			      $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
			  }
		}
	});
</script>
<!-- end datepicker method -->
@endsection
