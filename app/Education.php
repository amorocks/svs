<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    public static function mine()
    {
    	$educations = \App\Education::query();
        if(\Auth::user()->level < 3)
        {
        	$educations = $educations->where('unit_id', \Auth::user()->unit_id);
        }
        return $educations->get();
    }

    public function unit()
    {
    	return $this->belongsTo('App\Unit');
    }

    public function __toString()
    {
    	return $this->title;
    }
}
