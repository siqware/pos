<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public function variation(){
        return $this->hasMany('App\Variation');
    }
    public function variations(){
        return $this->hasMany('App\Variation');
    }
    public function variation_stock_detail(){
        return $this->hasMany('App\Variation');
    }
}
