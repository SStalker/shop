<div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                    </span>Content</a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
			<ul class="list-group">
				@foreach($categories as $category)	
				{!! HTML::printNodes($category) !!}
				@endforeach
			</ul>
		</div>
	</div>
</div>
