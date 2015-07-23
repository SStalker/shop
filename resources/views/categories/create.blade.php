@extends('layouts.simple')

@section('content')
    <h2>Neue Kategorie</h2>

    @include('errors.list')
    {!! Form::open(['method' => 'POST', 'route' => 'categories.store']) !!}

    @include ('categories/_form', ['submitButtonText' => 'Hinzufügen'])

@stop