<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $dates = ['next_at', 'due_at', 'paid_at', 'created_at', 'updated_at', 'deleted_at', 'invoice_at'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function next()
    {
        return $this->belongsTo('App\Invoice','next_invoice_id');
    }

    public function records()
    {
        return $this->hasMany('App\Record');
    }

    public function installments()
    {
        return $this->hasMany('App\InvoiceInstallment');
    }

    public function attachments()
    {
        return $this->hasMany('App\InvoiceAttachment');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
    public function province()
    {
        return $this->belongsTo('App\Province');
    }
    public function city()
    {
        return $this->belongsTo('App\City');
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
