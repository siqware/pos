@extends('layouts.dashboard')
@section('title')
    របាយការណ៍ - ចំណូល/ចំណាយ
@stop
@section('content')
    <div class="row">
        <div class="sixteen wide tablet sixteen wide computer column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">ចំណូល/ចំណាយ</h5>
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
@stop
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('sigware/css/daterangepicker.css')}}"/>
@endpush
@push('js')
    <script type="text/javascript" src="{{asset('sigware/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('sigware/js/daterangepicker.min.js')}}"></script>
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
        })
    </script>
@stop
