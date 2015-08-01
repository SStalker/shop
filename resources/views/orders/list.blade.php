@foreach($products as $product)
	<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">{{ $product->name }}</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>
@endforeach