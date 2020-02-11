<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Classification
 *
 * @property int $id
 * @property string $classification
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Classification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Classification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Classification whereClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Classification whereId($value)
 * @mixin \Eloquent
 */
class Classification extends Model
{
    const OTHER = 1;
    public $timestamps = false;

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
