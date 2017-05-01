@extends('layout.backend.admin.master.master')

@section('title', 'Dashboard')

@section('page-header', 'Dashboard')

@section('breadcrumb')
	<ol class="breadcrumbs">
	  <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
	  <li><span>Dashboard</span></li>
	</ol>
@endsection

@section('content')

@endsection

@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {
var Url = '/dashboard_ajax_bulletin_pagination';
$('#ajaxContent').load(Url);
});
</script>
    	{!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    	{!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/jquery-appear/jquery-appear.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/bootstrap-multiselect/bootstrap-multiselect.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/flot/jquery.flot.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/flot.tooltip/flot.tooltip.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/flot/jquery.flot.pie.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/flot/jquery.flot.categories.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/flot/jquery.flot.resize.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/jquery-sparkline/jquery-sparkline.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/raphael/raphael.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/morris.js/morris.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/gauge/gauge.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/snap.svg/snap.svg.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/liquid-meter/liquid.meter.js') !!}
        {!! Html::script('assets/backend/porto-admin/vendor/chartist/chartist.js') !!}
		
@endsection

@section('header')
		{!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}
		{!! Html::style('assets/backend/porto-admin/vendor/morris.js/morris.css') !!}
		{!! Html::style('assets/backend/porto-admin/vendor/chartist/chartist.min.css') !!}

@endsection