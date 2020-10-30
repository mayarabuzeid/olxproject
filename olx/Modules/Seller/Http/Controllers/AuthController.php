<?php

namespace Modules\Seller\Http\Controllers;
use Modules\Seller\Entities\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
   {
        $validatedData = $request->validate([
            'name'=>'required|max:55',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed',
            'mobileNo'=>'required|max:20'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);
       
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user'=> $user, 'access_token'=> $accessToken]);
       
   }
   public function login(Request $request)
   {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
       
        if(!auth()->attempt($loginData)) {
            return response(['message'=>'Invalid Email or Password']);
        }
       if(!$request->user()->hasVerifiedEmail()) {
           return response(['message'=>'Email not verified']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

   }
}
