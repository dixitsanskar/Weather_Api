<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        try{
            $validateUser = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
            );

            if($validateUser->fails())
            {
                return \response()->json(['status' => false,
                'message' => 'validation error', 'error'=> $validateUser->errors()],401);
            }
           
            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $ApiToken = $user->createToken("API TOKEN")->plainTextToken;
            User::where('id',$user->id)->update(['api_token' => $ApiToken]);
            return \response()->json(['status' => true,
            'message' => 'User created Successfully', 'token'=>$ApiToken],200);
        }catch(Throwable $th){
        return \response()->json(['status' => false,
        'message' => $th->getMessage()],500);

        }
    }

    public function login(Request $request)
    {
        try{
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
            );

            if($validateUser->fails())
            {
                return \response()->json(['status' => false,
                'message' => 'validation error', 'error'=> $validateUser->errors()],401);
            }

            if(!Auth::attempt($request->only(['email','password'])))
            {
             return \response()->json(['status' => false,
                'message' => 'Email & Password did not match', ],401);
            }


            $user = User::where('email',$request->email)->first();

            return \response()->json(['status' => true,
            'message' => 'User Logged In Successfully'],200);

        }catch(Throwable $th){
        return \response()->json(['status' => false,
        'message' => $th->getMessage()],500);

        }
    }
}
