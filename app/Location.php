<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Location
 *
 * @property int $id
 * @property string $description
 * @property string $location_url
 * @property float $latitude
 * @property float $longitude
 * @property int $neighborhood_id
 * @property int $city_id
 * @property-read \App\City $city
 * @property-read \App\Neighborhood $neighborhood
 * @property-read \App\Ticket $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereLocationUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Location whereNeighborhoodId($value)
 * @mixin \Eloquent
 */
class Location extends Model
{
    protected $fillable = [
        'location_url', 'latitude', 'longitude', 'neighborhood_id', 'city_id',
    ];

    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function neighborhood()
    {
        return $this->belongsTo('App\Neighborhood');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
