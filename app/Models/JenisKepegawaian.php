<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKepegawaian extends Model
{
    use HasFactory, HasUuid;
    
    protected $guarded = ['id'];
}