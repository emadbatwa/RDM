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
    const OPEN = 'OPEN';
    const ASSIGNED = 'ASSIGNED';
    const IN_PROGRESS = 'IN_PROGRESS';
    const SOLVED = 'SOLVED';
    const DONE = 'DONE';
    const CLOSED = 'CLOSED';
    const EXCLUDED = 'EXCLUDED';

    public $timestamps = false;

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
