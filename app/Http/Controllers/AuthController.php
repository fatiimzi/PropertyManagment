<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('authentification.register');
    }

    // Handle user registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = JWTAuth::fromUser($user);



        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);    }

    // Show login form
    public function showLoginForm()
    {
        return view('authentification.login');
    }

    // Handle user login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600,
        ]);    }


    // Handle user logout
    public function logout(Request $request)
    {

        return response()->json(['message' => 'Successfully logged out']);
    }
}


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
// use App\Models\User;
// use Tymon\JWTAuth\Facades\JWTAuth;

// class AuthController extends Controller
// {
//     // Show registration form
//     public function showRegisterForm()
//     {
//         return view('authentification.register');
//     }

//     // Handle user registration
//     public function register(Request $request)
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//         ]);

//         if ($validator->fails()) {
//             return redirect()->back()->withErrors($validator)->withInput();
//         }

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//         ]);
//         $token = JWTAuth::fromUser($user);


        
//         return response()->json(['token' => $token]);
//     }

//     // Show login form
//     public function showLoginForm()
//     {
//         return view('authentification.login');
//     }

//     // Handle user login
//     public function login(Request $request)
//     {
//         $credentials = $request->only('email', 'password');

//         if (!$token = JWTAuth::attempt($credentials)) {
//             return response()->json(['error' => 'Invalid credentials'], 401);
//         }
//         return response()->json([
//             'access_token' => $token,
//             'token_type' => 'bearer',
//             'expires_in' => 3600,
//         ]);    }


//     // Handle user logout
//     public function logout(Request $request)
//     {
//         JWTAuth::invalidate(JWTAuth::getToken());

//         return response()->json(['message' => 'Successfully logged out']);
//     }
// }
