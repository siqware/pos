@extends('layouts.dashboard')
@section('title')
    បញ្ញីទំនិញ
@stop
@section('content')
    <div class="row">
        <div class="column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        បញ្ញីទំនិញ
                    </h5>
                </div>
                <div class="ui segment">
                    <table id="product_list" class="ui compact selectable striped celled table tablet stackable datatable">
                        <thead>
                        <tr>
                            <th>ល.រ</th>
                            <th></th>
                            <th>ឈ្មោះ</th>
                            <th>ប្រភេទ</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="ui standard test modal transition" style="margin-top: -234px;">
        <div class="header p-header">
        </div>
        <div class="ui grid">
            <div class="row m-2">
                <div class="five wide column">
                    <img class="p-image">
                </div>
                <div class="eleven wide column">
                    <table class="ui compact celled definition table tablet stackable">
                        <thead>
                        <tr>
                            <th colspan="2">
                                ពត៌មានទំនិញទូទៅ
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="right aligned">
                                ឈ្មោះទំនិញ
                            </td>
                            <td class="p-name">
                            </td>
                        </tr>
                        <tr>
                            <td class="right aligned">
                                ប្រភេទទំនិញ
                            </td>
                            <td class="p-category">
                            </td>
                        </tr>
                        <thead>
                        <tr>
                            <th colspan="2">
                                បម្រែបម្រួលទំនិញ
                            </th>
                        </tr>
                        </thead>
                        <tr>
                            <td class="right aligned">
                                តម្លៃប្រែប្រួល
                            </td>
                            <td>
                                <table class="ui compact celled table tablet stackable">
                                    <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>តម្លៃ</th>
                                    </tr>
                                    </thead>
                                    <tbody id="p-variations">
                                    <tr>
                                        <td>328248</td>
                                        <td>XL</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">
                ចាកចេញ
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
            let product = $('#product_list').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: '{{route('product.json')}}',
                    method: 'GET'
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'image', name: 'image',orderable:false,searchcable:false },
                    { data: 'productName', name: 'productName' },
                    { data: 'category', name: 'category' },
                    { data: 'action', name: 'action' }
                ],
            });
            $(document).on('click','.modalshow',function () {
                let product_id = $(this).attr('id');
                product_id = product_id.replace('product-','');
                product_id = parseInt(product_id);
                $.ajax({
                    type:'get',
                    url:'{{route('product.view.json')}}',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'product_id':product_id,
                    },
                    success: function (data) {
                        console.log(data);
                        $('.p-header').html(data.productName);
                        $('.p-name').html(data.productName);
                        $('.p-category').html(data.category);
                        $('.p-image').attr('src','{{asset('/')}}'+data.image);
                        let variation_row = [];
                        $.each(data.variations,function (key,value) {
                            variation_row.push('<tr>\n' +
                                '                                        <td>'+value.barcode+'</td>\n' +
                                '                                        <td>'+value.variationName+'</td>\n' +
                                '                                    </tr>');
                        });
                        $('#p-variations').html(variation_row);
                    }
                });
                $(".ui.modal").modal({
                    inverted: true,
                    blurring: false
                }).modal("show");
            });
        })
    </script>
@stop
