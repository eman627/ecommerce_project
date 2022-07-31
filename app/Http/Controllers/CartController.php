<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Resources\CartResource;
use App\Http\Resources\CartCollection;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return new CartCollection (Cart::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $cart=new Cart;
        // if ($cart->quantity!=0)
        // {
            $cart->price=$request->price;
            $cart->quantity=$request->quantity;
            $cart->product_id=$request->product_id;
            //$cart->user_id=auth()->id();
            $cart->save();
            return response()->json("succesfully store", 200);
        // }
        // return response()->json("not available in the  store", 403);



    //     $cart=new Cart;
    //     $cart->create($request->all());
    //    return response()->json("succesfully store", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CartCollection (Cart::where('user_id','=',$id)->get());

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
        $cart=Cart::where('user_id','=',$id)->get();
        $cart->update($request->all());
        return response()->json($cart, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::where('product_id','=',$id)->delete();
        return response()->json("deleted is done", 200);
    }
}
