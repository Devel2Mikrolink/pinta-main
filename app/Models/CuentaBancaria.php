<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    protected $table = 'CUENTAS_BANCARIAS';
    protected $primaryKey = "CUENTA_BAN_ID";

    public function relacion_banco(){
        return $this->hasOne(Banco::class,'BANCO_ID','BANCO_ID');
    }
    
    public function relacion_moneda(){
        return $this->hasOne(Moneda::class,'MONEDA_ID','MONEDA_ID');
    }

    public function relacion_tipo_ctban(){
        return $this->hasOne(TipoCtaBan::class,'TIPO_CTABAN_ID','TIPO_CTABAN_ID');
    }
    
}
