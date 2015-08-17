@extends('app')

@section('content')
	@include('orders.breadcrumb', ['active' => 2])
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
					<legend>Bezahlmethode</legend>			

					<div class="radio">
					  <label>
					    <input type="radio" name="optionPaymentMethod" id="payment_method" value="1" checked="true">
					    <div>Vorkasse</div>
						</label>
					</div>

					<div class="radio">
					  <label>
					    <input type="radio" name="optionPaymentMethod" id="payment_method" value="2">
					    <div>Nachnahme</div>
						</label>
					</div>

					<div class="radio">
					  <label>
					    <input type="radio" name="optionPaymentMethod" id="payment_method" value="3">
					    <div>Lastschrift</div>
						</label>
					</div>

					<div class="radio">
					  <label>
					    <input type="radio" name="optionPaymentMethod" id="payment_method" value="4">
					    <div>Paypal</div>
						</label>
					</div>

					<div class="radio">
					  <label>
					    <input type="radio" name="optionPaymentMethod" id="payment_method" value="5">
					    <div>Kreditkarte</div>
						</label>
					</div>
				
				</fieldset>	
			</div> <!-- Payment Method --> 
		</div>

		<div class="row">
			<div class="col-md-10"></div>
			<div class="col-md-2">
				{!! Form::submit('Bestellung überprüfen', ['class' => 'btn btn-danger btn-lg pull-right']) !!}
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop
