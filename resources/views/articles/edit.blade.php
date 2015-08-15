@extends('layouts.simple')

@section('content')
    <h2>{!! $article->name!!} Ändern</h2>

    @include('errors.list')
    {!! Form::model($article, array('method' => 'PATCH', 'route' => array('articles.update', $article->id))) !!}
    @include ('articles/_form', ['submitButtonText' => 'Aktualisieren'])

@stop