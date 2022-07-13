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
            'message' => 'success',
            'result' => $data
        ];
        return response()->json($response, 201);
    }

    public function data_by_uuid()
    {
        $data = Mutation::where('uuid', request('uuid'))
            ->with(['mutasi_details', 'mutasi_details.pegawai'])->first();
        return response()->json(['message' => 'success!', 'result' => $data], 200);
    }
    public function set_status()
    {
        $data = Mutation::where('uuid', request('uuid'))->first();
        $data->flag = 1;
        $data->save();
        $data->mutasi_details()->update(['status' => 1]);
        return response()->json(['message' => 'success', 'result' => $data], 200);
    }

    public function store(Request $request)
    {
        $auth = $request->user();

        try {

            DB::beginTransaction();
            $data = Mutation::create(
                $request->only('no_mutasi', 'kode_mutasi', 'no_surat', 'tgl_surat', 'tgl_mutasi', 'jenis_kepegawaian_id')
            );
            $data->user_id = $auth->id;
            $data->save();
            DB::commit();
            /* Transaction successful. */
            return response()->json(['message' => 'Good Job! Data Sudah tersimpan', 'result' => $data], 201);
        } catch (\Exception $e) {

            DB::rollback();
            /* Transaction failed. */
            return response()->json(['message' => $e], 500);
        }
    }
}
