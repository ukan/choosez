<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<title>Al Ihsan Website</title>
		<meta name="keywords" content="HTML5" />
		<meta name="description" content="Website Pondok Pesantren Al - Ihsan Cibiru Hilir Kabupaten Bandung">
		<meta name="author" content="Pondok Pesantren Al - Ihsan">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/vendor/bootstrap/bootstrap.css') !!}">

		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/vendor/fontawesome/css/font-awesome.css') !!}">
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/vendor/owlcarousel/owl.carousel.min.css') !!}">
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/vendor/owlcarousel/owl.theme.default.min.css') !!}">
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/vendor/magnific-popup/magnific-popup.css') !!}">


		<!-- bootstrap select style -->
		<link rel="stylesheet" href="{!! asset($pathp.'assets/general/select/css/bootstrap-select.css') !!}">
		<link rel="stylesheet" href="{!! asset($pathp.'assets/general/select/css/bootstrap-select.min.css') !!}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/theme-elements.css') !!}">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/skins/default.css') !!}">
		{!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}
		{!! Html::style($pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.css') !!}
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/theme.css') !!}">
		
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/theme-blog.css') !!}">
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/theme-animate.css') !!}">
		
		<link rel="stylesheet" href="{!! asset($pathp.'assets/backend/porto-admin/vendor/hover/hover.css') !!}">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/vendor/rs-plugin/css/settings.css') !!}">
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/vendor/circle-flip-slideshow/css/component.css') !!}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/custom.css') !!}">
		<link rel="stylesheet" href="{!! asset($pathp.'assets/backend/porto-admin/vendor/select2/css/select2.css') !!}">
		<link rel="stylesheet" href="{!! asset($pathp.'assets/backend/porto-admin/vendor/select2-bootstrap-theme/select2-bootstrap.css') !!}">
		
		{!! Html::script( $pathp.'assets/backend/porto-admin/vendor/modernizr/modernizr.js') !!}
		<!-- Head Libs -->
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/modernizr/modernizr.js') !!}"></script>
		<style type="text/css">
			.img-flag{width: 20px;height: 20px;}
			body { background-image: url({{ asset($pathp.'assets/general/images/default/back_body.jpg') }}); }
			.back-content{background: #fff; padding : 15px 40px 15px 40px;}
			#demo{
				text-align: center;
  				color: blue;
  				font-family: 'Raleway',sans-serif; font-size: 30px; font-weight: 800;
			    text-shadow: 1px 1px 1px #ccc;
			    /*font-size: 1.5em;*/
			}
		</style>
		<script type="text/javascript">
			function cek(){
				$("#myModal").modal('show');
			}
		</script>
		<script>
			// Set the date we're counting down to
			var countDownDate = new Date("Apr 17, 2017 06:00:00").getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

			    // Get todays date and time
			    var now = new Date().getTime();
			    
			    // Find the distance between now an the count down date
			    var distance = countDownDate - now;
			    
			    // Time calculations for days, hours, minutes and seconds
			    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			    
			    // Output the result in an element with id="demo"
			    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
			    + minutes + "m " + seconds + "s ";
			    
			    // If the count down is over, write some text 
			    if (distance < 0) {
			        clearInterval(x);
			        document.getElementById("demo").innerHTML = "EXPIRED";
			    }
			}, 1000);
		</script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-98521525-1', 'auto');
		  ga('send', 'pageview');
		</script>
		<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=590f1fe01554ce001135766e&product=inline-share-buttons"></script>
		@yield('css')

		<!-- Specific Page Vendor CSS -->
        {!! Html::style( $pathp.'assets/backend/porto-admin/stylesheets/theme.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/stylesheets/skins/default.css') !!}
	</head>
	<body>
		<div id="myModal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
		  <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content" style="margin-top:300px">
		      <div class="modal-header">
		        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
		        <h4 style="font-weight: 600" class="modal-title">[Beta Version] This website will be released on :</h4>
		      </div>
		      <div class="modal-body">
		        <p id="demo"></p>
		      </div>
		      <div class="modal-footer">
		        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
		      </div>
		    </div>

		  </div>
		</div>
		<div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @include('flash::message')
                </div>
            </div>
        </div>
		<!-- modal register -->
		<div style="margin-top: 200px" class="modal fade modal-getstart" id="modalFormDecode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
		    <div class="modal-header bg">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <center class="confirmation-message"><h4 class="modal-title" id="myModalLabel">Notice</h4></center>
        </div>
        <div class="modal-body">
            <div class="form-group area-delete">                    
                <div class="col-md-12">
                     <center class="confirmation-message">
                      <i style="font-size: 30px;color: green" id="circle-status" class="fa fa-check-circle"></i>
                      <br>Thank You for Subscribing. Please check your email to confirm your subscription.
                     </center>
                </div>
            </div>
            <div class="form-group area-denied">                    
                <div class="col-md-12">
                     <center class="confirmation-message">
                      <i style="font-size: 30px;color: red" id="circle-status" class="fa fa-minus-circle"></i>
                      <br><span id="content"> The email must be a valid email address.</span>
                     </center>
                </div>
            </div>
        </div>
        <div class="modal-footer bg">
          <button class="btn btn-default btn-cancel modal-dismiss" type="button" data-dismiss="modal" aria-label="Close">Close</button>
        </div>
		  </div>
		</div>
		</div>
		<div class="body">
		@if(request()->segment(2) == NULL)
			<header id="header" class="single-menu flat-menu valign transparent font-color-light" data-plugin-options='{"stickyEnabled": true, "stickyBodyPadding": false}'>
		@else
			<header id="header" class="colored flat-menu" data-plugin-options='{"stickyEnabled": true, "stickyBodyPadding": false}'>
		@endif
				<div class="header-top">
					<div class="container">
						<nav>
							<ul class="nav nav-pills nav-top">
								<li>
									<span style="color: #fff">@lang('general.public.language')</span>
								</li>
								<li>
									<a href="{{ route('session', 'in') }}" title="Indonesia"><img alt="indonesia" class="img-flag" src="{{ asset($pathp.'assets/general/images/identity/in.ico') }}"></a>
								</li>
								<li>
									<a href="{{ route('session','en') }}" title="English (UK)"><img alt="UK" class="img-flag" src="{{ asset($pathp.'assets/general/images/identity/uk.ico') }}"></a>
								</li>
								<!-- <li>
									<a href="{{ route('session','ar') }}" title="Saudi Arabia"><img class="img-flag" alt="AR" src="{{ asset('assets/general/images/identity/ar.ico') }}"></a>
								</li> -->
							</ul>
						</nav>
						<ul class="social-icons">
							<li class="facebook"><a href="https://www.facebook.com/Pondok-Pesantren-Al-Ihsan-850234935093594/" target="_blank" data-placement="bottom" data-tooltip title="Facebook">Facebook</a></li>
							<li class="instagram"><a href="http://www.instagram.com/alihsan_hits/" target="_blank" data-placement="bottom" data-tooltip title="Instagram">Instagram</a></li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="logo">
						<a href="/">
							<img alt="Porto" width="181" height="94" data-sticky-width="152" data-sticky-height="90" src="{{ asset($pathp.'assets/general/images/identity/web.png') }}">
						</a>
					</div>
					<button class="btn btn-responsive-nav btn-inverse" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="navbar-collapse nav-main-collapse collapse">
					<div class="container">
						@include('layout.frontend.general.partials.menu-nav')

					</div>
				</div>
			</header>
			@yield('content')

			@include('layout.frontend.general.partials.footer')
		</div>
		<div class="modal fade modal-getstart" id="modalFormTicket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
			    <div class="modal-header bg-primary">
			      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			      	<h4 class="modal-title FormTicket-title" style="color: white" id="myModalLabel">Add</h4>
			    </div>
			    <div class="modal-body">
			    
			    </div>
			  </div>
			</div>
		</div>
		<!-- Vendor -->
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/jquery/jquery.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/jquery.appear/jquery.appear.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/jquery.easing/jquery.easing.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/jquery-cookie/jquery-cookie.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/bootstrap/bootstrap.js') !!}"></script>
		{!! Html::style( $pathp.'assets/backend/porto-admin/vendor/font-awesome/css/font-awesome.css') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/nanoscroller/nanoscroller.js') !!}
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/common/common.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/jquery.validation/jquery.validation.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/jquery.stellar/jquery.stellar.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/jquery.gmap/jquery.gmap.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/isotope/jquery.isotope.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/owlcarousel/owl.carousel.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/jflickrfeed/jflickrfeed.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/magnific-popup/jquery.magnific-popup.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/vide/vide.js') !!}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{!! asset($pathp.'assets/frontend/general/js/theme.js') !!}"></script>

		<!-- Specific Page Vendor and Views -->
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/vendor/circle-flip-slideshow/js/jquery.flipshow.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/frontend/general/js/views/view.home.js') !!}"></script>

		<!-- Theme Custom -->
		<script src="{!! asset($pathp.'assets/frontend/general/js/custom.js') !!}"></script>

		<!-- Theme Initialization Files -->
		<script src="{!! asset($pathp.'assets/frontend/general/js/theme.init.js') !!}"></script>

		<script src="{!! asset($pathp.'assets/general/select/js/bootstrap-select.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/general/select/js/bootstrap-select.min.js') !!}"></script>
		<script src="{!! asset($pathp.'assets/backend/porto-admin/vendor/select2/js/select2.js') !!}"></script>
		
		{!! Html::script($pathp.'assets/backend/custom/jquery.form/jquery.form.js') !!}
		{!! Html::script($pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.js') !!}

		<script>
		    $('#flash-overlay-modal').css('margin-top','210px');
		    $('#flash-overlay-modal').css('align','center');
		    $('#flash-overlay-modal').modal();
		</script>
		<script type="text/javascript">
			function removeHidden(){
				$("#loader").removeClass('hidden');
			}
			$(".select2").select2();
			function show_form_add(){           
		        $('.FormTicket-title').html('Form Pendaftaran Santri Baru');
		        $("[name='method']").val('add');
		        $("[name='subject']").val('');
		        $("[name='title']").val('');
		        $("[name='content']").val('');
		        $("[name='number_days']").val('1');
		        $("[name='time']").val('');
		        $('.area-insert-update').show();
		        $('.area-delete').hide();
		        $('#modalFormTicket').modal({backdrop: 'static', keyboard: false});
		        $('#modalFormTicket').modal('show');
		    }

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
		            $('.area-denied').hide(); 
		            $('.area-delete').show(); 
		            $("#modalFormDecode").modal("show");  
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
		            $('.area-delete').hide(); 
		            $('.area-denied').show(); 
		            $("#modalFormDecode").modal("show");
		          } else {
		              $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
		          }
		        }
		    });

		    function ajaxdistrict(id){
			    var url= '{{ route('user-location-information-process') }}';
			    url=url+"/province";
			    url=url+"/"+id;

			    $.get(url, function(data, status){
		        $("#district_id").html(data);
		    	});
			}

			function ajaxsubdistrict(id){
			    var url= '{{ route('user-location-information-process') }}';
			    url=url+"/subdistrict";
			    url=url+"/"+id;
			    $.get(url, function(data, status){
		        $("#sub_district_id").html(data);
		    	});
			}

			function ajaxvillage(id){
			    var url= '{{ route('user-location-information-process') }}';
			    url=url+"/village";
			    url=url+"/"+id;
			    $.get(url, function(data, status){
		        $("#village_id").html(data);
		    	});
			}
		</script>
		@yield('scripts')
	</body>
</html>
