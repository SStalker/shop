@extends('app')

@section('content')
    <h2>Produkte</h2>
    <div class="table-responsive">
        @foreach($products as $product)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{!! url('products/' .$product->id) !!}">{!! $product->name !!}</a>
                    @if($product->status)
                        <span class="pull-right text-success">Verfügbar</span>
                    @else
                        <span class="pull-right text-danger">Nicht Verfügbar</span>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="col-md-1">
                        <img src="{!! url( 'images/' .$product->image_path) !!}" alt="No image available">
                    </div>
                    <div class="col-md-8 ">
                        {!! $product->description !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::open(['method' => 'POST', 'url' => 'baskets/add-product/'. $product->id, 'class' => 'pull-right' ]) !!}
                            {!! Form::submit('In den Warenkorb', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop