<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <a href="{!! url('articles/' .$article->id) !!}">{!! $article->name !!}</a>
            @if($article->status)
                <span class="pull-right text-success">Verfügbar</span>
            @else
                <span class="pull-right text-danger">Nicht Verfügbar</span>
            @endif
        </div>
    </div>
    <div class="panel-body">
        <div class="col-md-2">
            <img class="center-block" src="{!! url( 'images/' .$article->image_path) !!}" alt="No image available">
        </div>
        <div class="col-md-8">
            {!! $article->description !!}
        </div>
        <div class="col-md-2">
            <div class="row text-center" >
                <h4 class="withoutMargin">{!!$article->price !!} €</h4>
            </div>
            <hr/>
            <div class="row text-center">
                @if(!$article->status)
                    {!! Form::open(['method' => 'POST', 'url' => 'baskets/add-article/'. $article->id, 'class' => 'withoutMargin']) !!}
                        {!! Form::submit('In den Warenkorb', ['class' => 'btn btn-danger disabled']) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['method' => 'POST', 'url' => 'baskets/add-article/'. $article->id, 'class' => 'withoutMargin']) !!}
                        {!! Form::submit('In den Warenkorb', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>