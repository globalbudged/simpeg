<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PegawaiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'nip' => $this->nip,
            'nik' => $this->nik,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'provinsi' => $this->provinsi,
            'kabkot' => $this->kabkot,
            'kecamatan' => $this->kecamatan,
            'kelurahan' => $this->kelurahan,
            'kodepos' => $this->kodepos,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'agama' => $this->agama,
            'gender' => $this->gender,
            'tmt' => $this->tmt,
            'contact' => $this->contact,
            "jenis_kepegawaian_id" => $this->jenis_kepegawaian_id,
            "jenis" => $this->whenLoaded('jenis'),
            "pendidikan_id" => $this->pendidikan_id,
            "kategori_id" => $this->kategori_id,
            "jurusan_id" => $this->jurusan_id,
            "jabatan_id" => $this->jabatan_id,
            "golongan_id" => $this->golongan_id,
            "ruangan_id" => $this->ruangan_id,
            "bagian_id" => $this->bagian_id,
            "flag" => $this->flag
        ];
    }
}
