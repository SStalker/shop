@extends('app')

@section('content')
    <div class="frontpageDist row borderBottom">

        <h1 class="text-center">Startseite</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach($articles as $article)
                <div class="frontpageDist frontpagePanel panel col-md-4">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 frontpagePanelBorder">
                            <a href="{!! url( 'articles/' .$article->id) !!}">
                                <img class="thumbnail center-block" src=" {!! url( 'images/' .$article->image_path) !!}" alt="No image available">
                                <div class="text-center">
                                    {!! $article->name !!}
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop