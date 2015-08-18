
<div class="panel-group" id="articles" role="tablist" aria-multiselectable="true">
@foreach($articles as $article)
	<div class="panel panel-default">
        <div class="panel-heading"role="tab" id="heading_{!! $article->id !!}">
            <a role="button" data-toggle="collapse" data-parent="#articles" href="#article_{!! $article->id !!}" aria-expanded="false" aria-controls="article_{!! $article->id !!}">
                <h3 class="panel-title">
                    <span class="caret"></span>  {!! $article->pivot->quantity !!} x  {!! $article->name !!}
                    <span class="pull-right">{!! money_format('%.2n',$article->price*$article->pivot->quantity) !!} €</span>
                </h3>
            </a>
        </div>
        <div id="article_{!! $article->id !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{!! $article->id !!}">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2">
                        <img class="center-block" src="{!! url( 'images/' .$article->image_path) !!}" alt="No image available">
                    </div>
                    <div class="col-md-10">
                        {!! $article->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>