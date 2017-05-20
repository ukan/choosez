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

article.post-large-custom .post-audio-custom {margin-left: -60px;}
.history-place{width: 100%;box-shadow: 0 10px 8px 0 rgba(0,0,0,0.2), 0 6px 40px 0 rgba(0,0,0,0.19);}

</style>
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/style.css') !!}">
{!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}
{!! Html::style($pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.css') !!}
@endsection

@section('content')
<div role="main" class="main">
	<section class="page-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ route('home') }}">@lang('general.menu.home')</a></li>
						<li class="active">@lang('general.menu.organization')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.region')</h1>
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
							<h2>Organisasi Santri Pondok Pesantren Al Ihsan (OSPAI) Wilayah</h2>
							<hr>
							<div class="post-meta">
							
							</div>
							<p class="justify">Organisasi Santri Pondok Pesantren Al-Ihsan (OSPAI) adalah organisasi resmi yang ada di pondok pesantren Al-Ihsan. OSPAI terdiri dari dua bagian salah satunya adalah OSPAI Wilayah.</p>
							<p class="justify">OSPAI Wilayah adalah OSPAI yang mengatur semua kegiatan di wilayah asrama pondok pesantren Al-Ihsan. Peran Ospai Wilayah adalah melakukan koordinasi dengan OSPAI Pusat serta berperan sebagai motivator penggerak, kontroler dan fasilitator dari aspirasi santri yang ada di wilayahnya masing-masing. Pondok pesantren Al-Ihsan terdiri dari tujuh asrama yang didalamnya terdapat pengurus OSPAI Wilayah. OSPAI Wilayah dipimpin oleh seorang Gubernur yang dibantu oleh sekretaris dan bendahara serta seksi bidang atau divisi yang bersinergi untuk mensejahterakan kehidupan santri di wilayah. Divisi yang ada di wilayah disesuaikan dengan kebutuhan dan kondisi asramanya masing-masing seperti, divisi keamanan, divisi kesejahteraan, divisi nalar dan intelektual, divisi olahraga dll.</p>
							<p class="justify">Untuk detail asramanya dapat dilihat dibawah ini :
								@php $i=1; @endphp
								@foreach($bidang as $key => $value)
									<br> {{$i}}. <a style="cursor: pointer;" onclick="show_form_struktur({{$value->id}})">{{$value->nama}}</a>
									@php $i++; @endphp
								@endforeach
							</p>
						</div>
					</article>

				</div>
			</div>
			@include('frontend.right_bar')
		</div>
	</div>
</div>

<div class="modal fade modal-getstart" id="struktur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="" role="document" style="max-width:1027px;margin:10px auto">
      <div class="modal-content">
        <div class="modal-header ">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="modal-body" id="getContentProkerModal" style="padding-top:0px">
        <div class="center">
        	<img style="width: 980px;height: 600" src="{{ asset($pathp.'storage/organigram/'.$struktur) }}">
        </div>
      </div>
    </div>
  </div>
</div>
<div id="getProkerModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: white"></h4>
      </div>
      <div class="modal-body" id="getContentProkerModal">
        
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function show_form_struktur(id){
		$.ajax({
            type: "POST",
            url: "{{ route('general-show-struktur-wilayah') }}",
            data: {
                'id': id
            },
            success: function(msg)
            {
                $('.modal-title').html('Detail Info');
				$('#struktur').modal({backdrop: 'static', keyboard: false});
				$('#struktur').modal('show');
                $("#getContentProkerModal").html(msg);
            }
        });
    }
    function show_form_kementerian(id){
        $.ajax({
            type: "POST",
            url: "{{ route('general-show-proker-pusat') }}",
            data: {
                'id': id
            },
            success: function(msg)
            {
                $('.modal-title').html('Detail Info');
                $("#getProkerModal").modal("show");
                $("#getContentProkerModal").html(msg);
            }
        });
    }
</script>

{!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.js') !!}
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