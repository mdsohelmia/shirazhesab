<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LastMessage extends Model
{
    protected $casts = [
        'message' => 'array',
    ];
}
