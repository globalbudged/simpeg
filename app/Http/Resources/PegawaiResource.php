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
            'id'=>$this->id,
            'uuid'=>$this->uuid,
            'nip'=>$this->nip,
            'nik'=>$this->nik,
            'nama'=>$this->nama,
            'alamat'=>$this->alamat,
            'provinsi'=>$this->provinsi,
            'kabkot'=>$this->kabkot,
            'kecamatan'=>$this->kecamatan,
            'kelurahan'=>$this->kelurahan,
            'kodepos'=>$this->kodepos,
            'tempat_lahir'=>$this->tempat_lahir,
            'tanggal_lahir'=>$this->tanggal_lahir,
            'agama'=>$this->agama,
            'gender'=>$this->gender,
            'tmt'=>$this->tmt,
            'contact'=>$this->contact,
            'pendidikan'=>$this->pendidikan,
            'flag'=>$this->flag,
            'user_id'=>$this->user_id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
