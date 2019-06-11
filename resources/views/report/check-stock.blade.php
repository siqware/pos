@extends('layouts.dashboard')
@section('title')
    Blank page
@stop
@section('content')
    <div class="row">
        <div class="column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        Blank Header
                    </h5>
                </div>
                <div class="ui segment">
                    <table id="import-stock" class="ui compact selectable striped celled table tablet stackable datatable">
                        <thead>
                        <tr>
                            <th>ល.រ</th>
                            <th></th>
                            <th>ឈ្មោះទំនិញ</th>
                            <th>ប្រភេទទំនិញ</th>
                            <th>បារកូដ</th>
                            <th>ទំហំ</th>
                            <th>ចំណាំ</th>
                            <th><i class="icon time"></i></th>
                        </tr>
                        </thead>
                    </table>
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
@endpush
@section('js')
    <script>
        $(function () {
            let product = $('#import-stock').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: '{{route('report.check.stock')}}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'product.image', name: 'product.image'},
                    {data: 'product.productName', name: 'product.productName'},
                    {data: 'product.category', name: 'product.category'},
                    {data: 'barcode', name: 'barcode'},
                    {data: 'variationName', name: 'variationName'},
                    {data: 'note', name: 'note'},
                    {data: 'created_at', name: 'created_at'}
                ],

            });
        })
    </script>
@stop
