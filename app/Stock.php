<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function stockDetail(){
        return $this->hasMany('App\StockDetail','stock_id','id')->with('variation');
    }
}
