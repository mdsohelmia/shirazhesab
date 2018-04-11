<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use SoftDeletes;
    public static function findWithCache($id)
    {
        if (Cache::has('page_'.$id)) {
            return Cache::get('page_'.$id);
        } else {
            $page = Page::findOrFail($id);
            Cache::forever('page_'.$id, $page);
            return $page;
        }
    }
}
