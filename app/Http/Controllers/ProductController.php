<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('verified');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::id()==1) return new ProductCollection(Product::all());
        else
         return new ProductCollection(Product::where('quantity','>',0)->get());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)

    {  $file=$request->file('image');
        $upload_path="public/image";
       $originalName= $file->getClientOriginalName();
       $file->move($upload_path,$originalName);
         $product=new Product;
         $product->name=$request->name;
         $product->price=$request->price;
         $product->description=$request->description;
         $product->brand=$request->brand;
         $product->quantity=$request->quantity;
         $product->category_id=$request->category_id;
         $product->user_id=$request->user_id;
         $product->image=$originalName;
         $product->save();
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
        return new ProductResource(Product::find($id));
    }
  public function producterbyuser($id){
    return new ProductCollection(Product::where('user_id','=',$id)->get());

  }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product=Product::find($id);
        $product->update($request->all());
        return response()->json(new ProductResource($product), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json("deleted is done", 200);
    }
}
