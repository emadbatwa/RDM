<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserRating
 *
 * @property int $id
 * @property int $rating
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRating query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRating whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserRating whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserRating extends Model
{
    protected $fillable = ['rating', 'comment'];
}
