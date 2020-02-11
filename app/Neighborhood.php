<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Neighborhood
 *
 * @property int $id
 * @property string $neighborhood
 * @property int $city_id
 * @property-read \App\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Location[] $location
 * @property-read int|null $location_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Neighborhood newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Neighborhood newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Neighborhood query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Neighborhood whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Neighborhood whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Neighborhood whereNeighborhood($value)
 * @mixin \Eloquent
 * @property string $name_ar
 * @property string $name_en
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Neighborhood whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Neighborhood whereNameEn($value)
 */
class Neighborhood extends Model
{
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function location()
    {
        return $this->hasMany('App\Location');
    }
}
