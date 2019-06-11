<div class="row product_id" id="{{$product->id}}">
    <div class="three wide column middle aligned">
        <img class="ui bordered image" src="{{asset($product->image)}}" alt="">
        <h5 class="m-0">{{$product->productName}}</h5>
        <div>{{$product->category}}</div>
    </div>
    <div class="thirteen wide column ui form">
        @foreach($product->variation as $value)
        <div class="six fields">
            <div class="field">
                <input type="text" disabled name="barcode" value="{{$value->barcode}}">
            </div>
            <div class="field">
                <input type="text" disabled name="variation" value="{{$value->variationName}}">
            </div>
            <div class="field">
                <input type="number" name="variation[{{$value->id}}][qty]" placeholder="ចំនួន">
            </div>
            <div class="field">
                <input type="number" step="any" name="variation[{{$value->id}}][purchase]" placeholder="តម្លៃទិញ">
            </div>
            <div class="field">
                <input type="number" step="any" name="variation[{{$value->id}}][sell]" placeholder="តម្លៃលក់">
            </div>
            <div class="field">
                <a class="ui button mini red" id="remove"><i class="remove icon"></i></a>
            </div>
        </div>
            @endforeach
    </div>
</div>
<div class="ui divider m-0"></div>
