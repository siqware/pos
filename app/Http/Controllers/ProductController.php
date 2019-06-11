<?php

namespace App\Http\Controllers;
use Faker\Generator as Faker;
use App\Product;
use App\Variation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function product_view_json(Request $request){
        $input = $request->all();
        $product = Product::findOrFail($input['product_id']);
        $variations = $product->variations;
        return $product_data = [
            'productName' => $product->productName,
            'image' => $product->image,
            'category' => $product->category,
            'variations' => $variations,
        ];
    }
    public function variation_add(Request $request, $id, Faker $faker){
        $input = $request->all();
        $product = Product::findOrFail($id);
        $product->variation()->create([
            'barcode' => $faker->ean8,
            'variationName' => $input['variationName']
        ]);
    }
    public function product_variation_json($id){
        $product = Product::findOrFail($id);
        $variations = $product->variations;
        return Datatables::of($variations)
            ->addColumn('action', function ($variations) {
                return '<form method="post" action="'.route('variation.destroy',$variations->id).'">
<div class="ui m-0">
'.csrf_field().method_field('delete').'
<button class="mini ui button px-2 pink"><i class="remove icon"></i></button>
</div>
</form>';
            })
            ->toJson();
    }
    public function product_json()
    {
        $product = Product::all();
        return Datatables::of($product)
            ->addColumn('action', function ($product) {
                return '<form method="post" action="'.route('product.destroy',$product->id).'">
<div class="ui buttons m-0">
'.csrf_field().method_field('delete').'
<a id="product-'.$product->id.'" class="mini ui button px-2 olive modalshow"><i class="eye icon"></i></a>
<a href="' . route('product.edit', $product->id) . '" class="mini ui button px-2 green"><i class="edit icon"></i></a>
<button class="mini ui button px-2 pink"><i class="remove icon"></i></button>
</div>
</form>';
            })
            ->addColumn('image', function ($product) {
                return '<img class="ui avatar image" src="'.asset($product->image).'" alt="">';
            })
            ->rawColumns(['action','image'])
            ->toJson();
    }
    public function product_category(){
        $products = Product::select(['category'])->groupBy(['category'])->get();
        $product_data = [];
        foreach ($products as $product){
            $product_data[] = [
                'name'=>$product->category,
                'value'=>$product->category,
                'text'=>$product->category
            ];
        }
        $product_format = [
            'success'=>true,
            'results'=>$product_data,
        ];
        return $product_format;
    }
    public function product_variation(){
        $variations = Variation::select(['variationName'])->groupBy(['variationName'])->get();
        $variation_data = [];
        foreach ($variations as $variation){
            $variation_data[] = [
                'name'=>$variation->variationName,
                'value'=>$variation->variationName,
                'text'=>$variation->variationName,
                'selected'=>true,
            ];
        }
        $variation_format = [
            'success'=>true,
            'results'=>$variation_data,
        ];
        return $variation_format;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Faker $faker)
    {
        $input = $request->all();
        $product = new Product();
        $product->productName = $input['product_name'];
        $product->image = $input['product_picture'];
        $product->category = $input['product_category'];
        $product->save();
        $variation_data = [];
        foreach ($input['variation'] as $value){
            $variation_data[]=[
                'variationName'=>$value,
                'barcode'=>$faker->ean8
            ];
        }
        if ($product){
            $product->variations()->createMany($variation_data);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $product = Product::findOrFail($id);
        $product->productName = $input['product_name'];
        $product->image = $input['product_picture'];
        $product->category = $input['product_category'];
        $product->save();
        if ($product){
            return redirect(route('product.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();
        if ($product){
            return redirect()->back();
        }
    }
}
