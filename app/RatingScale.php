<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingScale extends Model
{

	public static function mine()
	{
		$scales = RatingScale::query();
		if(\Auth::user()->level < 3)
		{
			$scales = $scales->where('unit_id', \Auth::user()->unit_id);
		}
		return $scales->get();
	}

	public function unit()
	{
		return $this->belongsTo('App\Unit');
	}

    public function ratings()
    {
    	return $this->hasMany('App\Rating');
    }
}
