<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;

    protected $fillable = [
        'name', 'email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dispatchesEvents = [
        'created' => 'App\Events\UserCreated',
    ];


    //
    //Relationships
    public function educations()
    {
        return $this->hasMany('App\Education');
    }

    public function tracks()
    {
        return $this->hasMany('App\Track');
    }

    public function terms()
    {
        return $this->hasMany('App\Term');
    }

    public function mentor()
    {
        return $this->belongsTo('App\User', 'mentor_id');
    }

    public function students()
    {
        return $this->hasMany('App\User', 'mentor_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
}
