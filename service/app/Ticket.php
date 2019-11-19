<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ticket
 *
 * @property int $id
 * @property string $description
 * @property int $assigned_to
 * @property int $user_id
 * @property int $status_id
 * @property int $location_id
 * @property int $neighborhood_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Classification $classification
 * @property-read \App\Location $location
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Photo[] $photos
 * @property-read int|null $photos_count
 * @property-read \App\Status $status
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereNeighborhoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ticket whereUserId($value)
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function classification()
    {
        return $this->belongsTo('App\Classification');
    }

    public function location()
    {
        return $this->hasOne('App\Location');
    }
}
