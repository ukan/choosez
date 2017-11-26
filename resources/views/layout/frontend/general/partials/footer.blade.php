<footer id="footer" class="color">
	<div class="container">
		<div class="row">
			<div class="footer-ribbon">
				<span>@lang('general.footer.get_in_touch')</span>
			</div>
			<div class="col-md-5">
				<div class="newsletter">
					<h4>@lang('general.footer.subscribe')</h4>
					<p>@lang('general.footer.subscriber')</p>

					<div class="alert alert-success hidden" id="newsletterSuccess">
						<strong>Success!</strong> You've been added to our email list.
					</div>

					<div class="alert alert-danger hidden" id="newsletterError"></div>

					{!! Form::open(['route'=>'post-data-subscribe', 'files'=>true, 'class' => 'form-horizontal jquery-form-tickets']) !!}
						<div class="input-group">
							<input class="form-control" placeholder="Email Address" name="email" id="newsletterEmail" type="text">
							<span class="input-group-btn">
								<button onclick="removeHidden()" class="btn btn-default" type="submit">Send</button>
								<span><img alt="loader gif" id="loader" class="hidden" style="margin-left: 10px" height="25" src="{{ asset($pathp.'assets/general/images/loader.gif') }}"></span>
							</span>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-5">
				<div class="contact-details">
					<h4>@lang('general.title.contact_us')</h4>
					<ul class="contact">
						<li><p><i class="fa fa-map-marker"></i> <strong>@lang('general.footer.address'):</strong> Jl. Cibiruhilir No.23 RT.01 Rw.02 Cileunyi Bandung.</p></li>
						<li><p><i class="fa fa-phone"></i> <strong>@lang('general.footer.phone'):</strong> -</p></li>
						<li><p><i class="fa fa-envelope"></i> <strong>@lang('general.footer.email'):</strong> <a href="mailto:alihsanpondokpesantren@gmail.com">alihsanpondokpesantren@gmail.com</a></p></li>
					</ul>
				</div>
			</div>
			<div class="col-md-2">
				<h4>@lang('general.footer.follow')</h4>
				<div class="social-icons">
					<ul class="social-icons">
						<li class="facebook"><a href="https://www.facebook.com/Pondok-Pesantren-Al-Ihsan-850234935093594/" target="_blank" data-placement="bottom" data-tooltip title="Facebook">Facebook</a></li>
						<li class="instagram"><a href="http://www.instagram.com/alihsan_hits/" target="_blank" data-placement="bottom" data-tooltip title="Instagram">Instagram</a></li>
						<li class="youtube"><a href="https://www.youtube.com/channel/UCzoAmqqHl4qPfDQDaFF8AXA" target="_blank" data-placement="bottom" data-tooltip title="Youtube">Youtube</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-1">
					<a href="{{ route('home') }}" class="logo">
						<img width="30" alt="Al Ihsan Website" class="img-responsive" src="{{ asset($pathp.'assets/logo_almamater.jpg') }}">
					</a>
				</div>
				<div class="col-md-7">
					<p>© @lang('general.footer.copyright')</p>
				</div>
			</div>
		</div>
	</div>
</footer>