@extends('app')

@section('content')
	@if($products->isEmpty())
		Sie haben keine Produkte im Warenkorb
	@else
		<table class="table table-striped table-hover">
			<thead>
				<th>Produkt</th>
				<th class="text-center">Menge</th>
				<th class="text-center">Preis</th>
				<th class="text-center">Summe</th>
				<th class="text-right">Aktion</th>
			</thead>
			@foreach($products as $product)
				<tr>					
					<td class="col-sm-8 col-md-6">
						<div class="media">
              <a class="pull-left" href="#"> <img class="media-object" src="{!! $product->image_path !!}" style="width: 72px; height: 72px;"> </a>
              <div class="media-body">
                <h4 class="media-heading"><a href="{!! url('/products/' . $product->id) !!}">{!! $product->name !!}</a></h4>
                <h5 class="media-heading"> by <a href="#">{!! $product->manufacturers_id !!}</a></h5>
                  <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
              </div>
            </div>
					</td>
					<td class="col-sm-1 col-md-1 text-center" >
						<div class="form-group">
							{!! Form::input('number','quantity', $product->pivot->quantity, ['class' => 'form-control', 'form' => 'form-quantity'.$product->id]) !!}
						</div>
					</td>
					<td class="col-sm-1 col-md-1 text-center">{!! money_format('%.2n', $product->pivot->price) !!}</td>
					<td class="col-sm-2 col-md-2 text-center">{!! money_format('%.2n', ($product->pivot->price*$product->pivot->quantity)) !!}</td>
					<td class="col-sm-1 col-md-1 text-right">
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
			<div class="col-md-3 pull-left">
				Summe: {!!  money_format('%.2n', $basket->total_price )!!} €
			</div>
			<div class="col-md-7"></div>
			<div class="col-md-2">
			{!! HTML::link('orders/choose-address', 'Choose an address') !!}
				{{--!! Form::open(['method' => 'POST', 'url' => 'orders/transaction/'. $basket->id, 'class' => 'pull-right']) !!}
					{!! Form::submit('Zur Kasse', ['class' => 'btn btn-danger']) !!--}}
				{!! Form::close() !!}
			</div>
		</div>
	@endif
@stop