@extends('app')

@section('leftmenu')
	@include('layouts.menuleft')
@stop

@section('content')
    <div class="frontpageDist row">
        <div class="col-md-4"></div>
        <h1 class="col-md-3 text-center">Startseite</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach($products as $product)
                <div class="frontpageDist panel col-md-3">
                    <a href="{!! url( 'images/' .$product->id) !!}">
                        <img class="thumbnail center-block" src=" {!! url( 'images/' .$product->image_path) !!}" alt="No image available">
                        <div class="text-center">
                            {!! $product->name !!}
                        </div>
                    </a>
                </div>
                <div class="frontpageDist col-md-1">

                </div>
            @endforeach
        </div>
    </div>
@stop