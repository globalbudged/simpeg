<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];



    public function scopeFilter($search, array $reqs)
    {
        $search->when($reqs['q'] ?? false, function ($search, $query) {
            return $search->where('nama', 'LIKE', '%' . $query . '%');
        });
    }


    public function mutasi_details()
    {
        return $this->hasMany(MutasiDetail::class);
    }
    public function jenis_kepegawaian()
    {
        return $this->belongsTo(JenisKepegawaian::class);
    }
}
