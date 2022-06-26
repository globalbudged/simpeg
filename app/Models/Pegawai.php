<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory, HasUuid;
    protected $guarded = ['id'];

    public function user()
    {
       return $this->hasOne(User::class);
    }
}
