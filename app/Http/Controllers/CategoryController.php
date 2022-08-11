<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
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

        $products=[];
         $brands=[];
         $category_id=0;
         $product=new Product();
        $cats= new CategoryCollection(Category::where('category_id','=',$id)->get());
        foreach ($cats as $cat ) {
            $category_id=$cat->id;
            $product= Product::where('category_id','=',$cat->id)->get();
            
            $brand=DB::table('products')->select('brand')->where('category_id','=',$cat->id)->distinct()->get();
            
            foreach ( $brand as $item){
                if(!in_array($item , $brands)){
                array_push($brands, $item); 
                }
            }

            foreach ($product as $item){
                // $email = DB::table('users')->where('name', 'John')->value('email');
              //    if(!in_array($brand, $brands)){
                //    
                //    }
    
                 
                    array_push($products, $item);
                   
            }
           
            //   $brands=array_unique($brands);
           

        }
    
    
        return response()->json( ["subcat"=>$cats,"products"=>$products,
        "brand"=>$brands], 200);

    }



}
