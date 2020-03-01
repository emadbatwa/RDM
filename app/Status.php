<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Status
 *
 * @property int $id
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereStatus($value)
 * @mixin \Eloquent
 */
class Status extends Model
{
    const OPEN = 1;
    const ASSIGNED = 2;
    const IN_PROGRESS = 3;
    const SOLVED = 4;
    const DONE = 5;
    const CLOSED = 6;
    const EXCLUDED = 7;

    public $timestamps = false;

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
