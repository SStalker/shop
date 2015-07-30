@extends('app')

@section('content')
	
	@if($custom_errors)
		<ul class="alert alert-danger">
		@foreach($custom_errors as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	@endif
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				Details of Articles	
				@foreach($products as $product)
					{{ $product->name }}
				@endforeach
			</div>			
		</div>
		<div class="row">
			<div class="col-md-4">Delivery address</div>
			<div class="col-md-4">Billing address</div>
			<div class="col-md-4">Payment method</div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8">
				<div class="row">sum + costs</div>
				<div class="row">
					<div class="col-md-6">Coupon</div>
					<div class="col-md-6">Buy Button</div>
				</div>
			</div>
		</div>
	</div>
	{{-- 
		TODO: 
			- Area  to choose the delivery and billing address		radio button + a new address button 

			- Area for the payment method f.e. select button

			- Area for coupon code textfield
	
			- Area again for all products details to check

			- Area for the final buy button
	 --}}

@stop
