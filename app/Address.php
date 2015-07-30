<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street',
        'housenumber',
        'postcode',
        'city',
        'state',
        'country',
        'user_id'
    ];

    public static $rules = [
        'street' => 'required|max:50',
        'housenumber' => 'required|min:1',
        'postcode' => 'required|min:5|digits:5',
        'city' => 'required|min:2|max:50',
        'state' => 'required|max:50',
        'country' => 'required|max:50'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
