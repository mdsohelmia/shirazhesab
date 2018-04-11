<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileDownload extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'file_id'
    ];
    public function file()
    {
        return $this->belongsTo('App\File');
    }
}
