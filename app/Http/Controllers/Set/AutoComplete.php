<?php

namespace App\Http\Controllers\Set;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisKepegawaian;
use App\Models\Jurusan;
use App\Models\Kategori;
use App\Models\Pendidikan;

class AutoComplete extends Controller
{
    public function index()
    {
        $jenisKepegawaian = JenisKepegawaian::all()->makeHidden(['created_at', 'updated_at']);
        $pendidikan = Pendidikan::all()->makeHidden(['created_at', 'updated_at']);
        $kategori = Kategori::all()->makeHidden(['created_at', 'updated_at']);

        $data = [
            'jenis_kepegawaian'=> $jenisKepegawaian,
            'pendidikans'=> $pendidikan,
            'kategoris'=> $kategori,
        ];

        $response = [
            'message'=> 'success',
            'result'=> $data
        ];
        return response()->json($response, 200);
    }

    public function jurusans()
    {
        $data = Jurusan::filter(request(['q']))->take(20)->get();

        $response = [
            'message'=> 'success',
            'result'=> $data
        ];
        return response()->json($response, 201);
    }
}
