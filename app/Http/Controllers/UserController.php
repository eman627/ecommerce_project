<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $users=User::where('role_id','=',"3")->get();
        // $sellers=User::where('role_id','=',"2")->get();
        // $admins=User::where('role_id','=',"1")->get();
        // return  response()->json([
        //     'users' => $users,
        //     "admin"=>$admins,
        //     'sellers'=>$sellers

        // ],200);
             $category_query=Category::with(['product']);
             if($request->keyword)
             {
                $category_query->where('name','like','%'.$request->keyword.'%');
             }
             $category=$category_query->get();

            return response()->json( ["data"=>$category], 200);
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
        $user=User::find($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }
}
