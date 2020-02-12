<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TicketHistory
 *
 * @property int $id
 * @property string $massage
 * @property int $sender
 * @property int $receiver
 * @property int $ticket_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory whereMassage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory whereReceiver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory whereSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TicketHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketHistory extends Model
{
    protected $fillable = ['massage', 'sender', 'receiver', 'ticket_id'];
}
