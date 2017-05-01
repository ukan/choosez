
					<div class="chart chart-md" id="{{ $chart_id }}"></div>
					<script>
	
						var {{ $chart_id }} = {!! $JsonChart !!};			
	
						// See: assets/javascripts/dashboard/examples.dashboard.js for more settings.
	
					</script>

			        {!! Html::script($pathp.'assets/backend/porto-admin/vendor/flot/jquery.flot.js') !!}
			        {!! Html::script($pathp.'assets/backend/porto-admin/vendor/flot.tooltip/flot.tooltip.js') !!}
			        {!! Html::script($pathp.'assets/backend/porto-admin/vendor/flot/jquery.flot.pie.js') !!}
			        {!! Html::script($pathp.'assets/backend/porto-admin/vendor/flot/jquery.flot.categories.js') !!}
			        {!! Html::script($pathp.'assets/backend/porto-admin/vendor/flot/jquery.flot.resize.js') !!}
					<script type="text/javascript">
						
						$.plot('#{{ $chart_id }}', {{ $chart_id }}, {
							series: {
								lines: {
									show: true,
									fill: true,
									lineWidth: 1,
									fillColor: {
										colors: [{
											opacity: 0.45
										}, {
											opacity: 0.45
										}]
									}
								},
								points: {
									show: true
								},
								shadowSize: 0
							},
							grid: {
								hoverable: true,
								clickable: true,
								borderColor: 'rgba(0,0,0,0.1)',
								borderWidth: 1,
								labelMargin: 15,
								backgroundColor: 'transparent'
							},
							yaxis: {
								min: 0,
								color: 'rgba(0,0,0,0.1)'
							},
							xaxis: {
								color: 'rgba(0,0,0,0)'
							},
							tooltip: true,
							tooltipOpts: {
								content: '%s: Value of %x is %y',
								shifts: {
									x: -60,
									y: 25
								},
								defaultTheme: false
							}
						});

					</script>