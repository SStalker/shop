@extends('app')

@section('content')
	@if($products->isEmpty())
		Sie haben keine Produkte im Warenkorb
	@else
		<table class="table table-striped table-hover">
			<thead>
				<th></th>
				<th></th>
				<th>Preis</th>
				<th>Menge</th>
				<th>Aktion</th>
			</thead>
			@foreach($products as $product)
				<tr>
					<td>{!! $product->image_path !!}</td>
					<td>{!! $product->name !!}</td>
					<td>{!! $product->pivot->price !!}</td>
					<td>									
						<div class="form-group">
							{!! Form::input('number','quantity', $product->pivot->quantity, ['class' => 'form-control', 'form' => 'form-quantity'.$product->id]) !!}
						</div>
					</td>
					<td>
						<div class="btn-group">
							{!! Form::open(['method' => 'POST', 'url' => ['baskets/change-quantity/'. $product->id],'id' => 'form-quantity'.$product->id, 'class' => '']) !!}
								<button type='submit'><span class="glyphicon glyphicon-ok"></span></button>
							{!! Form::close() !!}
							{!! Form::open(['method' => 'POST', 'url' => ['baskets/delete-product/'. $product->id], 'class' => 'pull-left']) !!}
								<button type='submit'><span class="glyphicon glyphicon-remove"></span></button>
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
			@endforeach
		</table>

		<div class="row">
			<div class="col-md-2">
				Summe: {!! $basket->total_price !!} €
			</div>
			<div class="col-md-8"></div>
			<div class="col-md-2">
				{!! Form::open(['method' => 'POST', 'route' => ['products.destroy', $product->id], 'class' => 'pull-right']) !!}
					{!! Form::submit('Zur Kasse', ['class' => 'btn btn-danger']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	@endif
@stop