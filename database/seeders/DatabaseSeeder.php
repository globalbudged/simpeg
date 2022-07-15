<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\JenisKepegawaian;
use App\Models\JenisPhk;
use App\Models\Kategori;
use App\Models\Pegawai;
use App\Models\Satker;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::create(['nama' => 'MANAGER']);
        Jabatan::create(['nama' => 'KEPALA RUANG / UNIT']);
        Jabatan::create(['nama' => 'SUPERVISOR / KA.INSTALASI']);
        Jabatan::create(['nama' => 'KARYAWAN']);

        // seed users
        User::create([
            'name' => 'Hariyadi',
            'email' => 'pharyyady@gmail.com',
            'password' => Hash::make('141312')
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        Kategori::create(['nama' => 'MEDIS', 'flag' => 0]);
        Kategori::create(['nama' => 'NON MEDIS', 'flag' => 0]);
        Kategori::create(['nama' => 'PARAMEDIS', 'flag' => 0]);

        JenisKepegawaian::create(['nama' => 'PNS', 'kelompok' => 'ASN', 'flag' => 0]);
        JenisKepegawaian::create(['nama' => 'P3K', 'kelompok' => 'ASN', 'flag' => 0]);
        JenisKepegawaian::create(['nama' => 'HONORER', 'kelompok' => 'NON ASN', 'flag' => 0]);

        JenisPhk::create(['nama' => 'MENGUNDURKAN DIRI', 'flag' => 0]);
        JenisPhk::create(['nama' => 'DIBERHENTIKAN', 'flag' => 0]);

        Satker::create(['nama' => 'DINAS PENDIDIKAN', 'flag' => 0]);
        Satker::create(['nama' => 'DINAS PERHUBUNGAN', 'flag' => 0]);
    }
}
