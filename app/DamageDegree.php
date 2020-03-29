<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamageDegree extends Model
{
    const SEVERE = 'SEVERE';
    const MODERATE = 'MODERATE';
    const SIMPLE = 'SIMPLE';

    protected $timestamps = false;

    protected $fillable = ['degree', 'degree_ar'];
}
