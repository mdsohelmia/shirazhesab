<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeBalance($query)
    {
        $query->where('invoice_id', null);
    }

    public function scopeOfUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
