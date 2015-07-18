<?php

?>

<div class="list-group">
	@foreach($categories as $category)
		{!! HTML::printNodes($category) !!}

	@endforeach
</div>