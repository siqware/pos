<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceDetail;
use App\StockDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function selling_list_barcode($barcode)
    {
        StockDetail::setBarcocde($barcode);
        return $stockItem =  StockDetail::with('variationCondition')->whereHas('variationCondition')->orderBy('created_at','asc')->where('remain_qty','>=',1)->limit(1)->get();
    }
    public function pos_invoice_detail(Request $request){
        $input = $request->all();
        $invoice = new Invoice();
        $invoice->total_amount = $input['_data']['total_amount'];
        $invoice->total_qty = $input['_data']['total_qty'];
        $invoice->save();
        $detail_data = [];
        foreach ($input['_dataDetail'] as $value){
            $detail_data[]=[
                'invoice_id'=>$invoice->id,
                'stock_detail_id'=>$value['stock_detail_id'],
                'amount'=>$value['amount'],
                'qty'=>$value['qty'],
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ];
            $updateQty = StockDetail::findOrFail($value['stock_detail_id']);
            $updateQty->remain_qty -= $value['qty'];
            $updateQty->save();
        }
        if ($invoice){
            InvoiceDetail::insert($detail_data);
            return 'success';
        }

    }
    public function selling_list()
    {
        $stockItem =  StockDetail::with('variation')->where('remain_qty','>=',1)->get();
        return Datatables::of($stockItem)->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sell.index');
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
