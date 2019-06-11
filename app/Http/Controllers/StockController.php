<?php

namespace App\Http\Controllers;

use App\Product;
use App\Stock;
use App\StockDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    public function _import(Request $request){
        $input = $request->all();
        $total_qty = 0;
        $total_pur = 0;
        $total_sell = 0;
        foreach ($input['variation'] as $key => $value){
            $total_qty +=$value['qty'];
            $total_pur += $value['qty']*$value['purchase'];
            $total_sell +=$value['sell'];
        }
        $stock = new Stock();
        $stock->total_pur_price = $total_pur;
        $stock->total_sell_price = $total_sell;
        $stock->total_qty = $total_qty;
        $stock->save();
        $stock_detail = [];
        foreach ($input['variation'] as $variation_id => $value){
            $stock_detail[]=[
                'stock_id' => $stock->id,
                'variation_id' => $variation_id,
                'qty' => $value['qty'],
                'remain_qty' => $value['qty'],
                'pur_price' => $value['purchase'],
                'sell_price' => $value['sell'],
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ];
        }
        $stk_detail = StockDetail::insert($stock_detail);
        if ($stk_detail){
            return redirect()->back();
        }
    }
    public function show_stock_item($id){
        $product = Product::with('variation')->findOrFail($id);
        return view('stock.ajax_stock_item',compact('product'));
    }
    public function product_list()
    {
        $product = Product::with('variation_stock_detail')->get();
        return Datatables::of($product)
            ->addColumn('action', function ($product) {
                return '<button href="#" id="'.$product->id.'" class="ui button px-2 pink"><i class="ion-arrow-right-a icon"></i> បន្ថែម</button>';
            })
            ->addColumn('image', function ($product) {
                return '<img class="ui avatar image" src="'.asset($product->image).'" alt="">';
            })
            ->rawColumns(['action','image'])
            ->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stock.index');
    }
    public function import()
    {
        return view('stock.import');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
