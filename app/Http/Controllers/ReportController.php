<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceDetail;
use App\Stock;
use App\StockDetail;
use App\Variation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function report_income_expense(){
        return view('report.income-expense');
    }
    public function report_import_export(){
        return view('report.import-export');
    }
    //Stock
    function stock_report_data(Request $request){
        $input = $request->all();
        $start = Carbon::parse($input['start']);
        $end = Carbon::parse($input['end']);
        $start = date_format($start,'Y-m-d');
        $end = date_format($end,'Y-m-d');
        $end = Carbon::create($end)->addDay(1);
        $stockData = Stock::all()->whereBetween('created_at',[$start,$end]);
        $totalPurchase = 0;
        $totalQty = 0;
        foreach ($stockData as $value){
            $totalPurchase +=$value['total_pur_price'];
            $totalQty +=$value['total_qty'];
        }
        return[
            'totalPur'=>$totalPurchase,
            'totalQty'=>$totalQty,
        ];
    }
    function stock_report_data_detail(Request $request){
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        $input = $request->all();
        $start = Carbon::parse($input['range']['start']);
        $end = Carbon::parse($input['range']['end']);
        $start = date_format($start,'Y-m-d');
        $end = date_format($end,'Y-m-d');
        $end = Carbon::create($end)->addDay(1);
        $stockData = Stock::all()->whereBetween('created_at',[$start,$end]);
        return DataTables::of($stockData)
            ->editColumn('created_at',function ($date){
                return $date->created_at->diffForHumans();
            })
            ->editColumn('total_pur_price',function ($total_pur_price){
                return money_format('%i', $total_pur_price->total_pur_price);
            })
            ->addColumn('action',function ($action){
                return '<button class="ui button mini olive btn-detail" id="'.$action->id.'"><i class="icon eye"></i></button>';
            })
            ->toJson();
    }
    function stock_report_detail(Request $request){
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        $input = $request->all();
        $stockData = StockDetail::with('variation')->where('stock_id',$input['id'])->get();
        return DataTables::of($stockData)
            ->editColumn('variation.product.image',function ($img){
                return '<img class="ui image avatar" src="'.asset($img->variation->product->image).'" alt="">';
            })
            ->editColumn('created_at',function ($date){
                return $date->created_at->diffForHumans();
            })
            ->editColumn('pur_price',function ($pur){
                return money_format('%i', $pur->pur_price);
            })
            ->rawColumns(['variation.product.image'])
            ->toJson();
    }
    //invoice
    function invoice_report_data(Request $request){
        $input = $request->all();
        $start = Carbon::parse($input['start']);
        $end = Carbon::parse($input['end']);
        $start = date_format($start,'Y-m-d');
        $end = date_format($end,'Y-m-d');
        $end = Carbon::create($end)->addDay(1);
        $stockData = Invoice::all()->whereBetween('created_at',[$start,$end]);
        $totalAmount = 0;
        $totalQty = 0;
        foreach ($stockData as $value){
            $totalAmount +=$value['total_amount'];
            $totalQty +=$value['total_qty'];
        }
        return[
            'totalAmount'=>$totalAmount,
            'totalQty'=>$totalQty,
        ];
    }
    function invoice_report_data_detail(Request $request){
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        $input = $request->all();
        $start = Carbon::parse($input['range']['start']);
        $end = Carbon::parse($input['range']['end']);
        $start = date_format($start,'Y-m-d');
        $end = date_format($end,'Y-m-d');
        $end = Carbon::create($end)->addDay(1);
        $stockData = Invoice::all()->whereBetween('created_at',[$start,$end]);
        return DataTables::of($stockData)
            ->editColumn('created_at',function ($date){
                return $date->created_at->diffForHumans();
            })
            ->editColumn('total_amount',function ($total_amount){
                return money_format('%i', $total_amount->total_amount);
            })
            ->addColumn('action',function ($action){
                return '<button class="ui button mini olive btn-detail-sell" id="'.$action->id.'"><i class="icon eye"></i></button>';
            })
            ->toJson();
    }
    function invoice_report_detail(Request $request){
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        $input = $request->all();
        $stockData = InvoiceDetail::with('stock_detail')->where('invoice_id',$input['id'])->get();
        return DataTables::of($stockData)
            ->editColumn('stock_detail.variation.product.image',function ($img){
                return '<img class="ui image avatar" src="'.asset($img->stock_detail->variation->product->image).'" alt="">';
            })
            ->editColumn('created_at',function ($date){
                return $date->created_at->diffForHumans();
            })
            ->editColumn('amount',function ($pur){
                return money_format('%i', $pur->amount);
            })
            ->rawColumns(['stock_detail.variation.product.image'])
            ->toJson();
    }
    //index check stock
    public function check_stock_index(){
        return view('report.check-stock');
    }
    //Report stock
    public function check_stock(){
        $outOrNotYetImportStock = Variation::with(['check_stock_detail','product'])->whereDoesntHave('check_stock_detail')->get();
        return DataTables::of($outOrNotYetImportStock)
            ->editColumn('product.image',function ($image){
                return '<img class="ui image avatar" src="'.asset($image->product->image).'" alt="">';
            })
            ->editColumn('created_at',function ($created_at){
                return $created_at->created_at->diffForHumans();
            })
            ->addColumn('note',function (){
                return '<div class="ui label pink">
                           <i class="bell icon"></i> មិនទាន់មានក្នុងស្តុក
                        </div>';
            })
            ->rawColumns(['product.image','note'])
            ->toJson();
    }
    public function check_stock_notification(){
        $notification_html = Variation::with(['check_stock_detail','product'])->whereDoesntHave('check_stock_detail')->get();
        $html = view('report.notification',compact('notification_html'));
        /*return $notification = [
            'count'=>1,
            'html'=>  $html
        ];*/
        $html = '';
        foreach ($notification_html as $value){
            $html .= '<div class="item">
                    <img class="ui avatar image" src="" alt="label-image" />
                    អាវប្រេន (បារកូដ: 3948398343 ទំហំ: M)
                    </div>';
        }
    }
    public function dd(){

    }
}
