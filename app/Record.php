<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
