@extends('layouts.dashboard')
@section('title')
    លក់ទំនិញ
@stop
@section('content')
    <div class="row">
        <div class="sixteen wide tablet eleven wide computer column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <div class="ui left action fluid right icon input">
                        <div class="ui search selection category dropdown" id="category">
                            <input type="hidden" placeholder="ប្រភេទទំនិញ">
                            <i class="dropdown icon"></i>
                            <input type="text" class="search">
                            <div class="default text">ជ្រើសរើស ប្រភេទទំនិញ</div>
                        </div>
                        <button class="ui button red" id="btnClear"><i class="eraser icon"></i> សម្អាត</button>
                        <input type="text" id="search" placeholder="ស្វែងរកទំនិញ.....">
                        <i class="search icon"></i>
                    </div>
                    <table id="product_list" class="ui compact selectable striped celled table tablet stackable datatable">
                        <thead>
                        <tr>
                            <th>ល.រ</th>
                            <th></th>
                            <th>barcode</th>
                            <th>ឈ្មោះ</th>
                            <th>ប្រភេទ</th>
                            <th>ទំហំ</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="sixteen wide tablet five wide computer column pl-0">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        បញ្ញីលក់
                    </h5>
                </div>
                <div class="ui segment">
                    <div class="ui divided list" id="order-list">
                        <h4>ស្កេន ឫចុចលើផ្ទាំងទំនិញ</h4>
                    </div>
                </div>
                <div class="ui segment">
                    <div class="ui bottom attached huge button rounded-0 green" id="btn-invoice">
                        គិតលុយ $<span id="total_amount">0.00</span> <i class="ion-cash large icon ml-1 icon-cash"></i>
                    </div>
                    <div class="ui bottom attached huge button rounded-0 primary" id="btn-print">
                        ព្រីន <i class="ion-cash large icon ml-1 ion-printer"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('css')
    <link rel="stylesheet" href="">
@endpush
@push('js')
    <script src="{{asset('sigware/plugins/datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('sigware/js/customjs/custom-datatable.js')}}"></script>
    <script src="{{asset('sigware/js/jquery.scannerdetection.js')}}"></script>
