@extends('app')

@section('content')
    <h2>Produkte</h2>
    <div class="table-responsive">
        @foreach($products as $product)
            @if($product->status)


                {{--ToDo: create decent output--}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {!! $product->product_name !!}
                    </div>
                    <div class="panel-body">
                        {!! $product->description !!}
                    </div>
                </div>
                {{--create decent output--}}


            @endif
        @endforeach
    </div>
@stop