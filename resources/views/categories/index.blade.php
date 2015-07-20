@extends('app')

@section('content')
    <h2>Kategorien</h2>
    <h3>Komplette Liste</h3>
        <div class="col-md-6">
            @foreach($Hlist as $item)
                {!! HTML::printNodes($item, 'plain') !!}
            @endforeach
        </div>
        <div class="col-md-6">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Aktion</th>
                </tr>
                @foreach($list as $item)
                    <tr>
                        <td>{!! $item->name !!}</td>
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
        </div>
        {!! HTML::link('/categories/create', 'Neu', array('class'=>'btn btn-primary')) !!}
@stop