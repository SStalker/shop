<?php

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
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

	/*
		id          
		name            
		display_name    
		description               
		created_at           
		updated_at
	*/
}
