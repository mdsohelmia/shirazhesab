<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceInstallment extends Model
{
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
