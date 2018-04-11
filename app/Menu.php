<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function scopeActive($query)
    {
        return $query->where('active', 'yes');
    }
    public function scopeDisable($query)
    {
        return $query->where('active', 'no');
    }
}
