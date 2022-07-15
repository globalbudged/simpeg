<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKepegawaian extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];


    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'jenis_kepegawaian_id', 'id');
    }

    public function mutation()
    {
        return $this->hasMany(Mutation::class);
    }



    public function scopeFilter($search, array $reqs)
    {
        $search->when($reqs['q'] ?? false, function ($search, $query) {
            return $search->where('nama', 'LIKE', '%' . $query . '%');
        });
    }
}
