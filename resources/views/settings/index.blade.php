@extends('layouts.simple')

@section('content')
	<div class="panel panel-default">
	   <div class="panel-heading">
	      <h3 class="panel-title">
	         <a href="{!! url('/settings') !!}">Einstellungen</a>
	      </h3>
	   </div>
	   <div class="panel-body">
	   		<div class="col-md-3">
		     	<ul class="nav nav-pills nav-stacked">
				   <li><a href="{!! url('/settings/account') !!}">Konto</a></li>
				   <li><a href="{!! url('/settings/order') !!}">Bestellungen</a></li>
				   <li><a href="{!! url('/settings/payment') !!}">Zahlung</a></li>
				</ul>
			</div>
			<div class="col-md-9">
				@yield('settingContent')
			</div>
	   </div>
	</div>		
@stop