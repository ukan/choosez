
										<div class="tm-body">
											<div class="tm-title">
												<h3 class="h5 text-uppercase">Recent Post</h3>
											</div>
											<ol class="tm-items">

			@foreach ($bulletin_boards as $bulletin_board)
					
												<li>
													<div class="tm-box">
														<p class="text-muted mb-none">{{ $bulletin_board -> created_at->diffForHumans() }}.</p>
														<p class="text-muted mb-none"><b><h5>{{$bulletin_board->title}}</h5></b></p>
														
														<p>
														@if($bulletin_board -> img_url != '')
															<?php echo "<img src='" . asset('storage/' . $bulletin_board -> img_url) . "' class='img-responsive pull-left' style='margin:0px 15px 15px 0px;width:200px;height:auto;'>"; ?>
																														
														@endif
															{!! $bulletin_board->description !!}
														</p>
														<div class="clearfix">&nbsp;</div>
														@if($bulletin_board->link_url != '')
														<p>
															<a class="btn btn-primary btn-sm" href="{{ $bulletin_board->link_url }}" target="_blank"> Go To The Article</a>				
														</p>
														@endif
													</div>
												</li>
			@endforeach

											</ol>
										</div>
										<?php echo $bulletin_boards->links() ?>
<script>
$( document ).ready(function() {
$('.pagination a').on('click', function(event) {
event.preventDefault();
if ($(this).attr('href') != '#') {
$('#ajaxContent').load($(this).attr('href'));
}
});
});
</script>