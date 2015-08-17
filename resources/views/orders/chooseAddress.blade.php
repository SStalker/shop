@extends('app')

@section('content')
	@include('orders.breadcrumb', ['active' => 1])
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
					<legend>Lieferadresse</legend>
					@if(!$addresses->isEmpty())
						@foreach($addresses as $address)
							<div class="radio">
							  <label>
							    <input type="radio" name="optionDeliveryAddress" id="delivery_address" value="{{ $address->id }}" {{ ($address->id == $order->address_id) ? 'checked' : '' }}>
							    <div>
										<address class="col-md-12">
											<strong>{!! $address->firstname !!} {!! $address->lastname !!}</strong><br>
											{!! $address->street !!} {!! $address->housenumber !!}<br>
											{!! $address->postcode !!} {!! $address->city !!}<br>
											{!! $address->state !!}<br>
											{!! $address->country !!}<br>
										</address>
									</div>
								</label>
							</div>
						@endforeach
					@else
						{!! HTML::link('addresses/create', 'Neue Adresse hinzufügen',['class' => 'btn btn-large btn-primary']) !!}
					@endif
				</fieldset>	
			</div> <!-- Delivery Address --> 
			<div class="col-md-4"> <!-- Billing Address --> 
				<fieldset>
					<legend>Rechnungsadresse</legend>
					<div class="radio">
					<label>
						<input type="radio" name="optionBillingAddress" id="billing_address" value="0" checked>
						<div>
							Wie die Lieferadresse
						</div>
					</label>
				</div>
				@foreach($addresses as $address)
					<div class="radio">
					  <label>
					    <input type="radio" name="optionBillingAddress" id="billing_address" value="{{ $address->id }}" {{ ($address->id == $order->billing_id) ? 'checked' : '' }}>		
					    <div>
							<address class="col-md-12">
								<strong>{!! $address->firstname !!} {!! $address->lastname !!}</strong><br>
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
				@if($addresses->isEmpty())
					{!! Form::submit('Weiter zur Bezahlung', ['class' => 'btn btn-danger btn-lg pull-right disabled']) !!}
				@else
					{!! Form::submit('Weiter zur Bezahlung', ['class' => 'btn btn-danger btn-lg pull-right']) !!}
				@endif
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop
