<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gateway extends Model
{
    use SoftDeletes;
    public function getInventory()
    {
        return $this->transactions()->sum('amount');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
