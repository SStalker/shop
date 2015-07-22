@extends('layouts.simple')
@section('content')
    <h1>Produkte</h1>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Anzahl</th>
            <th>Bildpfad</th>
            <th>Preis</th>
            <th>Status</th>
            <th># bestellt</th>
            <th>Kategorie</th>
            {{--<th>Hersteller</th>--}}
            <th>Aktionen</th>
        </thead>
        @foreach($products as $product)
            <tr>
                <td>{!! $product->name !!}</td>
                <td>{!! $product->description !!}</td>
                <td>{!! $product->quantity !!}</td>
                <td>{!! $product->image_path !!}</td>
                <td>{!! $product->price !!}</td>
                <td>{!! $product->status !!}</td>
                <td>{!! $product->times_ordered !!}</td>
                <td>{!! $product->category->name !!}</td>
                {{--}<td>{!! $product->manufactur()->name !!}</td>--}}
                <td>
                    <div class="btn-group">
                    {!! HTML::link('/products/'.$product->id.'/edit', 'Bearbeiten', array('class'=>'btn btn-default')) !!}
                    {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id]]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    {!! HTML::link('/products/create', 'Neu', array('class'=>'btn btn-primary')) !!}
@stop