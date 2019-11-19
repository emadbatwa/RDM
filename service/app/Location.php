<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $timestamps = false;

    public function city()
    {
        return $this->hasOne('App\City');
    }

    public function neighborhood()
    {
        return $this->hasOne('App\Neighborhood');
    }
}
