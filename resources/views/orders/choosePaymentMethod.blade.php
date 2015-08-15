@extends('app')

@section('content')

	@if( isset($custom_errors))
		<ul class="alert alert-danger">
		@foreach($custom_errors as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	@endif

	{!! Form::open(['url' => 'orders/choose-payment-method', 'method' => 'POST']) !!}	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12"> <!-- Payment Method --> 
				<fieldset>
					<legend>Payment Method</legend>
					@foreach($payment_methods as $method)

					<div class="radio">
					  <label>
					    <input type="radio" name="optionPaymentMethod" id="payment_method" value="{{ $method->id }}">
					    <div>
								{{--<address>
									<strong>{!! $address->user->firstname !!} {!! $address->user->lastname !!}</strong><br>
									{!! $address->street !!} {!! $address->housenumber !!}<br>
									{!! $address->postcode !!} {!! $address->city !!}<br>
									{!! $address->state !!}<br>
									{!! $address->country !!}<br>
								</address>--}}
							</div>
						</label>
					</div>
				@endforeach
				</fieldset>	
			</div> <!-- Payment Method --> 
		</div>

		<div class="row">
			<div class="col-md-10"></div>
			<div class="col-md-2">
				{!! Form::submit('Last check', ['class' => 'btn btn-danger btn-lg pull-right']) !!}
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop
