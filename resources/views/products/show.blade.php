@extends('layouts.simple')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 img-thumbnail centered">
				<img src="{!! url( 'images/' .$product->image_path) !!}" alt="No image available">
			</div>
			<div class="col-md-6 text-center">
				<h1>{!! $product->name !!} <small>aus {!! $category->name !!}</small> </h1>
			</div>
			<div class="col-md-3">
				{!! Form::open(['method' => 'POST', 'url' => 'baskets/add-product/'. $product->id, 'class' => 'pull-right vcenter' ]) !!}
					{!! Form::submit('In den Warenkorb', ['class' => 'btn btn-danger']) !!}
				{!! Form::close() !!}
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-md-12 p-descript">
				<p>{!! $product->description !!}</p>
			</div>
		</div>
	</div>
@stop