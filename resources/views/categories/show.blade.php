@extends('layouts.simple')

@sectopns('content')

	<div class="panel panel-default">
	   <div class="panel-heading">
	      <h3 class="panel-title">
	         {!! $category->name !!}
	      </h3>
	   </div>
	   <div class="panel-body">
			<div class="table-responsive">	
		   		@foreach($category->products as $product)
		   			@if($product->status)
			   			<div class="panel panel-default">
		                    <div class="panel-heading">
		                        {!! $product->name !!}
		                    </div>
		                    <div class="panel-body">
		                        {!! $product->description !!}
		                    </div>
		                </div>
	                @endif
	            @endforeach
			</div>
	   </div>
	</div>		

@stop
