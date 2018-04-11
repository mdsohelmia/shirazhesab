<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function attachments()
    {
        return $this->hasMany('App\TicketAttachment');
    }

    public function replays()
    {
        return $this->hasMany('App\TicketReplay');
    }

    public function scopeOfUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopeOpen($query)
    {
        $query->whereIn('status',['staff', 'user', 'waiting']);
    }

    public function scopeClose($query)
    {
        $query->whereIn('status',['close', 'force_close']);
    }
}
