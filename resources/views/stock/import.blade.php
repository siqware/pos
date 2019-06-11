@extends('layouts.dashboard')
@section('title')
    ទិញទំនិញចូល
@stop
@section('content')
    <div class="row">
        <div class="sixteen wide tablet seven wide computer column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        បញ្ជីទំនិញ
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
        <div class="sixteen wide tablet nine wide computer column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        បញ្ជីទំហំទំនិញ
                    </h5>
                </div>
                {{Form::open(['url'=>route('stock._import'),'method'=>'post','class'=>'ui segment grid'])}}
                    <div class="row">
                        <div class="three wide column">
                            <h4>ពិពណ៌នា</h4>
                        </div>
                        <div class="thirteen wide column">
                            <h4>បម្រែប្រួល</h4>
                        </div>
                    </div>
                    <div class="ui divider m-0"></div>
                    <div id="stock-item" class="ui grid pt-2 mb-2 product_id">
                        {{--<div class="row">
                            <div class="three wide column middle aligned">
                                <img class="ui bordered image" src="{{asset('files/1/loyversek_1.jpg')}}" alt="">
                                <h5 class="m-0">ខោខាវបោយ</h5>
                                <div>ខោ</div>
                            </div>
                            <div class="thirteen wide column ui form">
                                <div class="three fields">
                                    <div class="field">
                                        <input type="text" disabled name="variation" value="8776823">
                                    </div>
                                    <div class="field">
                                        <input type="number" name="qty" placeholder="ចំនួន">
                                    </div>
                                    <div class="field">
                                        <input type="number" name="purchase" placeholder="តម្លៃទិញ">
                                    </div>
                                    <div class="field">
                                        <input type="number" name="sell" placeholder="តម្លៃលក់">
                                    </div>
                                </div>
                                <div class="three fields">
                                    <div class="field">
                                        <input type="text" disabled name="variation" value="8776823">
                                    </div>
                                    <div class="field">
                                        <input type="number" name="qty" placeholder="ចំនួន">
                                    </div>
                                    <div class="field">
                                        <input type="number" name="purchase" placeholder="តម្លៃទិញ">
                                    </div>
                                    <div class="field">
                                        <input type="number" name="sell" placeholder="តម្លៃលក់">
                                    </div>
                                </div>
                                <div class="three fields">
                                    <div class="field">
                                        <input type="text" disabled name="variation" value="8776823">
                                    </div>
                                    <div class="field">
                                        <input type="number" name="qty" placeholder="ចំនួន">
                                    </div>
                                    <div class="field">
                                        <input type="number" name="purchase" placeholder="តម្លៃទិញ">
                                    </div>
                                    <div class="field">
                                        <input type="number" name="sell" placeholder="តម្លៃលក់">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ui divider m-0"></div>--}}
                    </div>
                    <div class="row">
                        <div class="sixteen wide column ui form">
                            <button href="#" id="import-btn" class="ui button px-2 pink"><i class="ion-arrow-down-a icon"></i> នាំចូល</button>
                        </div>
                    </div>
                {{Form::close()}}
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
            let btnImport = document.querySelector('#import-btn');
            btnImport.disabled = true;
            let product = $('#product_list').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: '{{route('stock.product.list')}}',
                    method: 'GET'
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'image', name: 'image',orderable:false,searchcable:false },
                    { data: 'productName', name: 'productName' },
                    { data: 'category', name: 'category' },
                    { data: 'action', name: 'action' }
                ]
            });
            $(document).on('click','#product_list',function (event) {
                let proId = parseInt(event.target.id);
                let url = '{{route('stock.product.variation',':id')}}';
                url = url.replace(':id',proId);
                if (proId){
                    $.ajax({
                        url: url,
                        type: 'html',
                        method: 'get',
                        success:function (data) {
                            let addedId = document.querySelectorAll('.product_id');
                            let addedList = [];
                            $.each(addedId,function (index, value) {
                                let extractId = parseInt(value.id);
                                addedList.push(extractId);
                            });
                            if (addedList.indexOf(proId)===-1){
                                $('#stock-item').append(data);
                                let check = formValidate();
                                console.log(check);
                                let inputs = document.querySelectorAll('[type="number"]');
                                $.each(inputs,function (index,value) {
                                    $(value).keyup(function () {
                                        let check = formValidate();
                                        btnImport.disabled = check ? false : true;
                                    })
                                });
                            }
                        }
                    })
                }
            });
            $(document).on('click','#stock-item',function (event) {
                let removeBtn = event.target;
                if (removeBtn.id === 'remove') {
                    removeBtn.parentNode.parentNode.remove();
                }
            });
            function formValidate() {
                let data = [];
                let inputs = document.querySelectorAll('[type="number"]');
                $.each(inputs,function (index,value) {
                    data.push(value['value']);
                });
                if (data.indexOf('')!==-1){
                    return false;
                }
                return true;
            }
        })
    </script>
@stop
