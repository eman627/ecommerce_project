<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class buyerAddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $id= DB::table('buyeraddresses')->insertGetId([
        'user_id'=>$request->user_id,
        'address_state'=>$request->address_state,
        'address_city'=>$request->address_city,
        'address_street'=>$request->address_street,
        'name'=>$request->name,
        'phone'=>$request->phone,
        'created_at'=>now(),
            'updated_at'=>now()
       ]);
       return response()->json($id,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $addresse=DB::table('buyeraddresses')->where("user_id","=",$id)->get();
        return $addresse;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('buyeraddresses')->where("id","=",$id)->delete();
        return response()->json("succesfull delete", 200);
    }
}
