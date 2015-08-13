@foreach($products as $product)
	<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">{!! $product->name !!}<span class="pull-right">{!! money_format('%.2n', $product->price) !!}€</span></h3>

  </div>
  <div class="panel-body">
    <p>{!! $product->description !!}</p>
  </div>
</div>
@endforeach