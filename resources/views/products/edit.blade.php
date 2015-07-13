extends('app')

@section('content')
    <h2>{!! $product->product_name!!} Ändern</h2>

    @include('errors.list')
    {!! Form::open(['method' => 'POST', 'route' => 'products.update']) !!}
    @include ('products/_form', ['submitButtonText' => 'Aktuelisieren'])

@stop