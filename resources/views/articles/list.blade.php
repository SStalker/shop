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
        @foreach($articles as $article)
            <tr>
                <td>{!! $article->name !!}</td>
                <td>{!! $article->description !!}</td>
                <td>{!! $article->quantity !!}</td>
                <td>{!! $article->image_path !!}</td>
                <td>{!! $article->price !!}</td>
                <td>{!! $article->status !!}</td>
                <td>{!! $article->times_ordered !!}</td>
                <td>{!! $article->category->name !!}</td>
                {{--}<td>{!! $article->manufactur()->name !!}</td>--}}
                <td>
                    <div class="btn-group">
                    {!! HTML::link('/articles/'.$article->id.'/edit', 'Bearbeiten', array('class'=>'btn btn-default')) !!}
                    {!! Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id]]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    {!! HTML::link('/articles/create', 'Neu', array('class'=>'btn btn-primary')) !!}
@stop