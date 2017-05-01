
<style type="text/css">
.editProfileAvatar{
cursor: pointer;
}
</style>
<section class="panel panel-group">
	<header class="panel-heading bg-primary">

		<div class="widget-profile-info">
			<div class="profile-picture editProfileAvatar">
				<a data-toggle="modal" data-target="#editProfileAvatar" >
				<img src="{{ user_info('avatar_path') }}" style="width:100px;height:100px">
				</a>
			</div>
			<div class="profile-info">
				<h4 class="name text-weight-semibold">{{ user_info('full_name') }}</h4>
				<h5 class="role">Scoido : {{ user_info('plan') }}</h5>
				<h5 class="role">Member ID : {{ user_info('member_id') }} <i class="fa fa-question-circle" rel="tooltip" title="Dapat Anda gunakan untuk mempromosikan halaman affiliate Anda (scoido.com/{{ user_info('member_id') }}) dan dapatkan komisi bulanan untuk setiap customer yang mendaftar"></i></h5>
				
			</div>
		</div>

	</header>

	<div id="accordion">
		<div class="panel panel-accordion panel-accordion-first">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a>
						<i class="fa fa-user"></i> Profile
					</a>
				</h4>
			</div>
		</div>
	</div>
</section>

 <!-- modal register -->
  <div class="modal fade modal-getstart" id="editProfileAvatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Avatar</h4>
        </div>
        <div class="modal-body">
				<div class="demo-wrap upload-demo">
                    <div class="container">
                        <div class="grid">
                            <div class="col-1-2">
                                <strong>Upload Your Avatar</strong>
                                
                                    
                                <div class="actions">
                                    <a class="btn file-btn">
                                        <span class="btn btn-primary">Upload</span>
                                        <input type="file" id="upload-input" value="Choose a file" accept="image/*" />
                                    </a>
                                    <button id="upload-result" class="upload-result btn btn-success"><i class="fa fa-check"></i> Crop</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="box-peview">
                            <div class="upload-msg">
                                Upload a file to start cropping
                            </div>
                            <div id="upload-demo"></div>
                            <div id="peview-avatar" style="display: none;"></div>
                            {!! Form::open(['url' => route('profile-upload-crop-avatar')]) !!}
                                <input type="hidden" name="image_base64" id="image_base64" value=""></input>
                                <input type="hidden" name="filename" id="image_filename" value=""></input>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="btn-upload" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
{!! Form::close() !!}
@section('partial-scripts')
    <script type="text/javascript">
    $('button[name="btn-upload"]').prop('disabled', true);
    $('#upload-result').click(function() {
        $('button[name="btn-upload"]').prop('disabled', false);
    });
    $('#upload-input').on('change', function(){ $('button[name="btn-upload"]').prop('disabled', true); });

        // function readURL(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();

        //         reader.onload = function (e) {
        //             // $('#img').attr('src', e.target.result);
        //             $('div#upload-demo').html('');
        //             $('div#upload-demo').html('<img src="'+e.target.result+'" id="target" style="width: 200px; height: 200px">');
                    
        //             $('div.preview-container').attr('src', '');
        //             $('div.preview-container img').attr('src', e.target.result);
        //         }

        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }


    </script>
    
    @include('backend.member.profile.js.script-crop')
<script type="text/javascript">
    $(document).ready(function() {
        photoUpload();
        photoUploadEdit();
    });
</script>
@endsection