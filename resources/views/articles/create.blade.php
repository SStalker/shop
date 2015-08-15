@extends('layouts.simple')

@section('content')
    <h2>Neues Produkt</h2>

    @include('errors.list')
    {!! Form::open(['method' => 'POST', 'route' => 'articles.store']) !!}
    @include ('articles/_form', ['submitButtonText' => 'Hinzufügen'])

@stop