@endpush
@section('js')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            let product = $('#product_list').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: '{{route('selling.list')}}',
                    method: 'post'
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'variation.product.image', name: 'variation.product.image'},
                    {data: 'variation.barcode', name: 'variation.barcode'},
                    {data: 'variation.product.productName', name: 'variation.product.productName'},
                    {data: 'variation.product.category', name: 'variation.product.category'},
                    {data: 'variation.variationName', name: 'variation.variationName'},
                ],
                drawCallback: function (settings) {
                    let wrapper = $('#product_list_wrapper .sixteen');
                    wrapper.addClass('ui five doubling cards');
                    wrapper.css('display', 'flex');
                    wrapper.html('');
                    $('#product_list_filter').remove();
                    $('#product_list').remove();
                    $.each(settings.json.data, function (key, val) {
                        $('#product_list_wrapper .sixteen').append('<a class="card card-item" id="' + val.variation.barcode + '">\n' +
                            '                            <div class="image">\n' +
                            '                                <img class="ui wireframe image" src="{{asset('')}}' + val.variation.product.image + '">\n' +
                            '                            </div>\n' +
                            '                            <div class="extra">\n' +
                            '                                (ទំហំ: ' + val.variation.variationName + ') ' + val.variation.product.productName + '(' + val.variation.barcode + ')\n' +
                            '                            </div>\n' +
                            '                        </a>');
                    })
                }
            });
            $('.ui.search.selection.category').dropdown({
                apiSettings: {
                    url: '{{route('product.category')}}',
                    cache: false
                },
                onChange: function (value, text, $choice) {
                    product.column(4).search(value).draw();
                },
                saveRemoteData: false,
                filterRemoteData: true
            });
            $('#search').on('change keyup', function () {
                product.search($(this).val()).draw();
            });
            $('#btnClear').on('click', function () {
                product.search('').columns().search('').draw();
            });
            //POS
            let posController = (function () {
                let pos = {
                    orderInvoiceDetail: [],
                    orderInvoice: {
                        "total_amount": 0,
                        "total_qty": 0,
                    },
                    resetData:function () {
                        this.orderInvoiceDetail = [];
                        this.orderInvoice.total_amount = 0;
                        this.orderInvoice.total_qty = 0;
                    }
                };
                return {
                    posData: function () {
                        return pos;
                    }
                }
            })();
            //UI
            let UIController = (function (posCtrl) {
                let dataTotal = posCtrl.posData().orderInvoice;
                let checkIdList = [];
                let DOMstrings = {
                    cardItem: '.card-item',
                };
                let updateOrder = {
                    updateOrderList : function() {
                        $('#order-list').html('');
                        let assetUrl = '{{asset('')}}';
                        let dataOrderList = posCtrl.posData().orderInvoiceDetail;
                        $.each(dataOrderList,function (key,value) {
                            let listItem = '<div class="item item-list" id="%barcodeId%">\n' +
                                '                            <img style="width: 50px; min-height: 50px;" class="ui image" src="%image-src%">\n' +
                                '                            <div class="content">\n' +
                                '                                <div class="header">%productName%</div>\n' +
                                '                                ទំហំ: %size% (%barcode%)' +
                                '\n' +
                                '                            </div>\n' +
                                '                            <div class="right floated content">\n' +
                                '                                <div class="ui left labeled button m-0">\n' +
                                '                                    <a class="ui basic label pink border-0">\n' +
                                '                                        <span class="green">$%amount% x <span class="qty">%qty%</span></span>\n' +
                                '                                    </a>\n' +
                                '                                    <div id="%id%" class="mini ui icon button rounded-circle pink remove-item">\n' +
                                '                                        <i class="remove icon"></i>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </div>\n' +
                                '                        </div>';
                            let img = value.image;
                            listItem = listItem.replace('%image-src%',assetUrl+img);
                            listItem = listItem.replace('%productName%',value.productName);
                            listItem = listItem.replace('%size%',value.variationName);
                            listItem = listItem.replace('%barcode%',value.barcode);
                            listItem = listItem.replace('%amount%',parseFloat(value.amount).toFixed(2));
                            listItem = listItem.replace('%qty%',value.qty);
                            listItem = listItem.replace('%id%',value.barcode);
                            listItem = listItem.replace('%barcodeId%',value.barcode);
                            $('#order-list').append(listItem);
                        });
                    },
                    updateTotalAmount:function () {
                        $('#total_amount').text(parseFloat(dataTotal.total_amount).toFixed(2));
                    },
                    disableAbleBtn:function () {
                        if (posCtrl.posData().orderInvoiceDetail.length<=0){
                            $('#btn-invoice').addClass('disabled');
                            $('#btn-print').addClass('disabled');
                        } else {
                            $('#btn-invoice').removeClass('disabled');
                            $('#btn-print').removeClass('disabled');
                        }
                    }
                };
                return {
                    getDOMString: function () {
                        return DOMstrings;
                    },
                    updateOrderList:function () {
                        return updateOrder;
                    }
                }
            })(posController);
            //Controller
            let Controller = (function (posCtrl, UICtrl) {
                let DOM = UICtrl.getDOMString();
                //calc total amount and aty from invoice detail
                let calcTotal = function () {
                    let totalQty = 0,totalAmount = 0;
                    $.each(posCtrl.posData().orderInvoiceDetail,function (key,val) {
                        totalQty+= val.qty;
                        totalAmount += (val.amount*val.qty);
                    });
                    //add total qty and amount to object
                    posCtrl.posData().orderInvoice.total_qty= totalQty;
                    posCtrl.posData().orderInvoice.total_amount = totalAmount;
                };
                //barcode scan function
                let barcodeScan = function (barcode) {
                    let url = '{{route('selling.list.barcode',':barcode')}}';
                    url = url.replace(':barcode', barcode);
                    $.ajax({
                        method: 'post',
                        type: 'json',
                        url: url,
                        success: function (data) {
                            if (data.length !== 0) {
                                //check barcode existed when scan
                                let data_exist = [];
                                //check if data existed in orderList object
                                $.each(posCtrl.posData().orderInvoiceDetail, function (key, value) {
                                    if (value.barcode === barcode) {
                                        data_exist.push(barcode)
                                    } else {
                                        data_exist.push(0);
                                    }
                                });
                                //check if existed data
                                if (data_exist.indexOf(barcode) === -1) {
                                    //if data not existed add to invoice array
                                    let invoiceDetail = {
                                        "stock_detail_id": data[0].id,
                                        "variation_id": data[0].variation_condition.id,
                                        "remain_qty": data[0].remain_qty,
                                        "qty": 1,
                                        "amount": parseFloat(data[0].sell_price).toFixed(2),
                                        "productName": data[0].variation_condition.product.productName,
                                        "image": data[0].variation_condition.product.image,
                                        "variationName": data[0].variation_condition.variationName,
                                        "barcode": data[0].variation_condition.barcode
                                    };
                                    posCtrl.posData().orderInvoiceDetail.push(invoiceDetail);
                                } else {
                                    //if existed update qty
                                    $.each(posCtrl.posData().orderInvoiceDetail, function (key, val) {
                                        //check if val is valid
                                        if (val!==undefined){
                                            if (barcode === val.barcode) {
                                                //check out of stock or not
                                                if (val.remain_qty === val.qty) {
                                                    //message case out of stock
                                                    alert('គ្មានចំនួនក្នុងស្តុក');
                                                } else {
                                                    //if not out stock update qty
                                                    val.qty += 1;
                                                }
                                            }
                                        }
                                    });
                                }
                                //calc total amount and aty from invoice detail
                                calcTotal();
                                //update order list
                                UICtrl.updateOrderList().updateOrderList();
                                //update total amount
                                UICtrl.updateOrderList().updateTotalAmount();
                                //disable btn
                                UICtrl.updateOrderList().disableAbleBtn();
                            }else {
                                alert('គ្មានទំនិញក្នុងស្តុក');
                            }
                        }
                    });
                };
                let scannerObject = {
                    onComplete: function (barcode) {
                        //select product by barcode
                        barcodeScan(barcode);
                    } // main callback function
                };
                //delete order list function
                let deleteOrderList = function () {
                    let _parentNode = $(this.parentNode.parentNode.parentNode);
                    let barcode = $(this)['context'].id;
                    $.each(posCtrl.posData().orderInvoiceDetail, function (key, val) {
                        if (val!==undefined){
                            if (barcode === val.barcode) {
                                if (val.qty>1){
                                    val.qty -= 1;
                                    _parentNode.find('span.qty').text(val.qty);
                                    //calc total
                                    calcTotal();
                                    //update total amount
                                    UICtrl.updateOrderList().updateTotalAmount();
                                } else {
                                    $(_parentNode).remove();
                                    posCtrl.posData().orderInvoiceDetail.splice(key,1);
                                    //calc total
                                    calcTotal();
                                    //update total amount
                                    UICtrl.updateOrderList().updateTotalAmount();
                                    //disable btn
                                    UICtrl.updateOrderList().disableAbleBtn();
                                }
                            }
                        }
                    });
                };
                //invoicing function
                let invoicing = function () {
                    let _data = (posCtrl.posData().orderInvoice);
                    let _dataDetail = (posCtrl.posData().orderInvoiceDetail);
                    $.ajax({
                        method:'post',
                        type: 'html',
                        data:{
                            '_token':'{{csrf_token()}}',
                            '_data':_data,
                            '_dataDetail':_dataDetail
                        },
                        url: '{{route('pos.invoice.detail')}}',
                        success:function (data) {
                            if (data==='success'){
                                posCtrl.posData().resetData();
                                UICtrl.updateOrderList().updateOrderList();
                                UICtrl.updateOrderList().updateTotalAmount();
                                //disable btn
                                UICtrl.updateOrderList().disableAbleBtn();
                            }
                        }
                    });
                };
                function setupEventListeners() {
                    //barcode scanner event listener
                    $(document).scannerDetection(scannerObject);
                    //item list click event listener
                    $(document).on('click', DOM.cardItem, function () {barcodeScan($(this)[0].id);});
                    //delete order list event listener
                    $(document).on('click','.remove-item',deleteOrderList);
                    //invoice click event listener
                    $(document).on('click','#btn-invoice',invoicing);
                    $(document).on('click','#btn-print',function () {
                        invoicing();
                        //show invoice
                    });
                }

                return {
                    init: function () {
                        console.log('Application has started.');
                        //hide sidebar
                        ManuelSideBarIsHide = true;
                        if (!ManuelSideBarIsState) {
                            resizeSidebar("1");
                            ManuelSideBarIsState = true;
                        } else {
                            resizeSidebar("0");
                            ManuelSideBarIsState = false;
                        }
                        UICtrl.updateOrderList().disableAbleBtn();
                        setupEventListeners();
                    }
                };
            })(posController, UIController);
            Controller.init();
        });
    </script>
@stop
