<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisKepegawaian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JenisKepegawaianController extends Controller
{
    public function index()
    {
        $data = JenisKepegawaian::orderBy(request('order_by'), request('sort'))
            ->filter(request(['q']))
            ->paginate(request('per_page'));

        $response = [
            'message' => 'success',
            'result' => $data
        ];
        return response()->json($response, 201);
    }

    public function store(Request $request)
    {
        $auth = $request->user();


        try {

            DB::beginTransaction();

            // DATA BARU
            if (!$request->has('id')) {

                $data = JenisKepegawaian::create([
                    'nama' => $request->nama,
                    'kelompok' => $request->kelompok
                ]);


                // UPDATE DATA 
            } else {

                $data = JenisKepegawaian::find($request->id);
                // update data pegawai
                $data->update([
                    'nama' => $request->nama,
                    'kelompok' => $request->kelompok
                ]);

                $auth->log("Merubah data JENIS KEPEGAWAIAN {$data->nama}");
            }

            DB::commit();
            /* Transaction successful. */
            return response()->json(['message' => 'Success! Data sudah Tersimpan', 'result' => $request->all()], 201);
        } catch (\Exception $e) {

            DB::rollback();
            /* Transaction failed. */
            return response()->json(['message' => 'Ada Kesalahan'], 500);
        }
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        return response()->json(['message' => 'Success', 'result' => $data], 200);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $id = $request->id;

        if (is_array($id)) {
            $data = JenisKepegawaian::whereIn('id', $id);
            $query = collect($data->get())->filter(function ($item) {
                return $item->id;
            });
            $ids = $query->pluck('id');
            $nama_ = $query->pluck('nama');
            $_deletes = User::destroy($ids);
            if (!$_deletes) {
                return response()->json([
                    'message' => 'Error on Delete'
                ], 500);
            }


            $user->log("Menghapus Data JenisKepegawaian {$nama_}");
            return response()->json([
                'result' => $ids,
                'message' => 'Sukses! Data Terhapus Semua'
            ], 200);
        } else {
            $data = JenisKepegawaian::find($id);
            $del = $data->delete();
            // $del = User::destroy($data->user_id);
            if (!$del) {
                return response()->json([
                    'message' => 'Error on Delete'
                ], 500);
            }

            $user->log("Menghapus Data JenisKepegawaian {$data->nama}");
            return response()->json([
                'message' => 'Data sukses terhapus'
            ], 200);
        }
        // return response()->json([
        //     'message' => 'Tidak bisa hapus diri sendiri'
        // ],500);

    }
}
