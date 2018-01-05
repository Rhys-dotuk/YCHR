<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $primaryKey = 'company_id';

	public function user() 
	{
		return $this->hasMany('App\User');
	}

    public function file() 
	{
		return $this->hasMany('App\File');
	}
}
