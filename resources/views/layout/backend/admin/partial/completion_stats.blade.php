@if(PercentCompletionProfile() != 100)
<script type="text/javascript">
window.setTimeout("$('.personal_information_process').popover('show')",0);
window.setTimeout("$('.personal_information_process').popover('hide')",5000);
</script>
<hr class="separator" />

<div class="sidebar-widget widget-stats">
	<div class="widget-header">
		<h6>QUICK START <span><i class="fa fa-question-circle" rel="tooltip" title="Warning: some of your features is lock. Please complete your profile information to access all your features."></i></span></h6>
		<div class="widget-toggle">+</div>
	</div>
	<div class="widget-content">
		<ul>
			<li class="personal_information_process" data-container="body" data-toggle="popover" data-placement="top" data-content="Warning: some of your features is lock. Please complete your profile information to access all your features" style="background:#EFA740;padding:3px 3px 3px 3px;border-radius:5px;color:#ABB1A9">
				<div style="margin:5px">
				<span class="stats-title" style="color:#000;">Progress..</span>
				<span class="stats-complete" style="color:#000">{{ PercentCompletionProfile() }}%</span>
				<div class="progress" style="margin-bottom:10px">
					<div class="progress-bar progress-bar-danger progress-without-number" role="progressbar" aria-valuenow="{{PercentCompletionProfile()}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ PercentCompletionProfile() }}%;">
						<span class="sr-only">{{ PercentCompletionProfile() }}% Complete</span>
					</div>
				</div>
				</div>
			</li>
			<!-- <li>
				<span class="stats-title">Stat 2</span>
				<span class="stats-complete">70%</span>
				<div class="progress">
					<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
						<span class="sr-only">70% Complete</span>
					</div>
				</div>
			</li>
			<li>
				<span class="stats-title">Stat 3</span>
				<span class="stats-complete">2%</span>
				<div class="progress">
					<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
						<span class="sr-only">2% Complete</span>
					</div>
				</div>
			</li> -->
		</ul>
	</div>
</div>
@endif