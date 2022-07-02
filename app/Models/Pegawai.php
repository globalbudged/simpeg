<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory, 
    // SoftDeletes,
    HasUuid;

    protected $guarded = ['id'];

    public function user()
    {
       return $this->belongsTo(User::class); // ini di tabel user gak ada pegawai_id nya
    }

    public function scopeFilter($search, array $reqs)
    {
        // if (isset($reqs['q'])? $reqs['q']:false) {
        //     return $search->where('nama', 'LIKE', '%' . $reqs['q'] . '%');
        // }

        $search->when($reqs['q']??false, function($search, $query){
            return $search->where('nama', 'LIKE', '%' . $query . '%');
        });
    }
}
