@extends('app')

@section('content')
    <h2>Kategorien</h2>
    <h3>Komplette Liste</h3>
        {!! HTML::link('/categories/create', 'Neu', array('class'=>'btn btn-primary')) !!}

            @foreach($Hlist as $item)
                {!! HTML::printNodes($item, 'plain') !!}
            @endforeach

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
        
    {{--<div class="table-responsive">
        @foreach($categories as $category)
            @if($category->status)

                <!--ToDo: create decent output-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {!! HTML::link('categories/'. $category->id, $category->name) !!}
                    </div>
                    <div class="panel-body">
                        {!! $category->description !!}
                    </div>
                </div>
                


            @endif
        @endforeach
        
    </div>
    --}}
@stop