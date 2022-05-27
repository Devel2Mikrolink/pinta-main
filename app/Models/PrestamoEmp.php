<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestamoEmp extends Model
{
    protected $table = 'PRESTAMOS_EMP';
    public function relacion_concepto_no(){
        return $this->hasOne(ConceptoNo::class,'CONCEPTO_NO_ID','CONCEPTO_NO_ID');
    }

    public function relacion_empleado(){
        return $this->hasOne(Empleado::class,'EMPLEADO_ID','EMPLEADO_ID');
    }
}
