<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoPendCC extends Model
{
    
    protected $table = 'DOCTOS_PEND_CC';
    

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }

    
    public function relacion_cobrador(){
        return $this->hasOne(Cobrador::class,'COBRADOR_ID','COBRADOR_ID');
    }

      
    public function relacion_concepto_cc(){
        return $this->hasOne(ConceptoCC::class,'CONCEPTO_CC_ID','CONCEPTO_CC_ID');
    }
    

    public function relacion_condicion_pago(){
        return $this->hasOne(CondicionPago::class,'COND_PAGO_ID','COND_PAGO_ID');
    }
    
    
    
}
