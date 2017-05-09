<?php

namespace App;

use App\UserInventory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $table = 'inventory';
    public function userInventory()  {
        return $this->belongsToMany('\App\User', 'userinventory', 'inventory_id', 'user_id')->withPivot('size', 'price', 'in_stock', 'id')->withTimestamps();
    }
    public function setPrice($mini_price, $hp_price, $pint_price, $fifth_price, $liter_price, $hg_price) {
        if(empty($mini_price)){
            $mini_price = 0.00;
        }
        if(empty($hp_price)){
            $hp_price = 0.00;
        }
        if(empty($pint_price)){
            $pint_price = 0.00;
        }
        if(empty($fifth_price)){
            $fifth_price = 0.00;
        }
        if(empty($liter_price)){
            $liter_price = 0.00;
        }
        if(empty($hg_price)){
            $hg_price = 0.00;
        }
        $array = ['mini_price' => round($mini_price, 2), 'hp_price' => round($hp_price, 2), 'pint_price' => round($pint_price, 2), 'fifth_price' => round($fifth_price, 2), 'liter_price' => round($liter_price, 2), 'hg_price' => round($hg_price, 2) ];
       return $this->price = json_encode($array);
    }
    public function priceDecode() {
       return json_decode($this->price);
    }

}
