<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table= 'empleados'; 
    protected $fillable = ['primer_nombre','apellido','email','telefono','company_id'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'company_id','id');
    }
}
