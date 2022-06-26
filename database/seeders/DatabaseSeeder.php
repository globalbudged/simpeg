<?php

namespace Database\Seeders;

use App\Models\Jabatan;
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
        // \App\Models\User::factory(10)->create();
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
    }
}
