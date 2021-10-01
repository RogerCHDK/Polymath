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
            'id' => $this->id,
            'primer_nombre' => $this->primer_nombre,
            'apellido' => $this->apellido,
            'email' => $this->email ,
            'telefono' => $this->telefono,
            'company' => [
                'nombre' => $this->empresa->nombre,
                'email' => $this->empresa->email,
                'logotipo' => asset('storage/'.$this->empresa->logotipo),
                'sitio_web' => $this->empresa->sitio_web 
            ]
        ];
    }
}
