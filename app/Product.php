<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function images()
    {
        return $this->hasMany('App\ProductImage');
    }
    public function items()
    {
        return $this->hasMany('App\ProductItem');
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
