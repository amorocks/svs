<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{

	protected $dates = [
    	'valid_from', 'valid_to'
    ];

	public static function mine()
	{
		$terms = Term::query();
		if(\Auth::user()->level < 3)
		{
			$terms = $terms->where('unit_id', \Auth::user()->unit_id);
		}
		return $terms->get();
	}

	public function unit()
	{
		return $this->belongsTo('App\Unit');
	}

    public function rating_scale()
    {
    	return $this->belongsTo('App\RatingScale');
    }
}
