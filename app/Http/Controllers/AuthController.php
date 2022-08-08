<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','redirectToProvider','handleProviderCallback']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // return $this->respondWithToken($token);
        return  response()->json([
            'status' => 'success',
            "token"=>$token,
            'user'=>Auth::user(),
           'user_type'=>Auth::user()->Roles->name
        ],200);
    }

// public function login(Request $request)
// {
//     $request->validate([
//         'email' => 'required|string|email',
//         'password' => 'required|string',
//     ]);
//     $credentials = $request->only('email', 'password');

//     $token = Auth::attempt($credentials);
//     if (!$token) {
//         return response()->json([
//             'status' => 'error',
//             'message' => 'Unauthorized',
//         ], 401);
//     }

//     $user = Auth::user();
//     return response()->json([
//             'status' => 'success',
//             'user' => $user,
//             'authorisation' => [
//                 'token' => $this->createNewToken($token),
//                 'type' => 'bearer',
//             ]
//         ]);

// }

public function register(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'phone' => ['unique:users','digits:11','starts_with:010,011,012','numeric']
    ]);

    $user= User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role_id' => $request->role_id,
        'phone' => $request->phone,
        'address' => $request->address,
        'password' => Hash::make($request->password),
    ]);

    $token = Auth::login($user);
    return response()->json([
        'status' => 'success',
        'message' => 'User created successfully',
        'user' => $user,
        'authorisation' => [
            'token' => $token,
            'type' => 'bearer',
        ]
    ]);
}

public function logout()
{
    Auth::logout();
    return response()->json([
        'status' => 'success',
        'message' => 'Successfully logged out',
    ]);
}

public function refresh()
{
    return response()->json([
        'status' => 'success',
        'user' => Auth::user(),
        'authorisation' => [
            'token' => Auth::refresh(),
            'type' => 'bearer',
        ]
    ]);
}

protected function respondWithToken($token)
{
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
    ]);
}


//Social Login (FaceBook and GoogleGmail)
public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'role_id'           =>3,

            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );
        //$token = $userCreated->createToken('token-name')->plainTextToken;
        $token = Auth::login($userCreated);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $userCreated,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return response()->json(['error' => 'Please login using facebook  or google'], 422);
        }
    }

}
