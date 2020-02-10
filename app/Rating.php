<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function rating_scale()
    {
    	return $this->belongsTo('App\RatingScale');
    }
}
