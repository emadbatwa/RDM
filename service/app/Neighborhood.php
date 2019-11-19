<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function location()
    {
        return $this->belongsTo('App\City');
    }
}
