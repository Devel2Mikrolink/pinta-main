<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcepGeneral extends Model
{
    protected $table ='EXCEP_GENERALES';

    public function relacion_concepto_no(){
        return $this->hasOne(ConceptoNo::class,'CONCEPTO_NO_ID','CONCEPTO_NO_ID');
    }

    public function relacion_depto_no(){
        return $this->hasOne(DeptoNo::class,'DEPTO_NO_ID','DEPTO_NO_ID');
    }

    public function relacion_nomina(){
        return $this->hasOne(Nomina::class,'NOMINA_ID','NOMINA_ID');
    }

    public function relacion_puesto_no(){
        return $this->hasOne(PuestoNo::class,'PUESTO_NO_ID','PUESTO_NO_ID');
    }

    public function relacion_reg_patronal(){
        return $this->hasOne(RegPatronal::class,'REG_PATRONAL_ID','REG_PATRONAL_ID');
    }
}
