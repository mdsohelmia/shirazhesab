<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function records()
    {
        return $this->hasMany('App\Record');
    }
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
    public function scopeDue($query)
    {
        return $query->where('status', '!=', 'paid');
    }

    public function scopeOfUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

}
