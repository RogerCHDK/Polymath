<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
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
            'primer_nombre' => $this->primer_nombre,
            'apellido' => $this->apellido,
            'email' => $this->email ,
            'telefono' => $this->telefono,
            'company_id' => $this->company_id 
        ];
    }
}
