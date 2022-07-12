<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class JenisKepegawaianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'uuid'=>$this->uuid,
            'nama'=>$this->nama,
            'kelompok'=>$this->kelompok,
            'flag'=>$this->flag,
        ];
    }
}
