@extends('layouts.simple')

@section('content')
    <h2>Kategorien</h2>

    <h3>Komplette Liste</h3>
        <div class="col-md-4">
            @foreach($Hlist as $item)
                {!! HTML::printNodes($item, 'plain') !!}
            @endforeach
        </div>
        <div class="col-md-8">
            <table class="table table-striped table-bordered">
                <tr>
                    <th class="col-md-7">Name</th>
                    <th class="col-md-2">Status</th>
                    <th class="col-md-3">Aktion</th>
                </tr>
                @foreach($list as $item)
                    <tr>
                        <td>{!! $item->name !!}</td>
                        <td>
                            <span class="
                            @if($item->status)
                                text-success
                            @else
                                text-danger
                            @endif
                            ">Verfügbar</span>
                        </td>
                        <td>
                            {!! HTML::link('/categories/' .$item->id .'/edit', 'Ändern', array('class'=>'btn btn-primary')) !!}
                            {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $item->id], 'style' => 'display:inline;']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onClick' => 
                                    'return confirm(\'Wirklich löschen? ACHTUNG es werden alle Kinder mitgelöscht!!!\');' ]) !!}
                            {!! Form::close() !!}   
                        </td>
                    </tr>
                    
                @endforeach
            </table>
            <br/>
            {!! HTML::link('/categories/create', 'Neu', array('class'=>'btn btn-primary')) !!}
        </div>
@stop