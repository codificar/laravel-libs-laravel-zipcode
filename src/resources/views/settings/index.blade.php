<?php $layout = '.master'; ?>
       
@extends('layout'.$layout)

@section('breadcrumbs')
<div class="row page-titles">
	<div class="col-md-6 col-8 align-self-center">
		<h3 class="text-themecolor m-b-0 m-t-0">{{ trans("setting.conf") }}</h3>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans("dashboard.home") }}</a></li>
			<li class="breadcrumb-item active">{{ trans("setting.conf") }}</li>
			<li class="breadcrumb-item active">{{$title}}</li>
		</ol>
	</div>
</div>	
@stop
	
@section('content')
	<div id="VueJs">		
		<zipcodesettings
			enum-data  = "{{ $enum }}"
			model = "{{ $model }}"
			zip-code-setting-store-route = "{{ URL::Route($enviroment.'ZipCodeSettingStore') }}"
		/>
	</div>

@stop

@section('javascripts')
<script>

function clearRowClass() {
  var element = document.getElementById("layout-row-id");
  if(element) element.classList.remove("row");
}
clearRowClass()

</script>


<script src="/libs/zipcode/lang.trans/zipcode"> </script> 
<script src="{{ asset('vendor/codificar/zipcode/zipcode.vue.js') }}"> </script> 
@stop
