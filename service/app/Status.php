<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
