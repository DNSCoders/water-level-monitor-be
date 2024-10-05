<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register a new user
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return response()->json(['message' => 'User successfully registered'], 201);
    // }

    // User login
    public function login(Request $request)
    {
        $credentials = $request->only('phone_number', 'password');

    // Find the user by phone_number (which is actually checking the email)
        $user = User::with('pob')->where('email', $credentials['phone_number'])->first();

        if (!$user ) {
            return response()->json(['status'=>404,'message' => "User doesn't exist"]);
        }

        if(!Hash::check($credentials['password'], $user->password)){
            return response()->json(['status'=>401,'message' => "Wrong Password"]);
        }

        // Attempt to log in the user and generate JWT token
        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    // Logout the user
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    // Refresh JWT token
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    // Get the authenticated user
    public function me()
    {
        return response()->json(auth()->user());
    }

    // Respond with token structure
    protected function respondWithToken($token)
    {
        return response()->json([
            'status'=>200,
            'message'=>'Login Success',
            'data'=>[
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'data' => auth()->user()
            ]
        ]);
    }
}
