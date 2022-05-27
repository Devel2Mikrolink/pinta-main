<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuenataNo extends Model
{
    protected $table = 'CUENTAS_NO';

    public function relacion_concepto_no(){
        return $this->hasOne(ConceptoNo::class,'CONCEPTO_NO_ID','CONCEPTO_NO_ID');
    }

    public function relacion_articulo(){
        return $this->hasOne(DeptoNo::class,'DEPTOS_NO','DEPTOS_NO');
    }
}
