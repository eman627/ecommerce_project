<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class FilterControler extends Controller
{
    // done
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
        //    done
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



    // ___________________________________ اللي جايين دول متعلقين ببعض  ______________________
    //Filter By Category Name
    public function filterByCategoryName(Request $request)
    {

    $products=new ProductCollection(Product::all());

    if($request->keyword)
    {
       $products=new ProductCollection(Product::where('category_id','=',$request->keyword)->get());

    }

   return response()->json( ["data"=>$products], 200);
    }

    public function filterByBrandName(Request $request)
    {

    $data=$request->input();

    foreach ($data as $key => $value) {
       $items=new ProductCollection (Product::whereIn('brand',$data['selected_categories'])->get());
    }

    return response()->json( $items, 200);

    }


    // filter by price



    // filter by rating

}
