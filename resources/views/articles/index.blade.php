@extends('app')

@section('content')
    <h2>Produkte</h2>
    <div class="table-responsive">
        @foreach($articles as $article)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{!! url('articles/' .$article->id) !!}">{!! $article->name !!}</a>
                    @if($article->status)
                        <span class="pull-right text-success">Verfügbar</span>
                    @else
                        <span class="pull-right text-danger">Nicht Verfügbar</span>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="col-md-1">
                        <img src="{!! url( 'images/' .$article->image_path) !!}" alt="No image available">
                    </div>
                    <div class="col-md-8 ">
                        {!! $article->description !!}
                    </div>
                    <div class="col-md-3">
                        @if(!$article->status)
                            {!! Form::open(['method' => 'POST', 'url' => 'baskets/add-article/'. $article->id, 'class' => 'pull-right']) !!}
                                {!! Form::submit('In den Warenkorb', ['class' => 'btn btn-danger disabled']) !!}
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method' => 'POST', 'url' => 'baskets/add-article/'. $article->id, 'class' => 'pull-right']) !!}
                                {!! Form::submit('In den Warenkorb', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop