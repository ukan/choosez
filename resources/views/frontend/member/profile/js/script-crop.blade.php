<script type="text/javascript">
    /* Crop Photo Profile */
    function photoUpload() {
        var uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                    
                }
                
                reader.readAsDataURL(input.files[0]);
            }
            else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }
        function popupResult(result) {
    		var html;
    		if (result.html) {
    			html = result.html;
    		}
    		if (result.src) {
    			html = '<img src="' + result.src + '" />';
    		}

    		$('#peview-avatar').html(html);
    		$('#upload-demo').hide();
    		$('#peview-avatar').show();
    		$('input#image_base64').val(result.src);
    		// swal({
    		// 	title: '',
    		// 	html: true,
    		// 	text: html,
    		// 	allowOutsideClick: true
    		// });
    		// setTimeout(function(){
    		// 	$('.sweet-alert').css('margin', function() {
    		// 		var top = -1 * ($(this).height() / 2),
    		// 			left = -1 * ($(this).width() / 2);

    		// 		return top + 'px 0 0 ' + left + 'px';
    		// 	});
    		// }, 1);
    	}

        uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'canvas'
            },
            boundary: {
                width: 300,
                height: 300
            },
            enableExif: true
        });

        $('input#upload-input').on('change', function () { 
            var fullPath = $(this).val();
            var filename = fullPath.replace(/^.*[\\\/]/, '');
        	$('#upload-demo').show();
        	$('#peview-avatar').hide();
        	$('input#image_filename').val(filename);
            readFile(this); 
        });
        
        $('.upload-result').on('click', function (ev) {
            uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                popupResult({
                    src: resp
                });
            });
        });
    }


    function photoUploadEdit() {
        var uploadCrop;

        function readFileEdit(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                    
                }
                
                reader.readAsDataURL(input.files[0]);
            }
            else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        function popupResultEdit(result) {
            var html;
            if (result.html) {
                html = result.html;
            }
            if (result.src) {
                html = '<img class="img-circle img-responsive" src="' + result.src + '" />';
            }
            
            $('.box-peview-avatar').html('');
            $('.box-peview-avatar').html(html);
            $('.box-upload-demo').hide();
            $('.box-peview-avatar').show();
            $('input#image_base64_edit').val(result.src);
            // swal({
            //  title: '',
            //  html: true,
            //  text: html,
            //  allowOutsideClick: true
            // });
            // setTimeout(function(){
            //  $('.sweet-alert').css('margin', function() {
            //      var top = -1 * ($(this).height() / 2),
            //          left = -1 * ($(this).width() / 2);

            //      return top + 'px 0 0 ' + left + 'px';
            //  });
            // }, 1);
        }

        uploadCrop = $('.box-upload-demo').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'canvas'
            },
            boundary: {
                width: 300,
                height: 300
            },
            enableExif: true
        });

        $('input#avatar').on('change', function () { 
            $('.box-upload-demo').show();
            $('.box-peview-avatar').hide();
            $('.upload-result-edit').show();
            $('input#image_filename_edit').val($(this).val());
            readFileEdit(this); 
        });
        
        $('button#btn-crop').on('click', function (ev) {
            uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                popupResultEdit({
                    src: resp
                });
            });
        });
    }
    
    /* Preview Thumbnail image */
    $('input#ktp_photo').on('change', function() {
        readUrl(this, 'ktp');
    });

    $('input#npwp_photo').on('change', function() {
        readUrl(this, 'npwp');
    });

    function readUrl(input, name)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var result = e.target.result;
                $('div#box-image-'+ name).html('');
                $('div#box-image-'+ name).html('<img src="'+ result +'" id="preview_image" style="width:200px; height:200px">');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    // var uploadCrop = $('#upload-demo').croppie({
    //     enableExif: true,
    //     viewport: {
    //         width: 200,
    //         height: 200,
    //         type: 'circle'
    //     },
    //     boundary: {
    //         width: 300,
    //         height: 300
    //     }
    // });
    // uploadCrop.croppie('bind', {
    //     url: "{{ user_info('avatar_path') }}",
    //     points: [77,469,280,739]
    // });

</script>