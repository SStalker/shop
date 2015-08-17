@extends('settings.index')

@section('settingContent')
    @if(!$orders->isEmpty())
        <div class="panel-group" id="orders" role="tablist" aria-multiselectable="true" >
            @foreach($orders as $order)
                <div class="panel panel-primary">
                    <div class="panel-heading"  role="tab" id="heading_{!! $order->id !!}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#orders" href="#order_{!! $order->id !!}" aria-expanded="false" aria-controls="order_{!! $order->id !!}" >
                                <span class="caret"></span>  Bestellung vom {!! $order->updated_at !!}</a>
                                <small class="text-wite">
                                    @if($order->status === 4)
                                        Abgeschlossen
                                    @elseif($order->status === 3)
                                        Versandt
                                    @elseif($order->status === 2)
                                        Bezahlt
                                    @else
                                        Wird Bearbeitet
                                    @endif
                                </small>
                            <!-- Todo: Add field for status -->
                            <span class="pull-right"> {!! $order->basket->total_price !!} €</span>
                        </h4>
                    </div>
                    <div id="order_{!! $order->id !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_{!! $order->id !!}">
                        <div  class="panel-body">
                            @foreach($order->basket->articles as $article)
                                @include ('articles/_short')
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="well">
            Es sind leider keine Bestellungen für diesen Nutzer eingetragen.
        </div>
    @endif
@stop