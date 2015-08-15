@extends('app')

@section('content')
	
	@include('errors.list')
	@if( isset($custom_errors) )
		<ul class="alert alert-danger">
		@foreach($custom_errors as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	@endif

	{!! Form::open(['url' => 'orders/choose-address', 'method' => 'POST']) !!}	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4"> <!-- Delivery Address --> 
				<fieldset>
					<legend>Delivery address</legend>
					@foreach($addresses as $address)

					<div class="radio">
					  <label>
					    <input type="radio" name="optionDeliveryAddress" id="delivery_address" value="{{ $address->id }}" "{{ ($address->id == $order->address_id) ? 'checked' : '' }}">
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
			</div> <!-- Delivery Address --> 
			<div class="col-md-4"> <!-- Billing Address --> 
				<fieldset>
					<legend>Billing address</legend>
					<div class="radio">
					<label>
						<input type="radio" name="optionBillingAddress" id="billing_address" value="0" checked>
						<div>
							Same as delivery address
						</div>
					</label>
				</div>
				@foreach($addresses as $address)
					<div class="radio">
					  <label>
					    <input type="radio" name="optionBillingAddress" id="billing_address" value="{{ $address->id }}" "{{ ($address->id == $order->billing_id) ? 'checked' : '' }}">		
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
			</div> <!-- Billing Address --> 
			<div class="col-md-4">	
			</div>
		</div>

		<div class="row">
			<div class="col-md-10"></div>
			<div class="col-md-2">
				{!! Form::submit('Go on to Payment', ['class' => 'btn btn-danger btn-lg pull-right']) !!}
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop
