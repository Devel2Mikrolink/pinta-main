<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoPagoElect extends Model
{
    protected $table ='GRUPOS_PAGOS_ELECT';

    public function relacion_cuenta_bancaria(){
        return $this->hasOne(CuentaBancaria::class,'CUENTA_BAN_ID','CUENTA_BAN_ID');
    }
}
