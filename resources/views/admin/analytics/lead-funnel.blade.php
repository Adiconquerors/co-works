@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )

@endsection

@section( 'new_content' )
<style>
	.container-width{
		width: 70%;
	}
</style>
<div id="container" class="container-width">
 <canvas id="lead_funnel_chart"></canvas>
</div>
  

@stop

@section( 'new_admin_js_scripts' )
 @include('admin.common.chart', array('chart_data'=>$lead_funnel_chart_data,'ids' =>array('lead_funnel_chart'), 'scale'=>TRUE))
@endsection  