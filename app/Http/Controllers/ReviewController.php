<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ReviewCollection;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use App\Models\orderdetails;



class ReviewController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    public function index()
    {
        return new ReviewCollection(Review::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $review=new Review;
       $review->create($request->all());
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
        $review=new ReviewCollection(Review::fine($id));
        return $review;
    }



    public function getProductToReviwe($id)
    {
        $products=[];
        $orderID=Order::where('user_id','=',$id)->where('status','=','delivered')->get();
        //return $orderID;
        if($orderID!="[]")
            {
                 foreach ($orderID as $key => $value)
                    {
                     foreach ($value->orderdetails as $key => $value)
                        {
                            array_push($products, $value->product_id);
                        }
                    }
                //  return $products;
                //  foreach ( $products as $key => $value)
                //     {
                         $items=Product::whereIn('id', $products)->get();


                    return response()->json(["products"=> $items],200);
                }
         else

             return response()->json("You Do Not make any orders yet",403);


    //
        // if($orderID!="[]")
        // {
        //     foreach ($orderID as $key => $value) {
        //         $productsID = orderdetails::where('order_id','=',$value->id)->get();

        //         foreach ($productsID as $key => $value)
        //         {
        //             array_push($products, $value->product_id);
        //         }


        //     }
        //     //return array_unique($products);
        //     foreach ( $products as $key => $value)
        //     {
        //         $items=Product::whereIn('id', $products)->get();
        //      }

        //     return $items;

        // }
        // else
        // return response()->json("You Do Not make any orders yet");


    }

}
