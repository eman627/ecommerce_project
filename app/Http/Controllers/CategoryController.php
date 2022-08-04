<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;

use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CategoryCollection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( CategoryRequest $request)
    {
        $category=new Category;
        $category->create($request->all());
       return response()->json("succesfull stor", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CategoryResource(Category::find($id));
        //return new CategoryCollection(Category::where('category_id','=',$id)->get());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id)
    {
        $category=Category::find($id);
        $category->update($request->all());
        return response()->json(new CategoryResource($category), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json("deleted is done", 200);
    }

    //return All Categories with Category_id=NULL
    public function mainCategory(Request $request)
    {
        return new CategoryCollection(Category::wherenull('category_id')->get());

    }

     //Return All SubCategory
    public function subCategory($id)
    {
        return new CategoryCollection(Category::where('category_id','=',$id)->get());

    }
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

    if($request->keyword)
    {
       $products=new ProductCollection(Product::where('category_id','=',$request->keyword)->get());

    }

   return response()->json( ["data"=>$products], 200);
    }



}
