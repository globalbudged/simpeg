<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\TryCatch;

class LoginController extends Controller
{
    public function index(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

       $user = User::where('email', $request->email)->first();

       if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'=> 'user tidak valid'
            ],500);
       }

       $token = $user->createToken($request->device_name)->plainTextToken;

       $response = [
        'message'=> 'success',
        'user'=> $user,
        'token'=> $token
       ];

       return response()->json($response, 201);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        // $user->currentAccessToken()->delete();
        return response()->json(['message'=>$request->header()], 201);
    //    try {
    //     return response()->json(['message'=>$request->all()], 201);
    //    } catch (\Throwable $th) {
    //     return response()->json(['message'=>$th], 201);
    //    }
    }
    public function check()
    {
        return response()->json(true, 201);
    }
}
