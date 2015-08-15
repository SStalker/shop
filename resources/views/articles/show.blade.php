@extends('layouts.simple')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 img-thumbnail centered">
				<img src="{!! url( 'images/' .$article->image_path) !!}" alt="No image available">
			</div>
			<div class="col-md-6 text-center">
				<div class="row">
					<h1>{!! $article->name !!} <small>aus {!! $category->name !!}</small> </h1>
				</div>
				<div class="row">
					<h4>{!! money_format('%.2n', $article->price) !!} €</h4>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					{!! Form::open(['method' => 'POST', 'url' => 'baskets/add-article/'. $article->id, 'class' => 'pull-right vcenter' ]) !!}
						{!! Form::submit('In den Warenkorb', ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
				</div>
				<div class="row">
					@if($article->status)
						<p class="text-success pull-right">Noch {!! $article->quantity !!} Verfügbar</p>
					@else
						<span class="text-danger pull-right">Nicht Verfügbar</span>
					@endif
				</div>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-md-12 p-descript">
				<p>{!! $article->description !!}</p>
			</div>
		</div>
	</div>
@stop