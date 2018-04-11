<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function balance()
    {
        return Transaction::balance()->where('user_id', $this->id)->sum('amount');
    }
}
