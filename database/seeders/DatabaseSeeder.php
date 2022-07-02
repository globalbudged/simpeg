<?php

namespace Database\Seeders;

use App\Models\Jabatan;
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
        \App\Models\User::factory(2)->create();
        // karyawan
        Pegawai::create([
            'user_id' => 1,
            'nik' => 3432432432,
            'nip' => 3432432432423,
            'nama' => 'Hasanah',
            'alamat' => 'Jl. Mboh wes lah',
            'tempat_lahir' => 'Probolinggo',
            'tanggal_lahir' => '2022-12-03',
            'gender' => 'L',
            'tmt' => '2000-03-03',
            'contact' => '081234567',
            'flag' => '',
        ]);
        Pegawai::create([
            'user_id' => 2,
            'nik' => 554747745,
            'nip' => 878087078,
            'nama' => 'Haji Asad',
            'alamat' => 'Jl. Mboh wes lah vd sfasfa',
            'tempat_lahir' => 'Jember',
            'tanggal_lahir' => '2022-12-03',
            'gender' => 'L',
            'tmt' => '2000-03-03',
            'contact' => '081234567',
            'flag' => '',
        ]);
        Pegawai::create([
            'user_id' => 3,
            'nik' => 55474774511,
            'nip' => 87808707811,
            'nama' => 'Hosnamwiyah',
            'alamat' => 'Jl. Mboh wes lah vd sfasfa',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2022-12-03',
            'gender' => 'L',
            'tmt' => '2000-03-03',
            'contact' => '081234567',
            'flag' => '',
        ]);
    }
}
