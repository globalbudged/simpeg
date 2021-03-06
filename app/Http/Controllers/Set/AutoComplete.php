<?php

namespace App\Http\Controllers\Set;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\JenisKepegawaianResource;
use App\Models\Bagian;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\JenisKepegawaian;
use App\Models\JenisPhk;
use App\Models\Jurusan;
use App\Models\Kategori;
use App\Models\Pendidikan;
use App\Models\Ruangan;

class AutoComplete extends Controller
{
    public function index()
    {
        $jenisKepegawaian = JenisKepegawaianResource::collection(JenisKepegawaian::all());
        $pendidikan = Pendidikan::all()->makeHidden(['created_at', 'updated_at']);
        $kategori = Kategori::all()->makeHidden(['created_at', 'updated_at']);
        $jenis_phk = JenisPhk::all()->makeHidden(['created_at', 'updated_at']);

        $data = [
            'jenis_kepegawaian' => $jenisKepegawaian,
            'pendidikans' => $pendidikan,
            'kategoris' => $kategori,
            'jenis_phks' => $jenis_phk,
        ];

        $response = [
            'message' => 'success',
            'result' => $data
        ];
        return response()->json($response, 200);
    }

    public function jurusans()
    {
        $data = Jurusan::all()->makeHidden(['created_at', 'updated_at']);

        $response = [
            'message' => 'success',
            'result' => $data
        ];
        return response()->json($response, 200);
    }
    public function jabatans()
    {
        $data = Jabatan::all()->makeHidden(['created_at', 'updated_at']);

        $response = [
            'message' => 'success',
            'result' => $data
        ];
        return response()->json($response, 200);
    }
    public function golongans()
    {
        $data = Golongan::all()->makeHidden(['created_at', 'updated_at']);

        $response = [
            'message' => 'success',
            'result' => $data
        ];
        return response()->json($response, 200);
    }
    public function ruangans()
    {
        $data = Ruangan::all()->makeHidden(['created_at', 'updated_at']);

        $response = [
            'message' => 'success',
            'result' => $data
        ];
        return response()->json($response, 200);
    }
    public function bagians()
    {
        $data = Bagian::all()->makeHidden(['created_at', 'updated_at']);

        $response = [
            'message' => 'success',
            'result' => $data
        ];
        return response()->json($response, 200);
    }
}
