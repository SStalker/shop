@extends('layouts.simple')
@section('content')
    <h1>Produkte</h1>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <th class="col-md-1">Name</th>
            <th class="col-md-3">Beschreibung</th>
            <th class="col-md-1">Anzahl</th>
            <th class="col-md-1">Bildpfad</th>
            <th class="col-md-1">Preis</th>
            <th class="col-md-1">Status</th>
            <th class="col-md-1">bestellt</th>
            <th class="col-md-1">Kategorie</th>
            {{--<th class="col-md-1">Hersteller</th>--}}
            <th class="col-md-1">Aktionen</th>
        </thead>
        @foreach($articles as $article)
            <tr>
                <td>{!! $article->name !!}</td>
                <td>{!! $article->description !!}</td>
                <td>{!! $article->quantity !!}</td>
                <td>{!! $article->image_path !!}</td>
                <td>{!! money_format('%.2n', $article->price) !!} €</td>
                <td>
                    <span class="
                    @if($article->status)
                        text-success
                    @else
                        text-danger
                    @endif
                        ">Verfügbar</span>
                </td>
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