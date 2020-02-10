<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Track extends Model
{
    protected $dates = [
    	'start', 'end'
    ];

    public static function mine()
    {
        $tracks = Track::query();
        if(\Auth::user()->level < 3)
        {
            $tracks = $tracks->whereHas('education', function(Builder $query) {
                $query->where('unit_id', \Auth::user()->unit_id);
            });
        }
        return $tracks->get();
    }

    public function terms()
    {
        return $this->hasMany('App\Term');
    }

    public function education()
    {
    	return $this->belongsTo('App\Education');
    }
}
