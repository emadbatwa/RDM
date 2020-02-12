<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Photo
 *
 * @property int $id
 * @property string $photo_path
 * @property string $photo_name
 * @property int $ticket_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Ticket $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo wherePhotoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo wherePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $role_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereRoleId($value)
 */
class Photo extends Model
{
    protected $fillable = [
        'photo_path', 'photo_name', 'ticket_id', 'role_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
