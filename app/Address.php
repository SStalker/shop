<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street_address',
        'postcode',
        'city',
        'state',
        'country',
        'user_id'
    ];

    public static $rules = [
        'street_address' => 'required|max:50',
        'postcode' => 'required|min:5|digits:5',
        'city' => 'required|max:50',
        'state' => 'required|max:50',
        'country' => 'required|max:50'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
