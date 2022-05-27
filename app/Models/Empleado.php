<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'EMPLEADOS';

    public function relacion_ciudad(){
        return $this->hasOne(Ciudad::class,'CIUDAD_ID','CIUDAD_ID');
    }


    public function relacion_ciudad_nacimiento(){
        return $this->hasOne(Ciudad::class,'CIUDAD_NACIMIENTO_ID','CIUDAD_ID');
    }

    public function relacion_depto_no(){
        return $this->hasOne(DeptoNo::class,'DEPTO_NO_ID','DEPTO_NO_ID');
    }


    public function relacion_frcuencia_pago(){
        return $this->hasOne(FrecuenciaPago::class,'FREPAG_ID','FREPAG_ID');
    }


    public function relacion_grupo_pago_elect(){
        return $this->hasOne(GrupoPagoElect::class,'GRUPO_PAGO_ELECT_ID','GRUPO_PAGO_ELECT_ID');
    }

    public function relacion_puesto_no(){
        return $this->hasOne(PuestoNo::class,'PUESTO_NO_ID','PUESTO_NO_ID');
    }

    public function relacion_reg_patronal(){
        return $this->hasOne(RegPatronal::class,'REG_PATRONAL_ID','REG_PATRONAL_ID');
    }

    public function relacion_tabla_no(){
        return $this->hasOne(TablaNo::class,'TABLA_ANTIG_ID','TABLA_ANTIG_ID');
    }
}
