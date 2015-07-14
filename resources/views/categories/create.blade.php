@extends('app')

@section('content')
    <h2>Neues Kategorie</h2>

    @include('errors.list')
    {!! Form::open(['method' => 'POST', 'route' => 'categories.store']) !!}
    @include ('products/_form', ['submitButtonText' => 'Hinzufügen'])

@stop