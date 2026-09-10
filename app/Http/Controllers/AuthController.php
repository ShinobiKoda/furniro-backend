<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        // Validate user input
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|min:8',
        ]);

        //create user and hash password

        $user = User::create([
            'name'=> $validated['name'],
            'email'=>$validated['email'],
            'password'=>$validated['password']
        ]);

        //generate token for user

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'=> 'Created User Sucessfully',
            'user'=>$user,
            'token'=>$token
        ]);
    }

    public function login(Request $request){
        $validated = $request->validate([
            "email"=> "required|email",
            "password"=> "required|string",
        ]);

        $user = User::where('email', $validated['email'])->first();

        if(!$user || Hash::check($validated['password'], $user->password)){
            return response()->json([
                'message'=>'Invalid Credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'=>$user,
            'token'=>$token
            ]
        );
    }

    public function user(Request $request){
        return response()->json($request->user());
    }
}
