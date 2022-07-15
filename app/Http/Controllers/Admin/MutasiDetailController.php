<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MutasiDetail;
use App\Models\Mutation;
use App\Models\Pegawai;
use App\Models\PindahRuang;
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
        try {

            DB::beginTransaction();
            // if request->mutasi masuk
            if ($kode_mutasi === 'MM') {
                // masukkan user data pegawai terlebih dahulu

                // DATA BARU
                if (!$request->has('id') || !$request->has('user_id')) {
                    $request->validate([
                        'nip' => 'unique:pegawais',
                        'nik' => 'unique:pegawais',
                        'email' => 'unique:users',
                        'nama' => 'required',
                    ]);
                    $user = User::create([
                        'email' => $request->nip . '@simrs.com',
                        'name' => $request->nama,
                        'password' => Hash::make($request->nip)
                    ]);

                    $pegawai = $user->pegawai()->create($request->only([
                        'nip', 'nik', 'nama', 'alamat', 'provinsi', 'kabkot', 'kecamatan', 'kelurahan', 'kodepos', 'tempat_lahir', 'agama', 'gender', 'tmt', 'contact',
                        'pendidikan_id', 'kategori_id', 'jurusan_id', 'jabatan_id', 'golongan_id', 'ruangan_id', 'bagian_id'
                    ]));
                    $pegawai->jenis_kepegawaian_id = $mutasi->jenis_kepegawaian_id;
                    $pegawai->save();

                    $details = $mutasi->mutasi_details()->create(
                        $request->only(
                            'alamat',
                            'provinsi',
                            'kabkot',
                            'kecamatan',
                            'kelurahan',
                            'pendidikan_id',
                            'kategori_id',
                            'jurusan_id',
                            'jabatan_id',
                            'golongan_id',
                            'ruangan_id',
                            'bagian_id',
                            'kode_skpd',
                            'nama_skpd',
                            'kode_skpd_before',
                            'nama_skpd_before'
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
                        [
                            'nip',
                            'nik',
                            'nama',
                            'alamat',
                            'provinsi',
                            'kabkot',
                            'kecamatan',
                            'kelurahan',
                            'kodepos',
                            'tempat_lahir',
                            'agama',
                            'gender',
                            'tmt',
                            'contact',
                            'pendidikan_id', 'kategori_id', 'jurusan_id', 'jabatan_id', 'golongan_id', 'ruangan_id', 'bagian_id', 'jenis_kepegawaian_id'
                        ]
                    ));

                    $details = MutasiDetail::find($request->id)->update(
                        $request->only(
                            'alamat',
                            'provinsi',
                            'kabkot',
                            'kecamatan',
                            'kelurahan',
                            'pendidikan_id',
                            'kategori_id',
                            'jurusan_id',
                            'jabatan_id',
                            'golongan_id',
                            'ruangan_id',
                            'bagian_id',
                            'kode_skpd',
                            'nama_skpd',
                            'kode_skpd_before',
                            'nama_skpd_before',
                            'jenis_kepegawaian_id',
                        )
                    );
                }
            } elseif ($kode_mutasi === 'MK') { // if request->mutasi Keluar
                $pegawai = Pegawai::find($request->id);
                $pegawai->flag = 0;
                $pegawai->save();

                $details = $mutasi->mutasi_details()->create(
                    $request->only(
                        [
                            'alamat', 'provinsi', 'kabkot', 'kecamatan', 'kelurahan',
                            'pendidikan_id', 'kategori_id', 'jurusan_id', 'jabatan_id',
                            'golongan_id', 'ruangan_id', 'bagian_id', 'kode_skpd', 'nama_skpd',
                            'kode_skpd_before', 'nama_skpd_before'
                        ]
                    )
                );
                $details->jenis_kepegawaian_id = $mutasi->jenis_kepegawaian_id;
                $details->pegawai_id = $pegawai->id;
                $details->save();
            } else {
                $pegawai = Pegawai::find($request->id);
                $details = $mutasi->mutasi_details()->create(
                    $request->only(
                        [
                            'alamat', 'provinsi', 'kabkot', 'kecamatan', 'kelurahan',
                            'pendidikan_id', 'kategori_id', 'jurusan_id', 'jabatan_id',
                            'golongan_id', 'ruangan_id', 'bagian_id', 'kode_skpd', 'nama_skpd',
                            'kode_skpd_before', 'nama_skpd_before'
                        ]
                    )
                );
                $details->jenis_kepegawaian_id = $mutasi->jenis_kepegawaian_id;
                $details->pegawai_id = $pegawai->id;
                $details->save();
                $details->pindah_ruang()->create(
                    [
                        'pegawai_id' => $pegawai->id,
                        'ruangan_id_before' => $request->ruangan_id,
                        'ruangan_id_after' => $request->ruangan_id_after,
                    ]
                );
                $pegawai->ruangan_id = $request->ruangan_id_after;
                $pegawai->save();
            }
            DB::commit();
            /* Transaction successful. */
            return response()->json(['message' => 'Good Job! Data Sudah tersimpan', 'result' => $details], 201);
        } catch (\Exception $e) {

            DB::rollback();
            /* Transaction failed. */
            return response()->json(['message' => $e], 500);
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
            ], 500);
        }

        $user->log("Menghapus Data Pegawai {$pegawai->nama}");

        return response()->json([
            'message' => 'Data sukses terhapus'
        ], 200);
    }

    public function del_mutasi_keluar(Request $request)
    {
        $user = $request->user();
        $details = MutasiDetail::find($request->id);
        $pegawai = Pegawai::find($details->pegawai_id);
        $pegawai->flag = 1;
        $pegawai->save();
        $del = $details->delete();

        if (!$del) {
            return response()->json([
                'message' => 'Error on Delete'
            ], 500);
        }

        $user->log("Menghapus Details Mutasi Keluar {$pegawai->nama}");

        return response()->json([
            'message' => 'Data sukses terhapus'
        ], 200);
    }
    public function del_mutasi_antar(Request $request)
    {
        $user = $request->user();
        $details = MutasiDetail::find($request->id);
        $pegawai = Pegawai::find($details->pegawai_id);
        $ruang = PindahRuang::where('mutasi_detail_id', $details->id)->first();
        $pegawai->ruangan_id = $ruang->ruangan_id_before;
        $pegawai->save();
        $del = $details->delete();

        if (!$del) {
            return response()->json([
                'message' => 'Error on Delete'
            ], 500);
        }

        $user->log("Menghapus Details Mutasi Keluar {$pegawai->nama}");

        return response()->json([
            'message' => 'Data sukses terhapus'
        ], 200);
    }
}
