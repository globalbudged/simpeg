<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        /**
         *  untuk menampilkan seluruh data termasuk yang terhapus
         *  Pegawai::withTrashed()->get()
         * 
         */

        /**
         *  untuk menampilkan yang terhapus saja
         *  Pegawai::onlyTrashed()->get() 
         * 
         */
        
        // $data = Pegawai::with('user')->orderBy(request()->order_by, request()->sort)
        // ->when(request('q'), function ($search) {
        //     $search->orWhere('nama', 'LIKE', '%' . request()->q . '%');
        // })
        // ->paginate(request('per_page'));
        $data = Pegawai::with('user')
                ->orderBy(request('order_by'), request('sort'))
                ->filter(request(['q']))
                ->paginate(request('per_page'));

        $response = [
            'message'=> 'success',
            'result'=> $data
        ];
        return response()->json($response, 201);
    }

    public function store(Request $request)
    {
        $auth = $request->user();

        
        try{
            
            DB::beginTransaction();

            $new_pass = $request->password;
            $password = '';
            // DATA BARU
            if (!$request->has('id') || !$request->has('user_id')) {
                empty($request->input('password')) ?
                $password = $request->nip : $password = $new_pass;

                $request->validate([
                    'nip' => 'unique:pegawais',
                    'nik' => 'unique:pegawais',
                    'email' => 'unique:users',
                    'nama' => 'required',
                ]);

                $user = User::create([
                    'email' => $request->email,
                    'name' => $request->nama,
                    'password' => Hash::make($password)
                ]);
                $user->pegawai()->create([
                    'nip'=>$request->nip,
                    'nik'=>$request->nik,
                    'nama'=>$request->nama,
                    'alamat'=>$request->alamat,
                    'provinsi'=>$request->provinsi,
                    'kabkot'=>$request->kabkot,
                    'kecamatan'=>$request->kecamatan,
                    'kelurahan'=>$request->kelurahan,
                    'kodepos'=>$request->kodepos,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'tanggal_lahir'=>$request->tanggal_lahir,
                    'agama'=>$request->agama,
                    'gender'=>$request->gender,
                    'tmt'=>$request->tmt,
                    'contact'=>$request->contact,
                    'pendidikan'=>$request->pendidikan,
                    'flag'=>$request->flag,
                    'user_id'=>$user->id
                ]);

                
                $auth->log("Memasukkan data PEGAWAI {$user->name}");

            // UPDATE DATA LAMA
            } else {
                $user = User::find($request->user_id);

                // $data = User::find($request->user_id);
                $user->update([
                    'email' => $request->email,
                    'name' => $request->nama,
                ]);
                // jika ada isian password diubah
                if (!empty($request->input('password'))) {
                    $user->update(['password' => Hash::make($request->password)]);
                }
                // update data pegawai
                $user->pegawai()->update([
                    'nip'=>$request->nip,
                    'nik'=>$request->nik,
                    'nama'=>$request->nama,
                    'alamat'=>$request->alamat,
                    'provinsi'=>$request->provinsi,
                    'kabkot'=>$request->kabkot,
                    'kecamatan'=>$request->kecamatan,
                    'kelurahan'=>$request->kelurahan,
                    'kodepos'=>$request->kodepos,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'tanggal_lahir'=>$request->tanggal_lahir,
                    'agama'=>$request->agama,
                    'gender'=>$request->gender,
                    'tmt'=>$request->tmt,
                    'contact'=>$request->contact,
                    'pendidikan'=>$request->pendidikan,
                    'flag'=>$request->flag,
                ]);

                $auth->log("Merubah data PEGAWAI {$user->name}");
            }
        
            DB::commit();
           /* Transaction successful. */
            return response()->json(['message'=>'Success', 'result'=> $request->all()],201);
        }catch(\Exception $e){       
        
            DB::rollback();
            /* Transaction failed. */
            return response()->json(['message'=>'Ada Kesalahan'],500);
        }
    }

    public function edit(Request $request)
    {
       $data = $request->all();
       return response()->json(['message'=>'Success', 'result'=> $data],200);
    }

    public function destroy(Request $request)
    {   
        // $data = Pegawai::whereIn('id', $request->id)->get();
        // foreach ($data as $key) {
        //     $old_path = $key->image;
        //     Storage::delete('public/'.$old_path);
        // }
        
        /**
         *  untuk menghapus permanen gunakan kode dibawah ini
         *  Pegawai::whereIn('id', $request->id)->forceDelete();
         * 
         * 
         * juga bagian yang terelasi
         * $flight->history()->forceDelete();
         * 
         */

       
        $user = $request->user();
        $id = $request->id;
        $auth = auth()->user()->id;
        if (is_array($id)) {
            $data = Pegawai::whereIn('id', $id);
            $query = collect($data->get())->filter(function($item) use($auth){
                return $item->user_id !== $auth;
            });
            $userIds = $query->pluck('id');
            $nama_user = $query->pluck('nama');
            //user dihapus 
            // $user = User::whereIn('id',$userIds)->get(); 
            // $user_deletes = $user->toQuery()->delete();
            $user_deletes = User::destroy($userIds);
            if (!$user_deletes) {
                return response()->json([
                    'message' => 'Error on Delete'
                ],500);
            }
            
            
            $user->log("Menghapus Data Pegawai {$nama_user}");
            return response()->json([
                'result'=> $userIds,
                'message' => 'Sukses! Data Terhapus Semua'
            ],200); 
        }

        
        if ($id !== $auth) {
            
            $data = Pegawai::find($id);
            $del = $data->user()->delete();
            // $del = User::destroy($data->user_id);
            if (!$del) {
                return response()->json([
                    'message' => 'Error on Delete'
                ],500);
            }

            $user->log("Menghapus Data Pegawai {$data->nama}");
            return response()->json([
                'message' => 'Data sukses terhapus'
            ],200); 
        }
        return response()->json([
            'message' => 'Tidak bisa hapus diri sendiri'
        ],500);
        
    }
}
