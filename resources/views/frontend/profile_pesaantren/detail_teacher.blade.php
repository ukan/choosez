@extends('layout.frontend.general.layout')

@section('title', 'Detail Teacher')

@section('css')
<style type="text/css">
	.image-resolution{height: 585px; width: 585px;}
	.disabled{pointer-events: none;cursor: default;}
	.list-custom{text-align: justify;font-size: 16px;color: #000;}
	.history-place{width: 100%;box-shadow: 0 10px 8px 0 rgba(0,0,0,0.2), 0 6px 40px 0 rgba(0,0,0,0.19);}
	.effect1{
	     box-shadow: -10px 10px 10px -6px #777;
	}
	.effect1 h4{
	     padding-left: 10px;
	     padding-top: 10px;
	}
</style>
@endsection

@section('content')
<div role="main" class="main">
	<section class="page-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ route('home') }}">@lang('general.menu.home')</a></li>
						<li class="active">@lang('general.menu.profile')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.profile_detail')</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container back-content effect1">
		<div class="row">
			@foreach($teacher as $key => $value)
				<div class="col-md-4">
					<div class=""'>
						<div>
							<div class="thumbnail">
								<img alt="" class="img-responsive image-resolution" src="{{ asset($pathp.'storage/avatars/').'/'.$value->photo }}">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">

				<h2 class="shorter">{{$value->name}}</h2>
				@if($value->position == 'leadership')
					<h4>@lang('general.public.leadership')</h4>
				@elseif($value->position == 'hod_ac')
					<h4>@lang('general.public.hod_ac')</h4>
				@elseif($value->position == 'hod_ks')
					<h4>@lang('general.public.hod_ks')</h4>
				@elseif($value->position == 'treasurer')
					<h4>@lang('general.public.treasurer')</h4>
				@else
					<h4>@lang('general.public.teacher')</h4>
				@endif
					<span class="thumb-info-social-icons">
						@if(!empty($value->facebook))
							<a data-tooltip data-placement="bottom" target="_blank" href="{{ $value->facebook }}" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
						@else
							<a data-tooltip data-placement="bottom" target="_blank" href="{{ $value->facebook }}" data-original-title="Facebook" class="disabled"><i class="fa fa-facebook"></i><span>Facebook</span></a>
						@endif

						@if(!empty($value->instagram))
							<a data-tooltip data-placement="bottom" href="{{ $value->instagram }}" data-original-title="Instagram"><i class="fa fa-instagram"></i><span>Instagram</span></a>
						@else
							<a class="disabled" data-tooltip data-placement="bottom" href="{{ $value->instagram }}" data-original-title="Instagram"><i class="fa fa-instagram"></i><span>Instagram</span></a>
						@endif

						@if(!empty($value->linkedin))
							<a data-tooltip data-placement="bottom" href="{{ $value->linkedin }}" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
						@else
							<a class="disabled" data-tooltip data-placement="bottom" href="{{ $value->linkedin }}" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
						@endif
					</span>
					<ul class="list icons list-unstyled list-custom">
						<li><i class="fa fa-envelope"></i>{{ $value->email }}</li>
						<li><i class="fa fa-phone"></i>{{ $value->phone }}</li>
						<li><i class="fa fa-book"></i>{!! $value->academic !!}</li>
						<li><i class="fa fa-group"></i>{!! $value->organization !!}</li>
						<li><i class="fa fa-map-marker"></i>{{ $value->address }}</li>
					</ul>
				</div>
		</div>

		<hr class="tall" />
		@if(!empty($value->quote))
			<div class="container">
				<div class="row center">
					<div class="col-md-12">
						<div class="row">
							<div class="">
								<div>
									<blockquote>
										<p style="font-size:20px"><i class="fa fa-quote-left"></i> {{ $value->quote }}</p>
									</blockquote>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		@else

		@endif
	</div>
	@endforeach
</div>
@endsection

@section('scripts')

@endsection