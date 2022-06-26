<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me()
    {
        $auth = Auth::user();
        return response()->json([
            'message'=>'success',
            'result'=> $auth
        ]);
    }
}
