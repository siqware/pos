<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    public function stock_detail(){
        return $this->belongsTo('App\StockDetail','stock_detail_id','id')->with('variation');
    }
}
