@extends('app')

@section('content')
    <h2>{!! $category->name !!} Ändern</h2>

    @include('errors.list')
    {!! Form::model($category, array('method' => 'PATCH', 'route' => array('categories.update', $category->id))) !!}
    @include ('categories/_form', ['submitButtonText' => 'Aktualisieren'])

@stop