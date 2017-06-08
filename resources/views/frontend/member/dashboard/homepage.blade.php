@extends('layout.backend.admin.master.bimtes')

@section('title', 'Dashboard')

@section('page-header', 'Dashboard')

@section('header')
<script type="text/javascript">
	function removeHiddenClass(){
	  $("#imageLoadingClass").removeClass('hidden');
	}
</script>
<style type="text/css">
    .styleLoad{
        height: 50px;
        width: 50px;
    }
</style>
@endsection

@section('breadcrumb')
	<ol class="breadcrumbs">
	  <li>
	      <a href="#">
	          <i class="fa fa-home"></i> Home
	      </a>
	  </li>
	  <li><span>Dashboard</span></li>
	</ol>
@endsection

@section('content')
<section class="content">
	{!! Form::open(['route'=>'edit-register-bimtes', 'files'=>true, 'class' => 'form-horizontal']) !!}
    	<input type="hidden" name="method" id="method" value="add">
    	<input type="hidden" name="id" id="id" value="{{ $data['id'] }}">
    	<input type="hidden" name="action" id="action" value="update">
    	<div class="form-group area-insert-update">
            <label class="col-md-3 control-label">Photo</label>
            <div class="col-md-9">
                <?php
                    $url = "";
                    if(!empty($data["photo"])){
                        $url = asset($pathp.'storage/bimtes/photo/'.$data["photo"]);
                    }
                    else{
                        $url = asset($pathp.'assets/avatar.png');
                    }
                ?>
                {!! form_input_file_image('file','image',$url,'200px','200px') !!}
                <p class="has-error text-danger error-image"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Nama Lengkap <b class="text-danger">*</b></label>
            <div class="col-md-5">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="{{ $data['name'] }}">
                <p class="has-error text-danger error-nama"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Tempat Lahir <b class="text-danger">*</b></label>
            <div class="col-md-5">
                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ $data['place_of_birth'] }}">
                <p class="has-error text-danger error-tempat_lahir"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Tanggal Lahir <b class="text-danger">*</b></label>
            <div class="col-md-5">
                <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" value="{{ $data['date_of_birth'] }}">
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
                {!! Form::textarea('alamat', $data["address"], array('class' => 'form-control')) !!}
                <p class="has-error text-danger error-alamat"></p>
            </div>
        </div>

        <div class="form-group area-insert-update">
            <label class="col-md-3 control-label">Sekolah Asal<b class="text-danger">*</b></label>
            <div class="col-md-4">
                {!! Form::text('sekolah_asal', $data["slta"], ['class' => 'form-control', 'placeholder' => 'Sekolah Asal']) !!}
                <p class="has-error text-danger error-sekolah_asal"></p>
            </div>
            <label class="col-md-2 control-label">Tahun Lulus <b class="text-danger">*</b></label>
            <div class="col-md-3">
                {!! Form::text('tahun_lulus', $data["slta_th"], ['class' => 'form-control', 'placeholder' => 'Tahun Lulus']) !!}
                <p class="has-error text-danger error-tahun_lulus"></p>
            </div>
        </div>

        <div class="form-group {{ $errors->has('no_kontak') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">No. Kontak <b class="text-danger">*</b></label>
            <div class="col-md-4">
                {!! Form::text('no_kontak', $data["phone"], ['class' => 'form-control', 'placeholder' => 'No. Kontak']) !!}
                <p class="has-error text-danger error-no_kontak"></p>
            </div>
        </div>

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Email <b class="text-danger">*</b></label>
            <div class="col-md-4">
                {!! Form::text('email', $data["email"], ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
                <p class="has-error text-danger error-email"></p>
            </div>
        </div>

        <div class="form-group {{ $errors->has('no_tes') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">No. Tes </label>
            <div class="col-md-4">
                {!! Form::text('no_tes', $data["test_number"], ['class' => 'form-control', 'placeholder' => 'No. Tes']) !!}
                <p class="has-error text-danger error-no_tes"></p>
            </div>
        </div>

        <div class="form-group {{ $errors->has('tanggal_tes') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Tanggal Tes </label>
            <div class="col-md-4">
                <input type="text" id="tanggal_tes" name="tanggal_tes" class="form-control" placeholder="Tanggal Tes" value="{{ $data['test_day'] }}">
                <p class="has-error text-danger error-tanggal_tes"></p>
            </div>
        </div>

        <div class="form-group {{ $errors->has('pilihan_jurusan') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Pilihan Jurusan <b class="text-danger">*</b></label>
            <div class="col-md-4">
                {!! Form::text('pilihan_jurusan', $data["major1"], ['class' => 'form-control', 'placeholder' => 'Jurusan 1']) !!}
                <p class="has-error text-danger error-pilihan_jurusan"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('pilihan_jurusan2') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-4">
                {!! Form::text('pilihan_jurusan2', $data["major2"], ['class' => 'form-control', 'placeholder' => 'Jurusan 2']) !!}
                <p class="has-error text-danger error-pilihan_jurusan2"></p>
            </div>
        </div>

        <div class="form-group area-insert-update">
            <label class="col-md-3 control-label">Bukti Pembayaran <b class="text-danger">*</b></label>
            <div class="col-md-9">
                {!! form_input_file_image('file','bukti_pembayaran',asset($pathp.'storage/bimtes/bukti/'.$data["image_confirm"]),'300px','300px') !!}
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
</section>
@endsection

@section('scripts')

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

	$("#jenis_kelamin").val("{{ $data['gender'] }}");
	$("[name='bukti_pembayaran']]").val("{{ $data['gender'] }}");

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