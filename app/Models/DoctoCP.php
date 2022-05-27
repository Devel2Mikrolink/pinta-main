<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoCP extends Model
{
    
    protected $table = 'DOCTOS_CP';

    public function relacion_concepto_cp(){
        return $this->hasOne(ConceptoCP::class,'CONCEPTO_CP_ID','CONCEPTO_CP_ID');
    }
    
    public function relacion_condiciones_pago(){
        return $this->hasOne(CondicionPago::class,'COND_PAGO_ID','COND_PAGO_ID');
    }
    public function relacion_proveedor(){
        return $this->hasOne(Provedor::class,'PROVEEDOR_ID','PROVEEDOR_ID');
    }

    
}
