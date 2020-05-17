<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamageDegree extends Model
{
    const SEVERE = 'SEVERE';
    const MODERATE = 'MODERATE';
    const SIMPLE = 'SIMPLE';

    public $timestamps = false;

    public $fillable = ['degree', 'degree_ar'];
}
