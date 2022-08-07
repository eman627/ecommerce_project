<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
<<<<<<< HEAD
=======

>>>>>>> 5e2f2cd9ea91b394df23bf05ddf43471bab00bbe
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function index(Request $request)
    {
        $users=User::where('role_id','=',"3")->get();
        $sellers=User::where('role_id','=',"2")->get();
        $admins=User::where('role_id','=',"1")->get();
        return  response()->json([
            'users' => $users,
            "admin"=>$admins,
            'sellers'=>$sellers

        ],200);


    }
<<<<<<< HEAD
=======

>>>>>>> 5e2f2cd9ea91b394df23bf05ddf43471bab00bbe
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
    // show login button view
    public function socialLogin(){
        return view("login");
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $socialuser = Socialite::driver('google')->user();
        // dd($socialuser->getAvatar());

        $user      =   User::where(['email' => $socialuser->getEmail()])->first();
        if(!$user){
            $user = User::firstOrCreate([
                'name'          => $socialuser->getName(),
                'email'         => $socialuser->getEmail(),
                'role_id'       =>3,
                'password'      =>encrypt('123456dummy')
            ]);
        }

        // Auth::login($user);
        return  ('welcom in home page');
    }

}
