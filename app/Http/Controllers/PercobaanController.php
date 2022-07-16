<?php

namespace App\Http\Controllers;

use App\Http\Resources\PegawaiResource;
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

        $collection = PegawaiResource::collection(Pegawai::with(['jenis:id,nama,kelompok'])->get());
        $all_data = $collection->filter(function ($item) {
            return $item->flag > 0;
        })->count();
        $honorer = $collection->filter(function ($item) {
            return $item->jenis->id === 3;
        })->count();
        return response()->json($honorer);
    }
}
