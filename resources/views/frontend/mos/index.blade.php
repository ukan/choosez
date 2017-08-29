@extends('layout.frontend.general.layout')

@section('title', "Ta'aruf Register")

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
						<li class="active">@lang('general.menu.mos')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.mos')</h1>
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
							          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><b>Form Pendaftaran Ta'aruf dan LPKS Online</b></a>
							        </h4>
							      </div>
							      <div id="collapse3" class="panel-collapse collapse in">
							        <div class="panel-body">
							        	{!! Form::open(['route'=>'post-register-mos', 'files'=>true, 'class' => 'form-horizontal jquery-form-data']) !!}
							            	<input type="hidden" name="method" id="method" value="add">
							            	<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Nama Lengkap <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) !!}
								                    @if ($errors->has('name'))
									                    <p class="has-error text-danger">{{ $errors->first('name') }}</p>
									                @endif
								                </div>
								            </div>
								            <div class="form-group {{ $errors->has('place') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Tempat Lahir <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    {!! Form::text('place', '', ['class' => 'form-control', 'placeholder' => 'Tempat Lahir']) !!}
								                    <p class="has-error text-danger error-place"></p>
								                </div>
								            </div>
								            <div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Tanggal Lahir <b class="text-danger">*</b></label>
								                <div class="col-md-5">
								                    <input type="text" id="tanggal_lahir" name="date" class="form-control" placeholder="Tanggal Lahir">
								                    <p class="has-error text-danger error-date"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
							                    <label class="col-md-3 control-label">Jenis Kelamin <b class="text-danger">*</b></label>
							                    <div class="col-md-5">
							                        <select name="gender" id="jenis_kelamin" class="select2" data-plugin-selectTwo class="form-control populate" style="width:100%">
							                            <option value="Pilih Jenis Kelamin">Pilih Jenis Kelamin</option>
							                            <option value="Laki - laki">Laki - laki</option>
							                            <option value="Perempuan">Perempuan</option>
							                        </select>
							                        <p class="has-error text-danger error-gender"></p>
							                    </div>
							                </div>

								            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Alamat <b class="text-danger">*</b></label>
								                <div class="col-lg-5">
							                        {!! Form::textarea('address', null, array('class' => 'form-control')) !!}
							                        <p class="has-error text-danger error-address"></p>
							                    </div>
								            </div>

								            <div class="form-group {{ $errors->has('asrama') ? ' has-error' : '' }}">
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
							                        <p class="has-error text-danger error-kamar"></p>
							                    </div>
								            </div>

								            <div class="form-group {{ $errors->has('major') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Jurusan <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('major', '', ['class' => 'form-control', 'placeholder' => 'Jurusan']) !!}
								                    <p class="has-error text-danger error-major"></p>
								                </div>
								            </div>


								            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">No. Kontak <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'No. Kontak']) !!}
								                    <p class="has-error text-danger error-phone"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Email <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
								                    <p class="has-error text-danger error-email"></p>
								                </div>
								            </div>

								            <div class="form-group {{ $errors->has('tshirtSize') ? ' has-error' : '' }}">
							                    <label class="col-md-3 control-label">Ukuran Kaos <b class="text-danger">*</b></label>
							                    <div class="col-md-5">
							                        <select name="tshirtSize" id="tshirtSize" class="select2" data-plugin-selectTwo class="form-control populate" style="width:100%">
							                            <option value="Pilih Ukuran Kaos">Pilih Ukuran Kaos</option>
							                            <option value="S">S</option>
							                            <option value="M">M</option>
							                            <option value="L">L</option>
							                            <option value="XL">XL</option>
							                            <option value="XXL">XXL</option>
							                        </select>
							                        <p class="has-error text-danger error-tshirtSize"></p>
							                    </div>
							                </div>

							                <div class="form-group {{ $errors->has('event') ? ' has-error' : '' }}">
								                <label class="col-md-3 control-label">Jenis Kegiatan <b class="text-danger">*</b></label>
								                <div class="col-md-4">
								                    <div class="checkbox">
													  <label><input name="event[]" type="checkbox" value="Ta'aruf">Ta'aruf</label><br>
													  <label><input name="event[]" type="checkbox" value="LPKS">LPKS</label>
													</div>
								                    <p class="has-error text-danger error-event"></p>
								                </div>
								            </div>

								            <div class="form-group area-insert-update">
							                    <label class="col-md-3 control-label">Bukti Pembayaran <b class="text-danger">*</b></label>
							                    <div class="col-md-9">
							                        {!! form_input_file_image('file','imageConfirm','','250px','','btn-primary') !!}
							                        <p class="has-error text-danger error-imageConfirm"></p>
							                    </div>
							                </div>

								            <div class="form-group area-insert-update">
								                <label class="col-md-3 control-label"></label>
								                <div class="col-md-5">
								                    <button type="submit" id="btnSubmit" onclick="removeHiddenClass()" title="Kirim" class="btn btn-primary btn-submit">Kirim</button>
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
			<div class="col-md-3">
				<aside class="sidebar">
					<div class="box effect1">
						<a href="{{ asset($pathp.'assets/pamfletmos.jpeg') }}">
							<img class="img-responsive" src="{{ asset($pathp.'assets/pamfletmos.jpeg') }}" alt="pamflet">
						</a>
					</div>
					<hr>
				</aside>
			</div>
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

                document.getElementById("btnSubmit").disabled = true;
            }else{
                var title_not = 'Notification';
                var type_not = 'failed';
            }
            $("[name='name']").val('');
            $("[name='place']").val('');
            $("[name='date']").val('');
            $("[name='gender']").val('Pilih Jenis Kelamin');
            $("[name='address']").val('');
            $("[name='asrama']").val('Pilih Asrama');
            $("[name='kamar']").val('');
            $("[name='major']").val('');
            $("[name='phone']").val('');
            $("[name='email']").val('');
            $("[name='tshirtSize']").val('');
            $("[name='imageConfirm']").val('');

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
@endsection