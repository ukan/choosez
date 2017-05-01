@extends('layout.backend.admin.master.master')

@section('title', 'Profile Completion')

@section('page-header', 'Profile Completion')

@section('breadcrumb')
	<ol class="breadcrumbs">
	  <li>
	      <a href="{!! action('Frontend\Member\DashboardController@index') !!}">
	          <i class="fa fa-home"></i> Home
	      </a>
	  </li>
	  <li><a href="{!! action('Frontend\Member\ProfileController@index') !!}">Profile</a></li>
	  <li><span>Profile Completion</span></li>
	</ol>
@endsection
@section('content')

@endsection

@section('header')
<style>

.pricing-table .most-popular {
	border-color: #0088cc;
}

.pricing-table .most-popular h3 {
	background-color: #0088cc !important;
}

.pricing-table.princig-table-flat .plan h3 {
	background-color: #0088cc;
}

.pricing-table.princig-table-flat .plan h3 span {
	background: #0088cc;
}
</style>
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}
    <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
@endsection
@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('assets/plugins/bootstrap-validator/bootstrap-validator.js') !!}
    {!! Html::script('assets/general/library/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('assets/general/library/tableExport.jquery.plugin/tableExport.js') !!}
    {!! Html::script('assets/general/library/tableExport.jquery.plugin/jquery.base64.js') !!}

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>


<script>
	$('.jquery-form-edit-profile-completion').ajaxForm({
	    success: function(response) {
	    	if(response.indexOf('fill_otp_code_mode') >= 0){
		      		$('#modal-with-form-otp').modal('show');
		      		$('#editBankAccount').modal('hide');
		      		$('#editCloseAccount').modal('hide');
					var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
						new PNotify({
						    title: "Success",
						    text: "Open Your Email For Get Otp Code",
							type: 'success',
						    addclass: "stack-custom",
						    stack: myStack
						});

	    	}else{
		      	if(response.indexOf('success_edit_bank_account') >= 0){
					$('.errorsMessageOtpCode').html('');
					$('.errorsMessageEditBankAccount').html('');
					$('.alert-sending-otp').html('');
		      		$('#modal-with-form-otp').modal('show');
		      		$('#editBankAccount').modal('hide');
				}else if(response.indexOf('success_close_account') >= 0){
					$('.errorsMessageOtpCode').html('');
					$('.errorsMessageCloseAccount').html('');
					$('.alert-sending-otp').html('');
		      		$('#modal-with-form-otp').modal('show');
		      		$('#editCloseAccount').modal('hide');
				}else if(response.indexOf('success_otp_code') >= 0){
					if(response.indexOf('success_otp_code_close_account') >= 0){
						var text_success = "Your Account Will Bee Closed, Wait Approval From Admin";
					}else if(response.indexOf('success_otp_code_edit_bank_account') >= 0){
						var text_success = "Bank Account Has Been Changed";
					}
					var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
						new PNotify({
						    title: "Success",
						    text: text_success,
							type: 'success',
						    addclass: "stack-custom",
						    stack: myStack
						});
		       		$('#modal-with-form-otp').modal('hide');
					setTimeout(function(){
					   window.location.reload(1);
					}, 1500);
						$('.errorsMessageOtpCode').html('');
						$('.errorsMessageEditBankAccount').html('');
						$('.alert-sending-otp').html('');

				}else{

					if(response.indexOf('error_otp') >= 0){
						$('.errorsMessageOtpCode').html(response);
					}else{
						$('.errorsMessageEditBankAccount').html(response);
					}
				}
			}

	    },
		beforeSend: function() {
		  $('.has-error').html('');
		},
		error: function(response){
		  if (response.status === 422) {
		      var data = response.responseJSON;
		      $.each(data,function(key,val){
		          $('.'+key).html(val);
		      });
		  } else {
		      $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
		  }
		}
	});

</script>

<script type="text/javascript">
$(".select-bank").val("{{ user_info('bank') }}");
$(".select-bank").select2({
            templateResult: formatState,
            templateSelection: formatState
        });
        function formatState (opt) {
            if (!opt.id) {
                return opt.text;
            }
            var optimage = $(opt.element).data('image');
            if(!optimage){
                return opt.text;
            } else {
                var $opt = $(
                    '<span><img src="' + optimage + '" width="23px" /> ' + opt.text + '</span>'
                );
                return $opt;
            }

        };
</script>
@endsection
