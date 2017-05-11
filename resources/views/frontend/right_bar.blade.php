<div class="col-md-3">
	<aside class="sidebar">
		<!-- <div class="box effect1">
			<h4><b>@lang('general.title.categories')</b></h4>
			<label class="line"></label>
			<ul class="nav nav-list push-bottom">
				<li><a href="#">Design</a></li>
				<li><a href="#">Design</a></li>
				<li><a href="#">Photos</a></li>
			</ul>
		</div> -->
		<!-- <hr> -->
		<div class="tabs box effect1">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#popularPosts" data-toggle="tab"><i class="fa fa-star"></i> @lang('general.title.popular_post')</a></li>
				<li><a href="#recentPosts" data-toggle="tab">@lang('general.title.recent_post')</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="popularPosts">
					<ul class="simple-post-list">
						@foreach($bulletin_populer as $key => $value)
						<?php
							/*$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		        			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$value->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
		        			$sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);*/
						?>
						<li>
							<div class="post-image">
								<div class="img-thumbnail">
									<a href="{{ route('news-detail', $value->slug) }}">
										<img width="55" height="50" src="{{ asset($pathp.'storage/news'.'/'.$value->img_url) }}" alt="news image">
									</a>
								</div>
							</div>
							<div class="post-info">
								<a href="{{ route('news-detail', $value->slug) }}">{!! $value->title !!}</a>
								<div class="post-meta">
									 {{eform_date_news($value->publish_date)}}
								</div>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
				<div class="tab-pane" id="recentPosts">
					<ul class="simple-post-list">
						@foreach($bulletin_recent as $key => $value)
						<?php
							/*$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		        			$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey),$value->id, MCRYPT_MODE_CBC,md5(md5($cryptKey))));
		        			$sentEncrypt = str_replace('/','zpaIwL8TvQqP', $encrypted);*/
						?>
						<li>
							<div class="post-image">
								<div class="img-thumbnail">
									<a href="{{ route('news-detail', $value->slug) }}">
										<img width="55" height="50" src="{{ asset($pathp.'storage/news'.'/'.$value->img_url) }}" alt="news image">
									</a>
								</div>
							</div>
							<div class="post-info">
								<a href="{{ route('news-detail', $value->slug) }}">{!! $value->title !!}</a>
								<div class="post-meta">
									 {{eform_date_news($value->publish_date)}}
								</div>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<hr />
	</aside>
</div>