@extends('layouts.simple')

@section('content')
    <h2>Suchergebnisse</h2>
    <div class="table-responsive">
        @foreach($articles as $article)
            @if($article->status)

                <!--ToDo: create decent output-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{!! url('articles/' .$article->id) !!}">{!! $article->name !!}</a>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-9">
                            {!! $article->description !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::open(['method' => 'POST', 'url' => 'baskets/add-article/'. $article->id, 'class' => 'pull-right' ]) !!}
                                {!! Form::submit('In den Warenkorb', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@stop