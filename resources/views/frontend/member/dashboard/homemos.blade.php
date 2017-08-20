@extends('layout.backend.admin.master.mos')

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
	{!! Form::open(['route'=>'edit-register-mos', 'files'=>true, 'class' => 'form-horizontal']) !!}
    	<input type="hidden" name="method" id="method" value="add">
    	<input type="hidden" name="id" id="id" value="{{ $data['id'] }}">
    	<input type="hidden" name="action" id="action" value="update">
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Nama Lengkap <b class="text-danger">*</b></label>
            <div class="col-md-5">
                {!! Form::text('name', $data["name"], ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) !!}
                <p class="has-error text-danger error-name"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('place') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Tempat Lahir <b class="text-danger">*</b></label>
            <div class="col-md-5">
                {!! Form::text('place', $data["place_of_birth"], ['class' => 'form-control', 'placeholder' => 'Tempat Lahir']) !!}
                <p class="has-error text-danger error-place"></p>
            </div>
        </div>
        <div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Tanggal Lahir <b class="text-danger">*</b></label>
            <div class="col-md-5">
                <input type="text" id="tanggal_lahir" name="date" value="{{ $data['date_of_birth'] }}" class="form-control" placeholder="Tanggal Lahir">
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
                {!! Form::textarea('address', $data['address'], array('class' => 'form-control')) !!}
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
                {!! Form::text('major', $data['major'], ['class' => 'form-control', 'placeholder' => 'Jurusan']) !!}
                <p class="has-error text-danger error-major"></p>
            </div>
        </div>


        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">No. Kontak <b class="text-danger">*</b></label>
            <div class="col-md-4">
                {!! Form::text('phone', $data['phone'], ['class' => 'form-control', 'placeholder' => 'No. Kontak']) !!}
                <p class="has-error text-danger error-phone"></p>
            </div>
        </div>

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Email <b class="text-danger">*</b></label>
            <div class="col-md-4">
                {!! Form::text('email', $data['email'], ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
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
                  <label><input id="taaruf" name="event[]" type="checkbox" value="Ta'aruf">Ta'aruf</label><br>
                  <label><input id="lpks" name="event[]" type="checkbox" value="LPKS">LPKS</label>
                </div>
                <p class="has-error text-danger error-event"></p>
            </div>
        </div>

        <div class="form-group area-insert-update">
            <label class="col-md-3 control-label">Bukti Pembayaran <b class="text-danger">*</b></label>
            <div class="col-md-9">
                {!! form_input_file_image('file','imageConfirm',asset($pathp.'storage/mos/'.$data["image_confirm"]),'300px','','btn-primary') !!}
                <p class="has-error text-danger error-imageConfirm"></p>
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
    $("#tshirtSize").val("{{ $data['tsirt_size'] }}");
    $("#asrama").val("{{ $data['dorm'] }}");
    
    if("{{ $data['lpks'] }}" == "Ya"){
        $("#lpks").prop('checked', true);
    }
    if("{{ $data['taaruf'] }}" == "Ya"){
        $("#taaruf").prop('checked', true);
    }

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