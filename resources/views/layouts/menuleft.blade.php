<div class="list-group">
	@foreach($categories as $category)
		<a href="{!! url('/categories/'. $category->id) !!}" class="list-group-item">{!! $category->name !!}</a>
	@endforeach
</div>