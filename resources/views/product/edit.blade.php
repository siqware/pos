@extends('layouts.dashboard')
@section('title')
    កែប្រែទំនិញ
@stop
@section('content')
    <div class="row">
        <div class="column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        កែប្រែទំនិញ
                    </h5>
                </div>
                {{Form::open(['url'=>route('product.update',$product->id),'method'=>'put','class'=>'ui form segment'])}}
                {{csrf_field()}}
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
                        <td class="three wide column right aligned">រូបភាព</td>
                        <td class="thirteen wide column">
                            <div class="ui input popupHover m-0" id="lfm" data-input="profile" data-preview="profile_holder" data-content="ដាក់រូបភាព" data-variation="larg">
                                <div class="ui button m-0">
                                    <img id="profile_holder" src="{{asset($product->image)}}" style="margin-top:15px;max-height:100px;">
                                </div>
                                <input id="profile" type="hidden" value="{{$product->image}}" name="product_picture">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="right aligned">
                            ទំនិញ
                        </td>
                        <td>
                            <div class="three fields m-0">
                                <div class="field">
                                    <label>ឈ្មោះទំនិញ</label>
                                    <input type="text" name="product_name" value="{{$product->productName}}" placeholder="ឈ្មោះទំនិញ">
                                </div>
                                <div class="field">
                                    <label>ប្រភេទទំនិញ</label>
                                    <div class="ui search selection allowAdditions category dropdown" id="province">
                                        <input type="hidden" name="product_category" placeholder="ប្រភេទទំនិញ" value="{{$product->category}}">
                                        <i class="dropdown icon"></i>
                                        <input type="text" class="search">
                                        <div class="default text">{{$product->category}}</div>
                                    </div>
                                </div>
                            </div>
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
                            <div class="ui segment">
                                <div id="child_el" class="four fields m-0">
                                    <div class="field">
                                        <div class="ui search selection allowAdditions variation dropdown" id="province">
                                            <input type="hidden" name="variation[0]">
                                            <i class="dropdown icon"></i>
                                            <input type="text" class="search">
                                            <div class="text"></div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <span class="ui positive button" id="add-child"><i class="add icon"></i>បន្ថែម</span>
                                    </div>
                                </div>
                                <table id="variation_list" class="ui data-table compact selectable striped celled table tablet stackable datatable">
                                    <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>តម្លៃ</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot class="full-width">
                    <tr>
                        <th colspan="4">
                            <button class="ui small primary labeled icon button hiddenui">
                                <i class="save icon"></i> រក្សារទុក
                            </button>
                        </th>
                    </tr>
                    </tfoot>
                </table>
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
    <script src="{{asset('vendor/laravel-filemanager/js/lfm.js')}}"></script>
@endpush
@section('js')
    <script>
        $(function () {
            function additionDropdownVariation(selector,url){
                let variationAddiction = document.querySelectorAll(selector);
                $.each(variationAddiction,function (key,value) {
                    $(value).dropdown({
                        onChange: this.onChange,
                        allowAdditions: true,
                        forceSelection: true,
                        hideAdditions: false,
                        apiSettings: {
                            url: url,
                            cache: false
                        },
                        saveRemoteData:false,
                        filterRemoteData: true
                    });
                });
            }
            additionDropdownVariation('.ui.allowAdditions.variation','{{route('product.variation')}}');
            additionDropdownVariation('.ui.allowAdditions.category','{{route('product.category')}}');
            let url = '{{route('product.variation.json',':id')}}';
            url = url.replace(':id','{{$product->id}}');
            let variation_list = $('#variation_list').DataTable({
                destroy: true,
                paging:false,
                searching:false,
                info:false,
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: url,
                    method: 'GET'
                },
                columns: [
                    { data: 'barcode', name: 'barcode',orderable:false,searchcable:false },
                    { data: 'variationName', name: 'variationName' },
                    { data: 'action', name: 'action' }
                ]
            });
            let variation_url = '{{route('product.variation.add',':id')}}';
            variation_url = variation_url.replace(':id', '{{$product->id}}');
            $('#add-child').click(function () {
                $.ajax({
                    type:'post',
                    url:variation_url,
                    data:{
                        '_token':'{{csrf_token()}}',
                        'variationName':$('input[name="variation[0]"]').val(),
                    },
                    success: function (data) {
                        variation_list.ajax.reload(null, false);
                    }
                })
            });
        })
    </script>
@stop
