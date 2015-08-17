@extends('layouts.simple')

@section('content')
    <h2>Suchergebnisse</h2>
    <div class="table-responsive">
        @forelse($articles as $article)
            @if($article->status)
                @include ('articles/_short', ['article' => $article])
            @endif
        @empty
            <div class="container containerMargin">
                <h3 class="text-center well">Keine Produkte gefunden</h3>
            </div>
        @endforelse
    </div>
@stop