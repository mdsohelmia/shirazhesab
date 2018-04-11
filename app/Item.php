<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    protected $casts = [
        'options' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function records()
    {
        return $this->hasMany('App\Record');
    }

    public function file()
    {
        return $this->hasOne('App\File');
    }

    public function getInventory()
    {
        return $this->records()->sum('quantity');
    }

    public function scopeCart($query)
    {
        return $query->where('cart', 'yes');
    }

    public function scopeEnable($query)
    {
        return $query->where('enable', 'yes');
    }

    public function scopeAsset($query)
    {
        return $query->where('asset', 'yes');
    }

    public function scopeOfCategory($query, $category_id)
    {
        return $query->where('category_id', $category_id);
    }
}
