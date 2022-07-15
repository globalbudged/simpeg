<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PercobaanController extends Controller
{
    public function index()
    {
        // $auth=1;
        // $m=[1,2,3];
        // $userIds = Pegawai::whereIn('id', $m)->get()->filter(function($item) use($auth){
        //     $get = $item->user_id !== $auth;
        //     return $get;
        // });
        // $userIds->pluck('id');
        // // $userIds->except($auth);
        // // User::whereIn('id', $userIds)
        // //     ->get()
        // //     ->map(function($user) {
        // //         $user->delete();
        // //     });
        // return response()->json($userIds);

        $collection = collect(Pegawai::all());
        $flag = $collection->pluck('flag');
        $counted = $flag->countBy();

        return response()->json($counted);
    }
}
