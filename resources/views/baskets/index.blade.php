@extends('app')

@section('content')

	@if( isset($quantity_errors) )
		@foreach($quantity_errors as $error)
			{{ $error }}
		@endforeach
	@endif

	@if($articles->isEmpty())
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
			@foreach($articles as $article)
				<tr>					
					<td class="col-sm-8 col-md-6">
						<div class="media">
              <a class="pull-left" href="#"> <img class="media-object" src="{!!url( 'images/' .$article->image_path) !!}" style="width: 72px; height: 72px;"> </a>
              <div class="media-body">
                <h4 class="media-heading"><a href="{!! url('/articles/' . $article->id) !!}">{!! $article->name !!}</a></h4>
                <h5 class="media-heading"> by <a href="#">{!! $article->manufacturers_id !!}</a></h5>
                  <span>Status: </span>
                  @if($article->status)
                      <span class="text-success"><strong>Auf Lager</strong></span>
                  @else
                      <span class="text-danger"><strong>Nicht auf Lager</strong></span>
                  @endif
              </div>
            </div>
					</td>
					<td class="col-sm-1 col-md-1 text-center" >
						<div class="form-group">
							{!! Form::input('number','quantity', $article->pivot->quantity, ['class' => 'form-control', 'form' => 'form-quantity'.$article->id]) !!}
						</div>
					</td>
					<td class="col-sm-1 col-md-1 text-center">{!! money_format('%.2n', $article->pivot->price) !!} €</td>
					<td class="col-sm-2 col-md-2 text-center">{!! money_format('%.2n', ($article->pivot->price*$article->pivot->quantity)) !!} €</td>
					<td class="col-sm-1 col-md-1 text-right">
						<div class="btn-group">
							{!! Form::open(['method' => 'POST', 'url' => ['baskets/change-quantity/'. $article->id],'id' => 'form-quantity'.$article->id, 'class' => '']) !!}
								<button type='submit'><span class="glyphicon glyphicon-ok"></span></button>
							{!! Form::close() !!}
							{!! Form::open(['method' => 'POST', 'url' => ['baskets/delete-article/'. $article->id], 'class' => 'pull-left']) !!}
								<button type='submit'><span class="glyphicon glyphicon-remove"></span></button>
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
			@endforeach
		</table>
		<div class="row">
			<div class="col-md-6 pull-left">
				<h3 >Gesamtsumme: {!! $basket->total_price !!} €</h3>
			</div>
			<div class="col-md-4"></div>
			<div class="col-md-2">
				{!! Form::open(['method' => 'GET', 'url' => 'orders/choose-address', 'class' => 'pull-right']) !!}
					@if( isset($invalidArticle) && $invalidArticle == true ) 
						{!! Form::submit('Weiter zu Adressen', ['class' => 'btn btn-danger disabled']) !!}
					@else
						{!! Form::submit('Weiter zu Adressen', ['class' => 'btn btn-danger']) !!}
					@endif
				{!! Form::close() !!}
			</div>
		</div>
	@endif
@stop