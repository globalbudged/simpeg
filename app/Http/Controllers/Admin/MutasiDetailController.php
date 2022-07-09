<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MutasiDetail;
use App\Models\Mutation;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MutasiDetailController extends Controller
{
    
    public function store(Request $request)
    {
        $auth = $request->user();

        $mutasi = Mutation::find($request->mutation_id);
        $kode_mutasi = $mutasi->kode_mutasi;
        try{
            
            DB::beginTransaction();
            // if request->mutasi masuk
            if ($kode_mutasi === 'MM') {
                // masukkan user data pegawai terlebih dahulu

                // DATA BARU
                if (!$request->has('id') || !$request->has('user_id') ) {
                    $request->validate([
                        'nip' => 'unique:pegawais',
                        'nik' => 'unique:pegawais',
                        'email' => 'unique:users',
                        'nama' => 'required',
                    ]);
                    $user = User::create([
                        'email' => $request->nip.'@simrs.com',
                        'name' => $request->nama,
                        'password' => Hash::make($request->nip)
                    ]);
    
                    $pegawai = $user->pegawai()->create($request->only([
                        'nip','nik','nama','alamat', 'provinsi','kabkot','kecamatan','kelurahan','kodepos','tempat_lahir','agama','gender','tmt','contact','pendidikan','flag',
                    ]));
    
                    $details = $mutasi->mutasi_details()->create(
                        $request->only('alamat', 'provinsi', 'kabkot', 'kecamatan', 'kelurahan', 'pendidikan_id'
                            ,'kategori_id', 'jurusan_id','jabatan_id','golongan_id','ruangan_id'
                            ,'bagian_id','kode_skpd','nama_skpd','kode_skpd_before','nama_skpd_before'
                        )
                    );
                    $details->jenis_kepegawaian_id = $mutasi->jenis_kepegawaian_id;
                    $details->pegawai_id = $pegawai->id;
                    $details->save();
                } else {
                    // edit data
                    $user = User::find($request->user_id);
                    // update data pegawai
                    $pegawai = $user->pegawai()->update($request->only(
                        'nip','nik','nama','alamat', 'provinsi','kabkot','kecamatan','kelurahan','kodepos','tempat_lahir','agama','gender','tmt','contact','pendidikan','flag',
                    ));

                    $details = MutasiDetail::find($request->id)->update(
                        $request->only('alamat', 'provinsi', 'kabkot', 'kecamatan', 'kelurahan', 'pendidikan_id'
                            ,'kategori_id', 'jurusan_id','jabatan_id','golongan_id','ruangan_id'
                            ,'bagian_id','kode_skpd','nama_skpd','kode_skpd_before','nama_skpd_before'
                            ,'jenis_kepegawaian_id', ''
                        )
                    );
                }
                
            }
            DB::commit();
           /* Transaction successful. */
            return response()->json(['message'=>'Good Job! Data Sudah tersimpan', 'result'=> $details],201);
        }catch(\Exception $e){       
        
            DB::rollback();
            /* Transaction failed. */
            return response()->json(['message'=>$e],500);
        }
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $details = MutasiDetail::find($request->id);
        $pegawai = Pegawai::find($details->pegawai_id);
        $del = $pegawai->user()->delete();
        $details->delete();

        if (!$del) {
            return response()->json([
                'message' => 'Error on Delete'
            ],500);
        }

        $user->log("Menghapus Data Pegawai {$pegawai->nama}");

        return response()->json([
            'message' => 'Data sukses terhapus'
        ],200); 

    }
}
