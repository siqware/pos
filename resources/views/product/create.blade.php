@extends('layouts.dashboard')
@section('title')
    បន្ថែមទំនិញថ្មី
@stop
@section('content')
    <div class="row">
        <div class="column">
            <div class="ui segments stacked">
                <div class="ui segment">
                    <h5 class="ui header">
                        បន្ថែមទំនិញថ្មី
                    </h5>
                </div>
                {{Form::open(['url'=>route('product.store'),'method'=>'post','class'=>'ui form segment'])}}
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
                                        <img id="profile_holder" src="{{asset('/files/1/placholder.png')}}" style="margin-top:15px;max-height:100px;">
                                    </div>
                                    <input id="profile" type="hidden" value="/files/1/placholder.png" name="product_picture">
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
                                        <input type="text" name="product_name" placeholder="ឈ្មោះទំនិញ">
                                    </div>
                                    <div class="field">
                                        <label>ប្រភេទទំនិញ</label>
                                        <div class="ui search selection allowAdditions category dropdown" id="province">
                                            <input type="hidden" name="product_category" placeholder="ប្រភេទទំនិញ">
                                            <i class="dropdown icon"></i>
                                            <input type="text" class="search">
                                            <div class="default text">ជ្រើសរើស ប្រភេទទំនិញ</div>
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
                                <i id="variation_add" class="circular olive add icon link popupHover" data-content="បន្ថែម" data-variation="mini"></i>
                            </td>
                            <td id="append_variation">
                                <div class="three fields mb-1">
                                    <div class="field">
                                        <label>ប្រភេទទំនិញ</label>
                                        <div class="ui search selection allowAdditions variation dropdown" id="province">
                                            <input type="hidden" name="variation[0]">
                                            <i class="dropdown icon"></i>
                                            <input type="text" class="search">
                                            <div class="text"></div>
                                        </div>
                                    </div>
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
            let key = 1;
            $('#variation_add').on('click',function () {
                let content = '<div class="three fields mb-1">\n' +
                    '                                    <div class="field">\n' +
                    '                                        <div class="ui search selection allowAdditions variation dropdown" id="province">\n' +
                    '                                            <input type="hidden" name="variation[%key%]">\n' +
                    '                                            <i class="dropdown icon"></i>\n' +
                    '                                            <input type="text" class="search">\n' +
                    '                                            <div class="text"></div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="field">\n' +
                    '                                        <i id="variation_remove" class="circular pink remove icon link popupHover" data-content="លុបច" data-variation="mini"></i>\n' +
                    '                                    </div>\n' +
                    '                                </div>';
                content = content.replace('%key%',key);
                $('#append_variation').append(content);
                additionDropdownVariation('.ui.allowAdditions.variation','{{route('product.variation')}}');
                key++;
            });
            $('#append_variation').on('click',function (event) {
                let remove_id = event.target.id;
                let remove_node = event.target.parentNode.parentNode;
                if (remove_id === 'variation_remove'){
                    $(remove_node).remove();
                }

            })
        })
    </script>
@stop
