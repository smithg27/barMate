<?php

namespace App;

use App\UserInventory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function inventory() {
        return $this->belongsToMany('\App\Inventory', 'userinventory', 'user_id', 'inventory_id')->withPivot('in_stock', 'id', 'price', 'size')->withTimestamps();
    }
}
