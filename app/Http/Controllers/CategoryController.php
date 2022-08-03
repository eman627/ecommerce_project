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

    //filter by category
    public function mainCategory(Request $request)
    {
        return new CategoryCollection(Category::wherenull('category_id')->get());

//         $category=Product::all();
//     if($request->keyword)
//     {
//        $category=Product::where('name','like','%'.$request->keyword.'%')->get();

//     }
//     if($request->keyword)
//     {
//        $category=Product::where('category_id','=',$request->keyword)->get();

//     }
//     // $category=Category::with(['category'])->get();

//    return response()->json( ["data"=>$category], 200);
    }
    public function subCategory($id)
    {
        return new CategoryCollection(Category::where('category_id','=',$id)->get());

    }


    public function filterByProductName(Request $request)
    {

    $category=Product::all();
        if($request->keyword)
        {
           $category=Product::where('name','like','%'.$request->keyword.'%')->get();

        }
         return response()->json( ["data"=>$category], 200);

    }






}
