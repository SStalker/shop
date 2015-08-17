<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use App\Basket;

class HasBasketID
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         //echo Session::get('basket_id') . '<br>';
         //echo Session::getId() . '<br>';
         /**
           *    1.)         Ist Kunde nicht angemeldet (Gast)
           *         1.1)    Überprüfe die sessionvariable basket_id
           *         1.2)    Ist diese gesetzt dann alles gut und weiter
           *         1.3)    Andernfalls erstelle temporären WK
           *         1.4)    Setze die sessionvariable
           *     2.)         Ist der Kunde angemeldet
           *         2.1)    Überprüfe ob der Kunde vorher in guest-state produkte im WK gelegt hatte
           *         2.2)    Hat er dies dann setze den WK als aktiv und setze die aktuelle id des kunden 
           *         2.3)    Lagen keine Produkte im WK dann überprüfe auf ein vllt älteren noch aktiven WK
           *         2.4)    Älterer WK vorhanden dann den neuen bedenkenlos löschen 
           *         2.5)    Kein älterer vorhanden dann den neuen als aktiven weiternutzen
          */
            if(Auth::guest()){
                echo 'Ich bin ein Gast';
                if (!Session::has('basket_id')){

                    $basket = new Basket();
                    $basket->user_id = 0;
                    $basket->session_id = Session::getId();                
                    $basket->total_price = 0;
                    $basket->total_quantity = 0;
                    $basket->active = 1;
                    $basket->save();

                    Session::put('basket_id', $basket->id);
                }

            } else {
                if (!Session::has('basket_id')){

                    $basket = new Basket();
                    $basket->user_id = 0;
                    $basket->session_id = Session::getId();                
                    $basket->total_price = 0;
                    $basket->total_quantity = 0;
                    $basket->active = 1;
                    $basket->save();

                    Session::put('basket_id', $basket->id);
                }

                $basket_id = Session::get('basket_id');
                $basket = Basket::findOrFail($basket_id);

                if($basket->user_id == 0) {
                    //dd($basket->articles->count());
                    if($basket->articles->count() > 0){
                        //echo 'Dieser Warenkorb hat Produkte';
                        $basket->user_id = Auth::user()->id;
                        $basket->active = 1;
                        $basket->session_id = Session::getId();
                        $basket->save();
                    } else {
                        //echo 'Dieser Warenkorb hat keine Produkte';
                        $oldBasket = Basket::where('user_id', '=', Auth::user()->id)
                                            ->where('active', '=', 1)->get();
                        //dd($oldBasket);
                        // Wenn ich keinen alten Warenkorb habe dann
                        if($oldBasket->isEmpty()){
                            //echo 'Ich besaß keinen älteren WK';
                            // hold the new one. Simply do nothing i think
                            $basket->user_id = Auth::user()->id;
                            $basket->active = 1;
                            $basket->session_id = Session::getId();
                            $basket->save();
                        } else {
                            // delete the new one and use the old one
                            //echo 'Ich wurde gelöscht';
                            $basket->delete();
                            Session::put('basket_id', $oldBasket->last()->id);
                            $oldBasket->last()->session_id = Session::getId();
                            $oldBasket->last()->save();
                        }
                    }
                }
            }
        return $next($request);        
    }
}
