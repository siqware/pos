<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'variations';
    protected $fillable = ['barcode','variationName'];
    public function stock_detail(){
        return $this->hasOne('App\StockDetail');
    }
    public function check_stock_detail(){
        return $this->hasOne('App\StockDetail','variation_id','id')->where('remain_qty','>=',1);
    }
    public function product(){
        return $this->belongsTo('App\Product')->select(['id','productName','category','image']);
    }
}
