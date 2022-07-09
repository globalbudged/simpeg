<?php


namespace App\Repositories;

use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class PegawaiRepository 
{
    public function create(array $attributes)
    {
       
        return DB::transaction(function () use($attributes) {

            $created = Pegawai::query()->create([
                'nip'=>data_get($attributes, 'nip'),
                'nik'=>data_get($attributes, 'nik'),
                'nama'=>data_get($attributes, 'nama'),
                'alamat'=>data_get($attributes, 'alamat'),
                'provinsi'=>data_get($attributes, 'provinsi'),
                'kabkot'=>data_get($attributes, 'kabkot'),
                'kecamatan'=>data_get($attributes, 'kecamatan'),
                'kelurahan'=>data_get($attributes, 'kelurahan'),
                'kodepos'=>data_get($attributes, 'kodepos'),
                'tempat_lahir'=>data_get($attributes, 'tempat_lahir'),
                'tanggal_lahir'=>data_get($attributes, 'tanggal_lahir'),
                'agama'=>data_get($attributes, 'agama'),
                'gender'=>data_get($attributes, 'gender'),
                'tmt'=>data_get($attributes, 'tmt'),
                'contact'=>data_get($attributes, 'contact'),
                'pendidikan'=>data_get($attributes, 'pendidikan'),
                'flag'=>data_get($attributes, 'flag', 0),
                'user_id'=>data_get($attributes, 'user_id')
            ]);

            return $created;
            
        });

    }


    public function update()
    {
       
    }

    public function forceDelete()
    {
       
    }
}