<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagoNomina extends Model
{
    protected $table = 'PAGOS_NOMINA';

    public function relacion_cuenta_bancaria(){
        return $this->hasOne(CuentaBancaria::class,'CUENTA_BAN_ID','CUENTA_BAN_ID');
    }


    public function relacion_depto_no(){
        return $this->hasOne(DeptoNo::class,'DEPTO_NO_ID','DEPTO_NO_ID');
    }

    public function relacion_empleado(){
        return $this->hasOne(Empleado::class,'EMPLEADO_ID','EMPLEADO_ID');
    }

    public function relacion_nomina(){
        return $this->hasOne(Nomina::class,'NOMINA_ID','NOMINA_ID');
    }
    
    public function relacion_puesto_no(){
        return $this->hasOne(PuestoNo::class,'PUESTO_NO_ID','PUESTO_NO_ID');
    }
}
