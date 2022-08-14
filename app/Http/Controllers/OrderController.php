<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\orderdetails;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
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
          return  OrderResource::collection( Order::all()) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     DB::beginTransaction();
    try{
        $order = new Order();
        // $order->status=$request->status;
        $order->address_state=$request->address_state;
        $order->address_city=$request->address_city;
        $order->address_street=$request->address_street;
        $order->copoun=$request->copoun;
        $order->user_id=$request->user_id;
        $order->name=$request->name;
        $order->phone=$request->phone;
        $order->comment=$request->comment;
        $order->price=$request->price;
        $order->payment_id=$request->payment_id;
        $order->save();
        $items = Cart::where('user_id','=',$request->user_id)->get();
        foreach( $items as $item ){
            $orderItem = new orderdetails;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->save();
            // Product::where(['id' => $item['product_id'])
           $product= Product::find($item['product_id']);
           $product->update([
           $product->quantity -=  $item['quantity']
        ]);
        }
        Cart::where('user_id','=',$request->user_id)->delete();
      DB::commit();
    }catch (\Exception $e ){
        DB::rollBack();
    }

    return response()->json($items);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OrderResource( Order::find($id)) ;
        // return Order::find($id);
    }
    public function showorderofuser($user_id){

        return OrderResource::collection(Order::where('user_id', '=', $user_id)->get());
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
        $order=Order::find($id);
        // if($order->status!="done"){
        //     $order->status=$request->status;
        //    return response()->json(new OrderResource($order), 200);
        //     }
        $order->update($request->all());
        return response()->json(new OrderResource($order), 200);
        // return response()->json(["message=>not allow to update status  order"], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(["message=>not allow to delete order"], 403);
    }

//    for getting
     public function  getCopoun(Request $request){
        $copoun=random_int(100000, 999999);//Generate copoun
        $id=$request->user_id;
        DB::table('copouns')->insert(['user_id'=>$id,'copoun'=>$copoun]);
        $subject = " your copoun to get free shipping  from Lorem.";
        $email=$request->email;
        $name=$request->name;
        Mail::send('copounMaile', ['name' =>$name , 'copoun'=>$copoun],
            function($mail) use ( $subject,$email,$name){
                $mail->from('gradproj763@gmail.com', "From Lorem");
                $mail->to($email, $name);
                $mail->subject($subject);
            });
            return response()->json("message=>email is sent successfully");
    }



    // public function trackingOrder(Request $request){
    //     Order::where('order_id', '=',$request->order_id)->get();
    //     $items=orderdetails::where('order_id', '=',$request->order_id)->get();
    // }
}
