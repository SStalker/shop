@extends('layouts.simple')

@section('content')
    <h2>Suchergebnisse</h2>
    <div class="table-responsive">
        @foreach($articles as $article)
            @if($article->status)
                @include ('articles/_short', ['article' => $article])
            @endif
        @endforeach
    </div>
@stop