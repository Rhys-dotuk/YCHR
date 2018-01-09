<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $primaryKey = 'file_id';

	public function company() 
	{
		return $this->belongsTo('App\Company');
	}

	public function user() 
	{
		return $this->belongsTo('App\User');
	}
}