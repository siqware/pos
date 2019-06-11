@extends('layouts.dashboard')
@section('title')
    ផ្ទាំងគ្រប់គ្រង
@stop
@section('content')
    <div class="row">
        <div class="sixteen wide tablet sixteen wide computer column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">ចំណូលចំណាយ</h5>
                </div>
                <div class="ui segment">
                    <div class="ui input">
                        <div id="reportrange-imp-sell"
                             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="icon calendar"></i>&nbsp;
                            <span></span> <i class="icon caret down"></i>
                        </div>
                    </div>
                </div>
                <div class="ui segment grid">
                    <div class="row">
                        <div class="eight wide tablet eight wide computer column">

                            <div class="ui segment left aligned">

                                <div class="ui  statistic">
                                    <div class="value counter">
                                        $<span id="expense">0.00</span>
                                    </div>
                                    <div class="label">
                                        ចំណាយ
                                    </div>
                                    <i class="icon ion-cash teal statisticIcon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="eight wide tablet eight wide computer column">

                            <div class="ui segment left aligned">

                                <div class="ui  statistic">
                                    <div class="value">
                                        $<span id="income">0.00</span>
                                    </div>
                                    <div class="label">
                                        ចំណូល
                                    </div>
                                    <i class="icon ion-cash teal statisticIcon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="eight wide tablet eight wide computer column">

                            <div class="ui segment left aligned">

                                <div class="ui  statistic">
                                    <div class="value">
                                        $<span id="revenue">0.00</span>
                                    </div>
                                    <div class="label">
                                        ចំណេញ/ខាត
                                    </div>
                                    <i class="icon ion-cash teal statisticIcon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="sixteen wide tablet eight wide computer column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">ទិញចូល</h5>
                </div>
                <div class="ui segment">
                    <div class="ui input">
                        <div id="reportrange"
                             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="icon calendar"></i>&nbsp;
                            <span></span> <i class="icon caret down"></i>
                        </div>
                    </div>
                </div>
                <div class="ui segment grid">
                    <div class="row">
                        <div class="eight wide tablet eight wide computer column">

                            <div class="ui segment left aligned">

                                <div class="ui  statistic">
                                    <div class="value counter">
                                        $<span id="totalPur">0.00</span>
                                    </div>
                                    <div class="label">
                                        តម្លៃទិញ
                                    </div>
                                    <i class="icon ion-cash teal statisticIcon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="eight wide tablet eight wide computer column">

                            <div class="ui segment left aligned">

                                <div class="ui  statistic">
                                    <div class="value counter">
                                        <span id="totalQty">0.00</span>
                                    </div>
                                    <div class="label">
                                        ចំនួនទិញ
                                    </div>
                                    <i class="icon ion-android-cart teal statisticIcon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui segment">
                    <table id="import-stock" class="ui compact selectable striped celled table tablet stackable datatable">
                        <thead>
                        <tr>
                            <th>ល.រ</th>
                            <th>តម្លៃទិញសរុប</th>
                            <th>ចំនួនសរុប</th>
                            <th><i class="icon time"></i></th>
                            <th>លម្អិត</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="sixteen wide tablet eight wide computer column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">លក់ចេញ</h5>
                </div>
                <div class="ui segment">
                    <div class="ui input">
                        <div id="reportrange-sell"
                             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="icon calendar"></i>&nbsp;
                            <span></span> <i class="icon caret down"></i>
                        </div>
                    </div>
                </div>
                <div class="ui segment grid">
                    <div class="row">
                        <div class="eight wide tablet eight wide computer column">

                            <div class="ui segment left aligned">

                                <div class="ui  statistic">
                                    <div class="value counter">
                                        $<span id="totalAmount-sell">0.00</span>
                                    </div>
                                    <div class="label">
                                        តម្លៃទិញ
                                    </div>
                                    <i class="icon ion-cash teal statisticIcon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="eight wide tablet eight wide computer column">
                            <div class="ui segment left aligned">
                                <div class="ui  statistic">
                                    <div class="value counter">
                                        <span id="totalQty-sell">0.00</span>
                                    </div>
                                    <div class="label">
                                        ចំនួនទិញ
                                    </div>
                                    <i class="icon ion-ios-cart teal statisticIcon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui segment">
                    <table id="import-stock-sell"
                           class="ui compact selectable striped celled table tablet stackable datatable">
                        <thead>
                        <tr>
                            <th>ល.រ</th>
                            <th>តម្លៃទិញសរុប</th>
                            <th>ចំនួនសរុប</th>
                            <th><i class="icon time"></i></th>
                            <th>លម្អិត</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        {{--modal--}}
        <div class="ui small test modal">
            <div class="header">
                លម្អិតទំនិញ
            </div>
            <div class="content">
                <table id="import-stock-modal" class="ui compact selectable striped celled table tablet stackable datatable">
                    <thead>
                    <tr>
                        <th>ល.រ</th>
                        <th></th>
                        <th>ឈ្មោះ</th>
                        <th>ប្រភេទទំនិញ</th>
                        <th>ទំហំ</th>
                        <th>តម្លៃទិញចូល</th>
                        <th>ចំនួន</th>
                        <th><i class="icon time"></i></th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="actions">
                <div class="ui positive right labeled icon button">
                    បិទ
                    <i class="ion-close icon"></i>
                </div>
            </div>
        </div>
    </div>
