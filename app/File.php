<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function downloads()
    {
        return $this->hasMany('App\FileDownload');
    }
    public function versions()
    {
        return $this->hasMany('App\FileVersion');
    }
    public function purchases()
    {
        return $this->hasMany('App\FilePurchase');
    }
    public function version()
    {
        return $this->belongsTo('App\FileVersion','id','file_id');
    }
    public function scopePublished($query)
    {
        return $query->where('published', 'yes');
    }

    public function scopeTop($query)
    {
        return $query->where('top', 'yes');
    }
}
