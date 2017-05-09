@extends('layout.frontend.general.layout')

@section('title', 'History')

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
					<h1>Penerimaan Santri Baru</h1>
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
							
							  <div class="panel-group" id="accordion">
							    
							    <div class="panel panel-default">
							      <div class="panel-heading">
							        <h4 class="panel-title">
							          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><b>Penerimaan Santri Baru</b></a>
							        </h4>
							      </div>
							      <div id="collapse1" class="panel-collapse collapse">
							        <div class="panel-body">
							        	<p class="justify">
							        		Penerimaan Santri Baru atau sering disingkat PSB merupakan kegiatan penerimaan santri baru Pondok Pesantren Al-Ihsan yang diadakan minimal satu tahun sekali, namun bisa disesuaikan dengan kebutuhan jika ada santri yang ingin mondok di Pondok Pesantren Al-Ihsan tidak pada tahun ajaran baru.
							        	</p>
							        	<p class="justify">
							        		Kegiatan PSB ini biasanya diadakan setelah Bimtes (Bimbingan Tes) Masuk Kampus UIN Sunan Gunung Djati Bandung.
							        	</p>
							        </div>
							      </div>
							    </div>
							    
							    <div class="panel panel-default">
							      <div class="panel-heading">
							        <h4 class="panel-title">
							          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><b>Prosedur Penerimaan Santri Baru</b></a>
							        </h4>
							      </div>
							      <div id="collapse2" class="panel-collapse collapse">
							        <div class="panel-body">
								        <p class="justify">
								        	Setelah diadakan musyawarah pengurus Pesantren Al-lhsan bersama seluruh Dewan Guru Pesantren Al-lhsan, maka ditetapakan proses penerimaan santri Pesantren Al-lhsan adalah sebagai berikut:<br>
								        	<ol class="justify">
												<li>Calon santri menemui Panitia Penerimaan Santri Baru (P2SB). kemudian mengisi lembaran kertas ekspedisi, surat permohonan dan biodata sebelum menghadap Pimpinan Pesantren Al-Ihsan, K.H. Tantan Taqiyudin, Lc.<br>Menghadap Pimpinan Pesantren Al-Ihsan untuk berdialog (psycho-test), antara lain ditanya tentang motivasi, kesungguhan, kejujuran, kemampuan dasar, akhlak, loyalitas, dedikasi, dll.</li>
												<li>Setelah mendapat ACC dari Pimpinan Pesantren atau sudah dinyatakan diterima sebagai santri antara lain dengan ditanda tanganinya blangko pengesahan pada lembaran kertas ekspedisi, calon santri kemudian menghadap kembali kepada Panitia Penerimaan Santri untuk mengisi formulir pedaftaran. Kemudian melunasi biaya administrasi masuk pesantren, antara lama.
												<ol type="a" class="justify">
													<li>
													<span style="font-style: italic;">Infaq pendaftaran, </span>dibayarkan oleh calon santri yang sudah diterima sebagai santri Pesantren Al-lhsan oleh Pimpinan Pesantren.
													</li>
													<li>
													<span style="font-style: italic;">Infaq masuk, </span>diwajibkan satu kali selama menjadi santri Pesantren Al- lhsan. Pada awalnya besar infaq bisa dimusyawarahkan langsung dengan Pimpinan Pondok Pesantren Al-Ihsan.
													</li>
													<li>
													<span style="font-style: italic;">Infaq sunah, </span>untuk membantu kemajuan dan perkembangan pesantren. Al-Ihsan senantiasa menganjurkan infaq sunat-besarnya tidak terhingga kepada para santri agar segala program dan pembangunan di Pesantren Al-Ihsan dapat berjalan lancar.
													</li>
													<li>
													<span style="font-style: italic;">Infaq untuk OSPAI, (Rp 25.000,-). </span>dibayarkan oleh calon santri yang sudah diterima sebagai santri Pesantren Al-lhsan oleh Pimpinan Pesantren.
													</li>
													<li>
													<span style="font-style: italic;">Infaq makan, </span>untuk membantu para santri agar lebih terkonsentrasi pada belajar dan agar tidak terlalu mengganggu kegiatan-kegiatan yang diselenggarakan oleh Pesantren Al-lhsan. maka Pesantren menyediakan nasi khususnya bagi santri putri.
													</li>
												</ol>
												</li>
												<li>Selain pembayaran adminitrasi di atas. santri baru juga harus menyerahkan pas photo ukuran 2X3 sebanyak 3 buah dan 3X4 sebanyak 3 buah-antara lain untuk buku induk santri, kartu anggota, RW, Desa. dan yayasan-, ijazah dan tanda pengenal, masing-masing dua rangkap.</li>
												<li>Prosedur terakhir dalam penerimaan santri baru adalah Ta.&#39;aruf santri. Kegiatan ini dimaksudkan antara lain agar setiap santri betul-betul mengenal Pesantren Al-Ihsan, keluarga besar Pesantren Al-Ihsan, masyarakat, untuk mengetahui minat dan bakat santri, dsb. Setiap santri diharuskan mengikutinya dengan serius agar tujuan ta&#39;aruf dapat tercapai, bahkan sebagian dari ta&#39;aruf itu akan diujikan pada test prestasi belajar santri baik pada tengah smester atau akhir smester.</li>
											</ol>
								        </p>
							        </div>
							      </div>
							    </div>

							    <div class="panel panel-default">
							      <div class="panel-heading">
							        <h4 class="panel-title">
							          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><b>Form Pendaftaran Santri Baru</b></a>
							        </h4>
							      </div>
							      <div id="collapse3" class="panel-collapse collapse in">
							        <div class="panel-body">
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
								                <div class="col-md-2">
								                    {!! Form::text('kode_pos', '', ['class' => 'form-control']) !!}
								                    @if ($errors->has('kode_pos'))
									                    <!-- <p class="has-error text-danger">{{ $errors->first('kode_pos') }}</p> -->
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
<!-- start datepicker method -->
<script type="text/javascript">
	$( function() {
		$('#tanggal_lahir').datepicker({
		    format: "dd-mm-yyyy",
		    forceParse: false
		});
	});
</script>
@endsection