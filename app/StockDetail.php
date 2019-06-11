<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{
    protected $table = 'stock_details';
    public static $barcode;
    public static function setBarcocde($barcode){
        self::$barcode=$barcode;
    }
    public function variationCondition(){
        return $this->belongsTo('App\Variation','variation_id','id')
            ->with('product')
            ->select(['id','product_id','variationName','barcode'])->where('barcode','=',''.self::$barcode.'');
    }
    public function variation(){
        return $this->belongsTo('App\Variation')->with('product')->select(['id','product_id','variationName','barcode']);
    }
}
