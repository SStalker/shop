@extends('app')

@section('content')
    <h2>Kategorien</h2>
    <div class="table-responsive">
        @foreach($categories as $category)
            @if($category->status)

                <!--ToDo: create decent output-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {!! $category->name !!}
                    </div>
                    <div class="panel-body">
                        {!! $category->description !!}
                    </div>
                </div>
                {{--create decent output--}}


            @endif
        @endforeach
    </div>
@stop