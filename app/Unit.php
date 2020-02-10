<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

	public static function mine()
	{
		$units = Unit::query();
		if(\Auth::user()->level < 3)
		{
			$units = $units->where('id', \Auth::user()->unit_id);
		}
		return $units->get();
	}
    
	public function users()
	{
		return $this->hasMany('App\User');
	}

    public function __toString()
    {
    	return $this->title;
    }
}
