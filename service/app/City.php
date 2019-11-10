<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    public function neighborhoods()
    {
        return $this->hasMany('App\Neighborhood');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