@stop
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('sigware/css/daterangepicker.css')}}"/>
@endpush
@push('js')
    <script type="text/javascript" src="{{asset('sigware/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('sigware/js/daterangepicker.min.js')}}"></script>
    <script src="{{asset('sigware/plugins/datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('sigware/js/customjs/custom-datatable.js')}}"></script>
@endpush
@section('js')
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
            //import
            var start = moment().subtract(29, 'days');
            var end = moment();
            function cbImpSell(start, end) {
                $('#reportrange-imp-sell span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $.ajax({
                    method: 'post',
                    type: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'start': start.format('MMMM D, YYYY'),
                        'end': end.format('MMMM D, YYYY'),
                    },
                    url: '{{route('report.stock.data')}}',
                    success: function (data) {
                        $('#expense').text(parseFloat(data.totalPur).toFixed(2));
                        $.ajax({
                            method: 'post',
                            type: 'json',
                            data: {
                                '_token': '{{csrf_token()}}',
                                'start': start.format('MMMM D, YYYY'),
                                'end': end.format('MMMM D, YYYY'),
                            },
                            url: '{{route('report.invoice.data')}}',
                            success: function (_data) {
                                $('#income').text(parseFloat(_data.totalAmount).toFixed(2));
                                let lostProfit = parseFloat(_data.totalAmount - data.totalPur).toFixed(2);
                                $('#revenue').text(lostProfit);
                            }
                        });
                    }
                });

            }
            $('#reportrange-imp-sell').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'ថ្ងៃនេះ': [moment(), moment()],
                    'ម្សិលមិញ': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'ប្រាំពីរថ្ងៃមុន': [moment().subtract(6, 'days'), moment()],
                    'សាមសិបថ្ងៃមុន': [moment().subtract(29, 'days'), moment()],
                    'ខែនេះ': [moment().startOf('month'), moment().endOf('month')],
                    'ខែមុន': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'ឆ្នាំនេះ': [moment().startOf('year'), moment().endOf('year')],
                    'ឆ្នាំមុន': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                }
            }, cbImpSell);
            cbImpSell(start, end);
            /*import export*/
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $.ajax({
                    method: 'post',
                    type: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'start': start.format('MMMM D, YYYY'),
                        'end': end.format('MMMM D, YYYY'),
                    },
                    url: '{{route('report.stock.data')}}',
                    success: function (data) {
                        $('#totalPur').text(parseFloat(data.totalPur).toFixed(2));
                        $('#totalQty').text(data.totalQty);
                        let product = $('#import-stock').DataTable({
                            destroy: true,
                            processing: true,
                            serverSide: true,
                            deferRender: true,
                            ajax: {
                                url: '{{route('report.stock.data.detail')}}',
                                method:'post',
                                data: {
                                    'range' : {'start':start.format('MMMM D, YYYY'),'end':end.format('MMMM D, YYYY')},
                                }
                            },
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'total_pur_price', name: 'total_pur_price'},
                                {data: 'total_qty', name: 'total_qty'},
                                {data: 'created_at', name: 'created_at'},
                                {data: 'action', name: 'action'},
                            ],

                        });
                    }
                });
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'ថ្ងៃនេះ': [moment(), moment()],
                    'ម្សិលមិញ': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'ប្រាំពីរថ្ងៃមុន': [moment().subtract(6, 'days'), moment()],
                    'សាមសិបថ្ងៃមុន': [moment().subtract(29, 'days'), moment()],
                    'ខែនេះ': [moment().startOf('month'), moment().endOf('month')],
                    'ខែមុន': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'ឆ្នាំនេះ': [moment().startOf('year'), moment().endOf('year')],
                    'ឆ្នាំមុន': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                }
            }, cb);
            cb(start, end);
            //modal import
            $(document).on('click','.btn-detail',function () {
                $(".ui.modal.small").modal('show');
                //aa
                let product = $('#import-stock-modal').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    ajax: {
                        url: '{{route('report.stock.detail')}}',
                        method:'post',
                        data: {
                            'id' : $(this).attr('id'),
                        }
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'variation.product.image', name: 'variation.product.image'},
                        {data: 'variation.product.productName', name: 'variation.product.productName'},
                        {data: 'variation.product.category', name: 'variation.product.category'},
                        {data: 'variation.variationName', name: 'variation.variationName'},
                        {data: 'pur_price', name: 'pur_price'},
                        {data: 'qty', name: 'qty'},
                        {data: 'created_at', name: 'created_at'},
                    ],

                });
            });
            //sell
            function cbSell(start, end) {
                $('#reportrange-sell span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $.ajax({
                    method: 'post',
                    type: 'json',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'start': start.format('MMMM D, YYYY'),
                        'end': end.format('MMMM D, YYYY'),
                    },
                    url: '{{route('report.invoice.data')}}',
                    success: function (data) {
                        $('#totalAmount-sell').text(parseFloat(data.totalAmount).toFixed(2));
                        $('#totalQty-sell').text(data.totalQty);
                        let product = $('#import-stock-sell').DataTable({
                            destroy: true,
                            processing: true,
                            serverSide: true,
                            deferRender: true,
                            ajax: {
                                url: '{{route('report.invoice.data.detail')}}',
                                method:'post',
                                data: {
                                    'range' : {'start':start.format('MMMM D, YYYY'),'end':end.format('MMMM D, YYYY')},
                                }
                            },
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'total_amount', name: 'total_amount'},
                                {data: 'total_qty', name: 'total_qty'},
                                {data: 'created_at', name: 'created_at'},
                                {data: 'action', name: 'action'},
                            ],

                        });
                    }
                });
            }
            $('#reportrange-sell').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'ថ្ងៃនេះ': [moment(), moment()],
                    'ម្សិលមិញ': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'ប្រាំពីរថ្ងៃមុន': [moment().subtract(6, 'days'), moment()],
                    'សាមសិបថ្ងៃមុន': [moment().subtract(29, 'days'), moment()],
                    'ខែនេះ': [moment().startOf('month'), moment().endOf('month')],
                    'ខែមុន': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'ឆ្នាំនេះ': [moment().startOf('year'), moment().endOf('year')],
                    'ឆ្នាំមុន': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                }
            }, cbSell);
            cbSell(start, end);
            //modal sell
            $(document).on('click','.btn-detail-sell',function () {
                $(".ui.modal.small").modal('show');
                //modal table
                let product = $('#import-stock-modal').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    ajax: {
                        url: '{{route('report.invoice.detail')}}',
                        method:'post',
                        data: {
                            'id' : $(this).attr('id'),
                        }
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'stock_detail.variation.product.image', name: 'stock_detail.variation.product.image'},
                        {data: 'stock_detail.variation.product.productName', name: 'stock_detail.variation.product.productName'},
                        {data: 'stock_detail.variation.product.category', name: 'stock_detail.variation.product.category'},
                        {data: 'stock_detail.variation.variationName', name: 'stock_detail.variation.variationName'},
                        {data: 'amount', name: 'amount'},
                        {data: 'qty', name: 'qty'},
                        {data: 'created_at', name: 'created_at'},
                    ],

                });
            });

        })
    </script>
@stop
