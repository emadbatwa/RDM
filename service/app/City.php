<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\City
 *
 * @property int $id
 * @property string $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Location[] $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Neighborhood[] $neighborhoods
 * @property-read int|null $neighborhoods_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereId($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    public $timestamps = false;

    public function neighborhoods()
    {
        return $this->hasMany('App\Neighborhood');
    }

    public function locations()
    {
        return $this->hasMany('App\Location');
    }
}
