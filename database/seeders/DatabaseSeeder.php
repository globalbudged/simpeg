<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

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
    }
}
