<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ReviewCollection;
use App\Http\Resources\ReviewResource;
use App\Models\Review;

class ReviewController extends Controller
{
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
        $review=Review::where('product_id','=',$id)->select('feedback','rating','user_id','product_id')->get();
        return $review;
    }
}
