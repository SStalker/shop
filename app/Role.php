<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
		'name',            
		'display_name',    
		'description'
	];

	public static $rules = [
		'name' => 'required|min:1',
		'display_name' => 'required|min:1',
		'description' => 'required|min:1',
	];
}
