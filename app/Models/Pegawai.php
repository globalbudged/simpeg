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
    public function bagian()
    {
        return $this->belongsTo(Bagian::class); // ini di tabel gak ada foreignId nya
    }
    public function golongan()
    {
        return $this->belongsTo(Golongan::class); // ini di tabel gak ada foreignId nya
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class); // ini di tabel gak ada foreignId nya
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class); // ini di tabel gak ada foreignId nya
    }
    public function jenis()
    {
        return $this->belongsTo(JenisKepegawaian::class, 'jenis_kepegawaian_id', 'id'); // ini di tabel gak ada foreignId nya
    }

    public function mutation_details()
    {
        return $this->hasMany(MutasiDetail::class);
    }

    public function scopeFilter($search, array $reqs)
    {
        $search->when($reqs['q'] ?? false, function ($search, $query) {
            return $search->where('nama', 'LIKE', '%' . $query . '%')
                ->orWhere('nip', 'LIKE', '%' . $query . '%')
                ->orWhere('nik', 'LIKE', '%' . $query . '%');
        });

        $search->when($reqs['jenis_kepegawaian_id'] ?? false, function ($search, $query) {
            return $search->where('jenis_kepegawaian_id', $query);
        });

        // $search->when($reqs['jenis_kepegawaian_id'] ?? false, function ($search, $jenis) {
        //     return $search->whereHas('jenis', function ($search) use ($jenis) {
        //         $search->where('id', $jenis);
        //     });
        // });
    }
}
