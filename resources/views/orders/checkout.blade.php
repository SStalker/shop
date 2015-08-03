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
			<fieldset>
				<legend>Details of Articles</legend>
				@include('orders.list', ['products' => $products])
			</fieldset>				
			</div>			
		</div>
		</br>
		<div class="row">
			<div class="col-md-4">
				<fieldset>
					<legend>Delivery address</legend>
					@foreach($addresses as $address)

					<div class="radio">
					  <label>
					    <input type="radio" name="optionDeliveryAddress" id="delivery_address" value="{{ $address->id }}" checked="{{ $address->id == $order->address_id }}">
					    <div>
								<address class="col-md-12">
									<strong>{!! $address->user->firstname !!} {!! $address->user->lastname !!}</strong><br>
									{!! $address->street !!} {!! $address->housenumber !!}<br>
									{!! $address->postcode !!} {!! $address->city !!}<br>
									{!! $address->state !!}<br>
									{!! $address->country !!}<br>
								</address>
							</div>
						</label>
					</div>
				@endforeach
				</fieldset>	
			</div>
			<div class="col-md-4">
				<fieldset>
					<legend>Billing address</legend>
					<div class="radio">
					<label>
						<input type="radio" name="optionBilligAddress" id="billing_address" value="0" checked="1">
						<div>
							Same as delivery address
						</div>
					</label>
				</div>
				@foreach($addresses as $address)
					<div class="radio">
					  <label>
					    <input type="radio" name="optionBilligAddress" id="billing_address" value="{{ $address->id }}" checked="{{ $address->id == $order->billing_id }}">		
					    <div>
							<address class="col-md-12">
								<strong>{!! $address->user->firstname !!} {!! $address->user->lastname !!}</strong><br>
								{!! $address->street !!} {!! $address->housenumber !!}<br>
								{!! $address->postcode !!} {!! $address->city !!}<br>
								{!! $address->state !!}<br>
								{!! $address->country !!}<br>
							</address>
							</div>
						</label>
					</div>
				@endforeach
				</fieldset>
			</div>
			<div class="col-md-4">
				<fieldset>
					<legend>Payment method</legend>
					{{ $order->payment_method }}
				</fieldset>				
			</div>
		</div>

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8">
				<div class="row" style="font-size: 20px;">
					<div class="col-md-10" style="border-bottom: 1px solid black;">Lieferkosten:</div>
					<div class="col-md-2" ><b>9,99 €</b></div>
				</div>
				<div class="row" style="font-size: 24px;">
					<div class="col-md-10">Summe:</div>
					<div class="col-md-2"><b>100 €</b></div>
				</div>
				<div class="row">
					<div class="col-md-6">Coupon</div>
					<div class="col-md-6">
						<button class="btn btn-danger btn-lg pull-right" type="submit">Buy!!</button>
					</div>
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
