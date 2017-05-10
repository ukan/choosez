<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>{{ env('APP_WEB_ADMIN_NAME', 'Ganteng') }} - @yield('title')</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Ganteng">
		<meta name="author" content="Ganteng">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
        {!! Html::style('assets/backend/porto-admin/vendor/simple-line-icons/css/simple-line-icons.css') !!}
        {!! Html::style('assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}
        {!! Html::style('assets/backend/porto-admin/vendor/font-awesome/css/font-awesome.css') !!}
        {!! Html::style('assets/backend/porto-admin/vendor/magnific-popup/magnific-popup.css') !!}
        {!! Html::style('assets/backend/porto-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') !!}
        {!! Html::style('assets/backend/porto-admin/vendor/jquery-ui/jquery-ui.css') !!}
        {!! Html::style('assets/backend/porto-admin/vendor/jquery-ui/jquery-ui.theme.css') !!}

        {!! Html::style('assets/backend/porto-admin/vendor/select2/css/select2.css') !!}
        {!! Html::style('assets/backend/porto-admin/vendor/select2-bootstrap-theme/select2-bootstrap.css') !!}
        {!! Html::style('assets/plugins/HoldOn/HoldOn.min.css') !!}
        <!-- {!! Html::style('assets/plugins/pace/pace.min.css') !!} -->
        {!! Html::style('assets/plugins/sweetalert/sweetalert.css') !!}

        {!! Html::style('assets/plugins/bootstrap-switch/bootstrap-switch.min.css') !!}
        {!! Html::style('assets/plugins/bootstrap-switch/bootstrap-switch.min.css') !!}
        {!! Html::style($pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.css') !!}
        
        <!-- Specific Page Vendor CSS -->
        {!! Html::style('assets/backend/porto-admin/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}
        {!! Html::style('assets/plugins/summernote/summernote.css') !!}

        {!! Html::style('assets/backend/porto-admin/stylesheets/theme.css') !!}
        {!! Html::style('assets/backend/porto-admin/stylesheets/theme-custom.css') !!}
        {!! Html::style('assets/backend/porto-admin/stylesheets/theme.css') !!}
        {!! Html::style('assets/backend/porto-admin/stylesheets/skins/default.css') !!}
        {!! Html::style('assets/plugins/croppie/demo.css') !!}
        {!! Html::style('assets/plugins/croppie/croppie.css') !!}
        

        <!-- General CSS -->
        {!! Html::style('assets/general/css/loader.css') !!}
        {!! Html::style('assets/general/library/bootstrap-file-input/bootstrap-file-input.css') !!}
        
        {!! Html::script('assets/backend/porto-admin/vendor/modernizr/modernizr.js') !!}

        <link rel="shortcut icon" type="image/png" href="{{ asset('assets/general/images/identity/logo.png')}}"/>

		@yield('css')
	</head>
	<body>
		<section class="body">

			@include('layouts.backend.partials.header')

			<div class="inner-wrapper">
				
				@include('layouts.backend.partials.sidebar')

				<section role="main" class="content-body">
					@yield('breadcrumb')

					@yield('content')
				</section>
			</div>
		</section>

		<!-- Vendor -->
        {!! Html::script('assets/backend/porto-admin/vendor/jquery/jquery.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/bootstrap/js/bootstrap.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/nanoscroller/nanoscroller.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/magnific-popup/jquery.magnific-popup.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/jquery-placeholder/jquery-placeholder.js') !!}
        {!! Html::script('assets/plugins/HoldOn/HoldOn.min.js') !!}
        <!-- {!! Html::script('assets/plugins/pace/pace.min.js') !!} -->
        {!! Html::script('assets/plugins/croppie/prism.js') !!}
        {!! Html::script('assets/plugins/sweetalert/sweetalert.min.js') !!}
        {!! Html::script('assets/plugins/tinymce/tinymce.min.js') !!}


        {!! Html::script('assets/backend/porto-admin/vendor/select2/js/select2.js') !!}
        {!! Html::script('assets/plugins/bootstrap-switch/bootstrap-switch.min.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/ios7-switch/ios7-switch.js') !!}

        {!! Html::script('assets/backend/custom/jquery.form/jquery.form.js') !!}
        {!! Html::script('assets/general/js/jquery.ajax-cross-origin.min.js') !!}

        {!! Html::script('assets/backend/porto-admin/vendor/pnotify/pnotify.custom.js') !!}        
        {!! Html::script('assets/backend/porto-admin/vendor/bootstrap-typeahead/typeahead.bundle.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') !!}

        {!! Html::script('assets/plugins/summernote/summernote.js') !!}
        
        <!-- Theme Base, Components and Settings -->
        {!! Html::script('assets/backend/porto-admin/javascripts/theme.js') !!}
        
        <!-- Theme Custom -->
        {!! Html::script('assets/backend/porto-admin/javascripts/theme.custom.js') !!}
        
        <!-- Theme Initialization Files -->
        {!! Html::script('assets/backend/porto-admin/javascripts/theme.init.js') !!}
        
        {!! Html::script('assets/general/library/bootstrap-file-input/bootstrap-file-input.js') !!}

        {!! Html::script('assets/plugins/croppie/croppie.js') !!}

        {!! Html::script('assets/plugins/croppie/exif.js') !!}

        <script type="text/javascript">
                jQuery(function ($) {
              $('.jquery-form-edit-avatar').ajaxForm({
                  success: function(response) {
                    $('#editProfileAvatar').modal('hide');
                    if(response.indexOf('success_edit_avatar') >= 0){

                      var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                      new PNotify({
                          title: "Success",
                          text: "Registration Success",
                        type: 'success',
                          addclass: "stack-custom",
                          stack: myStack
                      });
                          $.magnificPopup.close();
                      setTimeout(function(){
                         window.location.reload(1);
                      }, 2);  

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
            });

        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
                $('.loader-body').hide();
                jQuery(function ($) {
                    var loading = $('.loader-body').hide();
                    $(document)
                    .ajaxStart(function () {
                        loading.show();
                    })
                    .ajaxStop(function () {
                        loading.hide();
                    });
                }); 
        </script>

        @yield('scripts')
        @yield('partial-scripts')
	</body>
</html>