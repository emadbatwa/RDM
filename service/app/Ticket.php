<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function status()
    {
        return $this->hasOne('App\Status');
    }
}
