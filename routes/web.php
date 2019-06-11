<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('blank');
});
Route::get('dashboard', function () {return view('dashboard.index');})->name('dashboard.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/*Product Route*/
Route::resource('product','ProductController');
Route::get('product-category','ProductController@product_category')->name('product.category');
Route::get('product-view-json','ProductController@product_view_json')->name('product.view.json');
Route::post('product-variation-add/{id}','ProductController@variation_add')->name('product.variation.add');
Route::get('product-json','ProductController@product_json')->name('product.json');
Route::get('product-variation','ProductController@product_variation')->name('product.variation');
Route::get('product-variation-json/{id}','ProductController@product_variation_json')->name('product.variation.json');
/*Variation Route*/
Route::resource('variation','VariationController');
/*Media Route*/
Route::get('media',function (){return view('media.index');})->name('media.index');
/*User Route*/
Route::resource('user','UserController');
Route::put('user-role/{id}','UserController@updateRole')->name('user.updateRole');
Route::get('user-json-view','UserController@user_json_view')->name('user.json.view');
/*Stock*/
Route::resource('stock','StockController');
Route::get('stock-import','StockController@import')->name('stock.import');
Route::get('stock-product-list','StockController@product_list')->name('stock.product.list');
Route::get('stock-variation-items/{id}','StockController@show_stock_item')->name('stock.product.variation');
Route::post('stock-import-stock','StockController@_import')->name('stock._import');
/*Invoice*/
Route::resource('pos','InvoiceController');
Route::post('selling-list-barcode/{barcode}','InvoiceController@selling_list_barcode')->name('selling.list.barcode');
Route::post('selling-list','InvoiceController@selling_list')->name('selling.list');
Route::post('pos-invoice-detail','InvoiceController@pos_invoice_detail')->name('pos.invoice.detail');
/*Report*/
Route::get('report/import-export','ReportController@report_import_export')->name('report.import.export');
Route::get('report/income-expense','ReportController@report_income_expense')->name('report.income.expense');
//import
Route::post('report/stock-data','ReportController@stock_report_data')->name('report.stock.data');
Route::post('report/stock-data-detail','ReportController@stock_report_data_detail')->name('report.stock.data.detail');
Route::post('report/stock-detail','ReportController@stock_report_detail')->name('report.stock.detail');
//sell
Route::post('report/invoice-data','ReportController@invoice_report_data')->name('report.invoice.data');
Route::post('report/invoice-data-detail','ReportController@invoice_report_data_detail')->name('report.invoice.data.detail');
Route::post('report/invoice-detail','ReportController@invoice_report_detail')->name('report.invoice.detail');
//check stock
Route::get('report/check-stock-index','ReportController@check_stock_index')->name('report.check.stock.index');
Route::get('report/check-stock','ReportController@check_stock')->name('report.check.stock');
Route::get('report/check-stock-notification','ReportController@check_stock_notification')->name('report.check.stock.notification');

