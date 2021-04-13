<?php $layout = '.master'; ?>
       
@extends('layout'.$layout)

@section('breadcrumbs')
<div class="row page-titles">
	<div class="col-md-6 col-8 align-self-center">

		<h3 class="text-themecolor m-b-0 m-t-0">{{ trans('genericTrans::generic.generic')}}</h3>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('genericTrans::generic.home') }}</a></li>
			<li class="breadcrumb-item active">{{ trans('genericTrans::generic.laravel_trans_example') }}</li>
		</ol>
	</div>
</div>	
@stop


@section('content')
	<div id="VueJs">
		
		<genericvuejs 
			admins-list="{{ json_encode($admins_list )}}"	
			
		>
		</genericvuejs>
		
	</div>

		

	</div>

@stop

@section('javascripts')
<script src="/libs/generic/lang.trans/generic"> </script> 



<script src="{{ elixir('vendor/codificar/generic/generic.vue.js') }}"> </script> 
       
@stop
