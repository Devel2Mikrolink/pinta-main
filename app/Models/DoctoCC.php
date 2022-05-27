<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctoCC extends Model
{
    
    protected $table = 'DOCTOS_CC';
    

    public function relacion_cliente(){
        return $this->hasOne(Cliente::class,'CLIENTE_ID','CLIENTE_ID');
    }

    
    public function relacion_cobrador(){
        return $this->hasOne(Cobrador::class,'COBRADOR_ID','COBRADOR_ID');
    }


    
    public function relacion_condicion_pago(){
        return $this->hasOne(CondicionPago::class,'COND_PAGO_ID','COND_PAGO_ID');
    }

    
    public function relacion_cuenta_bancaria (){
        return $this->hasOne(CuentaBancaria::class,'CUENTA_BAN_ID','CUENTA_BAN_ID');
    }

    public function relacion_repositorio_cfdi (){
        return $this->hasOne(RepositorioCFDI::class,'CFDI_ASOCIADO_ID','CFDI_ASOCIADO_ID');
    }


    
}
