@extends('layouts.simple')

@section('content')

	<div class="panel panel-default">
	   <div class="panel-heading">
	        <h3 class="panel-title">
	            {!! $category->name !!}
	        </h3>
	        @if($category->parent_id != null)
		   		<div>		   			
		   			<a href="{!! url('/categories/$category->parent_id') !!}">Übergeordnete Kategorie</a>
		   		</div>
		    @endif
	   </div>
	   <div class="panel-body">	
			<div class="table-responsive">	
		   		@foreach($category->articles as $article)
		   			@if($article->status)
			   			<div class="panel panel-default">
		                    <div class="panel-heading">
		                        {!! $article->name !!}
		                    </div>
		                    <div class="panel-body">
		                        {!! $article->description !!}
		                    </div>
		                </div>
	                @endif
	            @endforeach
			</div>
	   </div>
	</div>		

@stop