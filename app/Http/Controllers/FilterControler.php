<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use DB;

class FilterControler extends Controller
{
    public function SearchByProductName(Request $request)
    {

    $products=new ProductCollection(Product::all());
    if($request->keyword)
    {
       $products=new ProductCollection(Product::where('name','like','%'.$request->keyword.'%')->get());

    }


   return response()->json( ["data"=>$products], 200);
    }

    //Search By Category Name
    public function searchByCategoryName(Request $request)
    {

    $products=new ProductCollection(Product::all());

    if($request->keyword)
    {
        $categoryId=Category::where('name','like','%'.$request->keyword.'%')->get('id');
        foreach ($categoryId as $key => $value) {
            $products = new ProductCollection(Product::where('category_id','=',$categoryId[$key]->id)->get());

        }


    }
    return response()->json( ["data"=>$products], 200);

    }

    //Filter By Category Name
    public function filterByCategoryName(Request $request)
    {

    $products=new ProductCollection(Product::all());
    $brands=Product::select('brand')->get();
    if($request->keyword)
    {
       $products=new ProductCollection(Product::where('category_id','=',$request->keyword)->get());
       $brands=Product::where('category_id','=',$request->keyword)->get('brand');

    }

   return response()->json( ["data"=>$products,
"brand"=>$brands], 200);
    }

    public function filterByBrandName(Request $request)
    {


        $items=DB::table('products') ->where("category_id",'=',$request->id)->when($request->selected_brands, function ($query, $selected_brands) {
                    return $query->whereIn('brand',$selected_brands);
                })->when($request->price, function ($query, $price)  {
                    return $query->whereBetween('price',[$price['min'],$price['max']]);
                })->get() ;



    return response()->json( $items, 200);

    }




}
