<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
