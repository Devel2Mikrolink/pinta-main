<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcepEmpleado extends Model
{
    protected $table ='EXCEP_EMPLEADOS';

    public function relacion_empleado(){
        return $this->hasOne(Empleado::class,'EMPLEADO_ID','EMPLEADO_ID');
    }
    public function relacion_nomina(){
        return $this->hasOne(Nomina::class,'NOMINA_ID','NOMINA_ID');
    }
}
