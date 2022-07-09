<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\JenisKepegawaian;
use App\Models\Kategori;
use App\Models\Pegawai;
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
        Jabatan::create(['nama'=>'MANAGER']);
        Jabatan::create(['nama'=>'KEPALA RUANG / UNIT']);
        Jabatan::create(['nama'=>'SUPERVISOR / KA.INSTALASI']);
        Jabatan::create(['nama'=>'KARYAWAN']);

        // seed users
        User::create([
            'name'=> 'Hariyadi',
            'email'=> 'pharyyady@gmail.com',
            'password'=> Hash::make('141312')
        ]);
        User::create([
            'name'=> 'Admin',
            'email'=> 'admin@admin.com',
            'password'=> Hash::make('password')
        ]);
        
        Kategori::create(['nama'=> 'MEDIS']);
        Kategori::create(['nama'=> 'NON MEDIS']);
        Kategori::create(['nama'=> 'PARAMEDIS']);

        JenisKepegawaian::create(['nama'=>'PNS', 'kelompok'=> 'ASN']);
        JenisKepegawaian::create(['nama'=>'P3k', 'kelompok'=> 'ASN']);
        JenisKepegawaian::create(['nama'=>'HONORER', 'kelompok'=> 'NON ASN']);
    }
}
