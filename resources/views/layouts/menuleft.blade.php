<div class="list-group">
	@foreach($categories as $category)
		{!! HTML::link('/categories/'.$category->id.'/edit', 'Bearbeiten' !!}
		<!--a href="{!! url('/categories/'.$category->id.'/show/' ) !!}" class="list-group-item">{!! $category->name !!}</a-->
	@endforeach
</div>