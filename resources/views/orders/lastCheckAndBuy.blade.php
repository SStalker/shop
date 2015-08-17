@extends('app')

@section('content')
	@include('orders.breadcrumb', ['active' => 3])
	{!! Form::open(['url' => 'orders/checkout', 'method' => 'POST']) !!}	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
			<fieldset>
				<legend>Artikelübersicht</legend>
				@include('orders.list', ['articles' => $articles])
			</fieldset>				
			</div>			
		</div>
		
		<div class="row containerMargin">
			<div class="col-md-4"> <!-- Delivery Address --> 
				<fieldset>
					<legend>Lieferadresse</legend>
						<div>
							<address class="col-md-12">
								<strong>{!! $delivery_address->firstname !!} {!! $delivery_address->lastname !!}</strong><br>
								{!! $delivery_address->street !!} {!! $delivery_address->housenumber !!}<br>
								{!! $delivery_address->postcode !!} {!! $delivery_address->city !!}<br>
								{!! $delivery_address->state !!}<br>
								{!! $delivery_address->country !!}<br>
							</address>
						</div>
				</fieldset>	
			</div> <!-- Delivery Address --> 
			<div class="col-md-4"> <!-- Billing Address --> 
				<fieldset>
					<legend>Rechnungsadresse</legend>
				    <div>
						<address class="col-md-12">
							<strong>{!! $billing_address->firstname !!} {!! $billing_address->lastname !!}</strong><br>
							{!! $billing_address->street !!} {!! $billing_address->housenumber !!}<br>
							{!! $billing_address->postcode !!} {!! $billing_address->city !!}<br>
							{!! $billing_address->state !!}<br>
							{!! $billing_address->country !!}<br>
						</address>
					</div>
				</fieldset>
			</div> <!-- Billing Address --> 
			<div class="col-md-4">
				<fieldset>
					<legend>Bezahlung</legend>
					{{ $payment_method }}
				</fieldset>				
			</div>
		</div>

		<div class="row containerMargin">
			<div class="col-md-4"></div>
			<div class="col-md-8">
				<div class="row" style="font-size: 20px;">
					<div class="col-md-10" style="border-bottom: 1px solid black;">Lieferkosten:</div>
					<div class="col-md-2" ><b>9,99 €</b></div>
				</div>
				<div class="row" style="font-size: 24px;">
					<div class="col-md-10">Summe:</div>
					<div class="col-md-2"><b>{!! $order->basket->total_price + 9.99 !!}</b></div>
				</div>

				<div class="row containerMargin">
					<div class="col-md-6">
						{!! Form::label('coupon', 'Coupon Code')!!}
						{!! Form::text('coupon', null, ['class' => 'form-control']) !!}
					</div>
					<div class="col-md-6">
							{!! Form::submit('Kaufen!!', ['class' => 'btn btn-danger btn-lg pull-right']) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@stop
