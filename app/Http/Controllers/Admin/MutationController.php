<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mutation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MutationController extends Controller
{
    public function index()
    {
        $data = Mutation::filter(request(['q']))
                ->paginate(request('per_page'))
                ->latest();

        $response = [
            'message'=> 'success',
            'result'=> $data
        ];
        return response()->json($response, 201);
    }

    public function store(Request $request)
    {
        // $auth = $request->user();
        
        try{
            
            DB::beginTransaction();

            $data = Mutation::create([
                'no_mutasi'=> $request->no_mutasi,
                'kode_mutasi'=>$request->kode_mutasi,
                'no_surat'=>$request->no_surat,
                'tgl_surat'=>$request->tgl_surat,
                'tgl_mutasi'=>$request->tgl_mutasi,
                'tgl_entry'=>$request->tgl_entry,
                'jenis_kepegawaian_id'=>$request->jenis_kepegawaian_id
            ]);
            DB::commit();
           /* Transaction successful. */
            return response()->json(['message'=>'Good Job! Data Sudah tersimpan', 'result'=> $data],201);
        }catch(\Exception $e){       
        
            DB::rollback();
            /* Transaction failed. */
            return response()->json(['message'=>$e],500);
        }
    }
}
