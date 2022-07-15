<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PindahRuang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function mutasi_detail()
    {
        return $this->belongsTo(MutasiDetail::class);
    }
}
