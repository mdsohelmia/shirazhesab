<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceAttachment extends Model
{
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
