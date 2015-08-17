@foreach($articles as $article)
	<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">{!! $article->name !!}<span class="pull-right">{!! $article->pivot->quantity !!} x {!! money_format('%.2n', $article->price) !!}€</span></h3>

  </div>
  <div class="panel-body">
    <p>{!! $article->description !!}</p>
  </div>
</div>
@endforeach