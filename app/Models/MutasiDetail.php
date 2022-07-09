<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiDetail extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = ['id'];

    public function mutasi()
    {
       return $this->belongsTo(Mutation::class);
    }

    public function pegawai()
    {
       return $this->belongsTo(Pegawai::class);
    }
}
