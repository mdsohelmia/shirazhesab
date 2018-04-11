<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilePurchase extends Model
{
    use SoftDeletes;
    public function file()
    {
        return $this->belongsTo('App\File');
    }
    public function scopeOfFile($query, $file_id)
    {
        return $query->where('file_id', $file_id);
    }
}
