<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoNominaDet extends Model
{
    protected $table = 'PAGOS_NOMINA_DET';

    public function relacion_concepto_no(){
        return $this->hasOne(ConceptoNo::class,'CONCEPTO_NO_ID','CONCEPTO_NO_ID');
    }

    public function relacion_empleado(){
        return $this->hasOne(Empleado::class,'EMPLEADO_ID','EMPLEADO_ID');
    }

    public function relacion_pago_nomina(){
        return $this->hasOne(PagoNomina::class,'PAGO_NOMINA_ID','PAGO_NOMINA_ID');
    }

    public function relacion_prestamo_emp(){
        return $this->hasOne(PrestamoEmp::class,'PRESTAMO_EMP_ID','PRESTAMO_EMP_ID');
    }


 
}
