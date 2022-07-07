<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory, HasUuid;
    protected $guarded = ['id'];

    public function scopeFilter($search, array $reqs)
    {
        $search->when($reqs['q']??false, function($search, $query){
            return $search->where('gedung', 'LIKE', '%' . $query . '%');
        });
    }
}
