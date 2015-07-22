@extends('app')

@section('content')
	@foreach($products as $product)
		{!! $product->name !!}
	@endforeach

	@if($products->isEmpty())
		Sie haben keine Produkte im Warenkorb
	@endif
@stop