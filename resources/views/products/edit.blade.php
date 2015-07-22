@extends('app')

@section('content')
    <h2>{!! $product->product_name!!} Ändern</h2>

    @include('errors.list')
    {!! Form::model($product, array('method' => 'PATCH', 'route' => array('products.update', $product->id))) !!}
    @include ('products/_form', ['submitButtonText' => 'Aktualisieren'])

@stop