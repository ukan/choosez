<nav class="nav-main mega-menu">
	<ul class="nav nav-pills nav-main" id="mainMenu">
		<li>
			<a href="{{ route('home') }}" title="@lang('general.menu.home')">@lang('general.menu.home')</a>
		</li>
		<li class="dropdown">	
			<a title="@lang('general.menu.profile')" class="dropdown-toggle" href="#">
				@lang('general.menu.profile')
				<i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a href="{{ route('profile-history') }}" title="@lang('general.menu.history')">@lang('general.menu.history')</a></li>
				<li><a href="{{ route('profile-structure') }}" title="@lang('general.menu.structure')">@lang('general.menu.structure')</a></li>
				<!-- <li><a href="{{ route('profile-teacher') }}" title="@lang('general.menu.teacher')">@lang('general.menu.teacher')</a></li> -->
				<li><a href="{{ route('profile-achievement') }}" title="@lang('general.menu.achievement')">@lang('general.menu.achievement')</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a title="@lang('general.menu.organization')" class="dropdown-toggle" href="#">
				@lang('general.menu.organization')
				<i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a href="{{ route('organization-center') }}" title="@lang('general.menu.center')">@lang('general.menu.center')</a></li>
				<li><a href="{{ route('organization-region') }}" title="@lang('general.menu.region')">@lang('general.menu.region')</a></li>
				<li><a href="{{ route('organization-uks') }}" title="Unit Kegiatan Santri">@lang('general.menu.uks')</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a title="@lang('general.menu.academic')" class="dropdown-toggle" href="#">
				@lang('general.menu.academic')
				<i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<!-- <li><a href="{{ route('academic-schedule') }}" title="@lang('general.menu.schedule')">@lang('general.menu.schedule')</a></li> -->
				<li><a href="{{ route('academic-material') }}" title="@lang('general.menu.material')">@lang('general.menu.material')</a></li>
				<!-- <li><a href="#" title="@lang('general.menu.academic_support')">@lang('general.menu.academic_support')</a></li> -->
			</ul>
		</li>
		<li class="dropdown">
			<a title="@lang('general.menu.event')" class="dropdown-toggle" href="#">
				@lang('general.menu.event')
				<i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a href="{{ route('get-page-psb') }}" title="Form Pendaftaran Satri Baru">@lang('general.menu.psb')</a></li>
				<li><a href="{{ route('get-page-bimtes') }}" title="Bimbingan Test">@lang('general.menu.bimtes')</a></li>
			</ul>
		</li>
		<!-- <li>
			<a href="{{ route('download') }}" title="@lang('general.menu.download')">@lang('general.menu.download')</a>
		</li> -->
		<li>
			<a href="{{ route('get-page-facilities') }}" title="@lang('general.menu.facilities')">@lang('general.menu.facilities')</a>
		</li>
		<li>
			<a href="{{ route('gallery') }}" title="@lang('general.menu.gallery')">@lang('general.menu.gallery')</a>
		</li>
		<li>
			<a href="{{ route('contact') }}" title="@lang('general.menu.contact')">@lang('general.menu.contact')</a>
		</li>
		<li>
			<a href="https://www.ponpesalihsancbr.id/in/login" title="Login">Login</a>
		</li>
	</ul>
</nav>