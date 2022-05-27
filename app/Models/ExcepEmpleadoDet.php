<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcepEmpleadoDet extends Model
{
    protected $table = 'EXCEP_EMPLEADOS_DET';

    public function relacion_cuenta_no(){
        return $this->hasOne(CuenataNo::class,'CONCEPTO_NO_ID','CONCEPTO_NO_ID');
    }

    public function relacion_excep_empleado(){
        return $this->hasOne(ExcepEmpleado::class,'EXCEP_EMP_ID','EXCEP_EMP_ID');
    }

    public function relacion_prestamo_emp(){
        return $this->hasOne(PrestamoEmp::class,'PRESTAMO_EMP_ID','PRESTAMO_EMP_ID');
    }
}
