<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;


class LoginController extends Controller
{

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {

            // $token=Auth::user()->createToken('mobile');
            // return ["token"=>$token->plainTextToken];
            return response(['message'=>'Successfully Login'],200);

        }
        return response(['message'=>'wrong email or password'],403);

    }

}

