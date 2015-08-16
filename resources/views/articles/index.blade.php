@extends('app')

@section('content')
    <h2>Produkte</h2>
    <div class="table-responsive">
        @foreach($articles as $article)
            @include ('articles/_short', ['article' => $article])
        @endforeach
    </div>
@stop