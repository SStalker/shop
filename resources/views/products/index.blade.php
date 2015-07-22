@extends('app')

@section('content')
    <h2>Produkte</h2>
    <div class="table-responsive">
        @foreach($products as $product)
            @if($product->status)

                <!--ToDo: create decent output-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{!! url('products/' .$product->id) !!}">{!! $product->name !!}</a>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-9">
                            {!! $product->description !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::open(['method' => 'POST', 'url' => 'baskets/add-product/'. $product->id, 'class' => 'pull-right' ]) !!}
                                {!! Form::submit('In den Warenkorb', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                {{--create decent output--}}


            @endif
        @endforeach
    </div>
@stop