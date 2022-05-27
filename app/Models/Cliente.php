<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    
    protected $table = 'CLIENTES';


    public function relacion_cobrador(){
        return $this->hasOne(Cobrador::class,'COBRADOR_ID','COBRADOR_ID');
    }

    public function relacion_condicion_pago(){
        return $this->hasOne(CondicionPago::class,'COND_PAGO_ID','COND_PAGO_ID');
    }


    public function relacion_moneda(){
        return $this->hasOne(Moneda::class,'MONEDA_ID','MONEDA_ID');
    }

    public function relacion_tipo_cliente(){
        return $this->hasOne(TipoCliente::class,'TIPO_CLIENTE_ID','TIPO_CLIENTE_ID');
    }

    public function relacion_vendedor(){
        return $this->hasOne(Vendedor::class,'VENDEDOR_ID','VENDEDOR_ID');
    }
    
    
    public function relacion_zona_cliente(){
        return $this->hasOne(ZonaCliente::class,'ZONA_CLIENTE_ID','ZONA_CLIENTE_ID');
    }

    
}
