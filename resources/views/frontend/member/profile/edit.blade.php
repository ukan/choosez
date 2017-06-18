<style type="text/css">
    .modal-body .col-md-6 .form-group{
        margin-left: 10px;
        margin-right: 10px;
    }
.btn-custom {
  background: transparent !important;
  border: 1px solid #fff !important;
  border-radius: 3px;
  padding: 6px 12px;
  margin-top: 15px;
  color: #fff !important;
  transition:0.5s ease all;
  -moz-transition:0.5s ease all;
  -webkit-transition:0.5s ease all;
}
.btn-custom-crop{

  background: rgb(155,213,161);
  border: 1px solid #fff !important;
  border-radius: 3px;
  padding: 6px 12px;
  margin-top: 15px;
  color: #fff !important;
  transition:0.5s ease all;
  -moz-transition:0.5s ease all;
  -webkit-transition:0.5s ease all;
}
.profile-box{
  background: #0088CC;
  color: #fff;
  padding-top: 15px;
  margin-bottom: 15px;
}
.btn-custom:hover,.btn-custom-crop:hover {  
/*  background: #fff !important;
  color: #ccc !important;
  border: 1px solid #fff !important;*/
}
.modal-header{
    border-bottom: 1px solid rgb(0,126,189) !important;
}
</style>
<div class="modal fade modal-getstart" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="" role="document" style="max-width:1027px;margin:10px auto">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
        </div>
        <div class="modal-body" style="padding-top:0px">

        {!! Form::open($form) !!}     
        <div class="row profile-box">    
            <input type="hidden" name="id" value="{{ user_info('id') }}">        
            <div class="col-md-4"></div>
            <div class="col-md-4">                
                <div style="text-align: center;" class="form-group">
                    <div class="col-md-12">
                        <?php
                            $url = "";
                            if(!empty(user_info('image'))){
                                $url = asset($pathp.'storage/student/'.user_info('image'));
                            }
                            else{
                                $url = asset($pathp.'assets/avatar.png');
                            }
                        ?>
                        {!! form_input_file_image('file','image',$url,'300px','','btn-default') !!}
                        <p class="has-error text-danger error-image"></p>
                    </div>
                </div>    
            </div>
        </div>    
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div>
                        {!! Form::text('nama', user_info('username'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-nama"></p>
                    </div>
                </div>
            </div>        
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Panggilan <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('nama_panggilan', user_info('first_name'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-nama_panggilan"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tempat Lahir <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('tempat_lahir', user_info('place_of_birth'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-tempat_lahir"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal Lahir <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('tanggal_lahir', user_info('date_of_birth'), ['class' => 'form-control datepicker-birthday']) !!}
                        <p class="has-error text-danger edit-profile-tanggal_lahir"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenis Kelamin <b class="text-danger">*</b></label>
                    <div>
                        <div class="radio-inline">
                            <input id="radioExample1" name="jenis_kelamin" type="radio" value="Laki - laki">
                            <label for="radioExample1">Laki - laki</label>
                        </div>
                        <div class="radio-inline">
                            <input id="radioExample1" name="jenis_kelamin" type="radio" value="Perempuan">
                            <label for="radioExample1">Perempuan</label>
                        </div>
                        <p class="has-error text-danger edit-profile-jenis_kelamin"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('email', user_info('email'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-email"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('telepon', user_info('phone'), ['class' => 'form-control','maxlength' => 13 ]) !!}
                        <p class="has-error text-danger edit-profile-telepon"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kode Pos <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('kode_pos', user_info('postal_code'), ['class' => 'form-control','maxlength' => 5 ]) !!}
                        <p class="has-error text-danger edit-profile-kode_pos"></p>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label>Province <b class="text-danger">*</b></label>
                    <div>
                        <select name="province" id="province_id" onchange="ajaxdistrict(this.value)" data-plugin-selectTwo class="form-control populate" style="width:100%">
                            
                            <option value="">Choice Province</option>                       
                            {{ user_info('select_province') }}  
                        </select>
                        <p class="has-error text-danger edit-profile-province"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label>City / District <b class="text-danger">*</b></label>
                    <div>
                        <select name="city" id="district_id" onchange="ajaxsubdistrict(this.value)" data-plugin-selectTwo class="full-width" style="width:100%" >
                            <option value="">Choice City / District</option>                                
                            {{ user_info('select_city') }}  
                        </select>
                        <p class="has-error text-danger edit-profile-city"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label>Sub District <b class="text-danger">*</b></label>
                    <div>
                       <select name="district" id="sub_district_id" onchange="ajaxvillage(this.value)" data-plugin-selectTwo class="full-width" style="width:100%">
                            <option value="">Choice Sub District</option>                                   
                            {{ user_info('select_district') }}                  
                        </select>
                        <p class="has-error text-danger edit-profile-district"></p>
                    </div>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>SD/MI <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('sd', user_info('sd'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-sd"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tahun Lulus <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('tahun_lulus_sd', user_info('sd_th'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-tahun_lulus_sd"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>SMP/M.Ts <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('smp', user_info('sltp'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-smp"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tahun Lulus <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('tahun_lulus_smp', user_info('sltp_th'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-tahun_lulus_smp"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>SMA/MA/SMK <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('sma', user_info('slta'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-sma"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tahun Lulus <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('tahun_lulus_sma', user_info('slta_th'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-tahun_lulus_sma"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Univ/Institut <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('universitas', user_info('university'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-universitas"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenjang <b class="text-danger">*</b></label>
                    <div>
                        <select name="jenjang" id="jenjang" class="select2" data-plugin-selectTwo class="form-control populate" style="width:100%">
                            <option value="Pilih Jenjang Pendidikan">Pilih Jenjang Pendidikan</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                        <p class="has-error text-danger edit-profile-jenjang"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fakultas <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('fakultas', user_info('faculty'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-fakultas"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jurusan <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('jurusan', user_info('major'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-jurusan"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Semester <b class="text-danger">*</b></label>
                    <div>
                        {!! Form::text('semester', user_info('semester'), ['class' => 'form-control']) !!}
                        <p class="has-error text-danger edit-profile-semester"></p>
                    </div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="col-md-6">
                
            </div>
                <div class="form-group">
                    <center>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary', 'title' => 'Save']) !!}&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default modal-dismiss" type="button" data-dismiss="modal" aria-label="Close" styl>Cancel</button>
                    </center>
                </div>
            {!! Form::close() !!}
        </div>

      </div>
    </div>
  </div>